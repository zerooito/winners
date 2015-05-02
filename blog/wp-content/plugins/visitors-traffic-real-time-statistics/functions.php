<?php

/**
 * Called when plugin is activated or upgraded
 *
 * @uses add_option()
 * @uses get_option()
 *
 * @return void
 */
 
  function ahc_search_engins_count(){
	global $wpdb;
	$result = $wpdb->get_results("SELECT count(srh_id) as cnt FROM `ahc_searching_visits`", OBJECT);
	if($result !== false){
		return $result[0]->cnt;
	}
	return false;
	
	
	}
 
 
  function ahc_browsers_count(){
	global $wpdb;
	$result = $wpdb->get_results("SELECT count(`bsr_id`) as cnt  FROM `ahc_browsers` WHERE `bsr_visits` > 0", OBJECT);
	if($result !== false){
		return $result[0]->cnt;
	}
	return false;
	
	
	}
 
 
			
			
			
function ahc_set_default_options(){
	// plugin activation
	if(get_option('ahc_wp_hits_counter_options') === false){
		require_once("database_basics_data.php");
		$plugin_options = array();
		$plugin_options['ahc_version'] = '1.0';
		$plugin_options['available_languages'] = array('ar' => 'عربي', 'en' => 'English');
		$plugin_options['ahc_lang'] = 'en';
		$plugin_options['user_roles_to_not_track'] = array('administrator' => true, 'editor' => true, 'author' => true, 'contributor' => true, 'subscriber' => false);
		add_option( 'ahc_wp_hits_counter_options', $plugin_options);
		set_time_limit(300);
		if(ahc_create_database_tables()){
			ahc_insert_search_engines_into_table($searchEngines);
			ahc_insert_browsers_into_table($browsers);
			ahc_insert_visit_times_into_table($dayHours);
		}
	}
}

function ahc_get_visitors_by_date(){
    global $wpdb;
    $lastDays = AHC_VISITORS_VISITS_LIMIT;
    $response = array();
    $beginning = new DateTime();
    $beginning->modify('-'.$lastDays.' day');        
    $sql = "SELECT vst_date, vst_visitors 
            FROM ahc_visitors 
            WHERE DATE(vst_date) >= DATE(%s)";
            
    
    $results = $wpdb->get_results($wpdb->prepare($sql, $beginning->format('Y-m-d')), OBJECT);
    if($results !== false){
        for($i = count($results); $i < $lastDays; $i++){
            $beginning->modify('+1 day');
            $xx .= "['".$beginning->format('Y-m-d')."', 0], ";
        }
        foreach($results as $r)
		{
            
			$hitDate = new DateTime($r->vst_date);
			$xx .= "['".$hitDate->format('Y-m-d')."', ".$r->vst_visitors."], ";
        }
		
    }
    return '['.$xx.']';
}

function ahc_get_visits_by_date(){
    global $wpdb;
    $lastDays = AHC_VISITORS_VISITS_LIMIT;
    $response = array();
    $beginning = new DateTime();
    $beginning->modify('-'.$lastDays.' day');        
    $sql = "SELECT vst_date, vst_visits 
            FROM ahc_visitors 
            WHERE DATE(vst_date) >= DATE(%s)";
            
    
    $results = $wpdb->get_results($wpdb->prepare($sql, $beginning->format('Y-m-d')), OBJECT);
    if($results !== false){
        for($i = count($results); $i < $lastDays; $i++){
            $beginning->modify('+1 day');
            $x .= "['".$beginning->format('Y-m-d')."', 0], ";
        }
        foreach($results as $r)
		{
			$hitDate = new DateTime($r->vst_date);
			$x .= "['".$hitDate->format('Y-m-d')."', ".$r->vst_visits."], ";
        }
		
    }
   return '['.$x.']';
}


//--------------------------------------------
/**
 * Called when plugin is deactivated
 *
 * @return void
 */
function ahc_unset_default_options(){
}
//--------------------------------------------
/**
 * Creates plugin page link in the admin menu
 *
 * @uses add_menu_page()
 * @uses plugins_url()
 *
 * @return void
 */
function ahc_create_admin_menu_link(){
	add_menu_page('WP Hits Counter', 'Visitors Traffic', 'manage_options', 'ahc_hits_counter_menu', 'ahc_create_plugin_overview_page', 
					plugins_url('/images/vtrts.png', AHC_PLUGIN_MAIN_FILE));
}
//--------------------------------------------
/**
 * Creates the main overview page
 *
 * @return void
 */
function ahc_create_plugin_overview_page(){
	require_once(AHC_PLUGIN_ROOT_DIR.AHC_DS.'lang'.AHC_DS.Globals::$lang.'_lang.php');
	include("overview.php");
}
//--------------------------------------------
/**
 * Returns links array of available languages
 *
 * @uses get_option()
 * @uses add_query_arg()
 *
 * @return array
 */
function ahc_get_change_lang_links(){
	$plugin_options = get_option('ahc_wp_hits_counter_options');
	$links = array();
	$i = 0;
	foreach($plugin_options['available_languages'] as $key => $value){
		if(Globals::$lang != $key){
			$links[$i]['name'] = $value;
			$links[$i]['href'] = add_query_arg('ahc_lang', $key);
			$i++;
		}
	}
	unset($plugin_options);
	unset($i);
	return $links;
}
//--------------------------------------------
/**
 * Decides whether or not should track the current visitor
 *
 * @uses is_user_logged_in()
 * @uses WP_User::$roles
 *
 * @return boolean
 */
function ahc_should_track_visitor(){
	global $current_user;
	$allow = true;
	if(is_user_logged_in()){
		$user = new WP_User($current_user->ID);
		if(!empty($user->roles) && is_array($user->roles)){
			foreach($user->roles as $role){
				$found = (isset(Globals::$plugin_options['user_roles_to_not_track'][$role]))? Globals::$plugin_options['user_roles_to_not_track'][$role] : false;
				if($found){
					$allow = false;
					break;
				}
			}
		}
	}
	return $allow;
}
//--------------------------------------------
/**
 * Returns true if the current user has administrator role
 *
 * @uses is_user_logged_in()
 * @uses WP_User::$roles
 *
 * @return boolean
 */
