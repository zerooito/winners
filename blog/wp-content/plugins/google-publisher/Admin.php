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

require_once 'ClassAutoloader.php';

/**
 * The GooglePublisherPluginAdmin class should be instantiated only in
 * administration mode. It registers WordPress hooks to create the admin menu
 * entry and the plugin admin page. This class also generates the environment
 * data to send to publisherplugin.google.com
 */
class GooglePublisherPluginAdmin {
  const PUBLISHER_PLUGIN_FRONTEND_URL = 'https://publisherplugin.google.com';

  /** Used to generate and check nonce on the cms command action. */
  const CMS_COMMAND_ACTION = "cms_command_action";

  /** Used to generate and check nonce on the metabox. */
  const METABOX_ACTION = "disable_ads_metabox_action";

  /** A relative URL to plugin administration page. */
  const ADMIN_PAGE_LOCATION = 'options-general.php?page=GooglePublisherPlugin';

  private $plugin_version;

  private $configuration;

  private $show_get_started;

  public function __construct($plugin_version, $configuration) {
    $this->plugin_version = $plugin_version;
    $this->configuration = $configuration;
    add_action('admin_menu', array($this, 'addAdminMenu'));
    if (count($configuration->get()) > 0) {
      add_action('add_meta_boxes', array($this, 'addPageEditOptions'));
      add_action('save_post', array($this, 'savePageEditOptions'));
    }
    add_filter(
        'plugin_action_links_' . GooglePublisherPlugin::$basename,
        array($this, 'addSettingsLink'), 10, 1);
    $this->show_get_started = is_null($configuration->getSiteId());
  }

  /**
   * Generates the environment object which contains basis data about the site.
   */
  public function getEnvironmentData() {
    global $wp_version;
    $environment = GooglePublisherPluginUtils::getUrlsToAnalyze();
    $environment['siteId'] = $this->configuration->getSiteId();
    $environment['pluginVersion'] = $this->plugin_version;
    $environment['wpVersion'] = $wp_version;
    $environment['hl'] = get_locale();
    $environment['updateSupport'] = $this->configuration->getUpdateSupport();
    return $environment;
  }

  public function addAdminMenu() {
    $page = add_options_page(
        'Options',
        'AdSense',
        'manage_options',
        'GooglePublisherPlugin', array($this, 'onAdminMenu'));
     // Only enqueue the admin CSS on the Google Publisher Plugin admin page.
     add_action('admin_print_styles-' . $page, array($this, 'enqueueAdminCss'));
  }

  public function addPageEditOptions() {
    add_meta_box('googlePublisherPluginMetaBox',
        __('AdSense Plugin', 'google-publisher-plugin'),
        array($this, 'showPageEditOptions'), 'page', 'side', 'low');
  }

  public function showPageEditOptions() {
    global $post;
    $exclude_ads = get_post_meta($post->ID,
        GooglePublisherPluginUtils::EXCLUDE_ADS_METADATA, true);
    wp_nonce_field(self::METABOX_ACTION, 'gppMetaboxNonce');

    if ($exclude_ads) {
      $exclude_checked = ' checked';
    } else {
      $exclude_checked = '';
    }
    echo '<input type="checkbox" name="gppDisableAds"',
        ' id="google-publisher-plugin-disable-ads" value="yes"',
        $exclude_checked, '/>',
        __('Disable ads on this page', 'google-publisher-plugin');
  }

  public function savePageEditOptions($post_id) {
    // If googlePublisherPluginMetabox has not been inserted then the nonce will
    // not have been set and the function should return.
    if (!isset($_POST['gppMetaboxNonce']) ||
        !wp_verify_nonce($_POST['gppMetaboxNonce'], self::METABOX_ACTION)) {
      return;
    } else if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
      return;
    } else if (!current_user_can('edit_page', $post_id)) {
      return;
    } else if (isset($_POST['gppDisableAds']) &&
        $_POST['gppDisableAds'] == 'yes') {
      update_post_meta($post_id,
          GooglePublisherPluginUtils::EXCLUDE_ADS_METADATA, true);
    } else {
      delete_post_meta($post_id,
          GooglePublisherPluginUtils::EXCLUDE_ADS_METADATA);
    }
  }

  public function onAdminMenu() {
    GooglePublisherPluginUtils::checkAdminRights();

    global $wp_version;
    // Admin menu contains an iframe showing publisherplugin.google.com.
    // The iframe can communicate with the main page through window.postMessage
    // API, these are managed in admin.js.
    $parameters = array();
    $parameters['site'] = get_home_url();
    $parameters['siteId'] = $this->configuration->getSiteId();
    $parameters['adminUrl'] = admin_url(self::ADMIN_PAGE_LOCATION);
    $parameters['version'] = $this->plugin_version;
    $parameters['wp_version'] = $wp_version;
    $parameters['hl'] = get_locale();

    $show_get_started = $this->show_get_started;

    $start_url = self::PUBLISHER_PLUGIN_FRONTEND_URL . '/start?' .
        http_build_query($parameters);
    $iframe_url = self::PUBLISHER_PLUGIN_FRONTEND_URL . '?' .
        http_build_query($parameters);
    $javascript_url = plugins_url('js/admin.js?ver=' .
        filter_var($this->plugin_version, FILTER_SANITIZE_STRING), __FILE__);
    $environment = $this->getEnvironmentData();
    $cmsCommandNonce = wp_create_nonce(self::CMS_COMMAND_ACTION);

    include 'AdminTemplate.php';
  }

  /** Adds the 'Settings' link to the Installed Plugins page. */
  public static function addSettingsLink($links) {
    array_unshift($links,
        sprintf('<a href="%s">%s</a>', admin_url(self::ADMIN_PAGE_LOCATION),
                __('Settings')));
    return $links;
  }

  public function enqueueAdminCss() {
    wp_enqueue_style('google-publisher-plugin-admin-css',
       plugins_url('css/admin.css', __FILE__), false,
       $this->plugin_version);
  }

  /**
   * Sets whether the "get started" page should be shown on the admin settings
   * page. If set to true, the "get started" page that's part of the plugin will
   * be shown. If set to false, an iframe to publisherplugin.google.com will
   * be shown.
   *
   * @param boolean $show_get_started Whether the "get started" page should be
   *        shown.
   */
  public function setShowGetStarted($show_get_started) {
    $this->show_get_started = $show_get_started;
  }
}
