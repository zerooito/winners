<?php

if(!defined('WP_UNINSTALL_PLUGIN')){
	exit();
} else{
	
	global $wpdb;
	if(get_option('ahc_wp_hits_counter_options') !== false){
		delete_option('ahc_wp_hits_counter_options');
	}
	/*
	$sqlQueries = array();
	$sqlQueries[] = "DROP TABLE IF EXISTS `ahc_hits`";
	$sqlQueries[] = "DROP TABLE IF EXISTS `ahc_browsers`";
	$sqlQueries[] = "DROP TABLE IF EXISTS `ahc_search_engines`";
	$sqlQueries[] = "DROP TABLE IF EXISTS `ahc_search_engine_crawlers`";
	$sqlQueries[] = "DROP TABLE IF EXISTS `ahc_visitors`";
	$sqlQueries[] = "DROP TABLE IF EXISTS `ahc_searching_visits`";
	$sqlQueries[] = "DROP TABLE IF EXISTS `ahc_refering_sites`";
	$sqlQueries[] = "DROP TABLE IF EXISTS `ahc_recent_visitors`";
	$sqlQueries[] = "DROP TABLE IF EXISTS `ahc_keywords`";
	$sqlQueries[] = "DROP TABLE IF EXISTS `ahc_title_traffic`";
	$sqlQueries[] = "DROP TABLE IF EXISTS `ahc_visits_time`";
	
	foreach($sqlQueries as $sql){
		$wpdb->query($sql);
	}*/
}
?>