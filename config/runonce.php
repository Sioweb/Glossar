<?php

class ROGlossar extends Controller {
  public function __construct() {
    parent::__construct();
    $this->import('Database');
  }

  public function run() {
    $Glossar = $this->Database->prepare("SELECT * FROM tl_glossar")->execute();
    if($Glossar->count() == 0) {
      $arrInsert=array(
        'id'        => 1,
        'tstamp'    => time(),
        'title'     => 'Standard Glossar',
        'alias'     => 'standard_glossar',
        'language'  => 'de',
      );
      $this->Database->prepare("INSERT INTO tl_glossar %s")->set($arrInsert)->execute();
      $Term = $this->Database->prepare("UPDATE tl_sw_glossar SET pid = 1 WHERE pid = 0 OR pid = NULL")->execute();
    } else {
      $Term = $this->Database->prepare("SELECT * FROM tl_sw_glossar WHERE pid = 0 OR pid = NULL or pid = '' ")->execute();
      if($Term->count() > 0) {

      }
    }
  }

  private function createContainer() {
    
  }
}

$ROGlossar = new ROGlossar();
$ROGlossar->run();