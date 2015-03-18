<?php /* Smarty version Smarty-3.1.16, created on 2014-01-15 22:40:47
         compiled from "templates/index.phtml" */ ?>
<?php /*%%SmartyHeaderCode:49254676052d754bfbcdfc2-17407110%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '08faf69b271b86f72f89a09ab87fd855a7c9fe9e' => 
    array (
      0 => 'templates/index.phtml',
      1 => 1389843532,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '49254676052d754bfbcdfc2-17407110',
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
  'unifunc' => 'content_52d754bfc0ff69_77353962',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52d754bfc0ff69_77353962')) {function content_52d754bfc0ff69_77353962($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
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
			<a href="cadastra.php">Cadastre-se Já</a>
		</div>

	</body>
</html><?php }} ?>
