<?php

	//Definir a constante com o caminho do diretorio da engine
	define('SMARTY_DIR', 'lib/smarty/libs/');
	//inclusao da class Smarty.class.php com a constante do diretorio
	include(SMARTY_DIR . 'Smarty.class.php');
	//
	$smarty = new Smarty();
	$smarty->cache_dir = 'cache';
	$smarty->config_dir = 'configs';
	$smarty->compile_dir = 'templates_c';
	$smarty->template_dir = 'templates';

?>