function ahc_has_administrator_role(){
	global $user_ID;
	$is_admin = false;
	if(is_user_logged_in()){
		$user = new WP_User($user_ID);
		if(!empty($user->roles) && is_array($user->roles)){
			foreach($user->roles as $role){
				if($role == 'administrator'){
					$is_admin = true;
					break;
				}
			}
		}
	}
	return $is_admin;
}
//--------------------------------------------
/**
 * Creates database plugin tables
 *
 * @uses wpdb::query()
 *
 * @return boolean
 */
 /*
function ahc_create_database_tables(){
	global $wpdb;
	$sqlQueries = array();
	$sqlQueries[] = "CREATE TABLE IF NOT EXISTS `ahc_hits`
			(
			`hit_id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
			PRIMARY KEY(`hit_id`),
			`hit_ip_address` VARCHAR(50) NOT NULL,
			`hit_user_agent` VARCHAR(200) NOT NULL,
			`hit_request_uri` VARCHAR(200) NULL,
			`hit_page_id` VARCHAR(30) NOT NULL,
			`hit_page_title` VARCHAR(200) NULL,
			`hit_referer` VARCHAR(300) NULL,
			`hit_referer_site` VARCHAR(100) NULL,
			`srh_id` INT(3) UNSIGNED NULL,
			`hit_search_words` VARCHAR(200) NULL,
			`bsr_id` INT(3) UNSIGNED NOT NULL,
			`hit_date` DATE NOT NULL,
			`hit_time` TIME NOT NULL
			) ENGINE=MyISAM DEFAULT CHARSET=utf8";
		
	$sqlQueries[] = "CREATE TABLE IF NOT EXISTS `ahc_browsers`
			(
			`bsr_id` INT(3) UNSIGNED NOT NULL,
			PRIMARY KEY(`bsr_id`),
			`bsr_name` VARCHAR(100) NOT NULL,
			`bsr_icon` VARCHAR(50),
			`bsr_visits` INT(11) NOT NULL DEFAULT 0
			) ENGINE=MyISAM DEFAULT CHARSET=utf8";
	
	$sqlQueries[] = "CREATE TABLE IF NOT EXISTS `ahc_search_engines`
			(
			`srh_id` INT(3) UNSIGNED NOT NULL AUTO_INCREMENT,
			PRIMARY KEY(`srh_id`),
			`srh_name` VARCHAR(100) NOT NULL,
			`srh_query_parameter` VARCHAR(10) NOT NULL,
			`srh_icon` VARCHAR(50),
			`srh_identifier` VARCHAR(50)
			) ENGINE=MyISAM DEFAULT CHARSET=utf8";
	
	$sqlQueries[] = "CREATE TABLE IF NOT EXISTS `ahc_search_engine_crawlers`
			(
			`bot_name` VARCHAR(50) NOT NULL,
			`srh_id` INT(3) UNSIGNED NOT NULL
			) ENGINE=MyISAM DEFAULT CHARSET=utf8";
			
	$sqlQueries[] = "CREATE TABLE IF NOT EXISTS `ahc_visitors`
			(
			`vst_id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
			PRIMARY KEY (`vst_id`),
			`vst_date` DATE NOT NULL,
			`vst_visitors` INT(11) UNSIGNED NULL DEFAULT 0,
			`vst_visits` INT(11) UNSIGNED NULL DEFAULT 0
			) ENGINE=MyISAM DEFAULT CHARSET=utf8";
	
	$sqlQueries[] = "CREATE TABLE IF NOT EXISTS `ahc_searching_visits`
			(
			`vtsh_id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
			PRIMARY KEY (`vtsh_id`),
			`srh_id` INT(3) UNSIGNED NOT NULL,
			`vtsh_date` DATE NOT NULL,
			`vtsh_visits` INT(11) UNSIGNED NOT NULL DEFAULT 0
			) ENGINE=MyISAM DEFAULT CHARSET=utf8";
			
	$sqlQueries[] = "CREATE TABLE IF NOT EXISTS `ahc_refering_sites`
			(
			`rfr_id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
			PRIMARY KEY (`rfr_id`),
			`rfr_site_name` VARCHAR(100) NOT NULL,
			`rfr_visits` INT(11) UNSIGNED NULL DEFAULT 0
			) ENGINE=MyISAM DEFAULT CHARSET=utf8";
			
	$sqlQueries[] = "CREATE TABLE IF NOT EXISTS `ahc_recent_visitors`
			(
			`vtr_id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
			PRIMARY KEY (`vtr_id`),
			`vtr_ip_address` VARCHAR(50) NOT NULL,
			`vtr_referer` VARCHAR(300) NULL,
			`srh_id` INT(3) UNSIGNED NULL,
			`bsr_id` INT(3) UNSIGNED NOT NULL,
			`vtr_date` DATE NOT NULL,
			`vtr_time` TIME NOT NULL
			) ENGINE=MyISAM DEFAULT CHARSET=utf8";
			
	$sqlQueries[] = "CREATE TABLE IF NOT EXISTS `ahc_keywords`
			(
			`kwd_id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
			PRIMARY KEY (`kwd_id`),
			`kwd_ip_address` VARCHAR(50) NOT NULL,
			`kwd_keywords` VARCHAR(200) NOT NULL,
			`kwd_referer` VARCHAR(300) NOT NULL,
			`srh_id` INT(3) UNSIGNED NOT NULL,
			`bsr_id` INT(3) UNSIGNED NOT NULL,
			`kwd_date` DATE NOT NULL,
			`kwd_time` TIME NOT NULL
			) ENGINE=MyISAM DEFAULT CHARSET=utf8";
			
	$sqlQueries[] = "CREATE TABLE IF NOT EXISTS `ahc_title_traffic`
			(
			`til_id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
			PRIMARY KEY (`til_id`),
			`til_page_id` VARCHAR(30) NOT NULL,
			`til_page_title` VARCHAR(100),
			`til_hits` INT(11) UNSIGNED NOT NULL
			) ENGINE=MyISAM DEFAULT CHARSET=utf8";
			
	$sqlQueries[] = "CREATE TABLE IF NOT EXISTS `ahc_visits_time`
			(
			`vtm_id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
			PRIMARY KEY (`vtm_id`),
			`vtm_time_from` TIME NOT NULL,
			`vtm_time_to` TIME NOT NULL,
			`vtm_visitors` INT(11) UNSIGNED NOT NULL DEFAULT 0,
			`vtm_visits` INT(11) UNSIGNED NOT NULL DEFAULT 0
			) ENGINE=MyISAM DEFAULT CHARSET=utf8";
			
	foreach($sqlQueries as $sql){
		if($wpdb->query($sql) === false){
			return false;
		}
	}
	return true;
}
*/



