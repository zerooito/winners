<div class="wrap">
<h2>Comments Facebook</h2>

<form method="post" action="options.php">
<?php wp_nonce_field('update-options'); ?>
<?php settings_fields('commentsfacebook'); ?>

<label><strong>App Title : </strong></label><br />
<input type="text" name="web_app_title" value="<?php echo get_option('web_app_title'); ?>" /><br /><br />
<label><strong>App ID : </strong></label><br />
<input type="text" name="web_app_id" value="<?php echo get_option('web_app_id'); ?>" /><br /><br />
<label><strong>App Language (P. Ej. es_ES, en_US, etc.) : </strong></label><br />
<input type="text" name="app_language" value="<?php echo get_option('app_language'); ?>" /><br /><br />
<label><strong>App Number of Post : </strong></label><br />
<input type="text" name="app_post" value="<?php echo get_option('app_post'); ?>" /><br /><br />
<label><b>NOTE:</b> Desactive the comments in your post and pages. (Optional)</label><br /><br />

<input type="checkbox" name="app_share" value="Share" <?php if (get_option('app_share') != "") echo checked; ?> /><strong>Share</strong><br /><br />

<input type="hidden" name="action" value="update"/>

<p class="submit">
<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
</p>

</form>


<span style="font-size:14px; font-weight:bold"><p><b>Other plugin of the author:</b></p>

<p><a href="http://wordpress.org/plugins/goodfidelity/" target="_blank">Goodfidelity Music Bar</a></p>
<p><b>Description:</b> Complements your website with a administrator of videos and music. Your users will be able to create one or more playlist, you be able to listen music without interruption, may share in facebook and more. Millions of music videos at your fingertips. It offers a powerful search engine. Demo: www.goodfidelity.com.</p>
<a href="http://wordpress.org/plugins/goodfidelity/" target="_blank">
<img src="http://www.goodfidelity.com/wp-content/uploads/2014/09/banner4.jpg"/>
</a>
</span>
</div>
