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

/** Static class containing utility functions. */
class GooglePublisherPluginUtils {

  private static $REQUIRED_EXTENSIONS = array('filter', 'json', 'pcre', 'SPL');

  const MINIMUM_PHP_VERSION = '5.2.0';

  /** The metadata key to add into the wp database to exclude ads. */
  const EXCLUDE_ADS_METADATA = 'GooglePublisherPlugin_ExcludeAds';

  /**
   * Gets the page type from WordPress.
   *
   * @return string A string representation of the current page type,
   *     corresponding to the values used by publisherplugin.google.com.
   */
  public static function getWordPressPageType() {
    // is_front_page() returns true if (1) a static front page is set and this
    // is that page, or (2) the front page is the blog home page and this
    // is the blog home page.
    if (is_front_page()) {
      return 'front';
    }
    if (is_home()) {
      return 'home';
    }
    if (is_single()) {
      return 'singlePost';
    }
    if (is_page()) {
      $pageTemplate = self::getPageTemplate();
      if ($pageTemplate == 'default') {
        return 'page';
      } else {
        return hash('sha256', $pageTemplate);
      }
    }
    if (is_category()) {
      return 'category';
    }
    if (is_archive()) {
      return 'archive';
    }
    if (is_search()) {
      return 'search';
    }
    if (is_404()) {
      return 'errorPage';
    }
    return '';
  }

  /**
   * Gets the template file from the id. If the template is not in use by the
   * current theme then 'default' is returned. This does not handle page
   * specific php files.
   *
   * @param int id The id of the page template to return. If no id is specified
   *     then the id of the current page is used.
   *
   * @return string The template name if it is in use, default otherwise
   */
  private static function getPageTemplate($id = null) {
    $template = get_page_template_slug($id);
    if (is_string($template) && $template != '') {
      $templates = wp_get_theme()->get_page_templates();
      if (array_key_exists($template, $templates)) {
        return $template;
      }
    }
    return 'default';
  }

  /**
   * Finds if metadata for the page has been set excluding ads.
   *
   * @return boolean Whether metadata has been set to exclude ads.
   */
  public static function getExcludeAds() {
    return get_post_meta(get_the_ID(), self::EXCLUDE_ADS_METADATA, true) ==
        true;
  }

  /**
   * @return array An array of URLs to be analyzed. The number of
   *     URLs varies based on the WordPress configuration.
   */
  public static function getUrlsToAnalyze() {
    $urls = array();

    $siteUrl = self::getFrontPageUrl();
    $urls['siteUrl'] = $siteUrl;

    $latestPostUrl = self::getLatestPostUrl();
    if ($latestPostUrl != '') {
      $urls['latestPostUrl'] = $latestPostUrl;
    }

    $postsUrl = self::getPostsUrl();
    if ($postsUrl != '') {
      $urls['postsUrl'] = $postsUrl;
    }

    $customPageTemplates = self::getCustomPageTemplates($siteUrl, $postsUrl);

    if (isset($customPageTemplates['default'])) {
      $urls['latestSinglePageUrl'] = $customPageTemplates['default'];
      unset($customPageTemplates['default']);
    }

    if (!empty($customPageTemplates)) {
      $urls['customPageTemplateUrlMap'] = $customPageTemplates;
    }

    $customPageTemplateDisplayNames = wp_get_theme()->get_page_templates();
    if (!empty($customPageTemplateDisplayNames)) {
      $urls['customPageTemplateDisplayNames'] = $customPageTemplateDisplayNames;
    }

    $latestArchiveUrl = self::getLatestArchiveUrl();
    if ($latestArchiveUrl != '') {
      $urls['latestArchiveUrl'] = $latestArchiveUrl;
    }

    $categoryUrl = self::getCategoryUrl();
    if ($categoryUrl != '') {
      $urls['categoryUrl'] = $categoryUrl;
    }

    $urls['searchUrl'] = get_search_link('wordpress');

    return $urls;
  }

  public static function getFrontPageUrl() {
    return trailingslashit(get_home_url());
  }

  /**
   * Returns the permalink URL of the latest post if one exists.
   * Otherwise returns ''.
   */
  public static function getLatestPostUrl() {
    $result = self::getRecentPosts('post', 1);
    if (is_array($result) && !empty($result)) {
      return esc_url(get_permalink($result[0]->ID));
    }
    return '';
  }

