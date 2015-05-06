<?php
/*
Plugin Name: Google AdSense
Plugin URI: http://wordpress.org/plugins/google-publisher
Description: Use Google AdSense and other Google tools with your WordPress site.
Author: Google
Version: 1.1.0
Author URI: https://support.google.com/adsense/answer/3380626
License: GPL2
Text Domain: google-publisher-plugin
*/
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

require_once 'ClassAutoloader.php';

register_activation_hook(__FILE__,
    array('GooglePublisherPluginUtils', 'meetsMinimumRequirementsOrDie'));

$google_publisher_plugin_file = __FILE__;
if (isset($plugin)) {
  $google_publisher_plugin_file = $plugin;
}

GooglePublisherPlugin::$basename =
    plugin_basename($google_publisher_plugin_file);

/**
 * This class is the main class of the AdSense Plugin. It manages
 * initialization of other classes, URL parameters and site verification.
 */
class GooglePublisherPlugin {
  public static $basename;

  const PLUGIN_VERSION = '1.1.0';

  private $admin;
  private $configuration;
  private $tags;

  public function __construct() {
    $this->versionCheck();

    $this->admin = null;
    $this->configuration = null;
    $this->tags = null;
    $this->updater = null;

    // Defer initialization until all plugins are loaded, to allow admin rights
    // and nonce checks.
    add_action('plugins_loaded', array($this, 'initialize'));
    add_action('wp_enqueue_scripts', array($this, 'enqueuePreviewLoader'));
  }

  /**
   * Enqueues previewloader.js to be loaded in the <head> section of the page
   * when the user is logged in as an admin and not viewing an admin page.
   */
  public function enqueuePreviewLoader() {
    // Note that is_admin returns whether the current page is an admin page,
    // not whether the current user is an admin.
    if (!is_admin() && current_user_can('manage_options')) {
      wp_enqueue_script(
          'previewloader', plugins_url('js/previewloader.js', __FILE__),
          false, self::PLUGIN_VERSION);
    }
  }

  /**
   * Initializes the Tags object if it was not already loaded and this is a
   * request that it should be loaded for.
   *
   * @param string $action The action that the current request represents.
   */
  public function initializeTags($action) {
    if (!isset($this->tags)) {
      $preview_mode = isset($action) && $action == self::ACTION_PREVIEW;
      $this->tags =
          new GooglePublisherPluginTags($this->configuration, $preview_mode);
    }
  }

  /**
   * Prints all verification tokens for Google Webmaster Tools as <meta>
   * tags. This function should be called in the <head> section of the page.
   */
  public function printVerificationTokens() {
    foreach ($this->configuration->getSiteVerificationTokens() as $token) {
      echo '<meta name="google-site-verification" content="' .
          htmlspecialchars($token) . '" />';
    }
  }

  const CMS_COMMAND_SET_SITE_CONFIG = 'set_site_config';
  const CMS_COMMAND_WRITE_SITE_DATA = 'write_site_data';
  const CMS_COMMAND_CHECK_UPDATE_SUPPORT = 'check_update_support';
  const CMS_COMMAND = 'command';
  const CMS_COMMAND_PARAM = 'param';
  const CMS_COMMAND_SUCCESS = 'GooglePublisherPluginCmsCommandStatus::OK';

  /**
   * Processes a CMS command sent from publisherplugin.google.com using the
   * postMessage API.
   *
   * @return mixed Void on success, or a string describing the error on failure.
   */
  public function handleCmsCommandAction() {
    GooglePublisherPluginUtils::checkAdminRights();
    // Reject invalid nonces.
    if (!isset($_REQUEST['_wpnonce']) || !wp_verify_nonce($_REQUEST['_wpnonce'],
        GooglePublisherPluginAdmin::CMS_COMMAND_ACTION)) {
      GooglePublisherPluginUtils::dieSilently();
      return;
    }
    $param = $this->getCommandParam();
    if (array_key_exists(self::CMS_COMMAND, $_REQUEST)) {
      switch ($_REQUEST[self::CMS_COMMAND]) {
        // @codingStandardsIgnoreStart
        case self::CMS_COMMAND_SET_SITE_CONFIG:
          if (is_null($param)) {
            return 'Missing param';
          }
          return $this->configuration->updateConfig($param);
        case self::CMS_COMMAND_WRITE_SITE_DATA:
          if (is_null($param)) {
            return 'Missing param';
          }
          return $this->handleWriteSiteDataAction($param);
        // @codingStandardsIgnoreEnd
        case self::CMS_COMMAND_CHECK_UPDATE_SUPPORT:
          return self::CMS_COMMAND_SUCCESS . '::' .
              $this->updater->getUpdateSupport();
      }
      return 'Unknown command';
    }
    return 'Missing command';
  }