function ahc_create_database_tables(){
	global $wpdb;
	$sqlQueries = array();
	$sqlQueries[] = "CREATE TABLE IF NOT EXISTS `ahc_hits`
			(
			`hit_id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
			PRIMARY KEY(`hit_id`),
			`hit_ip_address` VARCHAR(50) NOT NULL,
			`hit_user_agent` VARCHAR(200) NOT NULL,
			`hit_request_uri` VARCHAR(200) NULL,
			`hit_page_id` VARCHAR(30) NOT NULL,
			`hit_page_title` VARCHAR(200) NULL,
			`ctr_id` INT(3) UNSIGNED NULL,
			`hit_referer` VARCHAR(300) NULL,
			`hit_referer_site` VARCHAR(100) NULL,
			`srh_id` INT(3) UNSIGNED NULL,
			`hit_search_words` VARCHAR(200) NULL,
			`bsr_id` INT(3) UNSIGNED NOT NULL,
			`hit_date` DATE NOT NULL,
			`hit_time` TIME NOT NULL
			) ENGINE=MyISAM DEFAULT CHARSET=utf8";
		
	$sqlQueries[] = "CREATE TABLE IF NOT EXISTS `ahc_browsers`
			(
			`bsr_id` INT(3) UNSIGNED NOT NULL,
			PRIMARY KEY(`bsr_id`),
			`bsr_name` VARCHAR(100) NOT NULL,
			`bsr_icon` VARCHAR(50),
			`bsr_visits` INT(11) NOT NULL DEFAULT 0
			) ENGINE=MyISAM DEFAULT CHARSET=utf8";
	
	$sqlQueries[] = "CREATE TABLE IF NOT EXISTS `ahc_search_engines`
			(
			`srh_id` INT(3) UNSIGNED NOT NULL AUTO_INCREMENT,
			PRIMARY KEY(`srh_id`),
			`srh_name` VARCHAR(100) NOT NULL,
			`srh_query_parameter` VARCHAR(10) NOT NULL,
			`srh_icon` VARCHAR(50),
			`srh_identifier` VARCHAR(50)
			) ENGINE=MyISAM DEFAULT CHARSET=utf8";
	
	$sqlQueries[] = "CREATE TABLE IF NOT EXISTS `ahc_search_engine_crawlers`
			(
			`bot_name` VARCHAR(50) NOT NULL,
			`srh_id` INT(3) UNSIGNED NOT NULL
			) ENGINE=MyISAM DEFAULT CHARSET=utf8";
	
	$sqlQueries[] = "CREATE TABLE IF NOT EXISTS `ahc_countries`
			(
			`ctr_id` INT(5) UNSIGNED NOT NULL AUTO_INCREMENT,
			PRIMARY KEY(`ctr_id`),
			`ctr_name` VARCHAR(100) NOT NULL,
			`ctr_internet_code` VARCHAR(5) NOT NULL,
			`ctr_latitude` VARCHAR(30) NULL,
			`ctr_longitude` VARCHAR(30) NULL,
			`ctr_visitors` INT(11) NOT NULL DEFAULT 0,
			`ctr_visits` INT(11) NOT NULL DEFAULT 0
			) ENGINE=MyISAM DEFAULT CHARSET=utf8";
			
	$sqlQueries[] = "CREATE TABLE IF NOT EXISTS `ahc_visitors`
			(
			`vst_id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
			PRIMARY KEY (`vst_id`),
			`vst_date` DATE NOT NULL,
			`vst_visitors` INT(11) UNSIGNED NULL DEFAULT 0,
			`vst_visits` INT(11) UNSIGNED NULL DEFAULT 0
			) ENGINE=MyISAM DEFAULT CHARSET=utf8";
	
	$sqlQueries[] = "CREATE TABLE IF NOT EXISTS `ahc_searching_visits`
			(
			`vtsh_id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
			PRIMARY KEY (`vtsh_id`),
			`srh_id` INT(3) UNSIGNED NOT NULL,
			`vtsh_date` DATE NOT NULL,
			`vtsh_visits` INT(11) UNSIGNED NOT NULL DEFAULT 0
			) ENGINE=MyISAM DEFAULT CHARSET=utf8";
			
	$sqlQueries[] = "CREATE TABLE IF NOT EXISTS `ahc_refering_sites`
			(
			`rfr_id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
			PRIMARY KEY (`rfr_id`),
			`rfr_site_name` VARCHAR(100) NOT NULL,
			`rfr_visits` INT(11) UNSIGNED NULL DEFAULT 0
			) ENGINE=MyISAM DEFAULT CHARSET=utf8";
			
	$sqlQueries[] = "CREATE TABLE IF NOT EXISTS `ahc_recent_visitors`
			(
			`vtr_id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
			PRIMARY KEY (`vtr_id`),
			`vtr_ip_address` VARCHAR(50) NOT NULL,
			`vtr_referer` VARCHAR(300) NULL,
			`srh_id` INT(3) UNSIGNED NULL,
			`bsr_id` INT(3) UNSIGNED NOT NULL,
			`ctr_id` INT(5) UNSIGNED NULL,
			`vtr_date` DATE NOT NULL,
			`vtr_time` TIME NOT NULL
			) ENGINE=MyISAM DEFAULT CHARSET=utf8";
			
	$sqlQueries[] = "CREATE TABLE IF NOT EXISTS `ahc_keywords`
			(
			`kwd_id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
			PRIMARY KEY (`kwd_id`),
			`kwd_ip_address` VARCHAR(50) NOT NULL,
			`kwd_keywords` VARCHAR(200) NOT NULL,
			`kwd_referer` VARCHAR(300) NOT NULL,
			`srh_id` INT(3) UNSIGNED NOT NULL,
			`ctr_id` INT(5) UNSIGNED NULL,
			`bsr_id` INT(3) UNSIGNED NOT NULL,
			`kwd_date` DATE NOT NULL,
			`kwd_time` TIME NOT NULL
			) ENGINE=MyISAM DEFAULT CHARSET=utf8";
			
	$sqlQueries[] = "CREATE TABLE IF NOT EXISTS `ahc_title_traffic`
			(
			`til_id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
			PRIMARY KEY (`til_id`),
			`til_page_id` VARCHAR(30) NOT NULL,
			`til_page_title` VARCHAR(100),
			`til_hits` INT(11) UNSIGNED NOT NULL
			) ENGINE=MyISAM DEFAULT CHARSET=utf8";
			
	$sqlQueries[] = "CREATE TABLE IF NOT EXISTS `ahc_visits_time`
			(
			`vtm_id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
			PRIMARY KEY (`vtm_id`),
			`vtm_time_from` TIME NOT NULL,
			`vtm_time_to` TIME NOT NULL,
			`vtm_visitors` INT(11) UNSIGNED NOT NULL DEFAULT 0,
			`vtm_visits` INT(11) UNSIGNED NOT NULL DEFAULT 0
			) ENGINE=MyISAM DEFAULT CHARSET=utf8";
			
	foreach($sqlQueries as $sql){
		if($wpdb->query($sql) === false){
			return false;
		}
	}
	return true;
}
//--------------------------------------------
/**
 * Inserts search engines into ahc_search_engines table
 *
 * @uses wpdb::insert()
 * @uses wpdb::$insert_id
 *
 * @param array $searchEngines.
 * @return boolean
 */
