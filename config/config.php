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


/**
 * Back end modules
 */ 

if(TL_MODE == 'FE')
{
	$GLOBALS['TL_JAVASCRIPT'][] = 'system/modules/SWGlossar/assets/glossar.js';
	$GLOBALS['TL_CSS'][] = 'system/modules/SWGlossar/assets/glossar.css';
	$GLOBALS['TL_JQUERY'][] = '<script>var Contao = {request_token: "'.$_SESSION['REQUEST_TOKEN'].'"};</script>';
}

array_insert($GLOBALS['BE_MOD']['content'], 1, array
(
	'sw_glossar' => array
	(
		'tables' => array('tl_sw_glossar'),
		'icon'  => 'system/modules/SWGlossar/assets/sioweb16x16.png'
	)
));

$GLOBALS['glossar'] = array(
	'css' => array(
		'maxWidth' => 450,
		'maxHeight' => 300,
	),
	'illegal' => '\.,;<>',
);

$GLOBALS['TL_CTE']['texts']['sw_glossar'] = 'ContentGlossar';

$GLOBALS['TL_HOOKS']['outputFrontendTemplate'][] = array('Glossar', 'searchGlossarTerms');

if($_POST['glossar'] == 1)
$GLOBALS['TL_HOOKS']['dispatchAjax'][] = array('Glossar', 'ajaxGlossar');


