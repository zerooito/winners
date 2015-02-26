<?php /* Smarty version Smarty-3.1.16, created on 2014-01-16 20:10:10
         compiled from "templates\login.phtml" */ ?>
<?php /*%%SmartyHeaderCode:669452d68709906e31-69033799%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2dda41d4cc43f32c21c0f66c91de48e05e315e68' => 
    array (
      0 => 'templates\\login.phtml',
      1 => 1389897670,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '669452d68709906e31-69033799',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_52d68709a2cea7_75395645',
  'variables' => 
  array (
    'titulo' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52d68709a2cea7_75395645')) {function content_52d68709a2cea7_75395645($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
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
			<input type="hidden" name="id" value="<?php echo $_SESSION['logado_id'];?>
" />
			<textarea maxlength="255" name="postar">Digite seu comentario</textarea>
			<input type="submit" value="Postar" />	
			<span class="contagem"> 255 </span>
			<span id="link"><a href="login.php?acao=logoof">Sair</a></span>	
		</div>

		<div id="mensagens">
			<ul id="msg">
				
			</ul>
		</div>

	</body>
</html>
<!--
Pagina responsavel por mostra postagens e de fazer postagens, passando como parametro o 
id do usuario logado para usar na recuperação de dados 
--><?php }} ?>
