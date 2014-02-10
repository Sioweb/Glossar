<?php

/*
 * Contao Open Source CMS
 * Copyright (C) 2005-2012 Leo Feyer
 *
 */

/**
* @file autoload.php
* @author Sascha Weidner
* @version 3.0.0
* @package sioweb.contao.extensions.glossar
* @copyright Sioweb - Sascha Weidner
*/


/**
 * Register the namespaces
 */
ClassLoader::addNamespaces(array
(
	'sioweb\contao\extensions\glossar'
));


/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
	// Classes
	'sioweb\contao\extensions\glossar\Glossar'		=> 'system/modules/SWGlossar/classes/Glossar.php',

	// Elements
	'sioweb\contao\extensions\glossar\ContentGlossar' 	=> 'system/modules/SWGlossar/elements/ContentGlossar.php',
	
	// Models
	'sioweb\contao\extensions\glossar\SWGlossarModel'	=> 'system/modules/SWGlossar/models/SWGlossarModel.php',
));


/**
 * Register the templates
 */
TemplateLoader::addFiles(array
(
	'ce_glossar'       	   => 'system/modules/SWGlossar/templates',
	'glossar_default'  	   => 'system/modules/SWGlossar/templates',
	'glossar_layer'  	   => 'system/modules/SWGlossar/templates',
	'glossar_error'  	   => 'system/modules/SWGlossar/templates',
));
