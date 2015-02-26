<?php /* Smarty version Smarty-3.1.16, created on 2014-01-15 13:01:16
         compiled from "login.phtml" */ ?>
<?php /*%%SmartyHeaderCode:2003352d5f700a32657-54761341%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6fd5cd6051fb8e8bf209aa621348581e27fd4f04' => 
    array (
      0 => 'login.phtml',
      1 => 1389790863,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2003352d5f700a32657-54761341',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_52d5f700bb9a79_54895595',
  'variables' => 
  array (
    'titulo' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52d5f700bb9a79_54895595')) {function content_52d5f700bb9a79_54895595($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
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

		<div id="postagens">			
			<h2>Bem Vindo <?php echo $_SESSION['logado_login'];?>
</h2>
			<span id="link"><a href="login.php?acao=logoof">Sair</a></span>
			<input type="hidden" name="login" value="<?php echo $_SESSION['logado_login'];?>
" />
			<input type="text" name="postar" value="Digite seu comentario" />
			<input type="submit" value="Postar" />			
		</div>

		<div id="mensagens">
			<ul id="msg">
				
			</ul>
		</div>

	</body>
</html><?php }} ?>
