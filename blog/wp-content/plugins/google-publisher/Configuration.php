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
 * A singleton class that manages the plugin configuration, stored using
 * the WordPress options system.
 */
class GooglePublisherPluginConfiguration {

  /** Name used to store options in WordPress option table. */
  const OPTIONS_NAME = 'GooglePublisherPlugin';

  /** Name used to store the plugin's version in WordPress option table. */
  const PLUGIN_VERSION_KEY = 'GooglePublisherPlugin_Version';

  /** Keys used for root entries in options. */
  const SITE_VERIFICATION_TOKEN_KEY = 'token';
  const SITE_ID_KEY = 'siteId';
  const TAGS_CONFIGURATION_KEY = 'tags';
  const NOTIFICATION_KEY = 'notification';
  const UPDATE_SUPPORT_KEY = 'updateSupport'; // 'true' or 'false'.

  const CMS_COMMAND_SUCCESS = 'GooglePublisherPluginCmsCommandStatus::OK';

  public function __construct() {
    $this->createMissingDefaultOptions();
  }

  /**
   * Gets the stored site config. This should only be called when the
   * GooglePublisherPlugin option already exists.
   */
  public function get() {
    $option = get_option(self::OPTIONS_NAME);
    return $option[self::TAGS_CONFIGURATION_KEY];
  }

  /**
   * Gets a tag to embed on the given page type, at the given position. This
   * should only be called when the GooglePublisherPlugin option already exists.
   *
   * @param string $page_type The page type to get the tag for.
   * @param string $position The position to get the tag for.
   * @param string $current_theme_hash The current theme hash.
   * @return string The tag to embed, or an empty string if none is set.
   */
  public function getTag($page_type, $position, $current_theme_hash) {
    $option = get_option(self::OPTIONS_NAME);
    foreach ($option[self::TAGS_CONFIGURATION_KEY] as $tag) {
      if (array_key_exists('pageType', $tag) &&
          $tag['pageType'] == $page_type &&
          array_key_exists('position', $tag) && $tag['position'] == $position &&
          array_key_exists('code', $tag)) {
        // If an expected theme hash was specified then skip this tag if the
        // current theme hash doesn't match.
        if (array_key_exists('expectedCmsThemeHash', $tag) &&
            $tag['expectedCmsThemeHash'] !== $current_theme_hash) {
          continue;
        }
        return $tag['code'];
      }
    }
    return '';
  }

  /**
   * Stores the latest site config. This should only be called when the
   * GooglePublisherPlugin option already exists.
   *
   * @return string 'GooglePublisherPluginCmsCommandStatus::OK' on success,
   *     or a string describing the error on failure.
   */
  public function updateConfig($jsonEncodedConfig) {
    $decoded = json_decode($jsonEncodedConfig, true);
    if ($decoded === null) {
      return 'Failed to decode site config (invalid JSON)';
    }
    if (!is_array($decoded)) {
      return 'Unexpected site config received (array expected)';
    }

    if (array_key_exists('tags', $decoded)) {
      $tags = $decoded['tags'];
      if (!is_array($tags)) {
        return 'Unexpected tags received (array expected)';
      }
    } else {
      $tags = array();
    }

    if (array_key_exists('notification', $decoded)) {
      $notification = $decoded['notification'];
      if (!is_array($notification)) {
        return 'Unexpected notification received (array expected)';
      }
      if (array_key_exists('status', $notification)) {
        $notificationStatus = $notification['status'];
      } else {
        return 'Notification status missing';
      }
    }

    $option = get_option(self::OPTIONS_NAME);
    if (isset($tags)) {
      $option[self::TAGS_CONFIGURATION_KEY] = $tags;
    }
    if (isset($notificationStatus)) {
      $option[self::NOTIFICATION_KEY] = $notificationStatus;
    }
    update_option(self::OPTIONS_NAME, $option);
    return self::CMS_COMMAND_SUCCESS;
  }

  /**
   * Writes the site verification token to the configuration. The configuration
   * allows multiple tokens to be set. This should only be called when the
   * GooglePublisherPlugin option already exists.
   *
   * @param string $token The token to add.
   * @return boolean True on success, false otherwise.
   */
  public function writeSiteVerificationToken($token) {
    $option = get_option(self::OPTIONS_NAME);
    array_push($option[self::SITE_VERIFICATION_TOKEN_KEY], $token);
    if (update_option(self::OPTIONS_NAME, $option)) {
      /*
       * Clears the WordPress object cache whenever we change the site
       * verification token.
       *
       * (http://codex.wordpress.org/Class_Reference/WP_Object_Cache).
       * Usually, WP object cache is cleared after each request. But some
       * cache plugins, e.g., batcache, keep cached object persistent across
       * requests. The cache buster URL parameter does not help in this
       * situation. But it does help over the page level cache, e.g., in W3
       * Total Cache.
       *
       * Plugins are free to cache under whatever namespace and key, there is
       * no way for us to know which cached object corresponds to the HTML
       * head. So we have to clear everything.
       */
      wp_cache_flush();
      return true;
    }

    return false;
  }