function ahc_insert_search_engines_into_table($searchEngines){
	global $wpdb;
	foreach($searchEngines as $se){
		$result = $wpdb->insert('ahc_search_engines', array(
										'srh_name' => $se['srh_name'],
										'srh_query_parameter' => $se['srh_query_parameter'],
										'srh_icon' => $se['srh_icon'],
										'srh_identifier' => $se['srh_identifier']
										),
										array(
											'%s', '%s', '%s', '%s'
										)
					);
		if($result !== false){
			$srh_id = $wpdb->insert_id;
			foreach($se['crawlers'] as $crawler){
				$result2 = $wpdb->insert('ahc_search_engine_crawlers', array(
												'bot_name' => $crawler,
												'srh_id' => $srh_id
												),
												array(
													'%s', '%d'
												)
							);
				if($result2 === false){
					return false;
				}
			}
		} else{
			return false;
		}
	}
	return true;
}
//--------------------------------------------
/**
 * Inserts browsers into ahc_browsers table
 *
 * @uses wpdb::insert()
 *
 * @param array $browsers
 * @return boolean
 */
function ahc_insert_browsers_into_table($browsers){
	global $wpdb;
	foreach($browsers as $browser){
		$result = $wpdb->insert('ahc_browsers', array(
										'bsr_id' => $browser['bsr_id'],
										'bsr_name' => $browser['bsr_name'],
										'bsr_icon' => $browser['bsr_icon']
										),
										array(
											'%d', '%s', '%s'
										)
					);
		if($result === false){
			return false;
		}
	}
	return true;
}
//--------------------------------------------
/**
 * Inserts periods into ahc_visits_time table
 *
 * @uses wpdb::insert()
 *
 * @param array $dayHours
 * @return boolean
 */
function ahc_insert_visit_times_into_table($dayHours){
	global $wpdb;
	foreach($dayHours as $t){
		$result = $wpdb->insert('ahc_visits_time', array(
										'vtm_time_from' => $t['vtm_time_from'],
										'vtm_time_to' => $t['vtm_time_to'],
										'vtm_visitors' => 0
										),
										array(
											'%s', '%s', '%d'
										)
					);
		if($result === false){
			return false;
		}
	}
	return true;
}
//--------------------------------------------
/**
 * Returns the first and last days of the week of the date you pass
 *
 * @param string $date
 * @param string $format Optional
 * @return array
 */
function ahc_get_week_limits($date, $format = 'Y-m-d'){
	$beginingDay = new DateTime($date);
	$endingDay = new DateTime($date);
	$date = new DateTime($date);
	switch($date->format('w')){
			case 0: // sun
			//$beginingDay->modify('-1 day');
			$endingDay->modify('+6 day');
			break;

			case 1: // mon
			$beginingDay->modify('-1 day');
			$endingDay->modify('+5 day');
			break;

			case 2: // Tue
			$beginingDay->modify('-2 day');;
			$endingDay->modify('+4 day');
			break;

			case 3: // Wed
			$beginingDay->modify('-3 day');;
			$endingDay->modify('+3 day');
			break;

			case 4: // Thu
			$beginingDay->modify('-4 day');
			$endingDay->modify('+2 day');
			break;

			case 6: // Fri
			 $beginingDay->modify('-5 day');
			$endingDay->modify('+1 day');
			break;
	}
	return array(0 => $beginingDay->format($format), 1 => $endingDay->format($format));
}
//--------------------------------------------
/**
 * Return summary statistics of visitors and visits
 *
 * @return array
 */
function ahc_get_summary_statistics(){
	$arr = array();
	$arr['today'] = ahc_get_visitors_visits_in_period('today');
	$arr['yesterday'] = ahc_get_visitors_visits_in_period('yesterday');
	$arr['week'] = ahc_get_visitors_visits_in_period('week');
	$arr['month'] = ahc_get_visitors_visits_in_period('month');
	$arr['year'] = ahc_get_visitors_visits_in_period('year');
	$arr['total'] = ahc_get_visitors_visits_in_period();
	return $arr;
}
//--------------------------------------------
/**
 * Return counts visitors and visits in certain day (today|yesterday), certain period(last week, last month, last year) or total
 *
 * @uses wpdb::prepare()
 * @uses wpdb::get_results()
 *
 * @param string $period Optional
 * @return mixed
 */
function ahc_get_visitors_visits_in_period($period = 'total'){
	global $wpdb;
	$date = new DateTime();
	$sql = "SELECT SUM(vst_visitors) AS vst_visitors, SUM(vst_visits) AS  vst_visits 
			FROM `ahc_visitors` 
			WHERE 1 = 1";
	$results = false;
	switch($period){
		case 'today':
		$sql .= " AND DATE(vst_date) = DATE(NOW())";
		$results = $wpdb->get_results($sql, OBJECT);
		break;
		
		case 'yesterday':
		$date->modify('-1 day');
		$sql .= " AND DATE(vst_date) = DATE(%s)";
		$results = $wpdb->get_results($wpdb->prepare($sql, $date->format('Y-m-d')), OBJECT);
		break;
		
		case 'week':
		$limits = ahc_get_week_limits($date->format('Y-m-d'));
		$sql .= " AND DATE(vst_date) >= DATE(%s) AND DATE(vst_date) <= DATE(%s)";
		$results = $wpdb->get_results($wpdb->prepare($sql, $limits[0], $limits[1]), OBJECT);
		break;
		
		case 'month':
		$sql .= " AND DATE(vst_date) >= DATE(%s) AND DATE(vst_date) <= DATE(%s)";
		$results = $wpdb->get_results($wpdb->prepare($sql, $date->format('Y-m-01'), $date->format('Y-m-d')), OBJECT);
		break;
		
		case 'year':
		$sql .= " AND DATE(vst_date) >= DATE(%s) AND DATE(vst_date) <= DATE(%s)";
		$results = $wpdb->get_results($wpdb->prepare($sql, $date->format('Y-01-01'), $date->format('Y-12-31')), OBJECT);
		break;
		
		default:
		$results = $wpdb->get_results($sql, OBJECT);
	}
	
	if($results !== false){
		return array(
				'visitors' => (empty($results[0]->vst_visitors)? 0 : $results[0]->vst_visitors),
				'visits' => (empty($results[0]->vst_visits)? 0 : $results[0]->vst_visits)
				);
	} else{
		return false;
	}
}
//--------------------------------------------
/**
 * Return visits in a period from today 
 *
 * @uses wpdb::prepare()
 * @uses wpdb::get_results()
 *
 * @return array
 */
