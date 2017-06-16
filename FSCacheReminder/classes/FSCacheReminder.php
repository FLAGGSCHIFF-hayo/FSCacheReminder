<?php

class FSCacheReminder extends \Controller{

    public function addReminder($strBuffer, $strTemplate)
    {
        $objUser = BackendUser::getInstance();
        $getsreminder = true;
        $relevant_groups = deserialize($GLOBALS['TL_CONFIG']['cachereminder_usergroups']);
        if($relevant_groups){
            if ($objUser->admin && in_array('ad', $relevant_groups)) {
                $getsreminder = false;
            } else {
                foreach ($objUser->groups as $group) {
                    if (in_array($group, $relevant_groups)) {
                        $getsreminder = false;
                    }
                }
            }
        }
        session_start();
        if(\Input::post('FORM_SUBMIT') == 'tl_purge'){
            $purge = \Input::post('purge');
            if(in_array('pages',$purge['folders'])){
                $_SESSION['cache-relevant-changes'] = 0;
            }
        }
        if($_SESSION['cache-relevant-changes']&&$strTemplate=='be_main'&&$getsreminder){
            $objTemplate = new \BackendTemplate('cachereminder');
            $strBuffer .= $objTemplate->parse();
        }
        return $strBuffer;
    }

    public function onDCALoad($strName){
        $GLOBALS['TL_DCA'][$strName]['config']['onsubmit_callback'][] = array('FSCacheReminder','invalidateFECache');
        $GLOBALS['TL_DCA'][$strName]['config']['ondelete_callback'][] = array('FSCacheReminder','invalidateFECache');
        $GLOBALS['TL_DCA'][$strName]['config']['oncut_callback'][] = array('FSCacheReminder','invalidateFECache');
        $GLOBALS['TL_DCA'][$strName]['config']['oncopy_callback'][] = array('FSCacheReminder','onCopyCallback');
        $GLOBALS['TL_DCA'][$strName]['config']['onversion_callback'][] = array('FSCacheReminder','invalidateFECache');
        $GLOBALS['TL_DCA'][$strName]['config']['onrestore_callback'][] = array('FSCacheReminder','invalidateFECache');
    }

    public function onCopyCallback($id,$dc){
        $this->invalidateFECache($dc);
    }

    public function invalidateFECache($dc){
        $relevanttables = explode(',',$GLOBALS['TL_CONFIG']['cachereminder_tables']);
        if(!in_array($dc->table,$relevanttables)) {
            session_start();
            $_SESSION['cache-relevant-changes'] = 1;
        }
    }

}