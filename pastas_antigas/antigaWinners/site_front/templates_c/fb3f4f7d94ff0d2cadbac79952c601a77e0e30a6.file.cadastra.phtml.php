<?php /* Smarty version Smarty-3.1.16, created on 2014-01-16 18:51:38
         compiled from "templates\cadastra.phtml" */ ?>
<?php /*%%SmartyHeaderCode:1155452d693567c96b3-87395939%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'fb3f4f7d94ff0d2cadbac79952c601a77e0e30a6' => 
    array (
      0 => 'templates\\cadastra.phtml',
      1 => 1389894692,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1155452d693567c96b3-87395939',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_52d693568af036_13028562',
  'variables' => 
  array (
    'titulo' => 0,
    'h1' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52d693568af036_13028562')) {function content_52d693568af036_13028562($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title><?php echo $_smarty_tpl->tpl_vars['titulo']->value;?>
</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/funcoes.js"></script>
</head>
	<body>

		<div id="formulario">
		<h1><?php echo $_smarty_tpl->tpl_vars['h1']->value;?>
</h1><span>Todos os campos devem ser preenchidos</span>
		<form action="cadastra.php?acao=cadastro"  method="post">
			<span>Login: </span><input type="text" name="login" />
			<span>Senha: </span><input type="password" name="senha" />
			<span>Email: </span><input type="text" name="email" />
			<span>Nome: </span><input type="text" name="nome" />
			<span>Website: </span><input type="text" name="website" />		
			<input type="submit" name="logar" value="Cadastra" />
			<div id="rodape">
				<a href="index.php">Pagina Inicial</a>
			</div>
		</form>
		</div>
	</body>
</html>
<!-- 
Pagina resposavel por cadastra os usuarios no sistema 
passando os dados por post para uma acao chamada cadastro na 
pagina cadastra.php
--><?php }} ?>
