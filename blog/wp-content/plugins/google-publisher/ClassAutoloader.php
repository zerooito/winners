<?php
/*
Copyright 2013 Google Inc. All Rights Reserved.

This file is part of the AdSense Plugin.

The AdSense Plugin is free software:
you can redistribute it and/or modify it under the terms of the
GNU General Public License as published by the Free Software Foundation,
either version 2 of the License, or (at your option) any later version.

The AdSense Plugin is distributed in the hope that it
will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty
of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU General
Public License for more details.

You should have received a copy of the GNU General Public License
along with the AdSense Plugin.
If not, see <http://www.gnu.org/licenses/>.
*/

if(!defined('ABSPATH')) {
  exit;
}

spl_autoload_register(
    array('GooglePublisherPluginClassAutoloader', 'autoload'), false);

/**
 * A class which contains the autoload function, that the spl_autoload_register
 * will use to autoload PHP classes.
 */
class GooglePublisherPluginClassAutoloader {

  /**
   * A list of class names that are whitelisted for autoloading.
   */
  protected static $CLASSNAME_WHITELIST = array(
    'GooglePublisherPluginAdmin' => '',
    'GooglePublisherPluginConfiguration' => '',
    'GooglePublisherPluginNotifier' => '',
    'GooglePublisherPluginTags' => '',
    'GooglePublisherPluginUpdater' => '',
    'GooglePublisherPluginUpdaterStatus' => '',
    'GooglePublisherPluginUtils' => '',
  );

  private static $CLASSNAME_PREFIX = 'GooglePublisherPlugin';

  /**
   * Static method used by the autoloader, responsible for locating all
   * the whitelisted plugin's classes.
   *
   * Example usage:
   *   <code>
   *     spl_autoload_register(
   *         array('GooglePublisherPluginClassAutoloader', 'autoload'));
   *   </code>
   *
   * @param string $className The name of the Class to load.
   */
  public static function autoload($className) {
    if (isset($className) && is_string($className)
        && array_key_exists($className, self::$CLASSNAME_WHITELIST)) {
      $classFile = dirname(__FILE__) . '/'
          . substr($className, strlen(self::$CLASSNAME_PREFIX)) . '.php';
      include_once $classFile;
    }
  }
}
