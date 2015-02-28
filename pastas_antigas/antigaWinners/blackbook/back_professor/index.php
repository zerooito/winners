<?php
	  include '../Connections/conexao.php';
	  include 'configs/config.php';
	  require 'classes/BD.class.php';
	  require 'classes/instituicao.class.php';

		$smarty->assign('titulo', 'Bem Vindo, Logue na sua conta PRofessor');
		$smarty->assign('h1', 'Faça o login Professor');

		$smarty->display('index.phtml');

