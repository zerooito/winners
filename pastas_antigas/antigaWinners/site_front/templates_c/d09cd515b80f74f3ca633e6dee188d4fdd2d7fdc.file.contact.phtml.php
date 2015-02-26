<?php /* Smarty version Smarty-3.1.16, created on 2014-05-04 16:22:26
         compiled from "templates\contact.phtml" */ ?>
<?php /*%%SmartyHeaderCode:555853653d43ac1202-65561117%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd09cd515b80f74f3ca633e6dee188d4fdd2d7fdc' => 
    array (
      0 => 'templates\\contact.phtml',
      1 => 1399158465,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '555853653d43ac1202-65561117',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_53653d43d963f5_70018755',
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
    'latitude' => 0,
    'longitude' => 0,
    'email' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53653d43d963f5_70018755')) {function content_53653d43d963f5_70018755($_smarty_tpl) {?><!DOCTYPE html>
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
                <div class="col-lg-12">
                    <hr>
                    <h2 class="intro-text text-center">Localidade <strong><?php echo $_smarty_tpl->tpl_vars['nome_empresa_pagina']->value;?>
</strong>
                    </h2>
                    <hr>
                </div>
                <div class="col-md-8">
                    <!-- Embedded Google Map using an iframe - to select your location find it on Google maps and paste the link as the iframe src. If you want to use the Google Maps API instead then have at it! -->
                    <iframe width="100%" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com/maps?hl=en&amp;ie=UTF8&amp;ll=<?php echo $_smarty_tpl->tpl_vars['latitude']->value;?>
,<?php echo $_smarty_tpl->tpl_vars['longitude']->value;?>
&amp;spn=56.506174,79.013672&amp;t=m&amp;z=4&amp;output=embed"></iframe>
                </div>
                <div class="col-md-4">
                    <p>Telefone: <strong><?php echo $_smarty_tpl->tpl_vars['telefone']->value;?>
</strong>
                    </p>
                    <p>Email: <strong><?php echo $_smarty_tpl->tpl_vars['email']->value;?>
</strong>
                    </p>
                    <p>Endereço: <strong><?php echo $_smarty_tpl->tpl_vars['bairro']->value;?>
 <br><?php echo $_smarty_tpl->tpl_vars['rua']->value;?>
.<br><?php echo $_smarty_tpl->tpl_vars['cidade']->value;?>
, <?php echo $_smarty_tpl->tpl_vars['estado']->value;?>
</strong>
                    </p>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>

        <div class="row">
            <div class="box">
                <div class="col-lg-12">
                    <hr>
                    <h2 class="intro-text text-center">Formulario de <strong>Contato</strong>
                    </h2>
                    <hr>
                    
                        <div class="row">
                            <div class="form-group col-lg-4">
                                <label>Nome</label>
                                <input type="text" class="form-control" name="nome">
                            </div>
                            <div class="form-group col-lg-4">
                                <label>Email</label>
                                <input type="email" class="form-control" name="email_remetente">
                            </div>
                            <div class="form-group col-lg-4">
                                <label>Telefone</label>
                                <input type="tel" class="form-control" name="telefone">
                            </div>
                            <div class="clearfix"></div>
                            <div class="form-group col-lg-12">
                                <label>Mensagem</label>
                                <textarea class="form-control" rows="6" id="mensagem"></textarea>
                            </div>
                            <div class="form-group col-lg-12">
                                <input type="hidden" name="email_destinario" value="<?php echo $_smarty_tpl->tpl_vars['email']->value;?>
">
                                <button type="submit" class="btn btn-default" id="enviar_email">Enviar</button>
                            </div>
                        </div>
                    
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
