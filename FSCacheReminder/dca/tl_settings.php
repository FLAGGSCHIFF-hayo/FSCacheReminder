<?php

$GLOBALS['TL_DCA']['tl_settings']['palettes']['default'] .= ';{cacheremindersettings_legend},cachereminder_tables,cachereminder_usergroups;';

/*$GLOBALS['TL_DCA']['tl_settings']['fields']['cachereminder_tables'] = array(
    'label'                   => &$GLOBALS['TL_LANG']['tl_settings']['cachereminder_tables'],
    'options_callback'        => array('fs_cachereminder_settings','getDCATables'),
	'inputType'               => 'checkboxWizard',
    'eval'                    => array('multiple'=>true),
    'reference'               => &$GLOBALS['TL_LANG']['tl_settings']
);*/
$GLOBALS['TL_DCA']['tl_settings']['fields']['cachereminder_tables'] = array(
    'label'                   => &$GLOBALS['TL_LANG']['tl_settings']['cachereminder_tables'],
    'inputType'               => 'text',
    'reference'               => &$GLOBALS['TL_LANG']['tl_settings'],
    'default'                 => 'tl_files,tl_settings'
);

$GLOBALS['TL_DCA']['tl_settings']['fields']['cachereminder_usergroups'] = array(
    'label'                   => &$GLOBALS['TL_LANG']['tl_settings']['cachereminder_usergroups'],
    'options_callback'        => array('fs_cachereminder_settings','getUserGroups'),
    'inputType'               => 'checkboxWizard',
    'eval'                    => array('multiple'=>true),
    'reference'               => &$GLOBALS['TL_LANG']['tl_settings']
);

class fs_cachereminder_settings extends Backend
{
    /*public function getDCATables()
    {
        $DCA = array();
        foreach ($GLOBALS['TL_DCA'] as $key => $values) {
            $DCA[] = $key;
        }
        return $DCA;
    }*/

    public function getUserGroups()
    {
        $groups = \UserGroupModel::findAll();
        $options = array('ad' => 'Administrator');
        if($groups){
            $groups = $groups->getModels();
            foreach ($groups as $group) {
                $options[$group->id] = $group->name;
            }
        }
        return $options;
    }

}
