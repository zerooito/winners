<?php /* Smarty version Smarty-3.1.16, created on 2014-01-15 22:42:56
         compiled from "templates/login.phtml" */ ?>
<?php /*%%SmartyHeaderCode:88864893352d75540a26c93-26516949%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '17115e23e07871cf3e142384257336f71648b556' => 
    array (
      0 => 'templates/login.phtml',
      1 => 1389843532,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '88864893352d75540a26c93-26516949',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'titulo' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_52d75540a7ef05_61778181',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52d75540a7ef05_61778181')) {function content_52d75540a7ef05_61778181($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
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
			<input type="text" name="email" value="Digite seu email" />
			<input type="text" name="website" value="Digite seu website" />	
			<input type="submit" value="Postar" />	
			<span class="contagem"> 255</span>			
		</div>

		<div id="mensagens">
			<ul id="msg">
				
			</ul>
		</div>

	</body>
</html><?php }} ?>
