<?php

/**
 * Contao Open Source CMS
 */

namespace sioweb\contao\extensions\glossar;
use Contao;

/**
 * @file GlossarNews.php
 * @class GlossarNews
 * @author Sascha Weidner
 * @version 3.0.0
 * @package sioweb.contao.extensions.glossar
 * @copyright Sascha Weidner, Sioweb
 */
class GlossarNews extends \ModuleNews {

  public function __construct() {
    
  }

  public function compile() {}

  public function generateNewsUrl($objItem, $blnAddArchive=false) {
    return parent::generateNewsUrl($objItem, $blnAddArchive=false);
  }
}