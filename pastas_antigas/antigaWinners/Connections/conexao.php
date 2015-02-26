<?php
	//primeiras configurações feitas no intervalo da faculdade
	error_reporting(1);
	$host = 'localhost';
	$user = 'root';
	$pass = '';
	$bd = 'winners';

	//dados produção
/*	$host = "mysql17.000webhost.com";
	$bd = "a1769871_winners";
	$user = "a1769871_winners";
	$pass = "";

*/
	$conexao = mysql_connect($host,$user,$pass);
	$conecta = mysql_select_db($bd,$conexao);

	define('HOST',$host);
	define('BD',$bd);
	define('USER',$user);
	define('PASS',$pass);
