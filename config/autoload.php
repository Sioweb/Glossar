<?php

/**
 * Contao Open Source CMS
 */

/**
 * @file autoload.php
 * @author Sascha Weidner
 * @version 3.0.0
 * @package sioweb.contao.extensions.glossar
 * @copyright Sascha Weidner, Sioweb
 */


ClassLoader::addNamespaces(array
(
  'sioweb\contao\extensions\glossar'
));

ClassLoader::addClasses(array
(
  // classes
  'sioweb\contao\extensions\glossar\RebuildGlossar'   => 'system/modules/Glossar/classes/RebuildGlossar.php',
  'sioweb\contao\extensions\glossar\GlossarStatus'    => 'system/modules/Glossar/classes/GlossarStatus.php',
  'sioweb\contao\extensions\glossar\GlossarLog'       => 'system/modules/Glossar/classes/GlossarLog.php',
  'sioweb\contao\extensions\glossar\Glossar'          => 'system/modules/Glossar/classes/Glossar.php',

  'sioweb\contao\extensions\glossar\GlossarNews'      => 'system/modules/Glossar/classes/GlossarNews.php',
  'sioweb\contao\extensions\glossar\GlossarFAQ'       => 'system/modules/Glossar/classes/GlossarFAQ.php',
  'sioweb\contao\extensions\glossar\GlossarEvents'    => 'system/modules/Glossar/classes/GlossarEvents.php',

  // Elements
  'sioweb\contao\extensions\glossar\ContentGlossar'         => 'system/modules/Glossar/elements/ContentGlossar.php',
  'sioweb\contao\extensions\glossar\ContentGlossarCloud'    => 'system/modules/Glossar/elements/ContentGlossarCloud.php',

  // Models
  'StdModel'                                          => 'system/modules/Glossar/models/StdModel.php',
  'SWGlossarModel'                                    => 'system/modules/Glossar/models/SWGlossarModel.php',
  'GlossarPageModel'                                  => 'system/modules/Glossar/models/GlossarPageModel.php',
  'GlossarContentModel'                               => 'system/modules/Glossar/models/GlossarContentModel.php',
  'GlossarModel'                                      => 'system/modules/Glossar/models/GlossarModel.php',
  'GlossarLogModel'                                   => 'system/modules/Glossar/models/GlossarLogModel.php',
  'GlossarNewsArchiveModel'                           => 'system/modules/Glossar/models/GlossarNewsArchiveModel.php',
  'GlossarFaqCategoryModel'                           => 'system/modules/Glossar/models/GlossarFaqCategoryModel.php',
  'GlossarCalendarModel'                              => 'system/modules/Glossar/models/GlossarCalendarModel.php',
));

/* Support for older CTO Versions */
$version = '';
// Maybe for older Support
// if(VERSION <= 2.20)
//   $version = '/2.20';
if(VERSION <= 3.2)
  $version = '/3.2';

TemplateLoader::addFiles(array
(
  'ce_glossar'          => 'system/modules/Glossar/templates'.$version,
  'ce_glossar_cloud'    => 'system/modules/Glossar/templates'.$version,

  'glossar_default'     => 'system/modules/Glossar/templates',
  'glossar_pagination'  => 'system/modules/Glossar/templates',
  'glossar_layer'       => 'system/modules/Glossar/templates',
  'glossar_error'       => 'system/modules/Glossar/templates',
  'glossar_description' => 'system/modules/Glossar/templates',

  'be_rebuild_glossar'  => 'system/modules/Glossar/templates/backend',
  'be_glossar_import'   => 'system/modules/Glossar/templates/backend',
  'be_glossar_export'   => 'system/modules/Glossar/templates/backend',
  'be_glossar_log'      => 'system/modules/Glossar/templates/backend',
  'be_glossar_status'   => 'system/modules/Glossar/templates/backend',

  'be_glossar_type_valid'   => 'system/modules/Glossar/templates/backend/inputType',
  'be_glossar_type_page'    => 'system/modules/Glossar/templates/backend/inputType',
  'be_glossar_type_select'  => 'system/modules/Glossar/templates/backend/inputType',
  'be_glossar_type_content' => 'system/modules/Glossar/templates/backend/inputType',
));