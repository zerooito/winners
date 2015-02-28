<?php /* Smarty version Smarty-3.1.16, created on 2014-05-04 18:08:38
         compiled from "templates\about.phtml" */ ?>
<?php /*%%SmartyHeaderCode:140695361bcae9220a2-93267440%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c6a4ad5749d78761fc796c3a9e44ef0ecfe646a3' => 
    array (
      0 => 'templates\\about.phtml',
      1 => 1399158478,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '140695361bcae9220a2-93267440',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_5361bcaf00f3b8_25946992',
  'variables' => 
  array (
    'description_pagina' => 0,
    'title_pagina' => 0,
    'estilophp' => 0,
    'nome_empresa_pagina' => 0,
    'bairro' => 0,
    'rua' => 0,
    'cidade' => 0,
    'estado' => 0,
    'telefone' => 0,
    'id_usuario' => 0,
    'titulo_texto_1' => 0,
    'texto1' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5361bcaf00f3b8_25946992')) {function content_5361bcaf00f3b8_25946992($_smarty_tpl) {?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo $_smarty_tpl->tpl_vars['description_pagina']->value;?>
">
    <meta name="author" content="Reginaldo Luis de Luna Junior">

    <title><?php echo $_smarty_tpl->tpl_vars['title_pagina']->value;?>
</title>

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
                    <h2 class="intro-text text-center"><strong><?php echo $_smarty_tpl->tpl_vars['titulo_texto_1']->value;?>
</strong>
                    </h2>
                    <hr>
                </div>
                <div class="col-md-6">
                    <img class="img-responsive img-border-left" src="img/slide-2.jpg" alt="">
                </div>
                <div class="col-md-6">
                    <p><?php echo $_smarty_tpl->tpl_vars['texto1']->value;?>
.</p>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>

        <div class="row">
            <div class="box">
                <div class="col-lg-12">
                    <hr>
                    <h2 class="intro-text text-center">Sua<strong> Equipe</strong>
                    </h2>
                    <hr>
                </div>
                <div class="col-sm-4 text-center">
                    <img class="img-responsive" src="http://placehold.it/750x450" alt="">
                    <h3>John Smith
                        <small>Job Title</small>
                    </h3>
                </div>
                <div class="col-sm-4 text-center">
                    <img class="img-responsive" src="http://placehold.it/750x450" alt="">
                    <h3>John Smith
                        <small>Job Title</small>
                    </h3>
                </div>
                <div class="col-sm-4 text-center">
                    <img class="img-responsive" src="http://placehold.it/750x450" alt="">
                    <h3>John Smith
                        <small>Job Title</small>
                    </h3>
                </div>
                <div class="clearfix"></div>
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
    
</body>

</html>
<?php }} ?>
