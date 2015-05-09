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


(function() {

/**
 * @enum {string}
 */
var IframeLayout = {
  NORMAL: 'normal',
  EXPANDED: 'expanded',
  EXPANDED_PREVIEW_ON_TOP: 'expanded_preview_on_top'
};


var adminWrap = document.getElementById(
    'google-publisher-plugin-admin-wrap');
var adminIframe = document.getElementById(
    'google-publisher-plugin-admin-iframe');
var previewIframe = document.getElementById(
    'google-publisher-plugin-preview-iframe');

var currentIframeLayout = IframeLayout.NORMAL;
var currentPreviewMarginTop = 0;

/**
 * Sets the layout of the admin and preview iframe.
 *
 * @param {!IframeLayout} layout The layout to use.
 * @param {number} previewMarginTop The top margin to apply to the preview
 *    iframe, in pixels. This is used to make room for the UI in the
 *    admin iframe.
 * @param {number|undefined} pageHeight The height of the admin iframe, in
 *    pixels. Only applied when the layout is set to normal.
 */
var setIframeLayout = function(layout, previewMarginTop, pageHeight) {
  currentIframeLayout = layout;
  currentPreviewMarginTop = previewMarginTop;

  var cssClassName;
  switch (layout) {
    case IframeLayout.NORMAL:
      cssClassName = '';
      break;
    case IframeLayout.EXPANDED:
      cssClassName = 'google-publisher-plugin-expanded';
      break;
    case IframeLayout.EXPANDED_PREVIEW_ON_TOP:
      cssClassName = 'google-publisher-plugin-expanded ' +
          'google-publisher-plugin-preview-on-top';
      break;
  }
  adminWrap.className = cssClassName;

  if (layout == IframeLayout.NORMAL && pageHeight !== undefined) {
    adminIframe.style.height = pageHeight + 'px';
  } else {
    adminIframe.style.height = '';
  }

  updateIframePositioning();

  var hideWordPressMenu = (layout != IframeLayout.NORMAL);
  var adminMenuWrap = document.getElementById('adminmenuwrap');
  if (adminMenuWrap) {
    adminMenuWrap.style.visibility = hideWordPressMenu ? 'hidden' : 'visible';
  }
  var adminMenuBack = document.getElementById('adminmenuback');
  if (adminMenuBack) {
    adminMenuBack.style.visibility = hideWordPressMenu ? 'hidden' : 'visible';
  }
};


var updateIframePositioning = function() {
  var headerHeight =
      (currentIframeLayout == IframeLayout.NORMAL) ? 0 : getHeaderHeight();
  adminIframe.style.marginTop = headerHeight + 'px';

  var previewIframeMarginTop = headerHeight + currentPreviewMarginTop;
  previewIframe.style.marginTop = previewIframeMarginTop + 'px';
  previewIframe.style.height =
      (window.innerHeight - previewIframeMarginTop) + 'px';
};


/**
 * Returns the height of the WordPress admin header bar in pixels.
 */
var getHeaderHeight = function() {
  var headerHeight = 28;
  // Before WordPress 3.7, the ID of the admin bar was 'wphead'.
  var wpHead = document.getElementById('wphead');
  // From WordPress 3.7 onwards, it became 'wpadminbar'.
  var wpAdminBar = document.getElementById('wpadminbar');
  if (wpHead) {
    headerHeight = wpHead.offsetHeight - 1;
  } else if (wpAdminBar) {
    headerHeight = wpAdminBar.offsetHeight;
  }
  return headerHeight;
};


/**
 * Sends an AllowFrame message to the framebuster in the admin iframe.
 */
var sendAllowFrameMessage = function() {
  adminIframe.contentWindow.postMessage(
      'AllowFrame: GooglePublisherPlugin',
      'https://publisherplugin.google.com');
};


/**
 * Callback to handle postMessage calls.
 *
 * @param {Object} event The postMessage event.
 */
var receiveMessage = function(event) {
  if (event.origin !== 'https://publisherplugin.google.com') {
    console.log('receiveMessage: bad origin: ' + event.origin);
    return;
  }
  var data = /** @type {PostMessageData} */ (JSON.parse(event.data));
  switch (data.action) {
    case 'get_environment':
      adminIframe.contentWindow.postMessage(JSON.stringify({
        'action': 'get_environment_reply',
        'environment': googlePublisherPluginAdmin.ENVIRONMENT
      }), 'https://publisherplugin.google.com');
      break;
    case 'send_cms_command':
      var url = document.URL + '&google_publisher_plugin_action=' +
          'cms_command&command=' + data.command + '&_wpnonce=' +
          googlePublisherPluginAdmin.CMS_COMMAND_NONCE;
      var postBody = 'param=' + encodeURIComponent(data.param);
      var request = new XMLHttpRequest();
      request.open('POST', url, false);
      request.setRequestHeader(
          'Content-Type', 'application/x-www-form-urlencoded');
      request.send(postBody);
      adminIframe.contentWindow.postMessage(JSON.stringify({
          'action': 'send_cms_command_reply',
          'httpStatus': request.status,
          'httpResponse': request.responseText
      }), 'https://publisherplugin.google.com');
      break;
    case 'set_iframe_layout':
      setIframeLayout(/** @type {!IframeLayout} */ (data.layout),
          data.previewMarginTop, data.pageHeight);
      break;
    case 'set_preview_url':
      previewIframe.contentWindow.location.replace(data.value);
      break;
  }
};

window.addEventListener('message', receiveMessage, false);
window.addEventListener('resize', updateIframePositioning, false);
adminIframe.addEventListener('load', sendAllowFrameMessage, false);

})();