  /**
   * Returns the permalink URL of the posts page, aka, the (blog) home page,
   * if one exists. Otherwise returns ''.
   */
  public static function getPostsUrl() {
    if (get_option('show_on_front') == 'page') {
      $postsPageId = get_option('page_for_posts');
      return esc_url(get_permalink($postsPageId));
    }
    return '';
  }

  /**
   * @return array A mapping of all of the page templates in use and an example
   *     page of each one. Pages with ads showing are preferred over pages with
   *     ads excluded.
   */
  private static function getCustomPageTemplates($siteUrl, $postsUrl) {
    $pages = get_pages(
      array('post_type' => 'page', 'post_status' => 'publish'));
    $customPageTemplates = array();
    $templatesWithExclusions = array();
    foreach ($pages as $page) {
      $pageUrl = esc_url(get_permalink($page->ID));
      if ($pageUrl == $siteUrl || $pageUrl == $postsUrl) {
        continue;
      }
      $pageTemplate = self::getPageTemplate($page->ID);
      $pageWithExclusions = get_post_meta($page->ID,
          self::EXCLUDE_ADS_METADATA, true);
      if (!isset($templatesWithExclusions[$pageTemplate])) {
        $templatesWithExclusions[$pageTemplate] = true;
      }
      // Note the pageTemplate is 'default' or the name of the php file
      if (!$pageWithExclusions) {
        $templatesWithExclusions[$pageTemplate] = false;
        $customPageTemplates[$pageTemplate] = $pageUrl;
      } else if ($templatesWithExclusions[$pageTemplate]) {
        $customPageTemplates[$pageTemplate] = $pageUrl;
      }
    }
    return $customPageTemplates;
  }

  /**
   * Returns a latest monthly archive URL if one exists. Otherwise returns ''.
   */
  public static function getLatestArchiveUrl() {
    $link = wp_get_archives(array('format' => 'link', 'echo' => 0,
        'limit' => 1, 'order' => 'DESC'));
    preg_match('/href\s*=\s*[\'\"]([^\'\"]+)[\'\"]/', $link, $matches);
    if (sizeof($matches) == 2) {
      return $matches[1];
    } else {
      return '';
    }
  }

  /**
   * Returns a category URL if one exists. Otherwise returns ''.
   */
  public static function getCategoryUrl() {
    $category = array_values(get_categories(array('number' => 1)));
    if (sizeof($category) == 1) {
      $categoryUrl = get_category_link($category[0]->term_id);
      return $categoryUrl;
    } else {
      return '';
    }
  }

  /**
   * Returns a given number of recent posts of the given type.
   *
   * @param string $type The type of posts to retrieve.
   * @param int $number The number of posts to retrieve.
   */
  public static function getRecentPosts($type, $number) {
    return get_posts(array('numberposts' => $number,
        'orderby' => 'post_date', 'order' => 'DESC', 'post_type' => $type,
        'post_status' => 'publish', 'suppress_filters' => true));
  }

  /**
   * Stops php interpretation.
   * When running unit tests, calls wp_die which can be intercepted by the
   * test environment.
   */
  public static function dieSilently() {
    global $GOOGLE_PUBLISHER_PLUGIN_UNIT_TESTS;
    if (isset($GOOGLE_PUBLISHER_PLUGIN_UNIT_TESTS)) {
      wp_die();
    }
    die();
  }

  /**
   * Checks whether the current user is an administrator and the current page
   * is an admin page. If not, wp_die is called.
   */
  public static function checkAdminRights() {
    if (is_admin() && current_user_can('manage_options'))  {
      return;
    }
    wp_die(__('You do not have sufficient permissions to access this page.'));
  }

  public static function meetsMinimumRequirements() {
    foreach (self::$REQUIRED_EXTENSIONS as $extension) {
      if (!extension_loaded($extension)) {
        return false;
      }
    }

    return version_compare(self::MINIMUM_PHP_VERSION, phpversion(), '<=');
  }

  public static function meetsMinimumRequirementsOrDie() {
    if (!self::meetsMinimumRequirements()) {
      wp_die(__('Plugin activation failed. Your WordPress installation ' .
                'doesn\'t meet the minimum requirements.',
                'google-publisher-plugin'),
             '',
             array('response' => 200, 'back_link' => true));
    }
  }
}
