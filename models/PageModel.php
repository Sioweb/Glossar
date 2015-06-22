<?php

/**
 * Contao Open Source CMS
 */

/**
 * @file PageModel.php
 * @class PageModel
 * @author Sascha Weidner
 * @version 3.0.0
 * @package sioweb.contao.extensions.glossar
 * @copyright Sascha Weidner, Sioweb
 */

if(!class_exists('PageModel')) {
class PageModel extends \Contao\PageModel {
  public static function findActiveAndEnabledGlossarPages($arrOptions = array()) {
    $t = static::$strTable;

    $arrValues = array(1,'regular');
    $arrColumns = array("published = ? AND type = ? AND disableGlossar = 0");
    return static::findBy($arrColumns, $arrValues, $arrOptions);
  }
}}