function ahc_get_visitors_visits_by_date(){
    global $wpdb;
    $lastDays = AHC_VISITORS_VISITS_LIMIT - 1;
    $response = array();
    $beginning = new DateTime();
    $beginning->modify('-'.$lastDays.' day');        
    $sql = "SELECT vst_date, vst_visitors, vst_visits 
            FROM ahc_visitors 
            WHERE DATE(vst_date) >= DATE(%s)";
            
    
    $results = $wpdb->get_results($wpdb->prepare($sql, $beginning->format('Y-m-d')), OBJECT);
    if($results !== false){
        $response['success'] = true;
        $response['date'] = array();
        for($i = count($results); $i < $lastDays; $i++){
            $beginning->modify('+1 day');
            $response['data']['dates'][] = $beginning->format('d/m');
            $response['data']['visitors'][] = 0;
            $response['data']['visits'][] = 0;
        }
        foreach($results as $r){
            $hitDate = new DateTime($r->vst_date);
            $response['data']['dates'][] = $hitDate->format('d/m');
            $response['data']['visitors'][] = $r->vst_visitors;
            $response['data']['visits'][] = $r->vst_visits;
        }
    } else{
        $response['success'] = false;
    }
    return $response;
}
//--------------------------------------------
/**
 * Return visitors visits that came from search engine in a period from today 
 *
 * @uses wpdb::prepare()
 * @uses wpdb::get_results()
 *
 * @return array
 */
function ahc_get_serch_visits_by_date(){
	global $wpdb;
	$searchEngines = ahc_get_all_search_engines();
	$lastDays = AHC_VISITORS_VISITS_SUMMARY_LIMIT - 1;
	$response = array();
	$beginning = new DateTime();
	$beginning->modify('-'.$lastDays.' day');
	$sql = "SELECT srh_id, vtsh_visits, vtsh_date 
			FROM `ahc_searching_visits` 
			WHERE DATE(vtsh_date) >= DATE(%s)";
			
	$results = $wpdb->get_results($wpdb->prepare($sql, $beginning->format('Y-m-d')), OBJECT);
	if($results !== false){
		$arr = array();
		foreach($results as $r){
			$hitDate = new DateTime($r->vtsh_date);
			$arr[$hitDate->format('Ymd').'-'.$r->srh_id] = $r->vtsh_visits;
		}
		
		$response['success'] = true;
		$response['data']['dates'] = array();
		foreach($searchEngines as $srhEng){
			$response['data']['search_engines'][$srhEng['srh_name']] = array();
		}
		
		$date = new DateTime();
		$date->modify('-'.$lastDays.' day');
		for($i = 0; $i <= $lastDays; $i++){
			$response['data']['dates'][] = $date->format('d/m');
			
			foreach($searchEngines as $srhEng){
				if(isset($arr[$date->format('Ymd').'-'.$srhEng['srh_id']])){
					$response['data']['search_engines'][$srhEng['srh_name']][] = $arr[$date->format('Ymd').'-'.$srhEng['srh_id']];
				} else{
					$response['data']['search_engines'][$srhEng['srh_name']][] = 0;
				}
			}
			
			$date->modify('+1 day');
		}
		
	} else{
		$response['success'] = false;
	}
	return $response;
}
//--------------------------------------------
/**
 * Returns the total visits by search engines
 *
 * @uses wpdb::get_results()
 *
 * @return mixed
 */
function ahc_get_total_visits_by_search_engines(){
	global $wpdb;
	$result = $wpdb->get_results("SELECT SUM(vtsh_visits) AS total FROM ahc_searching_visits", OBJECT);
	if($result !== false){
		return $result[0]->total;
	}
	return false;
}
//--------------------------------------------
/**
 * Return counts visits happened by search engine result in certain day (today|yesterday), certain period(last week, last month, last year) or total
 *
 * @uses wpdb::prepare()
 * @uses wpdb::get_results()
 *
 * @param string $period Optional
 * @return mixed
 */
function ahc_get_hits_search_engines_referers($period = 'total'){
	global $wpdb;
	$date = new DateTime();
	$sql = "SELECT srh_id, vtsh_visits 
			FROM `ahc_searching_visits`";
	$results = false;
	switch($period){
		case 'today':
		$sql .= " WHERE DATE(vtsh_date) = DATE(NOW())";
		$results = $wpdb->get_results($sql, OBJECT);
		break;
		
		case 'yesterday':
		$date->modify('-1 day');
		$sql .= " WHERE DATE(vtsh_date) = DATE(%s)";
		$results = $wpdb->get_results($wpdb->prepare($sql, $date->format('Y-m-d')), OBJECT);
		break;
		
		case 'week':
		$limits = ahc_get_week_limits($date->format('Y-m-d'));
		$sql .= " WHERE DATE(vtsh_date) >= DATE(%s) AND DATE(vtsh_date) <= DATE(%s)";
		$results = $wpdb->get_results($wpdb->prepare($sql, $limits[0], $limits[1]), OBJECT);
		break;
		
		case 'month':
		$sql .= " WHERE DATE(vtsh_date) >= DATE('".$date->format('Y-m-01')."') AND DATE(vtsh_date) <= DATE('".$date->format('Y-m-t')."')";
		$results = $wpdb->get_results($wpdb->prepare($sql, $limits[0], $limits[1]), OBJECT);
		break;
		
		case 'year':
		$sql .= " WHERE DATE(vtsh_date) >= DATE(%s) AND DATE(vtsh_date) <= DATE(%s)";
		$results = $wpdb->get_results($wpdb->prepare($sql, $date->format('Y-01-01'), $date->format('Y-12-31')), OBJECT);
		break;
		
		default:
		$results = $wpdb->get_results($sql, OBJECT);
	}
	
	$hitsReferers = array();
	if($results !== false){
		foreach($results as $r){
			$hitsReferers[$r->srh_id] = $r->vtsh_visits;
		}
		return $hitsReferers;
	}
	return false;
}
//--------------------------------------------
/**
 * Retrieves all search engines
 *
 * @uses wpdb::get_results()
 *
 * @return mixed
 */
