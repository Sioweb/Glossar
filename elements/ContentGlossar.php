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
		return parent::generate();
	}
	
	public function compile() 
	{
		if(\Input::get('g') == '')
			$Glossar = SWGlossarModel::findAll();
		else
			$Glossar = SWGlossarModel::findByAlias(\Input::get('g'));
			
		/* Gefundene Begriffe durch Links zum Glossar ersetzen */
		$arrGlossar = array();
		if($Glossar)
		{
			while($Glossar->next())
			{
				$newGlossarObj = new \FrontendTemplate('glossar_default');
				$newGlossarObj->setData($Glossar->row());
				$link = \PageModel::findByPk($newGlossarObj->jumpTo);
				
				if($link)
					$newGlossarObj->link = (\Environment::get('ssl') ? 'https://' : 'http://') . \Environment::get('host') . TL_PATH . '/' . $this->generateFrontendUrl($link->row()).'?g='.$newGlossarObj->alias;
				$arrGlossar[] = $newGlossarObj->parse();
			}
		}
		
		$this->Template->glossar = $arrGlossar;
	}
}