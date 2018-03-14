<?php

/**
 * Contao Open Source CMS
 */


/**
 * Extend default palette
 */
$GLOBALS['TL_DCA']['tl_user_group']['palettes']['default'] = str_replace('fop;', 'fop;{glossar_legend},glossar,glossarp;', $GLOBALS['TL_DCA']['tl_user_group']['palettes']['default']);


/**
 * Add fields to tl_user_group
 */
$GLOBALS['TL_DCA']['tl_user_group']['fields']['glossar'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_user']['glossar'],
	'exclude'                 => true,
	'inputType'               => 'checkbox',
	'foreignKey'              => 'tl_glossar.title',
	'eval'                    => array('multiple'=>true),
	'sql'                     => "blob NULL"
);


/**
 * Add fields to tl_user_group
 */
$GLOBALS['TL_DCA']['tl_user_group']['fields']['glossarp'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_user']['glossarp'],
	'exclude'                 => true,
	'inputType'               => 'checkbox',
	'options'                 => array('create', 'delete'),
	'reference'               => &$GLOBALS['TL_LANG']['MSC'],
	'eval'                    => array('multiple'=>true),
	'sql'                     => "blob NULL"
);
