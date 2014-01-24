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
				if($Glossar->title && $Glossar->jumpTo && preg_match( "/(?!(?:[^<]+>|[^>]+<\/a>))\b(" . $Glossar->title . ")\b/is", $this->text ))
					$this->text = preg_replace_callback ( "/(?!(?:[^<]+>|[^>]+<\/a>))\b(" . $Glossar->title . ")\b/is", array($this,'replaceTitle'), $this->text );
			}
		return parent::generate();
	}

	private function replaceTitle($treffer)
	{
 
		return '<a class="glossar" data-glossar="'.$this->glossar->id.'" href="{{link_url::'.$this->glossar->jumpTo.'}}?g='.standardize(\String::restoreBasicEntities($treffer[1])).'">'.$treffer[1].'</a>';
	}
	
}
