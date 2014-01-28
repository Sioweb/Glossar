<?php

/*
 * Contao Open Source CMS
 * Copyright (C) 2005-2012 Leo Feyer
 *
 */

namespace sioweb\contao\extensions\glossar;
use Contao;

/**
* @file SWDepartmentsModel.php
* @author Sascha Weidner
* @version 3.0.0
* @package sioweb.contao.extensions.company
* @copyright Sioweb - Sascha Weidner
*/

if(!class_exists('SWGlossarModel'))
{
	
class SWGlossarModel extends \Model
{
	/**
	 * Table name
	 * @var string
	 */
	protected static $strTable = 'tl_sw_glossar';

	public static function findAllInitial($arrOptions,$initial)
	{
		$t = static::$strTable;

		$arrColumns = array("left($t.alias,1) = ?");


		return static::findBy($arrColumns, $initial, $arrOptions);
	}
	
}

}