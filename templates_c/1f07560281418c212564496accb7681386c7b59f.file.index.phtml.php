<?php /* Smarty version Smarty-3.1.16, created on 2014-05-25 17:18:25
         compiled from "templates\index.phtml" */ ?>
<?php /*%%SmartyHeaderCode:1271532f2569d00de5-88659007%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1f07560281418c212564496accb7681386c7b59f' => 
    array (
      0 => 'templates\\index.phtml',
      1 => 1401038233,
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
    'script' => 0,
    'h1' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_532f2569dcf895_05727114')) {function content_532f2569dcf895_05727114($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="product" content="BlackBook EAD">
    <meta name="description" content="">
    <meta name="author" content="Reginaldo Luis">

    <link href="assets/css/metro-bootstrap.css" rel="stylesheet">
    <link href="assets/css/metro-bootstrap-responsive.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">

    <script type="text/javascript" src="assets/js/jquery.js"></script>
    <script type="text/javascript" src="assets/js/funcoes.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <script src="http://malsup.github.com/jquery.tcycle.js"></script>
    <script src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>

    <?php echo $_smarty_tpl->tpl_vars['script']->value;?>


    <title>Winnes Desenvolvimento de Sites e Sistemas</title>
</head>

	<body class="metro">
    <nav class="navigation-bar dark fixed-top shadow">
        <nav class="navigation-bar-content container">

            <button class="element image-button image-left place-left">
                <img src="assets/images/logo.png" width="64" height="64"/>
            </button>
            <a class="element brand" href="#"><span class="icon-spin">O que é ?</span></a>     
            <span class="element-divider"></span>
            <a class="element brand" href="#"><span class="icon-printer">Por que usar ?</span></a>     
            <span class="element-divider"></span>
            <a class="element brand" href="#"><span class="icon-printer">Planos</span></a>     
            <span class="element-divider"></span>
            <a class="element brand" href="#"><span class="icon-printer">Downloads</span></a>     
            <span class="element-divider"></span>
            <a class="element brand" href="#"><span class="icon-printer">Suporte</span></a>     
            <span class="element-divider"></span>
            <a class="element brand" href="#"><span class="icon-printer">Compra Agora</span></a>     
            <span class="element-divider"></span>
     
            <div class="element input-element">
                <form>
                    <div class="input-control text">
                        <input type="text" placeholder="O que procura ?">
                        <button class="btn-search"></button>
                    </div>
                </form>
            </div>
     
            <span class="element-divider place-right"></span>
            <a class="element place-right" href="#"><span class="icon-locked-2">Duvidas ?</span></a>
            <span class="element-divider place-right"></span>
            <button class="element image-button image-left place-right">
                Reginaldo Luis
                <img src="assets/images/1.png"/>
            </button>
        </nav>
    </nav>

    <div id="sucesso">
        <div class="alert">Aviso</div>
        <div class="conteudo_alert"></div>
        <span id="ok">Ok, Entedi !</span>
    </div>


    <div class="tcycle">
            <img src="assets/images/1.png">
            <img src="assets/images/4.jpg">
    </div>

    <div id="login" class="login">
    <form action="index.php" method="post">
        <label>Email: </label><input class="input-control text" data-role="input-control" type="text" name="login_email" placeholder="Digite seu email" required />
        <label>Senha: </label><input class="input-control text" data-role="input-control" type="password" name="login_senha" placeholder="Digite sua senha" required /><br/><br/>
        <span class="large" id="logar">Login</span>
    </form>
    </div>

    <div id="formulario" class="cadastro">
	<h3><?php echo $_smarty_tpl->tpl_vars['h1']->value;?>
</h3>
	<form action="index.php"  method="post">
		<label>Nome: </label><input class="input-control text" data-role="input-control" type="text" name="nome" placeholder="Digite seu nome" required />
		<label>Email: </label><input class="input-control text" data-role="input-control" type="text" name="email" placeholder="Digite seu email" required />
		<label>Senha: </label><input class="input-control text" data-role="input-control" type="password" name="senha" placeholder="Digite sua senha" required />
        <label>Escolha seus produtos</label>
        <div class="input-control checkbox">
            <label>
                <input type="checkbox" name="ead" id="ead" value="1" />
                <span class="check"></span>
                EAD
            </label>
        </div>
        <div class="input-control checkbox">
            <label>
                <input type="checkbox" name="erp" id="erp" value="1" />
                <span class="check"></span>
                ERP
            </label>
        </div>
        <div class="input-control checkbox">
            <label>
                <input type="checkbox" name="site" id="site" value="1" />
                <span class="check"></span>
                Site Pronto
            </label>
        </div>
		<span class="large" id="enviar">Cadastrar</span>
	</form>
	</div>

    <div id="conteudo">
        <h1>Sistemas Winners</h1>
        <p>Os sistemas da winners são os melhores por diversos motivos, a facilidade para o usuario, o suporte integrado 24 horas, e os melhores desenvolvedores que você irá ver está aqui, fazendo de tudo para que você obtenha o maior grau de experiencia, em cada um de nossos sistemas, então corra e faça um orçamento.</p>
    </div>

    <div id="menu2">
        <ul>
            <li><img src="assets/images/chat.png" width="200" height="200"></li>
            <li><img src="assets/images/equipe.jpg" width="200" height="200"></li>
            <li><img src="assets/images/orcamento.png" width="200" height="200"></li>
        </ul>
    </div>

	</body>
</html><?php }} ?>
