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

class GooglePublisherPluginTags {

  // Url parameter specifying whether to send page details in the WordPress
  // responses, both as metadata and in the HTTP header.
  const SEND_PAGE_DETAILS = 'google_publisher_plugin_page_details';
  const PAGE_TYPE_META_TAG_NAME = 'google-publisher-plugin-pagetype';
  const EXCLUDE_ADS_META_TAG_NAME = 'google-publisher-plugin-exclude-ads';

  const THEME_HASH_HTTP_HEADER = 'X-Publisher-Plugin-Theme-Hash';
  const VERSION_HTTP_HEADER = 'X-Publisher-Plugin-Version';

  private $configuration;
  private $current_page_type;
  private $exclude_ads;
  private $theme_hash;
  private $send_page_details;

  /**
   * @param Configuration $configuration The configuration object to use
   *        (required).
   * @param boolean $preview_mode True if in preview mode.
   */
  public function __construct($configuration, $preview_mode) {
    $this->configuration = $configuration;
    $this->send_page_details = array_key_exists(self::SEND_PAGE_DETAILS, $_GET);

    // Note we can't compute the theme hash here, since this is executed before
    // before plugins like WP touch have had a chance to change the theme.
    $this->theme_hash = '';

    // To determine the current page type, WordPress needs to have
    // initialized wp_query. The template_redirect hook is the first
    // action hook after that initialization.
    add_action('template_redirect', array($this,
        'determineCurrentPageDetails'));
    add_action('send_headers', array($this, 'computeThemeHashAndSetHeaders'),
        PHP_INT_MAX);

    if ($preview_mode || $this->send_page_details) {
      add_action('wp_head', array($this, 'printPageDetails'));
    }

    if (!$preview_mode) {
      add_action('wp_head', array($this, 'wpHead'), PHP_INT_MAX);
      add_filter('the_content', array($this, 'wpRepeating'), PHP_INT_MAX, 1);
      add_filter('the_excerpt', array($this, 'wpRepeating'), PHP_INT_MAX, 1);
      add_action('wp_footer', array($this, 'wpFooter'), ~PHP_INT_MAX);
    }
  }

  /**
   * Prints the page details in meta data to the page. Expected to be called on
   * the wp_head action hook.
   */
  public function printPageDetails() {
    printf('<meta name="%s" content="%s">', self::PAGE_TYPE_META_TAG_NAME,
           htmlspecialchars($this->current_page_type));
    if ($this->exclude_ads) {
      printf('<meta name="%s" content="true">',
          self::EXCLUDE_ADS_META_TAG_NAME);
    }
  }

  /**
   * Computes an opaque ID for the current Theme.
   *
   * If the request is flagged to send_page_details then send headers containing
   * the current theme hash and plugin version. The theme hash is stored by the
   * Google Publisher Plugin in the ad configuration so the php plugin can
   * detect if the theme has changed at serving time, and turn off ads if
   * needed.
   */
  public function computeThemeHashAndSetHeaders() {
    $this->theme_hash = $this->computeThemeHash();

    if ($this->send_page_details) {
      $this->emitHttpHeader(self::THEME_HASH_HTTP_HEADER . ': ' .
          $this->theme_hash);
      $this->emitHttpHeader(self::VERSION_HTTP_HEADER . ': ' .
          GooglePublisherPlugin::PLUGIN_VERSION);
    }
  }

  /**
   * Wrapper for the php header function, to facilitate unit testing.
   */
  public function emitHttpHeader($value) {
    header($value);
  }

  /**
   * Computes the md5 digest hash of the current active theme directory and the
   * site id.  NOTE we don't use get_template here because we can't use that to
   * detect when WP Touch v3.1.5 is active.
   */
  public function computeThemeHash() {
    return md5(
        parse_url(get_bloginfo('template_directory'), PHP_URL_PATH) . '#' .
        $this->configuration->getSiteId());
  }

  /**
   * Inserts tags into the <head> section. Expected to be called on the wp_head
   * action hook.
   */
  public function wpHead() {
    if ($this->exclude_ads) {
      return;
    }
    // Inserts a js script tag which don't need escaping.
    echo $this->configuration->getTag(
        $this->current_page_type, 'head', $this->theme_hash);
  }

  /**
   * Inserts the repeating tag before the content of every post and excerpt.
   * Executed as a filter on the_content and the_excerpt.
   *
   * @return string The given $content prefixed with the repeating tag for the
   *         current configuration.
   */
  public function wpRepeating($content) {
    if ($this->exclude_ads) {
      return $content;
    }
    $repeatingTag = $this->configuration->getTag(
        $this->current_page_type, 'repeating', $this->theme_hash);

    return $repeatingTag . $content;
  }

  /**
   * Inserts tags at the end of the <body> section. Expected to be called on the
   * wp_footer action hook.
   */
  public function wpFooter() {
    if ($this->exclude_ads) {
      return;
    }
    // Inserts js script tags which don't need escaping.
    echo $this->configuration->getTag(
        $this->current_page_type, 'repeating', $this->theme_hash);
    echo $this->configuration->getTag(
        $this->current_page_type, 'bodyEnd', $this->theme_hash);
  }

  /**
   * Determines the current page details. This should be called after WordPress
   * has initialized wp_query.
   */
  public function determineCurrentPageDetails() {
    if (!isset($this->current_page_type)) {
      $this->current_page_type =
          GooglePublisherPluginUtils::getWordPressPageType();
    }
    if (!isset($this->exclude_ads)) {
      $this->exclude_ads =
          GooglePublisherPluginUtils::getExcludeAds();
    }
  }

  public function getThemeHash() {
    return $this->theme_hash;
  }
}
