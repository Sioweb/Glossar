<?php

/**
 * Contao Open Source CMS
 */

/**
 * @file tl_content.php
 * @author Sascha Weidner
 * @version 3.0.0
 * @package sioweb.contao.extensions.glossar
 * @copyright Sascha Weidner, Sioweb
 */


/**
 * Dynamically add the permission check and parent table
 */
if (Input::get('do') == 'sw_glossar') {
  $GLOBALS['TL_DCA']['tl_content']['config']['ptable'] = 'tl_sw_glossar';
}

$GLOBALS['TL_DCA']['tl_content']['palettes']['sw_glossar'] = '{type_legend},type,sortGlossarBy;{pagination_legend:hide},addAlphaPagination';
$GLOBALS['TL_DCA']['tl_content']['palettes']['__selector__'][] = 'addAlphaPagination';
$GLOBALS['TL_DCA']['tl_content']['subpalettes']['addAlphaPagination'] = 'showAfterChoose,addOnlyTrueLinks';

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
$GLOBALS['TL_DCA']['tl_content']['fields']['showAfterChoose'] = array
(
  'label'                   => &$GLOBALS['TL_LANG']['tl_content']['showAfterChoose'],
  'exclude'                 => true,
  'inputType'               => 'checkbox',
  'eval'                    => array('submitOnChange'=>true),
  'sql'                     => "char(1) NOT NULL default ''"
);