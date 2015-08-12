<?php

/**
 * Contao Open Source CMS
 */

/**
 * @file tl_page.php
 * @author Sascha Weidner
 * @version 3.0.0
 * @package sioweb.contao.extensions.glossar
 * @copyright Sascha Weidner, Sioweb
 */


$semicolon = substr($GLOBALS['TL_DCA']['tl_page']['palettes']['regular'], -1, 1);
if($semicolon != ';')
  $semicolon = ';';

$GLOBALS['TL_DCA']['tl_page']['palettes']['regular'] = $GLOBALS['TL_DCA']['tl_page']['palettes']['regular'].$semicolon.'{glossar_legend},disableGlossar,glossar_no_fallback';

$GLOBALS['TL_DCA']['tl_page']['fields']['disableGlossar'] = array(
  'label'                   => &$GLOBALS['TL_LANG']['tl_page']['disableGlossar'],
  'exclude'                 => true,
  'inputType'               => 'checkbox',
  'sql'                     => "char(1) NOT NULL default ''"
);
$GLOBALS['TL_DCA']['tl_page']['fields']['glossar_no_fallback'] = array(
  'label'                   => &$GLOBALS['TL_LANG']['tl_page']['glossar_no_fallback'],
  'exclude'                 => true,
  'inputType'               => 'checkbox',
  'sql'                     => "char(1) NOT NULL default ''"
);
$GLOBALS['TL_DCA']['tl_page']['fields']['glossar'] = array(
  'sql'                     => "text NULL"
);
$GLOBALS['TL_DCA']['tl_page']['fields']['fallback_glossar'] = array(
  'sql'                     => "text NULL"
);
$GLOBALS['TL_DCA']['tl_page']['fields']['glossar_time'] = array(
  'sql'                     => "int(10) unsigned NOT NULL default '0'"
);