<?php /* Smarty version Smarty-3.1.16, created on 2014-05-03 23:20:04
         compiled from "templates\index.phtml" */ ?>
<?php /*%%SmartyHeaderCode:234452d5674802c2a2-29489730%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1f07560281418c212564496accb7681386c7b59f' => 
    array (
      0 => 'templates\\index.phtml',
      1 => 1399158459,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '234452d5674802c2a2-29489730',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_52d5674810eee0_62102266',
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
    'titulo_texto_2' => 0,
    'texto2' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52d5674810eee0_62102266')) {function content_52d5674810eee0_62102266($_smarty_tpl) {?>
<!DOCTYPE html>
<html lang="pt">

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
                <div class="col-lg-12 text-center">
                    <div id="carousel-example-generic" class="carousel slide">
                        <!-- Indicators -->
                        <ol class="carousel-indicators hidden-xs">
                            <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                            <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                            <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                        </ol>

                        <!-- Wrapper for slides -->
                        <div class="carousel-inner">
                            <div class="item active">
                                <img class="img-responsive img-full" src="img/slide-1.jpg" alt="">
                            </div>
                            <div class="item">
                                <img class="img-responsive img-full" src="img/slide-2.jpg" alt="">
                            </div>
                            <div class="item">
                                <img class="img-responsive img-full" src="img/slide-3.jpg" alt="">
                            </div>
                        </div>

                        <!-- Controls -->
                        <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                            <span class="icon-prev"></span>
                        </a>
                        <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                            <span class="icon-next"></span>
                        </a>
                    </div>
                    <h2>
                        <small>Bem vindo ao</small>
                    </h2>
                    <h1>
                        <span class="brand-name"><?php echo $_smarty_tpl->tpl_vars['nome_empresa_pagina']->value;?>
</span>
                    </h1>
                    <hr class="tagline-divider">
                    <h2>
                        <small>By <strong>Winners Desenvolvimento</strong></small>
                    </h2>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="box">
                <div class="col-lg-12">
                    <hr>
                    <h2 class="intro-text text-center"><strong><?php echo $_smarty_tpl->tpl_vars['titulo_texto_1']->value;?>
</strong>
                    </h2>
                    <hr>
                    <img class="img-responsive img-border img-left" src="img/intro-pic.jpg" alt="">
                    <hr class="visible-xs">
                    <p><?php echo $_smarty_tpl->tpl_vars['texto1']->value;?>
.</p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="box">
                <div class="col-lg-12">
                    <hr>
                    <h2 class="intro-text text-center"><strong><?php echo $_smarty_tpl->tpl_vars['titulo_texto_2']->value;?>
</strong>
                    </h2>
                    <hr>
                    <p><?php echo $_smarty_tpl->tpl_vars['texto2']->value;?>
.</p>
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
    <script>
    // Activates the Carousel
    $('.carousel').carousel({
        interval: 5000
    })
    </script>

</body>

</html>
<?php }} ?>
