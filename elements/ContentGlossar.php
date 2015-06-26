<?php

/**
 * Contao Open Source CMS
 */

namespace sioweb\contao\extensions\glossar;
use Contao;

/**
 * @file ContentGlossar.php
 * @class ContentGlossar
 * @author Sascha Weidner
 * @version 3.0.0
 * @package sioweb.contao.extensions.glossar
 * @copyright Sascha Weidner, Sioweb
 */


class ContentGlossar extends \ContentElement {
  
  /**
   * Template
   * @var string
   */
  protected $strTemplate = 'ce_glossar';


  /**
   * Return if there are no files
   * @return string
   */
  public function generate() {

    if (!isset($_GET['items']) && $GLOBALS['TL_CONFIG']['useAutoItem'] && isset($_GET['auto_item']))
      \Input::setGet('items', \Input::get('auto_item'));

    if (!isset($_GET['alpha']) && $GLOBALS['TL_CONFIG']['useAutoItem'] && isset($_GET['auto_item']))
      \Input::setGet('alpha', \Input::get('auto_item'));

    return parent::generate();
  }
  
  public function compile()  {
    $this->loadLanguageFile('glossar_errors');
    $glossarErrors = array();
    
    if(!$this->sortGlossarBy)
      $this->sortGlossarBy = 'alias';
    $this->sortGlossarBy = explode('_',$this->sortGlossarBy);
    $this->sortGlossarBy = $this->sortGlossarBy[0].($this->sortGlossarBy[1] ? ' '.strtoupper($this->sortGlossarBy[1]) : '');

    if(\Input::get('items') == '')
      $Glossar = \SWGlossarModel::findAll(array('order'=>$this->sortGlossarBy));
    else
      $Glossar = \SWGlossarModel::findByAlias(\Input::get('items'),array(),array('order'=>$this->sortGlossarBy));
    
    

    /* Gefundene Begriffe durch Links zum Glossar ersetzen */
    $arrGlossar = array();
    $filledLetters = array();
    if($Glossar) {
      while($Glossar->next()) {
        $initial = substr($Glossar->alias,0,1);
        $filledLetters[] = $initial;

        if(\Input::get('items') != '' || (!$this->showAfterChoose || !$this->addAlphaPagination) || ($this->addAlphaPagination && $this->showAfterChoose && \Input::get('pag') != '')) {
          if(\Input::get('pag') == '' || $initial == \Input::get('pag') ) {
            $newGlossarObj = new \FrontendTemplate('glossar_default');
            $newGlossarObj->setData($Glossar->row());
            if(\Input::get('items') != '')
              $newGlossarObj->teaser = null;

            if(!$newGlossarObj->jumpTo)
              $newGlossarObj->jumpTo = $GLOBALS['TL_CONFIG']['jumpToGlossar'];

            if($newGlossarObj->jumpTo)
              $link = \PageModel::findByPk($newGlossarObj->jumpTo);

            if($link)
              $newGlossarObj->link =  $this->generateFrontendUrl($link->row(), (($GLOBALS['TL_CONFIG']['useAutoItem'] && !$GLOBALS['TL_CONFIG']['disableAlias']) ?  '/' : '/items/').$newGlossarObj->alias);
            
            if(\Input::get('items') == '')
              $arrGlossar[] = $newGlossarObj->parse();
            else {
              $elements = $this->getGlossarElements($newGlossarObj->id);
              if(empty($elements) && $Glossar->description) {
                $descriptionObj = new \FrontendTemplate('glossar_description');
                $descriptionObj->content = $Glossar->description;
                $elements = array($descriptionObj->parse());
              }
              $arrGlossar[] = $elements;
            }
          }
        }
      }
    }

    $letters = array();
    if($this->addAlphaPagination) {
      for($c=65;$c<=90;$c++) {
        if(($this->addOnlyTrueLinks && in_array(strtolower(chr($c)),$filledLetters)) || !$this->addOnlyTrueLinks)
        $letters[] = array(
          'href' => $this->addToUrl('pag='.strtolower(chr($c)).'&amp;alpha=&amp;items=&amp;auto_item='),
          'initial' => chr($c),
          'active'=>(\Input::get('pag') == strtolower(chr($c))),
          'trueLink'=>(in_array(strtolower(chr($c)),$filledLetters) && !$this->addOnlyTrueLinks)
        );
      }
    }
    
    $this->Template->alphaPagination = $letters;
    
    if(\Input::get('items') != '' || (!$this->showAfterChoose || !$this->addAlphaPagination) || ($this->addAlphaPagination && $this->showAfterChoose && \Input::get('pag') != ''))
      if(!$arrGlossar && $GLOBALS['glossar']['errors']['no_content'])
        $glossarErrors[] = $GLOBALS['glossar']['errors']['no_content'];

    if(\Input::get('items') != '') {
      $this->Template->content = 1;
      $arrGlossar = array_shift($arrGlossar);
    }

    $this->Template->glossar = $arrGlossar;
    if($glossarErrors) {
      $errorObj = new \FrontendTemplate('glossar_error');
      $errorObj->msg = $glossarErrors;
      $this->Template->errors = $errorObj->parse();
    }
  }

  private function getGlossarElements($id) {
    $arrElements = array();
    $objCte = \ContentModel::findPublishedByPidAndTable($id, 'tl_sw_glossar');

    if ($objCte !== null) {
      $intCount = 0;
      $intLast = $objCte->count() - 1;

      while ($objCte->next()) {
        $arrCss = array();

        /** @var \ContentModel $objRow */
        $objRow = $objCte->current();

        // Add the "first" and "last" classes (see #2583)
        if ($intCount == 0 || $intCount == $intLast) {
          if ($intCount == 0) {
            $arrCss[] = 'first';
          }

          if ($intCount == $intLast) {
            $arrCss[] = 'last';
          }
        }

        $objRow->classes = $arrCss;
        $arrElements[] = $this->getContentElement($objRow, $this->strColumn);
        ++$intCount;
      }
    }
    return $arrElements;
  }
}