<?php

/*
 * Contao Open Source CMS
 * Copyright (C) 2005-2012 Leo Feyer
 *
 */

namespace sioweb\contao\extensions\glossar;

/**
* @file SWGlossar.php
* @class SWGlossar
* @author Sascha Weidner
* @version 3.0.0
* @package sioweb.contao.extensions.glossar
* @copyright Sioweb - Sascha Weidner
*/
 
abstract class ContentElement extends \Contao\ContentElement
{

	private $Glossar;
	
	public function generate()
	{
		#echo '<pre style="display:none;">'.print_r($this,1).'</pre>';
		$Glossar = SWGlossarModel::findAll(array('order'=>' CHAR_LENGTH(title) DESC'));

		/* Gefundene Begriffe durch Links zum Glossar ersetzen */
		if($Glossar)
			while($Glossar->next())
			{
				$this->glossar = $Glossar;
				if(!$this->glossar->maxWidth)
					$this->glossar->maxWidth = $GLOBALS['glossar']['css']['maxWidth'];
				if(!$this->glossar->maxHeight)
					$this->glossar->maxHeight = $GLOBALS['glossar']['css']['maxHeight'];

				if($Glossar->title && $Glossar->jumpTo && preg_match( "/(?!(?:[^<]+>|[^>]+<\/a>))\b(" . $Glossar->title . (!$Glossar->noPlural ?"[^ ]*": '').")/is", $this->text ))
					$this->text = preg_replace_callback ( "/(?!(?:[^<]+>|[^>]+<\/a>))\b(" . $Glossar->title . (!$Glossar->noPlural ?"[^ ]*": '').")/is", array($this,'replaceTitle'), $this->text );
			}
		return parent::generate();
	}

	private function replaceTitle($treffer)
	{
		$link = \PageModel::findByPk($this->glossar->jumpTo);
		if($link)
			$link = $this->generateFrontendUrl($link->row(), (($GLOBALS['TL_CONFIG']['useAutoItem'] && !$GLOBALS['TL_CONFIG']['disableAlias']) ?  '/' : '/items/').standardize(\String::restoreBasicEntities($this->glossar->alias)));

		return '<a class="glossar" data-maxwidth="'.($this->glossar->maxWidth ? $this->glossar->maxWidth : 0).'" data-maxheight="'.($this->glossar->maxHeight ? $this->glossar->maxHeight : 0).'" data-glossar="'.$this->glossar->id.'" href="'.$link.'">'.$treffer[1].'</a>';
	}
	
}
