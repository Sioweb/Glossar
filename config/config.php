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
    'tables' => array('tl_glossar','tl_sw_glossar','tl_content'),
    'icon'   => 'system/modules/Glossar/assets/sioweb16x16.png',
    'importGlossar' => array('Glossar', 'importGlossar'),
    'exportGlossar' => array('Glossar', 'exportGlossar'),
    'importTerms' => array('Glossar', 'importTerms'),
    'exportTerms' => array('Glossar', 'exportTerms'),
  )
));

if(method_exists('Contao\Config','set')) {
  if(!isset($GLOBALS['TL_CONFIG']['ignoreInTags']))
    \Config::set('ignoreInTags','title,a,h1,h2,h3,h4,h5,h6,nav');

  if(!isset($GLOBALS['TL_CONFIG']['illegalChars']))
    \Config::set('illegalChars','")(=?.,;~:\'\>\<+\/\\');
} elseif(method_exists('Contao\Config','add')) {
  if(!isset($GLOBALS['TL_CONFIG']['ignoreInTags']))
    \Config::add('$GLOBALS[\'TL_CONFIG\'][\'ignoreInTags\']','title,a,h1,h2,h3,h4,h5,h6,nav');

  if(!isset($GLOBALS['TL_CONFIG']['illegalChars']))
    \Config::add('$GLOBALS[\'TL_CONFIG\'][\'illegalChars\']','")(=?.,;~:\'\>+\/!$€`´\'%&');
}

$GLOBALS['TL_CTE']['texts']['glossar'] = 'ContentGlossar';
$GLOBALS['TL_HOOKS']['outputFrontendTemplate'][] = array('sioweb\contao\extensions\glossar\Glossar', 'searchGlossarTerms');
$GLOBALS['TL_HOOKS']['getSearchablePages'][] = array('sioweb\contao\extensions\glossar\Glossar','getSearchablePages');

$GLOBALS['TL_HOOKS']['getGlossarPages']['news'] = array('sioweb\contao\extensions\glossar\GlossarNews','generateUrl');
$GLOBALS['TL_HOOKS']['cacheGlossarTerms']['news'] = array('sioweb\contao\extensions\glossar\GlossarNews','updateCache');
$GLOBALS['TL_HOOKS']['glossarContent']['news'] = array('sioweb\contao\extensions\glossar\GlossarNews','glossarContent');

$GLOBALS['TL_HOOKS']['getGlossarPages']['faq'] = array('sioweb\contao\extensions\glossar\GlossarFAQ','generateUrl');
$GLOBALS['TL_HOOKS']['cacheGlossarTerms']['faq'] = array('sioweb\contao\extensions\glossar\GlossarFAQ','updateCache');
$GLOBALS['TL_HOOKS']['glossarContent']['faq'] = array('sioweb\contao\extensions\glossar\GlossarFAQ','glossarContent');

$GLOBALS['TL_HOOKS']['getGlossarPages']['events'] = array('sioweb\contao\extensions\glossar\GlossarEvents','generateUrl');
$GLOBALS['TL_HOOKS']['cacheGlossarTerms']['events'] = array('sioweb\contao\extensions\glossar\GlossarEvents','updateCache');
$GLOBALS['TL_HOOKS']['glossarContent']['events'] = array('sioweb\contao\extensions\glossar\GlossarEvents','glossarContent');

if(\Config::get('enableGlossar') == 1) {
  if(Input::get('rebuild_glossar') == 1 || \Config::get('disableGlossarCache') == 1) {
    $GLOBALS['TL_HOOKS']['modifyFrontendPage'][] = array('sioweb\contao\extensions\glossar\RebuildGlossar', 'prepareRebuild');
    $GLOBALS['TL_HOOKS']['indexPage'][] = array('sioweb\contao\extensions\glossar\RebuildGlossar', 'rebuild');
  }

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
    'illegal' => '\-_\.&',
    'templates' => array(
      'ce_glossar',
      'glossar_default',
      'glossar_error',
      'glossar_layer'
    )
  );

  if(Input::post('glossar') == 1)
    $GLOBALS['TL_HOOKS']['initializeSystem'][] = array('sioweb\contao\extensions\glossar\Glossar', 'getGlossarTerm');
}