<?php

/*
 * Contao Open Source CMS
 * Copyright (C) 2005-2012 Leo Feyer
 *
 */

namespace sioweb\contao\extensions\glossar;
use Contao;

/**
* @file NewsGlossar.php
* @class NewsGlossar
* @author Sascha Weidner
* @version 3.0.0
* @package sioweb.contao.extensions.glossar
* @copyright Sioweb - Sascha Weidner
*/

class NewsGlossar extends \Frontend
{ 

	private $Glossar;
	public function searchGlossarArticles($template, $objArticle, $news)
	{
		$Glossar = SWGlossarModel::findAll(array('order'=>' CHAR_LENGTH(title) DESC'));
		/* Gefundene Begriffe durch Links zum Glossar ersetzen */
		if($Glossar)
			while($Glossar->next())
			{
				$this->glossar = $Glossar;
				if($Glossar->title && $Glossar->jumpTo && preg_match( "/(?!(?:[^<]+>|[^>]+<\/a>))\b(" . $Glossar->title . ")\b/is", $template->teaser ))
					$template->teaser = preg_replace_callback ( "/(?!(?:[^<]+>|[^>]+<\/a>))\b(" . $Glossar->title . ")\b/is", array($this,'replaceTitle'), $template->teaser );
			}
	}
	
	public function ajaxGlossar()
	{
		if($_POST['id'])
			$Glossar = SWGlossarModel::findByPk($_POST['id']);
		if($Glossar === null)
			return false;
			
		$glossarObj = new \FrontendTemplate('glossar_layer');
		$glossarObj->setData($Glossar->row());
		$glossarObj->class = 'ce_glossar_layer';
		$link = \PageModel::findByPk($glossarObj->jumpTo);
		$glossarObj->link = (\Environment::get('ssl') ? 'https://' : 'http://') . \Environment::get('host') . TL_PATH . '/' . $this->generateFrontendUrl($link->row()).'?g='.$glossarObj->alias;
		
		
		return $glossarObj->parse();
		exit;  
	}

	private function replaceTitle($treffer)
	{
		return '<a class="glossar" data-glossar="'.$this->glossar->id.'" href="{{link_url::'.$this->glossar->jumpTo.'}}?g='.standardize(\String::restoreBasicEntities($treffer[1])).'">'.$treffer[1].'</a>';
	}
}