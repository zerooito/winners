<?php

define('AHC_DS', DIRECTORY_SEPARATOR);
define('AHC_PLUGIN_SUPDIRE_FILE', dirname(__FILE__).'WP_Stats_Plus.php');

require_once("settings.php");
require_once("WPHitsCounter.php");

register_activation_hook(AHC_PLUGIN_MAIN_FILE, 'ahc_set_default_options');
register_deactivation_hook(AHC_PLUGIN_MAIN_FILE, 'ahc_unset_default_options');

class Globals{

	static $plugin_options = array();
	static $lang = NULL;
	static $post_type = NULL; // post | page | category
	static $page_id = NULL;
	static $page_title = NULL;
}

Globals::$plugin_options = get_option('ahc_wp_hits_counter_options');
Globals::$lang = 'en';



	
	
	$admincore = '';
	if (isset($_GET['page'])) $admincore = $_GET['page'];
	if( is_admin() && $admincore == 'ahc_hits_counter_menu') 
	{
	add_action('admin_enqueue_scripts', 'ahc_include_scripts');
	}
	
//add_action('admin_bar_menu', 'vtrts_add_items',  90);
//$plugin = plugin_basename( __FILE__ );
//add_filter( "plugin_action_links_$plugin", 'vtrtsp_plugin_add_settings_link' );

add_action('parse_request', 'ahc_track_visitor', 1);
add_action('admin_menu', 'ahc_create_admin_menu_link');

?>