  /**
   * Gets the site verification tokens from the configuration. This should only
   * be called when the GooglePublisherPlugin option already exists.
   *
   * @return array An array of tokens, or an empty array if none was set.
   */
  public function getSiteVerificationTokens() {
    $option = get_option(self::OPTIONS_NAME);
    return $option[self::SITE_VERIFICATION_TOKEN_KEY];
  }

  /**
   * Writes the site ID to the configuration. This should only be called when
   * the GooglePublisherPlugin option already exists.
   *
   * @param string $id The site ID to set.
   * @return boolean True on success, false otherwise.
   */
  public function writeSiteId($id) {
    $option = get_option(self::OPTIONS_NAME);
    if ($option[self::SITE_ID_KEY] === $id) {
      return true;
    }

    $option[self::SITE_ID_KEY] = $id;
    if (update_option(self::OPTIONS_NAME, $option)) {
      return true;
    }

    return false;
  }

  /**
   * Gets the site ID from the configuration.
   *
   * @return string|null The site ID, or null if none was set.
   */
  public function getSiteId() {
    $option = get_option(self::OPTIONS_NAME);
    return $option[self::SITE_ID_KEY];
  }

  /**
   * Gets the notification status. This should only be called when the
   * GooglePublisherPlugin option already exists.
   *
   * @return string|null The notification status, or null if none was set.
   */
  public function getNotification() {
    $option = get_option(self::OPTIONS_NAME);
    return $option[self::NOTIFICATION_KEY];
  }

  /**
   * Writes the notification status. This should only be called when the
   * GooglePublisherPlugin option already exists.
   *
   * @param string $notification The notification status to set.
   * @return boolean True on success, false otherwise.
   */
  public function writeNotification($notification) {
    $option = get_option(self::OPTIONS_NAME);
    if ($option[self::NOTIFICATION_KEY] === $notification) {
      return true;
    }
    $option[self::NOTIFICATION_KEY] = $notification;
    return update_option(self::OPTIONS_NAME, $option);
  }

  /**
   * Gets the update support status. This should only be called when the
   * GooglePublisherPlugin option already exists.
   *
   * @return string|null The update support status, or null if none was set.
   */
  public function getUpdateSupport() {
    $option = get_option(self::OPTIONS_NAME);
    return $option[self::UPDATE_SUPPORT_KEY];
  }

  /**
   * Writes the update support status. This should only be called when the
   * GooglePublisherPlugin option already exists.
   *
   * @param string $updateSupport The update support status to set.
   * @return boolean True on success, false otherwise.
   */
  public function writeUpdateSupport($updateSupport) {
    $option = get_option(self::OPTIONS_NAME);
    if ($option[self::UPDATE_SUPPORT_KEY] === $updateSupport) {
      return true;
    }
    $option[self::UPDATE_SUPPORT_KEY] = $updateSupport;
    return update_option(self::OPTIONS_NAME, $option);
  }

  /**
   * Gets the current ad tags.
   *
   * @return array|null The current tags, or null if none was set.
   */
  public function getTags() {
    $option = get_option(self::OPTIONS_NAME);
    return $option[self::TAGS_CONFIGURATION_KEY];
  }

  /**
   * Writes the ad tags. This should only be called when the
   * GooglePublisherPlugin option already exists.
   *
   * @param string $tags The ad tags to set.
   * @return boolean True on success, false otherwise.
   */
  public function writeTags($tags) {
    $option = get_option(self::OPTIONS_NAME);
    if ($option[self::TAGS_CONFIGURATION_KEY] === $tags) {
      return true;
    }
    $option[self::TAGS_CONFIGURATION_KEY] = $tags;
    return update_option(self::OPTIONS_NAME, $option);
  }

  /**
   * Creates the missing entries in options. This should only be called when the
   * GooglePublisherPlugin option already exists.
   */
  private function createMissingDefaultOptions() {
    $option = get_option(self::OPTIONS_NAME);
    if (empty($option)) {
      $option = array();
    }
    $default_values = array(
        self::SITE_VERIFICATION_TOKEN_KEY => array(),
        self::SITE_ID_KEY => null,
        self::TAGS_CONFIGURATION_KEY => array(),
        self::NOTIFICATION_KEY => null,
        self::UPDATE_SUPPORT_KEY => null);

    $option = array_merge($default_values, $option);
    update_option(self::OPTIONS_NAME, $option);
  }
}
