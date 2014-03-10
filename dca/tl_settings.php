<?php

/*
 * Contao Open Source CMS
 * Copyright (C) 2005-2012 Leo Feyer
 *
 */

/**
* @file tl_settins.php
* @author Sascha Weidner
* @version 3.0.0
* @package sioweb.contao.extensions.glossar
* @copyright Sioweb - Sascha Weidner
*/

/**
 * Table tl_sw_glossar
 */
$GLOBALS['TL_DCA']['tl_settings']['palettes']['default'] = '{glossar_legend},ignoreInTags,jumpToGlossar;' . $GLOBALS['TL_DCA']['tl_sw_glossar']['palettes']['default'];

$GLOBALS['TL_DCA']['tl_settings']['fields']['ignoreInTags'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_settings']['ignoreInTags'],
	'exclude'                 => true,
	'default'				  => 'title,a',
	'inputType'               => 'text',
	'eval'                    => array('maxlength'=>255, 'tl_class'=>'clr long'),
	'sql'                     => "text NULL"
);
$GLOBALS['TL_DCA']['tl_settings']['fields']['jumpToGlossar'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_settings']['jumpToGlossar'],
	'exclude'                 => true,
	'inputType'               => 'pageTree',
	'foreignKey'              => 'tl_page.title',
	'eval'                    => array('fieldType'=>'radio', 'tl_class'=>'w50 clr'),
	'sql'                     => "int(10) unsigned NOT NULL default '0'",
	'relation'                => array('type'=>'belongsTo', 'load'=>'lazy')
);