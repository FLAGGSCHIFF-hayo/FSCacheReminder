<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2017 Leo Feyer
 *
 * @license LGPL-3.0+
 */


/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
	// Classes
	'FSCacheReminder' => 'system/modules/FSCacheReminder/classes/FSCacheReminder.php',
));


/**
 * Register the templates
 */
TemplateLoader::addFiles(array
(
	'cachereminder' => 'system/modules/FSCacheReminder/templates',
));
