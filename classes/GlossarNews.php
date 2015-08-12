<?php

/**
 * Contao Open Source CMS
 */

namespace sioweb\contao\extensions\glossar;
use Contao;

/**
 * @file GlossarNews.php
 * @class GlossarNews
 * @author Sascha Weidner
 * @version 3.0.0
 * @package sioweb.contao.extensions.glossar
 * @copyright Sascha Weidner, Sioweb
 */
class GlossarNews extends \ModuleNews {

  public function __construct() {}

  public function compile() {}

  public function clearGlossar($time) {
    $this->import('Database');
    $this->Database->prepare("UPDATE tl_news SET glossar = NULL,fallback_glossar = NULL,glossar_time = ? WHERE glossar_time != ?")->execute($time,$time);
  }

  public function glossarContent($item,$strContent,$template) {
    if(empty($item)) return array();

    $News = \NewsModel::findByAlias(\Input::get('items'));
    return $News->glossar;
  }

  public function updateCache($item,$arrTerms,$strContent) {
    preg_match_all('#'.implode('|',$arrTerms['both']).'#is', $strContent, $matches);
    $matches = array_unique($matches[0]);

    if(empty($matches))
      return;

    $News = \NewsModel::findByAlias($item);
    $News->glossar = implode('|',$matches);
    $News->save();
  }

  public function generateUrl($arrPages) {
    $arrPages = array();

    $News = \NewsModel::findAll();
    if(empty($News))
      return array();

    $arrNews = array();
    while($News->next()) {
      if(!empty($News))
        $arrNews[$News->pid][] = $this->generateNewsUrl($News);
    }

    $NewsReader = \ModuleModel::findByType('newsreader');
    if(empty($NewsReader))
      return array();

    $arrReader = array();
    while($NewsReader->next()) $arrReader[$NewsReader->id] = deserialize($NewsReader->news_archives);

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

      foreach($arrReader[$ReaderId] as $news_id) {
        if(in_array($news_id,$finishedIDs))
          continue;

        foreach($arrNews[$news_id] as $news_domain) {
          $news_domain = str_replace('.html','',$news_domain);
          $arrPages['de'][] = $domain . static::generateFrontendUrl($objPages->row(), substr($news_domain,strpos($news_domain,'/')), $strLanguage);
        }
        $finishedIDs[] = $news_id;
      }
    }
    return $arrPages;
  }
}