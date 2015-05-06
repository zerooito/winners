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

require_once 'Configuration.php';

/** Uninstallation of the plugin. */
if (defined('WP_UNINSTALL_PLUGIN')) {
  if (!is_multisite()) {
    delete_option(GooglePublisherPluginConfiguration::OPTIONS_NAME);
    delete_option(GooglePublisherPluginConfiguration::PLUGIN_VERSION_KEY);
  } else {
    // For multisite installations, if the network admin uninstalls us we
    // must tidy up each site's DB.
    global $wpdb;
    $blog_ids = $wpdb->get_col("SELECT blog_id FROM $wpdb->blogs");
    $original_blog_id = get_current_blog_id();
    foreach ($blog_ids as $blog_id) {
      switch_to_blog($blog_id);
      delete_option(GooglePublisherPluginConfiguration::OPTIONS_NAME);
      delete_option(GooglePublisherPluginConfiguration::PLUGIN_VERSION_KEY);
    }
    switch_to_blog($original_blog_id);
  }
}
