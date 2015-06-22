<?php

/**
 * Contao Open Source CMS
 */

namespace sioweb\contao\extensions\glossar;
use Contao;

/**
 * @file RebuildGlossar.php
 * @class RebuildGlossar
 * @author Sascha Weidner
 * @version 3.0.0
 * @package sioweb.contao.extensions.glossar
 * @copyright Sascha Weidner, Sioweb
 */


class RebuildGlossar extends \Backend implements \executable {

  public function rebuild($strContent,$arrData,$arrSet) {
    global $objPage;

    $Glossar = \SWGlossarModel::findAll(array('order'=>' CHAR_LENGTH(title) DESC'));
    if(empty($Glossar))
      return;

    while($Glossar->next())
      $arrGlossar[] = $Glossar->title;

    preg_match_all('#'.implode('|',$arrGlossar).'#', $strContent, $matches);
    $matches = array_unique($matches[0]);

    $Page = \PageModel::findByPk($objPage->id);
    $Page->glossar = implode('|',$matches);
    $Page->save();
  }

  /**
   * Return true if the module is active
   * @return boolean
   */
  public function isActive()
  {
    return (\Config::get('enableGlossar') && \Input::get('act') == 'glossar');
  }


  /**
   * Generate the module
   * @return string
   */
  public function run()
  {
    if (!\Config::get('enableGlossar'))
    {
      return '';
    }

    $time = time();
    $objTemplate = new \BackendTemplate('be_rebuild_glossar');
    $objTemplate->action = ampersand(\Environment::get('request'));
    $objTemplate->indexHeadline = $GLOBALS['TL_LANG']['tl_maintenance']['glossarIndex'];
    $objTemplate->isActive = $this->isActive();

    $arrPages = $this->findGlossarPages();

    // Add the error message
    if ($_SESSION['REBUILD_INDEX_ERROR'] != '')
    {
      $objTemplate->indexMessage = $_SESSION['REBUILD_INDEX_ERROR'];
      $_SESSION['REBUILD_INDEX_ERROR'] = '';
    }

    // Rebuild the index
    if (\Input::get('act') == 'glossar')
    {
      // Check the request token (see #4007)
      if (!isset($_GET['rt']) || !\RequestToken::validate(\Input::get('rt')))
      {
        $this->Session->set('INVALID_TOKEN_URL', \Environment::get('request'));
        $this->redirect('contao/confirm.php');
      }

      $arrPages = $this->findGlossarPages();

      // HOOK: take additional pages
      if (isset($GLOBALS['TL_HOOKS']['getGlossarPages']) && is_array($GLOBALS['TL_HOOKS']['getGlossarPages']))
      {
        foreach ($GLOBALS['TL_HOOKS']['getGlossarPages'] as $callback)
        {
          $this->import($callback[0]);
          $arrPages = $this->$callback[0]->$callback[1]($arrPages);
        }
      }

      // Return if there are no pages
      if (empty($arrPages))
      {
        $_SESSION['REBUILD_INDEX_ERROR'] = $GLOBALS['TL_LANG']['tl_maintenance']['noGlossarPages'];
        $this->redirect($this->getReferer());
      }

      // Truncate the search tables
      $this->import('Automator');
      $this->Automator->purgeSearchTables();

      // Hide unpublished elements
      $this->setCookie('FE_PREVIEW', 0, ($time - 86400));

      // Calculate the hash
      $strHash = sha1(session_id() . (!\Config::get('disableIpCheck') ? \Environment::get('ip') : '') . 'FE_USER_AUTH');

      // Remove old sessions
      $this->Database->prepare("DELETE FROM tl_session WHERE tstamp<? OR hash=?")
               ->execute(($time - \Config::get('sessionTimeout')), $strHash);

      // Log in the front end user
      if (is_numeric(\Input::get('user')) && \Input::get('user') > 0)
      {
        // Insert a new session
        $this->Database->prepare("INSERT INTO tl_session (pid, tstamp, name, sessionID, ip, hash) VALUES (?, ?, ?, ?, ?, ?)")
                 ->execute(\Input::get('user'), $time, 'FE_USER_AUTH', session_id(), \Environment::get('ip'), $strHash);

        // Set the cookie
        $this->setCookie('FE_USER_AUTH', $strHash, ($time + \Config::get('sessionTimeout')), null, null, false, true);
      }

      // Log out the front end user
      else
      {
        // Unset the cookies
        $this->setCookie('FE_USER_AUTH', $strHash, ($time - 86400), null, null, false, true);
        $this->setCookie('FE_AUTO_LOGIN', \Input::cookie('FE_AUTO_LOGIN'), ($time - 86400), null, null, false, true);
      }

      $strBuffer = '';
      $rand = rand();

      // Display the pages
      for ($i=0, $c=count($arrPages); $i<$c; $i++)
      {
        $strBuffer .= '<span class="page_url" data-url="' . $arrPages[$i] . '#' . $rand . $i . '">' . \String::substr($arrPages[$i], 100) . '</span><br>';
        unset($arrPages[$i]); // see #5681
      }

      $objTemplate->content = $strBuffer;
      $objTemplate->note = $GLOBALS['TL_LANG']['tl_maintenance']['glossarNote'];
      $objTemplate->loading = $GLOBALS['TL_LANG']['tl_maintenance']['glossarLoading'];
      $objTemplate->complete = $GLOBALS['TL_LANG']['tl_maintenance']['glossarComplete'];
      $objTemplate->indexContinue = $GLOBALS['TL_LANG']['MSC']['continue'];
      $objTemplate->theme = \Backend::getTheme();
      $objTemplate->isRunning = true;

      return $objTemplate->parse();
    }

    $arrUser = array(''=>'-');

    // Get active front end users
    $objUser = $this->Database->execute("SELECT id, username FROM tl_member WHERE disable!=1 AND (start='' OR start<$time) AND (stop='' OR stop>$time) ORDER BY username");

    while ($objUser->next())
    {
      $arrUser[$objUser->id] = $objUser->username . ' (' . $objUser->id . ')';
    }

    // Default variables
    $objTemplate->user = $arrUser;
    $objTemplate->indexLabel = $GLOBALS['TL_LANG']['tl_maintenance']['frontendUser'][0];
    $objTemplate->indexHelp = (\Config::get('showHelp') && strlen($GLOBALS['TL_LANG']['tl_maintenance']['frontendUser'][1])) ? $GLOBALS['TL_LANG']['tl_maintenance']['frontendUser'][1] : '';
    $objTemplate->indexSubmit = $GLOBALS['TL_LANG']['tl_maintenance']['glossarSubmit'];

    return $objTemplate->parse();
  }

  protected function findGlossarPages() {
    $time = time();
    $arrPages = array();
    $objPages = \PageModel::findActiveAndEnabledGlossarPages();
    if(!empty($objPages))
      while($objPages->next()) {
        $domain = \Environment::get('base');

        $strLanguage = 'de';
        if ((!$objPages->start || $objPages->start < $time) && (!$objPages->stop || $objPages->stop > $time)) {
          $arrPages[] = $domain . static::generateFrontendUrl($objPages->row(), null, $strLanguage);

          $objArticle = \ArticleModel::findBy(array("tl_article.pid=? AND (tl_article.start='' OR tl_article.start<$time) AND (tl_article.stop='' OR tl_article.stop>$time) AND tl_article.published=1 AND tl_article.showTeaser=1"),array($objPages->id),array('order'=>'sorting'));

          if(!empty($objArticle))
            while ($objArticle->next())
              $arrPages[] = $domain . static::generateFrontendUrl($objPages->row(), '/articles/' . (($objArticle->alias != '' && !\Config::get('disableAlias')) ? $objArticle->alias : $objArticle->id), $strLanguage);
        }
      }
    return $arrPages;
  }
}