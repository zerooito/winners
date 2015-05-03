<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Moesia
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php if ( get_theme_mod('site_favicon') ) : ?>
	<link rel="shortcut icon" href="<?php echo esc_url(get_theme_mod('site_favicon')); ?>" />
<?php endif; ?>

<?php if ( get_theme_mod('apple_touch_144') ) : ?>
	<link rel="apple-touch-icon" sizes="144x144" href="<?php echo esc_url(get_theme_mod('apple_touch_144')); ?>" />
<?php endif; ?>
<?php if ( get_theme_mod('apple_touch_114') ) : ?>
	<link rel="apple-touch-icon" sizes="114x114" href="<?php echo esc_url(get_theme_mod('apple_touch_114')); ?>" />
<?php endif; ?>
<?php if ( get_theme_mod('apple_touch_72') ) : ?>
	<link rel="apple-touch-icon" sizes="72x72" href="<?php echo esc_url(get_theme_mod('apple_touch_72')); ?>" />
<?php endif; ?>
<?php if ( get_theme_mod('apple_touch_57') ) : ?>
	<link rel="apple-touch-icon" href="<?php echo esc_url(get_theme_mod('apple_touch_57')); ?>" />
<?php endif; ?>

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-60234652-1', 'auto');
  ga('send', 'pageview');

</script>

<style type="text/css">
	#masthead {
		height: 335px !important;
	}
</style>

<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'moesia' ); ?></a>

	<?php //Single page header image data
		$himage  = get_post_meta( get_the_ID(), 'wpcf-header-image', true );
		$htitle  = get_post_meta( get_the_ID(), 'wpcf-header-title', true );
		$hlogo 	 = get_post_meta( get_the_ID(), 'wpcf-header-logo', true );
		$htext 	 = get_post_meta( get_the_ID(), 'wpcf-header-text', true );
		$hbutton = get_post_meta( get_the_ID(), 'wpcf-header-button-title', true );
		$hlink 	 = get_post_meta( get_the_ID(), 'wpcf-header-button-link', true );
	?>
	<?php tha_header_before(); ?>



	<?php tha_header_after(); ?>

	<?php if ( !is_page_template('page_front-page.php') || ( 'posts' == get_option( 'show_on_front' ) ) ) : ?>
		<?php $container = "container"; ?>
	<?php else : ?>
		<?php $container = ""; ?>
	<?php endif; ?>
	<?php tha_content_before(); ?>
	<div id="content" class="site-content clearfix <?php echo $container; ?>">
		<?php tha_content_top(); ?>
