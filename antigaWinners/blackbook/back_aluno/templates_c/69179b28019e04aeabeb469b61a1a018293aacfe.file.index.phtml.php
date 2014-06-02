<?php /* Smarty version Smarty-3.1.16, created on 2014-03-25 23:29:15
         compiled from "templates\professor\index.phtml" */ ?>
<?php /*%%SmartyHeaderCode:278615332114bba8b65-27427246%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '69179b28019e04aeabeb469b61a1a018293aacfe' => 
    array (
      0 => 'templates\\professor\\index.phtml',
      1 => 1395790078,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '278615332114bba8b65-27427246',
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
  'unifunc' => 'content_5332114c4bb3a9_00458133',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5332114c4bb3a9_00458133')) {function content_5332114c4bb3a9_00458133($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
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
