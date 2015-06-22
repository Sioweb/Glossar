<?php

/**
 * Contao Open Source CMS
 */

/**
 * @file config.php
 * @author Sascha Weidner
 * @version 3.0.0
 * @package sioweb.contao.extensions.glossar
 * @copyright Sascha Weidner, Sioweb
 */


array_insert($GLOBALS['TL_MAINTENANCE'],1,array(
  'sioweb\contao\extensions\glossar\RebuildGlossar'
));

array_insert($GLOBALS['BE_MOD']['content'], 1, array(
  'glossar' => array(
    'tables' => array('tl_sw_glossar','tl_content'),
    'icon'   => 'system/modules/Glossar/assets/sioweb16x16.png'
  )
));

$GLOBALS['TL_CTE']['texts']['glossar'] = 'ContentGlossar';
$GLOBALS['TL_HOOKS']['outputFrontendTemplate'][] = array('Glossar', 'searchGlossarTerms');

if(\Config::get('enableGlossar') == 1) {
  if(Input::get('rebuild_glossar') == 1 || \Config::get('disableGlossarCache') == 1)
    $GLOBALS['TL_HOOKS']['indexPage'][] = array('sioweb\contao\extensions\glossar\RebuildGlossar', 'rebuild');

  if(TL_MODE == 'FE') {
    $GLOBALS['TL_JAVASCRIPT'][] = 'system/modules/Glossar/assets/glossar.js';
    $GLOBALS['TL_CSS'][] = 'system/modules/Glossar/assets/glossar.css';
    $GLOBALS['TL_JQUERY'][] = '<script>var Contao = {request_token: "'.$_SESSION['REQUEST_TOKEN'].'"};</script>';
  }

  $GLOBALS['glossar'] = array(
    'css' => array(
      'maxWidth' => 450,
      'maxHeight' => 300,
    ),
    'illegal' => '\.,;<>',
    'templates' => array(
      'ce_glossar',
      'glossar_default'
,      'glossar_error',
      'glossar_layer'
    )
  );

  if(Input::post('glossar') == 1)
    $GLOBALS['TL_HOOKS']['initializeSystem'][] = array('Glossar', 'getGlossarTerm');
}