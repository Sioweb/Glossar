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
 
class ContentGlossar extends ContentElement
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

		return parent::generate();
	}
	
	public function compile() 
	{
		if(\Input::get('items') == '')
			$Glossar = SWGlossarModel::findAll();
		else
			$Glossar = SWGlossarModel::findByAlias(\Input::get('items'));
			
		/* Gefundene Begriffe durch Links zum Glossar ersetzen */
		$arrGlossar = array();
		if($Glossar)
		{
			while($Glossar->next())
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
		
		$this->Template->glossar = $arrGlossar;
	}
}