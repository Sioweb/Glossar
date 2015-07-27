<?php

/**
 * Contao Open Source CMS
 */

namespace sioweb\contao\extensions\glossar;
use Contao;

/**
 * @file GlossarEvents.php
 * @class GlossarEvents
 * @author Sascha Weidner
 * @version 3.0.0
 * @package sioweb.contao.extensions.glossar
 * @copyright Sascha Weidner, Sioweb
 */
class GlossarEvents extends \Events {

  public function __construct() {
    
  }

  public function compile() {}

  public function glossarContent($item,$strContent,$template) {
    if(empty($item)) return array();

    $Event = \CalendarEventsModel::findByAlias(\Input::get('items'));
    return $Event->glossar;
  }

  public function updateCache($item,$arrTerms,$strContent) {
    preg_match_all('#'.implode('|',$arrTerms['both']).'#is', $strContent, $matches);
    $matches = array_unique($matches[0]);

    $Event = \CalendarEventsModel::findByAlias($item);
    $Event->glossar = implode('|',$matches);
    $Event->save();
  }

  public function generateUrl($arrPages) {
    $arrPages = array();

    $Event = \CalendarEventsModel::findAll();
    if(empty($Event))
      return array();

    $arrEvent = array();
    while($Event->next()) {
      $objCalendar = \CalendarModel::findByPk($Event->pid);
      if ($objCalendar !== null && $objCalendar->jumpTo && ($objTarget = $objCalendar->getRelated('jumpTo')) !== null)
        $arrEvent[$Event->pid][] = $this->generateEventUrl($Event,$this->generateFrontendUrl($objTarget->row(), ((\Config::get('useAutoItem') && !\Config::get('disableAlias')) ?  '/%s' : '/events/%s')));
    }

    $EventReader = \ModuleModel::findByType('eventreader');
    if(empty($EventReader))
      return array();

    $arrReader = array();
    while($EventReader->next()) $arrReader[$EventReader->id] = deserialize($EventReader->cal_calendar);

    $Content = \ContentModel::findBy(array("module IN ('".implode("','",array_keys($arrReader))."')"),array());
    if(empty($Content))
      return array();

    $arrContent = array();
    while($Content->next()) $arrContent[$Content->module] = $Content->pid;

    $Article = \ArticleModel::findBy(array("tl_article.id IN ('".implode("','",$arrContent)."')"),array());
    if(empty($Article))
      return array();

    $finishedIDs = $arrPages = array();
    while($Article->next()) {

      // $root = $this->getRootPage($Article->pid);

      $domain = \Environment::get('base');
      $strLanguage = 'de';
      $objPages = $Article->getRelated('pid');

      $ReaderId = false;
      foreach($arrContent as $module => $mid)
        if($mid == $Article->id)
          $ReaderId = $module;

      foreach($arrReader[$ReaderId] as $event_id) {
        if(in_array($event_id,$finishedIDs))
          continue;

        foreach($arrEvent[$event_id] as $event_domain) {
          $event_domain = str_replace('.html','',$event_domain);
          $arrPages['de'][] = $domain . static::generateFrontendUrl($objPages->row(), substr($event_domain,strpos($event_domain,'/')), $strLanguage);
        }
        $finishedIDs[] = $event_id;
      }
    }

    return $arrPages;
  }
}