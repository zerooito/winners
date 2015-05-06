<?php
/*
Copyright 2014 Google Inc. All Rights Reserved.

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

/**
 * An enum representing all update response statuses.
 *
 * The response format is:
 * STATUS[:detail]
 */
abstract class GooglePublisherPluginUpdaterStatus {
  // Success.
  const OK = 'OK';
  // The request does not contain a site id.
  const MISSING_SITE_ID = 'MISSING_SITE_ID';
  // The request contains an invalid site id.
  const INVALID_SITE_ID = 'INVALID_SITE_ID';
  // Cannot connect to the configuration server.
  const CONNECTION_FAILURE = 'CONNECTION_FAILURE';
  // HTTP API has been blocked.
  const HTTP_BLOCKED = 'HTTP_BLOCKED';
  // Gets a non-200 response from the configuration server.
  const HTTP_ERROR = 'HTTP_ERROR';
  // The response from the configuration server is not a valid JSON format.
  const INVALID_JSON = 'INVALID_JSON';
  // The response from the configuration server cannot be understood.
  const INVALID_DATA = 'INVALID_DATA';
  // The response contains an invalid notification.
  const INVALID_NOTIFICATION = 'INVALID_NOTIFICATION';
  // The response contains a configuration server error.
  const SERVER_ERROR = 'SERVER_ERROR';
  // An error inside WordPress prevents update from succeeding.
  const WORDPRESS_ERROR = 'WORDPRESS_ERROR';

  private static $STATUS_RESPONSE_CODES = array(
    self::OK => 200,
    self::MISSING_SITE_ID => 400,
    self::INVALID_SITE_ID => 400
  );

  public static function getResponseCode($status) {
    if (array_key_exists($status, self::$STATUS_RESPONSE_CODES)) {
      return self::$STATUS_RESPONSE_CODES[$status];
    }
    // Otherwise returns the default response code.
    return 500;
  }
}
