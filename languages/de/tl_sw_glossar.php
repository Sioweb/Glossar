<?php

/*
 * Contao Open Source CMS
 * Copyright (C) 2005-2012 Leo Feyer
 *
 */
 
/**
* @file config.php
* @author Sascha Weidner
* @version 3.0.0
* @package sioweb.contao.extensions.glossar
* @copyright Sioweb - Sascha Weidner
*/

	$GLOBALS['TL_LANG']['tl_sw_glossar']['title_legend'] = 'Titel';

	$GLOBALS['TL_LANG']['tl_sw_glossar']['title'] = array('Suchwort/Stichwort','Wird als Link in den Glossar ersetzt.');
	$GLOBALS['TL_LANG']['tl_sw_glossar']['alias'] = array('Alias','Wird als Wert für den Suchstring in der URL ersetzt.');
	
	$GLOBALS['TL_LANG']['tl_sw_glossar']['maxWidth'] = array('Maximale Breite','Die maximale Breite, die das Ajax-Layer bekommen kann - Standard 450.');
	$GLOBALS['TL_LANG']['tl_sw_glossar']['maxHeight'] = array('Maximale Höhe','Die maximale Höhe, die das Ajax-Layer bekommen kann - Standard 500.');
	$GLOBALS['TL_LANG']['tl_sw_glossar']['ignoreInTags'] = array('Diese Tags ignorieren','Befindet der Begriff in diesen Tags wird er nicht ersetzt.');
	$GLOBALS['TL_LANG']['tl_sw_glossar']['date'] = array('Datum','Kann verwendet werden, um nach Datum zu sortieren.');
	$GLOBALS['TL_LANG']['tl_sw_glossar']['jumpTo'] = array('Weiterleitungsseite','Gibt die Seite mit den Glossar-Einträgen an.');
	$GLOBALS['TL_LANG']['tl_sw_glossar']['noPlural'] = array('Plural-Suche deaktivieren','Das Modul sucht standardmäßig bis zum nächsten vorkommenden leerzeichen.');
	
	$GLOBALS['TL_LANG']['tl_sw_glossar']['description'] = array('Beschreibung','Erklärung des oben genannten Bergiffes.');
	$GLOBALS['TL_LANG']['tl_sw_glossar']['teaser'] = array('Teaser','Ein Vorschau-Artikel für die Glossar-Liste und der Maus-Hover-Ansicht.');
	

	$GLOBALS['TL_LANG']['tl_sw_glossar']['new'] = array('Neuer Eintrag','Einen neuen Eintrag erstellen');
	$GLOBALS['TL_LANG']['tl_sw_glossar']['show'] = array('Eintragsdetails','Die Details des Eintrags ID %s anzeigen');
	$GLOBALS['TL_LANG']['tl_sw_glossar']['edit'] = array('Eintrag bearbeiten','Eintrag ID %s bearbeiten');
	
	$GLOBALS['TL_LANG']['tl_sw_glossar']['copy'] = array('Eintrag duplizieren','Eintrag ID %s duplizieren');
	$GLOBALS['TL_LANG']['tl_sw_glossar']['cut'] = array('Eintrag verschieben','Eintrag ID %s verschieben');
	$GLOBALS['TL_LANG']['tl_sw_glossar']['delete'] = array('Eintrag löschen','Eintrag ID %s löschen');
	$GLOBALS['TL_LANG']['tl_sw_glossar']['toggle'] = array('Eintrag veröffentlichen/unveröffentlichen','Eintrag ID %s veröffentlichen/unveröffentlichen');
	$GLOBALS['TL_LANG']['tl_sw_glossar']['feature'] = array('Eintrag hervorheben/zurücksetzen','Beitrag ID %s hervorheben/zurücksetzen');