function ahc_get_all_search_engines(){
	global $wpdb;
	$sql = "SELECT `srh_id`, `srh_name`, `srh_icon` FROM `ahc_search_engines`";
	$searchEngines = array();
	$c = 0;
	$results = $wpdb->get_results($sql, OBJECT);
	if($results !== false){
		foreach($results as $re){
			$searchEngines[$c]['srh_id'] = $re->srh_id;
			$searchEngines[$c]['srh_name'] = $re->srh_name;
			$searchEngines[$c]['srh_icon'] = $re->srh_icon;
			$c++;
		}
		return $searchEngines;
	}
	return false;
}
//--------------------------------------------
/**
 * Retrieves count of visits order by browsers
 *
 * @uses wpdb::get_results()
 *
 * @return array
 */
function ahc_get_browsers_hits_counts(){
	global $wpdb;
	$sql = "SELECT `bsr_id`, `bsr_name`, `bsr_visits` 
			FROM `ahc_browsers` 
			WHERE `bsr_visits` > 0";
	$results = $wpdb->get_results($sql, OBJECT);
	$response = array();
	if($results !== false){
		$response['success'] = true;
		$response['data'] = array();
		$c = 0;
		foreach($results as $bsr){
			$response['data'][$c]['bsr_id'] = $bsr->bsr_id;
			$response['data'][$c]['bsr_name'] = $bsr->bsr_name;
			$response['data'][$c]['hits'] = $bsr->bsr_visits;
			$c++;
		}
	} else{
		$response['success'] = false;
	}
	return $response;
}
//--------------------------------------------
/**
 * Retrieves top referring sites
 *
 * @uses wpdb::prepare()
 * @uses wpdb::get_results()
 *
 * @return mixed
 */
function ahc_get_top_refering_sites(){
	global $wpdb;
	$sql = "SELECT rfr_site_name, rfr_visits 
			FROM `ahc_refering_sites` 
			ORDER BY rfr_visits DESC 
			LIMIT %d OFFSET 0";
	$results = $wpdb->get_results($wpdb->prepare($sql, AHC_TOP_REFERING_SITES_LIMIT), OBJECT);
	if($results !== false){
		$arr = array();
		$c = 0;
		foreach($results as $referer){
			$arr[$c]['site_name'] = $referer->rfr_site_name;
			$arr[$c]['total_hits'] = $referer->rfr_visits;
			$c++;
		}
		return $arr;
	} else{
		return false;
	}
}
//--------------------------------------------
/**
 * Retrieves recent visitors
 *
 * @uses wpdb::prepare()
 * @uses wpdb::get_results()
 *
 * @return mixed
 */
function ahc_get_recent_visitors(){
	global $wpdb, $_SERVER;
	$sql = "SELECT v.vtr_id, v.vtr_ip_address, v.vtr_referer, v.vtr_date, v.vtr_time, 
			b.bsr_name, b.bsr_icon 
			FROM `ahc_recent_visitors` AS v 
			JOIN `ahc_browsers` AS b ON v.bsr_id = b.bsr_id 
			WHERE v.vtr_ip_address NOT LIKE 'UNKNOWN%%' 
			ORDER BY v.vtr_date DESC 
			LIMIT %d OFFSET 0";
			
	$results = $wpdb->get_results($wpdb->prepare($sql, AHC_RECENT_VISITORS_LIMIT));
	if($results !== false){
		$arr = array();
		$c = 0;
		if(is_array($results)){
			foreach($results as $hit){
				$arr[$c]['hit_id'] = $hit->vtr_id;
				$arr[$c]['hit_ip_address'] = $hit->vtr_ip_address;
				$arr[$c]['hit_referer'] = (parse_url($hit->vtr_referer, PHP_URL_HOST) == $_SERVER['SERVER_NAME'])? '' : rawurldecode($hit->vtr_referer);
				$arr[$c]['hit_date'] = $hit->vtr_date;
				$arr[$c]['hit_time'] = $hit->vtr_time;
				$arr[$c]['bsr_name'] = $hit->bsr_name;
				$arr[$c]['bsr_icon'] = $hit->bsr_icon;
				$c++;
			}
		}
		return $arr;
	} else{
		return false;
	}
}
//--------------------------------------------
/**
 * Retrieves latest of key words used in search
 *
 * @uses wpdb::prepare()
 * @uses wpdb::get_results()
 *
 * @return mixed
 */
function ahc_get_latest_search_key_words_used(){
	global $wpdb;
	$sql = "SELECT k.kwd_ip_address, k.kwd_referer, k.kwd_keywords, k.kwd_date, k.kwd_time, 
			b.bsr_name, b.bsr_icon, s.srh_name, s.srh_icon 
			FROM `ahc_keywords` AS k 
			JOIN `ahc_browsers` AS b ON k.bsr_id = b.bsr_id 
			JOIN `ahc_search_engines` AS s on k.srh_id = s.srh_id 
			WHERE k.kwd_ip_address NOT LIKE 'UNKNOWN%%' 
			ORDER BY k.kwd_date DESC, k.kwd_time DESC 
			LIMIT %d OFFSET 0";
	
	$results = $wpdb->get_results($wpdb->prepare($sql, AHC_RECENT_KEYWORDS_LIMIT), OBJECT);
	if($results !== false){
		$arr = array();
		$c = 0;
		foreach($results as $re){
			$arr[$c]['hit_referer'] = rawurldecode($re->kwd_referer);
			$arr[$c]['hit_search_words'] = $re->kwd_keywords;
			$arr[$c]['hit_date'] = $re->kwd_date;
			$arr[$c]['hit_time'] = $re->kwd_time;
			$arr[$c]['hit_ip_address'] = $re->kwd_ip_address;
			$arr[$c]['bsr_name'] = $re->bsr_name;
			$arr[$c]['bsr_icon'] = $re->bsr_icon;
			$arr[$c]['srh_name'] = $re->srh_name;
			$arr[$c]['srh_icon'] = $re->srh_icon;
			$c++;
		}
		return $arr;
	} else{
		return false;
	}
}
//--------------------------------------------
/**
 * Is in login page
 *
 * @return boolean
 */
