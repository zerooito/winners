<?php /* Smarty version Smarty-3.1.16, created on 2014-03-25 23:46:01
         compiled from "templates\index.phtml" */ ?>
<?php /*%%SmartyHeaderCode:1271532f2569d00de5-88659007%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1f07560281418c212564496accb7681386c7b59f' => 
    array (
      0 => 'templates\\index.phtml',
      1 => 1395790518,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1271532f2569d00de5-88659007',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_532f2569dcf895_05727114',
  'variables' => 
  array (
    'titulo' => 0,
    'h1' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_532f2569dcf895_05727114')) {function content_532f2569dcf895_05727114($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
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
		<form action="login.php"  method="post">
			<span>Login: </span><input type="text" name="login" />
			<span>Senha: </span><input type="password" name="senha" />
			<input type="submit" name="logar" value="Logar" />
		</form>
		</div>
		<div id="rodape">
			<a href="professor/professor.php">Cadastre-se Já</a>
		</div>

	</body>
</html><?php }} ?>
