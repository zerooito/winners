<?php /* Smarty version Smarty-3.1.16, created on 2014-05-04 18:08:55
         compiled from "templates\blog.phtml" */ ?>
<?php /*%%SmartyHeaderCode:146275362a8731f49c0-97442392%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '27238bea9cd4e8763aa9228bf5820fb49ac989ab' => 
    array (
      0 => 'templates\\blog.phtml',
      1 => 1399158471,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '146275362a8731f49c0-97442392',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_5362a873d0b8c7_28106302',
  'variables' => 
  array (
    'estilophp' => 0,
    'nome_empresa_pagina' => 0,
    'bairro' => 0,
    'rua' => 0,
    'cidade' => 0,
    'estado' => 0,
    'telefone' => 0,
    'id_usuario' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5362a873d0b8c7_28106302')) {function content_5362a873d0b8c7_28106302($_smarty_tpl) {?><!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title></title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- Add custom CSS here -->
    <link href="css/business-casual.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['estilophp']->value;?>
" type="text/css" />
</head>

<body>

    <div class="brand"><?php echo $_smarty_tpl->tpl_vars['nome_empresa_pagina']->value;?>
</div>
    <div class="address-bar"><?php echo $_smarty_tpl->tpl_vars['bairro']->value;?>
 | <?php echo $_smarty_tpl->tpl_vars['rua']->value;?>
. | <?php echo $_smarty_tpl->tpl_vars['cidade']->value;?>
, <?php echo $_smarty_tpl->tpl_vars['estado']->value;?>
 | <?php echo $_smarty_tpl->tpl_vars['telefone']->value;?>
</div>

    <nav class="navbar navbar-default" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html"><?php echo $_smarty_tpl->tpl_vars['nome_empresa_pagina']->value;?>
</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav">
                    <li><a href="index.php?id=<?php echo $_smarty_tpl->tpl_vars['id_usuario']->value;?>
">Home</a>
                    </li>
                    <li><a href="about.php?id=<?php echo $_smarty_tpl->tpl_vars['id_usuario']->value;?>
">Quem Somos</a>
                    </li>
                    <li><a href="blog.php?id=<?php echo $_smarty_tpl->tpl_vars['id_usuario']->value;?>
">Blog</a>
                    </li>
                    <li><a href="contact.php?id=<?php echo $_smarty_tpl->tpl_vars['id_usuario']->value;?>
">Fale Conosco</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <div class="container">
        <div class="row">
            <div class="box">
                <div class="col-lg-12">
                    <hr>
                    <h2 class="intro-text text-center"><strong><?php echo $_smarty_tpl->tpl_vars['nome_empresa_pagina']->value;?>
</strong>
                    </h2>
                    <hr>
                </div>

                <!-- Aqui fica as postagens -->
                <div class="col-lg-12 text-center" id="posts">

                </div>

                <div class="col-lg-12 text-center">
                    <!--ul class="pager">
                        <li class="previous"><a href="#">&larr; Anterior</a>
                        </li>
                        <li class="next"><a href="#">Proximo &rarr;</a>
                        </li>
                    </ul-->
                </div>
            </div>
        </div>

    </div>
    <!-- /.container -->

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <p>Copyright &copy; <?php echo $_smarty_tpl->tpl_vars['nome_empresa_pagina']->value;?>
 2013</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- JavaScript -->
    <script src="js/jquery-1.10.2.js"></script>
    <script src="js/bootstrap.js"></script>
    <script type="text/javascript" src="../assets/js/funcoes.js"></script>

</body>

</html>
<?php }} ?>
