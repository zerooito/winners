<?php /* Smarty version Smarty-3.1.16, created on 2014-01-15 22:42:31
         compiled from "templates/cadastra.phtml" */ ?>
<?php /*%%SmartyHeaderCode:142258508952d75527837096-69779860%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'bf9e5c9adaf812eca20cdeaa3dd238a98cd2e295' => 
    array (
      0 => 'templates/cadastra.phtml',
      1 => 1389843532,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '142258508952d75527837096-69779860',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'titulo' => 0,
    'h1' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_52d75527875df0_14269730',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52d75527875df0_14269730')) {function content_52d75527875df0_14269730($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title><?php echo $_smarty_tpl->tpl_vars['titulo']->value;?>
</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
	<body>

		<div id="formulario">
		<h1><?php echo $_smarty_tpl->tpl_vars['h1']->value;?>
</h1>
		<form action="cadastra.php?acao=cadastro"  method="post">
			<span>Login: </span><input type="text" name="login" />
			<span>Senha: </span><input type="password" name="senha" />
			<input type="submit" name="logar" value="Cadastra" />
		</form>
		</div>
		<div id="rodape">
			<a href="index.php">Pagina Inicial</a>
		</div>

	</body>
</html><?php }} ?>
