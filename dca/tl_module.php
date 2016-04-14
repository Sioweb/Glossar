<?php

/**
 * Contao Open Source CMS
 */

/**
 * @file tl_module.php
 * @author Sascha Weidner
 * @version 3.0.0
 * @package sioweb.contao.extensions.glossar
 * @copyright Sascha Weidner, Sioweb
 */


$GLOBALS['TL_DCA']['tl_module']['palettes']['glossar_pagination']    = '{title_legend},name,headline,type;{glossar_legend},glossar,addOnlyTrueLinks;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID,space';


$GLOBALS['TL_DCA']['tl_module']['fields']['glossar'] = array
(
    'label'                   => &$GLOBALS['TL_LANG']['tl_module']['glossar'],
    'default'                 => 'alias',
    'inputType'               => 'select',
    'foreignKey'              => 'tl_glossar.title',
    'eval'                    => array('tl_class'=>'w50','includeBlankOption'=>true),
    'sql'                     => "varchar(20) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_module']['fields']['sortGlossarBy'] = array
(
    'label'                   => &$GLOBALS['TL_LANG']['tl_module']['sortGlossarBy'],
    'default'                 => 'alias',
    'inputType'               => 'select',
    'options'                 => array('id', 'id_desc', 'date', 'date_desc', 'alias', 'alias_desc' ),
    'reference'               => &$GLOBALS['glossar']['sortGlossarBy'],
    'eval'                    => array('tl_class'=>'w50'),
    'sql'                     => "varchar(20) NOT NULL default ''"
);
$GLOBALS['TL_DCA']['tl_module']['fields']['addOnlyTrueLinks'] = array
(
    'label'                   => &$GLOBALS['TL_LANG']['tl_module']['addOnlyTrueLinks'],
    'exclude'                 => true,
    'inputType'               => 'checkbox',
    'eval'                    => array('submitOnChange'=>true),
    'sql'                     => "char(1) NOT NULL default ''"
);
