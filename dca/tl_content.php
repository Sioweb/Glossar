<?php

/*
 * Contao Open Source CMS
 * Copyright (C) 2005-2012 Leo Feyer
 *
 */

/**
* @file config.php
* @author Sascha Weidner
* @version 3.0.0
* @package sioweb.contao.extensions.glossar
* @copyright Sioweb - Sascha Weidner
*/

$GLOBALS['TL_DCA']['tl_content']['palettes']['sw_glossar'] = '{type_legend},type,sortGlossarBy;{pagination_legend:hide},addAlphaPagination';
	
$GLOBALS['TL_DCA']['tl_content']['palettes']['__selector__'][] = 'addAlphaPagination';

$GLOBALS['TL_DCA']['tl_content']['subpalettes']['addAlphaPagination'] = 'addOnlyTrueLinks';

$GLOBALS['TL_DCA']['tl_content']['fields']['sortGlossarBy'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['sortGlossarBy'],
	'default'                 => 'alias',
	'inputType'               => 'select',
	'options'                 => array('id', 'id_desc', 'date', 'date_desc', 'alias', 'alias_desc' ),
	'reference'               => &$GLOBALS['glossar']['sortGlossarBy'],
	'eval'                    => array('tl_class'=>'w50'),
	'sql'                     => "varchar(20) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_content']['fields']['addAlphaPagination'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['addAlphaPagination'],
	'exclude'                 => true,
	'inputType'               => 'checkbox',
	'eval'                    => array('submitOnChange'=>true),
	'sql'                     => "char(1) NOT NULL default ''"
);
$GLOBALS['TL_DCA']['tl_content']['fields']['addOnlyTrueLinks'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['addOnlyTrueLinks'],
	'exclude'                 => true,
	'inputType'               => 'checkbox',
	'eval'                    => array('submitOnChange'=>true),
	'sql'                     => "char(1) NOT NULL default ''"
);