function ahc_is_login_page() {
    return in_array($GLOBALS['pagenow'], array('wp-login.php', 'wp-register.php'));
}
//--------------------------------------------
/**
 * Detect if the visitor is search engine bot
 *
 * @uses wpdb::get_results()
 *
 * @return boolean
 */
function ahc_is_search_engine_bot(){
		global $wpdb, $_SERVER;
		$results = $wpdb->get_results("SELECT `bot_name` FROM `ahc_search_engine_crawlers`", OBJECT);
		foreach($results as $crawler){
			if(stripos($_SERVER['HTTP_USER_AGENT'], $crawler->bot_name) !== false){
				return true;
			}
		}
		
		if(stripos($_SERVER['REQUEST_URI'], 'robots.txt') !== false){
			return true;
		}
		
		if(stripos($_SERVER['REQUEST_URI'], 'Bot') !== false){
			return true;
		}
		
		if(stripos($_SERVER['REQUEST_URI'], 'bot') !== false){
			return true;
		}
		return false;
}
//--------------------------------------------
/**
 * Detect if the visitor is WordPress bot
 *
 * @return boolean
 */
function ahc_is_wordpress_bot(){
	global $_SERVER;
	if(stripos($_SERVER['HTTP_USER_AGENT'], 'WordPress') !== false){
		return true;
	}
	return false;
}
//--------------------------------------------
/**
 * Detects post id, post title and post type of current page
 *
 * @uses wpdb::prepare()
 * @uses wpdb::get_results()
 *
 * @param object $query. this object is passed to the callback function of "parse_query" hooked action
 * @return mixed
 */
function ahc_detect_requested_page($query){
	global $wpdb;
	$vars = $query->query_vars;
	if(isset($vars['p']) && !empty($vars['p'])){
		$result = $wpdb->get_results($wpdb->prepare("SELECT post_title FROM ".$wpdb->prefix."posts WHERE ID = %d AND post_type = %s", $vars['p'], 'post'));
		if($result !== false && $wpdb->num_rows > 0){
			return array('page_id' => $vars['p'], 'page_title' => $result[0]->post_title, 'post_type' => 'post');
		}
	}
	
	else if(isset($vars['name']) && !empty($vars['name'])){
		$result = $wpdb->get_results($wpdb->prepare("SELECT ID, post_title FROM ".$wpdb->prefix."posts WHERE post_name = %s ", $vars['name']));
		if($result !== false && $wpdb->num_rows > 0){
			return array('page_id' => $result[0]->ID, 'page_title' => $result[0]->post_title, 'post_type' => 'post');
		}
	}
	
	else if(isset($vars['pagename']) && !empty($vars['pagename'])){
		$result = $wpdb->get_results($wpdb->prepare("SELECT ID, post_title FROM ".$wpdb->prefix."posts WHERE post_name = %s AND post_type = %s", $vars['pagename'], 'page'));
		if($result !== false && $wpdb->num_rows > 0){
			return array('page_id' => $result[0]->ID, 'page_title' => $result[0]->post_title, 'post_type' => 'page');
		}
	}
	
	else if(isset($vars['page_id']) && !empty($vars['page_id'])){
		$result = $wpdb->get_results($wpdb->prepare("SELECT post_title FROM ".$wpdb->prefix."posts WHERE ID = %s AND post_type = %s", $vars['page_id'], 'page'));
		if($result !== false && $wpdb->num_rows > 0){
			return array('page_id' => $page_id, 'page_title' => $result[0]->post_title, 'post_type' => 'page');
		}
	}
	else{
		return array('page_id' => 'HOMEPAGE', 'page_title' => NULL, 'post_type' => NULL);
	}
}
//--------------------------------------------
/**
 * Initiates tracking process
 *
 * @param object $query. this object is passed to this callback function of "parse_request" hooked action
 * @return void
 */
function ahc_track_visitor($query){
	if(ahc_should_track_visitor() && !ahc_is_login_page() && !ahc_is_search_engine_bot() && !ahc_is_wordpress_bot()){
		$page = ahc_detect_requested_page($query);
		if(is_array($page)){
			Globals::$page_id = $page['page_id'];
			Globals::$page_title = $page['page_title'];
			Globals::$post_type = $page['post_type'];
		} else{
			return;
		}
		$hitsCounter = new WPHitsCounter(Globals::$page_id, Globals::$page_title, Globals::$post_type);
		$hitsCounter->traceVisitorHit();
	}
}
//--------------------------------------------
/**
 * Ceil for decimal numbers with precision
 *
 * @param float $number
 * @param integer $precision
 * @param string $separator
 * @return float
 */
function ceil_dec($number,$precision,$separator){
	if(strpos($number, '.') !== false){
    $numberpart=explode($separator,$number);  
$numberpart[1]=substr_replace($numberpart[1],$separator,$precision,0);
    if($numberpart[0]>=0)
    {$numberpart[1]=ceil($numberpart[1]);}
    else
    {$numberpart[1]=floor($numberpart[1]);}

    $ceil_number= array($numberpart[0],$numberpart[1]);
    return implode($separator,$ceil_number);
	}
	return $number;
}
//--------------------------------------------
/**
 * Retrieve sum visits by post title
 *
 * @uses wpdb::prepare()
 * @uses wpdb::get_results()
 *
 * @return mixed
 */
function ahc_get_traffic_by_title(){
	global $wpdb;
	$sql1 = "SELECT SUM(hits) AS sm FROM (
			SELECT SUM(til_hits) AS hits 
			FROM ahc_title_traffic 
			GROUP BY til_page_id
			) myTable";
			
	$sql2 = "SELECT til_page_id, til_page_title, til_hits 
			FROM ahc_title_traffic 
			GROUP BY til_page_id 
			ORDER BY til_hits DESC 
			LIMIT %d OFFSET 0";
			
	$result1 = $wpdb->get_results($sql1);
	if($result1 !== false){
		$total = $result1[0]->sm;
		$result2 = $wpdb->get_results($wpdb->prepare($sql2, AHC_TRAFFIC_BY_TITLE_LIMIT));
		if($result2 !== false){
			$arr = array();
			if($wpdb->num_rows > 0){
				$c = 0;
				foreach($result2 as $r){
					$arr[$c]['rank'] = $c + 1;
					$arr[$c]['til_page_id'] = $r->til_page_id;
					$arr[$c]['til_page_title'] = $r->til_page_title;
					$arr[$c]['til_hits'] = $r->til_hits;
					$arr[$c]['percent'] = ($total > 0)? ceil_dec((($r->til_hits / $total) * 100), 2, ".").' %' : 0;
					$c++;
				}
			}
			return $arr;
		}
	}
	return false;
}
//--------------------------------------------
/**
 * Retrieves sum of visits order by time
 *
 * @uses wpdb::get_results()
 *
 * @return mixed
 */
