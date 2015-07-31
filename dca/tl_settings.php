<?php

/**
 * Contao Open Source CMS
 */

/**
 * @file tl_settings.php
 * @author Sascha Weidner
 * @version 3.0.0
 * @package sioweb.contao.extensions.glossar
 * @copyright Sascha Weidner, Sioweb
 */


$semicolon = substr($GLOBALS['TL_DCA']['tl_settings']['palettes']['default'], -1, 1);
if($semicolon != ';')
  $semicolon = ';';
$GLOBALS['TL_DCA']['tl_settings']['palettes']['default'] = $GLOBALS['TL_DCA']['tl_settings']['palettes']['default'].$semicolon.'{glossar_legend},enableGlossar';

$GLOBALS['TL_DCA']['tl_settings']['palettes']['__selector__'][] = 'enableGlossar';
$GLOBALS['TL_DCA']['tl_settings']['subpalettes']['enableGlossar'] = 'glossarIncludeUnsearchable,activateGlossarTags,disableGlossarCache,glossar_no_fallback,strictSearch,ignoreInTags,illegalChars,jumpToGlossar';

$GLOBALS['TL_DCA']['tl_settings']['fields']['ignoreInTags'] = array
(
  'label'                   => &$GLOBALS['TL_LANG']['tl_settings']['ignoreInTags'],
  'exclude'                 => true,
  'inputType'               => 'text',
  'eval'                    => array('maxlength'=>255, 'tl_class'=>'clr long'),
  'sql'                     => "text NULL"
);
$GLOBALS['TL_DCA']['tl_settings']['fields']['illegalChars'] = array
(
  'label'                   => &$GLOBALS['TL_LANG']['tl_settings']['illegalChars'],
  'exclude'                 => true,
  'inputType'               => 'text',
  'eval'                    => array('maxlength'=>255, 'tl_class'=>'clr long','allowHtml'=>true,'decodeEntities'=>false),
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

$GLOBALS['TL_DCA']['tl_settings']['fields']['enableGlossar'] = array(
  'label'                   => &$GLOBALS['TL_LANG']['tl_settings']['enableGlossar'],
  'exclude'                 => true,
  'inputType'               => 'checkbox',
  'eval'                    => array('submitOnChange'=>true),
  'sql'                     => "char(1) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_settings']['fields']['glossarIncludeUnsearchable'] = array(
  'label'                   => &$GLOBALS['TL_LANG']['tl_settings']['glossarIncludeUnsearchable'],
  'exclude'                 => true,
  'inputType'               => 'checkbox',
  'sql'                     => "char(1) NOT NULL default ''"
);
$GLOBALS['TL_DCA']['tl_settings']['fields']['activateGlossarTags'] = array(
  'label'                   => &$GLOBALS['TL_LANG']['tl_settings']['activateGlossarTags'],
  'exclude'                 => true,
  'inputType'               => 'checkbox',
  'sql'                     => "char(1) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_settings']['fields']['glossar_no_fallback'] = array(
  'label'                   => &$GLOBALS['TL_LANG']['tl_settings']['glossar_no_fallback'],
  'exclude'                 => true,
  'inputType'               => 'checkbox',
  'sql'                     => "char(1) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_settings']['fields']['strictSearch'] = array(
  'label'                   => &$GLOBALS['TL_LANG']['tl_settings']['strictSearch'],
  'default'                 => 'alias',
  'inputType'               => 'select',
  'options'                 => array_keys($GLOBALS['glossar']['searchTypes']),
  'reference'               => &$GLOBALS['glossar']['searchTypes'],
  'eval'                    => array('tl_class'=>'w50 clr','includeBlankOption'=>true),
  'sql'                     => "varchar(20) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_settings']['fields']['disableGlossarCache'] = array(
  'label'                   => &$GLOBALS['TL_LANG']['tl_settings']['disableGlossarCache'],
  'exclude'                 => true,
  'inputType'               => 'checkbox',
  'eval'                    => array('submitOnChange'=>true),
  'sql'                     => "char(1) NOT NULL default ''"
);