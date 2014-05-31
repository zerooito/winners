<?php
	  include '../Connections/conexao.php';
	  include 'configs/config.php';

		$smarty->assign('titulo', 'Bem Vindo, Logue na sua conta Aluno');
		$smarty->assign('h1', 'Faça o login ALuno');

		$smarty->display('index.phtml');

?>