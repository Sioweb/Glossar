<?php

/**
 * Contao Open Source CMS
 */

namespace sioweb\contao\extensions\glossar;
use Contao;

/**
 * @file GlossarLog.php
 * @class GlossarLog
 * @author Sascha Weidner
 * @version 3.0.0
 * @package sioweb.contao.extensions.glossar
 * @copyright Sascha Weidner, Sioweb
 */


class GlossarLog extends \BackendModule {

  protected $strTemplate = 'be_glossar_log';

  public function generate() {
    return parent::generate();
  }

  public function compile() {

    $db = &$this->Database;
    $ext = $db->prepare("select * from `tl_repository_installs` where `extension`='SWGlossar'")->execute();

    if($ext->lickey == false || $ext->lickey == 'free2use') {
      $this->Template->lickey = false;
    } else $this->Template->lickey = true;

    // $Statistics = \GlossarLogModel::findAll();
    if(!empty($Statistics)) {
      
    }
  }

}