  private function getCommandParam() {
    if (array_key_exists(self::CMS_COMMAND_PARAM, $_REQUEST)) {
      $param = $_REQUEST[self::CMS_COMMAND_PARAM];
      // If magic quotes are enabled we need to undo what it did.
      if (get_magic_quotes_gpc()) {
        $param = stripslashes($param);
      }
      return $param;
    }
    return null;
  }

  private function handleWriteSiteDataAction($jsonEncodedSiteData) {
    $decoded = json_decode($jsonEncodedSiteData, true);
    if ($decoded === null) {
      return 'Failed to decoded site data (invalid JSON)';
    }

    if (array_key_exists('verification_token', $decoded)) {
      $token = htmlspecialchars($decoded['verification_token']);
      if (!$this->configuration->writeSiteVerificationToken($token)) {
        return 'Write site verification token failed';
      }
    }
    if (array_key_exists('site_id', $decoded)) {
      if (!$this->configuration->writeSiteId($decoded['site_id'])){
        return 'Write site ID failed';
      }
    }

    return self::CMS_COMMAND_SUCCESS;
  }

  /**
   * Checks if the plugin's version defined in the source matches the last
   * installed version stored in WordPress' options.
   */
  private function versionCheck() {
    $current_version = get_option(
        GooglePublisherPluginConfiguration::PLUGIN_VERSION_KEY, '0.0.0');
    if (version_compare($current_version, self::PLUGIN_VERSION, '=')) {
      // Versions match, bail out.
      return;
    }
    // Placeholder for upgrade / downgrade logic.
    update_option(GooglePublisherPluginConfiguration::PLUGIN_VERSION_KEY,
        self::PLUGIN_VERSION);
  }

  const API_URL_PARAMETER = 'google_publisher_plugin_action';
  const WRITE_SITE_DATA_ACTION = 'write_site_data';
  const ACTION_PREVIEW = 'preview';
  const ACTION_VERIFY = 'verify';
  const ACTION_TRIGGER_UPDATE = 'trigger_update';
  const CMS_COMMAND_ACTION = 'cms_command';

  /**
   * Runs an action requested through URL or POST parameters.
   *
   * @param string $action The action to run.
   */
  public function runAction($action) {
    switch ($action) {
      case self::ACTION_PREVIEW:
        add_filter('show_admin_bar', '__return_false');
        break;
      case self::ACTION_VERIFY:
        $this->admin->setShowGetStarted(false);
        break;
      case self::ACTION_TRIGGER_UPDATE:
        $this->updater->doUpdate();
        break;
      case self::CMS_COMMAND_ACTION:
        echo esc_html($this->handleCmsCommandAction());
        GooglePublisherPluginUtils::dieSilently();
        break;
    }
  }

  /**
   * Initializes the plugin by loading the textdomain and initializing the Admin
   * and Tag objects.
   */
  public function initialize() {
    load_plugin_textdomain('google-publisher-plugin', false,
        basename(dirname(__FILE__)) . '/languages/');
    $this->configuration = new GooglePublisherPluginConfiguration();

    $this->updater = new GooglePublisherPluginUpdater($this->configuration);

    if (is_admin()) {
      $this->admin = new GooglePublisherPluginAdmin(
          self::PLUGIN_VERSION, $this->configuration);
      $this->notifier = new GooglePublisherPluginNotifier($this->configuration);
      $this->notifier->notify();
    }
    $action = null;
    if (array_key_exists(self::API_URL_PARAMETER, $_REQUEST)) {
      $action = filter_var(
          $_REQUEST[self::API_URL_PARAMETER], FILTER_SANITIZE_STRING);
      $this->runAction($action);
    }
    $this->initializeTags($action);

    add_action('wp_head', array($this, 'printVerificationTokens'));
  }
}

if (!isset($GOOGLE_PUBLISHER_PLUGIN_UNIT_TESTS)) {
  new GooglePublisherPlugin();
}
