<?php
				
$searchEngines = array(
					array('srh_name' => 'Google', 'srh_icon' => 'google.png', 'srh_query_parameter' => 'q', 'srh_identifier' => 'google',
						'crawlers' => array(
										'Googlebot',
										'Googlebot-News',
										'Googlebot-Image',
										'Googlebot-Video',
										'Googlebot-Mobile',
										'Mediapartners-Google',
										'Mediapartners',
										'Mediapartners-Google',
										'Mediapartners',
										'AdsBot-Google'
										)
					),
					array('srh_name' => 'Bing', 'srh_icon' => 'bing.png', 'srh_query_parameter' => 'q', 'srh_identifier' => 'bing',
						'crawlers' => array(
										'bingbot'
										)
					),
					array('srh_name' => 'Yahoo Search', 'srh_icon' => 'yahoo.png', 'srh_query_parameter' => 'p', 'srh_identifier' => 'yahoo',
						'crawlers' => array(
										'Yahoo! Slurp',
										'Yahoo! Slurp China',
										'YahooSeeker'
										)
					),
					array('srh_name' => 'Ask', 'srh_icon' => 'ask.png', 'srh_query_parameter' => 'q', 'srh_identifier' => 'ask',
						'crawlers' => array(
										'Ask Jeeves'
										)
					),
					array('srh_name' => 'WebCrawler', 'srh_icon' => 'webcrawler.gif', 'srh_query_parameter' => 'q', 'srh_identifier' => 'webcrawler',
						'crawlers' => array(
										'FAST-WebCrawler'
										)
					),
					array('srh_name' => 'Baiduspider', 'srh_icon' => 'baiduspider.png', 'srh_query_parameter' => 'domain_name', 'srh_identifier' => 'baiduspider',
						'crawlers' => array(
										'Baiduspider'
										)
					),
					array('srh_name' => 'DuckDuckGo', 'srh_icon' => 'duckduckgo.png', 'srh_query_parameter' => 'q', 'srh_identifier' => 'duckduckgo',
						'crawlers' => array(
										'DuckDuckBot'
										)
					),
					array('srh_name' => 'Yandex', 'srh_icon' => 'yandex.png', 'srh_query_parameter' => 'text', 'srh_identifier' => 'yandex',
						'crawlers' => array(
										'YandexBot'
										)
					),
					array('srh_name' => 'Aol Search', 'srh_icon' => 'aol.png', 'srh_query_parameter' => 'q', 'srh_identifier' => 'aol',
						'crawlers' => array(
										'inktomi',
										'aol.com'
										)
					),
					array('srh_name' => 'Dotmic', 'srh_icon' => 'dotmic.gif', 'srh_query_parameter' => 'q', 'srh_identifier' => 'dotmic',
						'crawlers' => array(
										'DotBot',
										)
					),
				);
				
$browsers = array(
				array('bsr_id' => 1, 'bsr_name' => 'IE', 'bsr_icon' => 'ie.png'),
				array('bsr_id' => 2, 'bsr_name' => 'Firefox', 'bsr_icon' => 'firefox.png'),
				array('bsr_id' => 3, 'bsr_name' => 'Netscape', 'bsr_icon' => 'netscape.png'),
				array('bsr_id' => 4, 'bsr_name' => 'Chrome', 'bsr_icon' => 'chrome.png'),
				array('bsr_id' => 5, 'bsr_name' => 'Gecko/Mozilla', 'bsr_icon' => 'mozilla.png'),
				array('bsr_id' => 6, 'bsr_name' => 'Opera Mini', 'bsr_icon' => 'opera.png'),
				array('bsr_id' => 7, 'bsr_name' => 'Opera', 'bsr_icon' => 'opera.png'),
				array('bsr_id' => 8, 'bsr_name' => 'Safari', 'bsr_icon' => 'safari.png'),
				array('bsr_id' => 9, 'bsr_name' => 'iPad', 'bsr_icon' => 'ipad.png'),
				array('bsr_id' => 10, 'bsr_name' => 'Android', 'bsr_icon' => 'android.png'),
				array('bsr_id' => 11, 'bsr_name' => 'AIR', 'bsr_icon' => 'air.png'),
				array('bsr_id' => 12, 'bsr_name' => 'Fluid', 'bsr_icon' => 'fluid.png'),
				array('bsr_id' => 13, 'bsr_name' => 'Maxthon', 'bsr_icon' => 'maxthon.png'),
				array('bsr_id' => 14, 'bsr_name' => 'unknown', 'bsr_icon' => 'unknown.png')
			);

$dayHours = array(
				array('vtm_time_from' => '00:00:00', 'vtm_time_to' => '00:59:59'),
				array('vtm_time_from' => '01:00:00', 'vtm_time_to' => '01:59:59'),
				array('vtm_time_from' => '02:00:00', 'vtm_time_to' => '02:59:59'),
				array('vtm_time_from' => '03:00:00', 'vtm_time_to' => '03:59:59'),
				array('vtm_time_from' => '04:00:00', 'vtm_time_to' => '04:59:59'),
				array('vtm_time_from' => '05:00:00', 'vtm_time_to' => '05:59:59'),
				array('vtm_time_from' => '06:00:00', 'vtm_time_to' => '06:59:59'),
				array('vtm_time_from' => '07:00:00', 'vtm_time_to' => '07:59:59'),
				array('vtm_time_from' => '08:00:00', 'vtm_time_to' => '08:59:59'),
				array('vtm_time_from' => '09:00:00', 'vtm_time_to' => '09:59:59'),
				array('vtm_time_from' => '10:00:00', 'vtm_time_to' => '10:59:59'),
				array('vtm_time_from' => '11:00:00', 'vtm_time_to' => '11:59:59'),
				array('vtm_time_from' => '12:00:00', 'vtm_time_to' => '12:59:59'),
				array('vtm_time_from' => '13:00:00', 'vtm_time_to' => '13:59:59'),
				array('vtm_time_from' => '14:00:00', 'vtm_time_to' => '14:59:59'),
				array('vtm_time_from' => '15:00:00', 'vtm_time_to' => '15:59:59'),
				array('vtm_time_from' => '16:00:00', 'vtm_time_to' => '16:59:59'),
				array('vtm_time_from' => '17:00:00', 'vtm_time_to' => '17:59:59'),
				array('vtm_time_from' => '18:00:00', 'vtm_time_to' => '18:59:59'),
				array('vtm_time_from' => '19:00:00', 'vtm_time_to' => '19:59:59'),
				array('vtm_time_from' => '20:00:00', 'vtm_time_to' => '20:59:59'),
				array('vtm_time_from' => '21:00:00', 'vtm_time_to' => '21:59:59'),
				array('vtm_time_from' => '22:00:00', 'vtm_time_to' => '22:59:59'),
				array('vtm_time_from' => '23:00:00', 'vtm_time_to' => '23:59:59'),
			);
?>