<?php

$GLOBALS['TL_HOOKS']['parseBackendTemplate'][] = array('FSCacheReminder','addReminder');
$GLOBALS['TL_HOOKS']['loadDataContainer'][] = array('FSCacheReminder','onDCALoad');

$GLOBALS['TL_CONFIG']['cachereminder_tables'] = 'tl_files,tl_settings,tl_user,tl_group,tl_mgroup,tl_member';