function ahc_get_time_visits(){
	global $wpdb;
	$sql1 = "SELECT SUM(vtm_visitors) AS sm FROM ahc_visits_time";
	$sql2 = "SELECT vtm_time_from, vtm_time_to, vtm_visitors, vtm_visits 
			FROM ahc_visits_time";
			
	$result1 = $wpdb->get_results($sql1);
	if($result1 !== false){
		$total = $result1[0]->sm;
		$result2 = $wpdb->get_results($sql2);
		if($result2 !== false){
			$arr = array();
			$c = 0;
			foreach($result2 as $r){
				$timeFrom = $r->vtm_time_from;
				$timeFrom = explode(':', $timeFrom);
				$timeFrom = $timeFrom[0].':'.$timeFrom[1];
				$timeTo = $r->vtm_time_to;
				$timeTo = explode(':', $timeTo);
				$timeTo = $timeTo[0].':'.$timeTo[1];
				
				$arr[$c]['vtm_time_from'] = $timeFrom;
				$arr[$c]['vtm_time_to'] = $timeTo;
				$arr[$c]['vtm_visitors'] = $r->vtm_visitors;
				$arr[$c]['vtm_visits'] = $r->vtm_visits;
				$arr[$c]['percent'] = ($total > 0)? ceil_dec((($r->vtm_visitors / $total) * 100), 2, ".") : 0;
				$c++;
			}
			return $arr;
		}
	}
	return false;
}
//--------------------------------------------
/**
 * Returns client IP address
 *
 * @return string
 */
function ahc_get_client_ip_address(){
	global $_SERVER;
	$ipAddress = '';
    if(isset($_SERVER['HTTP_CLIENT_IP']) && !empty($_SERVER['HTTP_CLIENT_IP'])){
        $ipAddress = $_SERVER['HTTP_CLIENT_IP'];
	}
    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']) && !empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
        $ipAddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
	}
    else if(isset($_SERVER['HTTP_X_FORWARDED']) && !empty($_SERVER['HTTP_X_FORWARDED'])){
        $ipAddress = $_SERVER['HTTP_X_FORWARDED'];
	}
    else if(isset($_SERVER['HTTP_FORWARDED_FOR']) && !empty($_SERVER['HTTP_FORWARDED_FOR'])){
        $ipAddress = $_SERVER['HTTP_FORWARDED_FOR'];
	}
    else if(isset($_SERVER['HTTP_FORWARDED']) && !empty($_SERVER['HTTP_FORWARDED'])){
        $ipAddress = $_SERVER['HTTP_FORWARDED'];
	}
    else if(isset($_SERVER['REMOTE_ADDR']) && !empty($_SERVER['REMOTE_ADDR'])){
        $ipAddress = $_SERVER['REMOTE_ADDR'];
	}
    else{
        $ipAddress = 'UNKNOWN';
	}
    return $ipAddress;
}
//--------------------------------------------
/**
 * To include scripts and styles tags into the head
 *
 * @uses wp_register_style()
 * @uses wp_enqueue_style()
 * @uses wp_register_script()
 * @uses wp_enqueue_script()
 *
 * @return void
 */
function ahc_include_scripts(){
	wp_register_style('ahc_lang_css', plugins_url('/css/en_css.css', AHC_PLUGIN_MAIN_FILE));
	wp_enqueue_style('ahc_lang_css');
	
	wp_register_style('ahc_bootstrap_css', plugins_url('/lib/bootstrap/css/bootstrap.min.css', AHC_PLUGIN_MAIN_FILE));
	wp_enqueue_style('ahc_bootstrap_css');
	
	wp_enqueue_script('jquery');
	
	wp_register_script('ahc_bootstrap_js', plugins_url('/lib/bootstrap/js/bootstrap.min.js', AHC_PLUGIN_MAIN_FILE));
	wp_enqueue_script('ahc_bootstrap_js');
	
	wp_register_script('ahc_lang_js', plugins_url('/lang/js/'.Globals::$lang.'_lang.js', AHC_PLUGIN_MAIN_FILE));
	wp_enqueue_script('ahc_lang_js');
	
	wp_register_script('ahc_main_js', plugins_url('/js/js.js', AHC_PLUGIN_MAIN_FILE));
	wp_enqueue_script('ahc_main_js');
	
	
	wp_register_script('ahc_Chart_js', plugins_url('/lib/Chart_js/Chart.min.js', AHC_PLUGIN_MAIN_FILE));
	wp_enqueue_script('ahc_Chart_js');
	
	wp_register_script('ahc_google_maps', 'http://maps.googleapis.com/maps/api/js?key=AIzaSyB0fRgC_3Wmp1PY5ZsuzK8VEooiUvVQq3Q&sensor=false');
	wp_enqueue_script('ahc_google_maps');
	
	

}
//--------------------------------------------



//---------------------------------------------Add button to the admin bar
function vtrts_add_items($admin_bar)
{
global $pluginsurl;

$wccpadminurl = get_admin_url();
//The properties of the new item. Read More about the missing 'parent' parameter below
    $args = array(
            'id'    => 'visitorstraffic',
            'title' => __('<img src="'.plugins_url('/images/vtrtspro.png', AHC_PLUGIN_MAIN_FILE).'" style="vertical-align:middle;margin-right:5px;" alt="visitors traffic" title="visitors traffic" />' ),
            'href'  => $wccpadminurl.'admin.php?page=ahc_hits_counter_menu',
            'meta'  => array('title' => __('Visitors Traffic Real Time Statistics'),)
            );
 
    //This is where the magic works.
    $admin_bar->add_menu( $args);
}
//---------------------------------------- Add plugin settings link to Plugins page
function vtrtsp_plugin_add_settings_link( $links ) {
	$settings_link = '<a href="admin.php?page=ahc_hits_counter_menu">' . __( 'visitors traffic' ) . '</a>';
	array_push( $links, $settings_link );
	return $links;
}
//------------------------------------------------------------------------


?>