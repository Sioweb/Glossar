<?php

/*
 * Contao Open Source CMS
 * Copyright (C) 2005-2012 Leo Feyer
 *
 */

namespace sioweb\contao\extensions\glossar;

/**
* @file ContentGlossar.php
* @class ContentGlossar
* @author Sascha Weidner
* @version 3.0.0
* @package sioweb.contao.extensions.glossar
* @copyright Sioweb - Sascha Weidner
*/
 
class ContentGlossar extends \ContentElement
{
	
	/**
	 * Template
	 * @var string
	 */
	protected $strTemplate = 'ce_glossar';


	/**
	 * Return if there are no files
	 * @return string
	 */
	public function generate()
	{
		// Set the item from the auto_item parameter
		if (!isset($_GET['items']) && $GLOBALS['TL_CONFIG']['useAutoItem'] && isset($_GET['auto_item']))
		{
			\Input::setGet('items', \Input::get('auto_item'));
		}
		// Set the item from the auto_item parameter
		if (!isset($_GET['alpha']) && $GLOBALS['TL_CONFIG']['useAutoItem'] && isset($_GET['auto_item']))
		{
			\Input::setGet('alpha', \Input::get('auto_item'));
		}

		return parent::generate();
	}
	
	public function compile() 
	{
		$this->loadLanguageFile('glossar_errors');
		$glossarErrors = array();
		
		if(!$this->sortGlossarBy)
			$this->sortGlossarBy = 'alias';
		$this->sortGlossarBy = explode('_',$this->sortGlossarBy);
		$this->sortGlossarBy = $this->sortGlossarBy[0].($this->sortGlossarBy[1] ? ' '.strtoupper($this->sortGlossarBy[1]) : '');

		if(\Input::get('items') == '')
			$Glossar = SWGlossarModel::findAll(array('order'=>$this->sortGlossarBy));
		else
			$Glossar = SWGlossarModel::findByAlias(\Input::get('items'),array(),array('order'=>$this->sortGlossarBy));
		
		

		/* Gefundene Begriffe durch Links zum Glossar ersetzen */
		$arrGlossar = array();
		$filledLetters = array();
		if($Glossar)
		{
			while($Glossar->next())
			{
				$initial = substr($Glossar->alias,0,1);
				$filledLetters[] = $initial;

				if((!$this->showAfterChoose || !$this->addAlphaPagination) || ($this->addAlphaPagination && $this->showAfterChoose && \Input::get('pag') != ''))
				{
					if(\Input::get('pag') == '' || $initial == \Input::get('pag') )
					{
						$newGlossarObj = new \FrontendTemplate('glossar_default');
						$newGlossarObj->setData($Glossar->row());
						if(\Input::get('items') != '')
							$newGlossarObj->teaser = null;
						$link = \PageModel::findByPk($newGlossarObj->jumpTo);
						if($link)
							$newGlossarObj->link = 	$this->generateFrontendUrl($link->row(), (($GLOBALS['TL_CONFIG']['useAutoItem'] && !$GLOBALS['TL_CONFIG']['disableAlias']) ?  '/' : '/items/').$newGlossarObj->alias);
						$arrGlossar[] = $newGlossarObj->parse();
					}
				}
			}
		}

		$letters = array();
		if($this->addAlphaPagination)
		{
			for($c=65;$c<=90;$c++)
			{
				if(($this->addOnlyTrueLinks && in_array(strtolower(chr($c)),$filledLetters)) || !$this->addOnlyTrueLinks)
				$letters[] = array(
					'href' => $this->addToUrl('pag='.strtolower(chr($c))),
					'initial' => chr($c),
					'active'=>(\Input::get('pag') == strtolower(chr($c))),
					'trueLink'=>(in_array(strtolower(chr($c)),$filledLetters) && !$this->addOnlyTrueLinks)
				);
			}
		}
		
		$this->Template->alphaPagination = $letters;
		
		if((!$this->showAfterChoose || !$this->addAlphaPagination) || ($this->addAlphaPagination && $this->showAfterChoose && \Input::get('pag') != ''))
			if(!$arrGlossar && $GLOBALS['glossar']['errors']['no_content'])
				$glossarErrors[] = $GLOBALS['glossar']['errors']['no_content'];
		/**/
		$this->Template->glossar = $arrGlossar;
		if($glossarErrors)
		{
			$errorObj = new \FrontendTemplate('glossar_error');
			$errorObj->msg = $glossarErrors;
			$this->Template->errors = $errorObj->parse();
		}
	}
}