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
?>
<div id="google-publisher-plugin-admin-wrap" class="wrap">
  <?php if ($show_get_started): ?>
  <h2><?php esc_html_e('AdSense Plugin', 'google-publisher-plugin') ?></h2>

  <div class="google-publisher-plugin-signin-panel">
    <p><?php esc_html_e('To use the AdSense Plugin, you need to sign in to your Google account.', 'google-publisher-plugin') ?></p>

    <p><?php esc_html_e('You should use the Google account that you use for Google products that relate to this site. For example, if you have an AdSense account or a Google Analytics account that you use with this site, use the associated Google account.', 'google-publisher-plugin') ?></p>

    <p>
      <a href="<?php echo esc_url($start_url, array('http', 'https')); ?>"
         id="google-publisher-plugin-admin-start" class="button-primary">
        <?php esc_html_e('Get started', 'google-publisher-plugin') ?>
      </a>
    </p>

    <p>
      <?php _e('If you don\'t have a Google account, you can <a href="https://accounts.google.com/SignUp" target="_blank">create one now</a>.', 'google-publisher-plugin') ?>
    </p>
  </div>

  <?php else: ?>
  <iframe id="google-publisher-plugin-admin-iframe"
      name="admin-iframe"
      src="<?php echo esc_url($iframe_url, array('http', 'https')); ?>"
      width="100%" height="512"
      scrolling="no" allowtransparency="true"></iframe>

  <iframe id="google-publisher-plugin-preview-iframe"
      name="preview-iframe"
      src=""
      width="100%" height="512"></iframe>

  <script>
    var googlePublisherPluginAdmin = {};
    googlePublisherPluginAdmin.ENVIRONMENT =
        <?php echo json_encode($environment); ?>;
    googlePublisherPluginAdmin.CMS_COMMAND_NONCE =
        "<?php echo esc_js($cmsCommandNonce); ?>";
  </script>

  <script type="text/javascript"
      src="<?php echo esc_url($javascript_url, array('http', 'https')); ?>">
  </script>
  <?php endif ?>
</div>
