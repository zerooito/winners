<?php
	session_start();
	require '../Connections/conexao.php';
	include('../configs/config.php');
	require '../classes/BD.class.php';
	require '../classes/user.class.php';

	$user = new user();

	if($_SESSION){
		$email = $_SESSION['email'];
		$senha = $_SESSION['senha'];
	}else{
		echo 'Sabe de nada inocente !';
		die;
	}

	$dados = $user->meus_dados_email($email,$senha);
	foreach ($dados as $indice => $valor){
		$smarty->assign('id_usuario', $valor['id_usuario']);
		$smarty->assign('nome', $valor['nome']);
		$smarty->assign('erp', $valor['erp_situacao']);
		$smarty->assign('ead', $valor['ead_situacao']);
		$smarty->assign('site', $valor['site_situacao']);
		$smarty->assign('usuario_ativo', $valor['usuario_ativo']);
	}

	$smarty->assign('titulo', 'Bem Vindo, Logue na sua conta');
	$smarty->assign('h1', 'Faça o login');
	$smarty->assign('email', $email);

	$smarty->display('index.phtml');

	if($_GET['acao'] == 'logout'){
		unset($_SESSION['email']);
		unset($_SESSION['senha']);
		unset($_SESSION);
		session_destroy();

		echo '<script>location.href="../index.php";</script>';
	}