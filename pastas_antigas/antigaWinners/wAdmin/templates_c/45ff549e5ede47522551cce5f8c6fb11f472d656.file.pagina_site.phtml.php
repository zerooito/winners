<?php /* Smarty version Smarty-3.1.16, created on 2014-05-18 20:43:29
         compiled from "templates\pagina_site.phtml" */ ?>
<?php /*%%SmartyHeaderCode:48615365b7e9a661a9-16246258%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '45ff549e5ede47522551cce5f8c6fb11f472d656' => 
    array (
      0 => 'templates\\pagina_site.phtml',
      1 => 1400445784,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '48615365b7e9a661a9-16246258',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_5365b7e9b2ec55_07616798',
  'variables' => 
  array (
    'nome' => 0,
    'id_usuario' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5365b7e9b2ec55_07616798')) {function content_5365b7e9b2ec55_07616798($_smarty_tpl) {?><!DOCTYPE html>
<html lang="pt">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>WAdmin</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">

    <!-- Add custom CSS here -->
    <link href="assets/css/sb-admin.css" rel="stylesheet">
    <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
    <!-- Page Specific CSS -->
    <link rel="stylesheet" href="http://cdn.oesmith.co.uk/morris-0.4.3.min.css">

  </head>

  <body>

  <!--Conteudo-->
  <div id="wrapper">

      <!-- Sidebar -->
      <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.html">WAdmin - Site, Ead, Erp</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
          <ul class="nav navbar-nav side-nav">
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>

            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-caret-square-o-down"></i>WSite<b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="#">Cor de Fundo</a></li>
                <li><a href="#">Banner</a></li>
                <li class="active"><a href="pagina_site.php">Paginas</a></li>
                <li><a href="#">Logo</a></li>
                <li><a href="#">Description</a></li>
                <li><a href="#">Title</a></li>
              </ul>
            </li>
          </ul>

          <ul class="nav navbar-nav navbar-right navbar-user">
            <!--li class="dropdown messages-dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-envelope"></i> Mensagens <span class="badge">7</span> <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li class="dropdown-header">7 Novas mensagens</li>
                <li class="message-preview">
                  <a href="#">
                    <span class="avatar"><img src="http://placehold.it/50x50"></span>
                    <span class="name">John Smith:</span>
                    <span class="message">Hey there, I wanted to ask you something...</span>
                    <span class="time"><i class="fa fa-clock-o"></i> 4:34 PM</span>
                  </a>
                </li>
                <li class="divider"></li>
                <li class="message-preview">
                  <a href="#">
                    <span class="avatar"><img src="http://placehold.it/50x50"></span>
                    <span class="name">John Smith:</span>
                    <span class="message">Hey there, I wanted to ask you something...</span>
                    <span class="time"><i class="fa fa-clock-o"></i> 4:34 PM</span>
                  </a>
                </li>
                <li class="divider"></li>
                <li class="message-preview">
                  <a href="#">
                    <span class="avatar"><img src="http://placehold.it/50x50"></span>
                    <span class="name">John Smith:</span>
                    <span class="message">Hey there, I wanted to ask you something...</span>
                    <span class="time"><i class="fa fa-clock-o"></i> 4:34 PM</span>
                  </a>
                </li>
                <li class="divider"></li>
                <li><a href="#">Ver Inbox <span class="badge">7</span></a></li>
              </ul>
            </li-->
            <li class="dropdown user-dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $_smarty_tpl->tpl_vars['nome']->value;?>
 <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <!--li><a href="#"><i class="fa fa-user"></i> Perfil</a></li>
                <li><a href="#"><i class="fa fa-envelope"></i> Inbox <span class="badge">7</span></a></li-->
                <li><a href="#"><i class="fa fa-gear"></i> Configurações</a></li>
                <li class="divider"></li>
                <li><a href="index.php?acao=logout"><i class="fa fa-power-off"></i> Log Out</a></li>
              </ul>
            </li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </nav>

      <div id="page-wrapper">

        <div class="row">
          <div class="col-lg-12">
            <h1>Paginas <small>Configure as pagina do seu site</small></h1>
            <ol class="breadcrumb">
              <li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
              <li class="active"><i class="fa fa-edit"></i> Paginas</li>
            </ol>
            <div class="alert alert-info alert-dismissable">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              Configure a pagina do seu site para exibir o conteudo que deseja !
            </div>
          </div>
        </div><!-- /.row -->

        <div class="row">
          <div class="col-lg-6">

            <form role="form">

              <div class="panel panel-primary" id="home">
                <div class="panel-heading">
                  <h3 class="panel-title">Pagina Home</h3>
                </div>
                <div class="panel-body">

                  <div class="form-group">
                    <label>Title</label>
                    <input class="form-control" placeholder="Title que vai está nesta pagina" name="title_home">
                    <label>Description</label>
                    <input class="form-control" placeholder="Description que vai está nesta pagina" name="description_home">
                    <label>Keywords</label>
                    <input class="form-control" placeholder="Keywords que vai está nesta pagina" name="keywords_home">
                    <label>Nome da empresa</label>
                    <input class="form-control" placeholder="Nome da empresa que vai está nesta pagina" name="empresa_home">
                    <input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['id_usuario']->value;?>
" name="id_usuario">
                    <br/>
                    <button type="button" class="btn btn-default" id="atualizar_dados_home">Atualizar dados</button>
                    <button class="btn btn-primary" data-toggle="modal" data-target="#modal_home">Atualizar Texto da Home</button>
                  </div>

                </div>
              </div>

              <!-- Modal -->
              <div class="modal fade" id="modal_home" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                      <h4 class="modal-title" id="myModalLabel">Atualizar textos e fotos da home</h4>
                    </div>
                      <div class="modal-body">
                      <div id="texto_pagina_home">
                        <label>Titulo texto 1</label>
                        <input class="form-control" placeholder="Titulo texto 1" name="titulo_1">
                        <label>Texto 1</label>
                        <textarea class="form-control" rows="3" id="texto_1"></textarea>
                        <label for="exampleInputFile" name="foto_texto_1">Insira um arquivo</label>
                        <input type="file" id="foto_texto_1">
                        <br/>

                        <label>Titulo texto 2</label>
                        <input class="form-control" placeholder="Titulo texto 2" name="titulo_2">
                        <label>Texto 2</label>
                        <textarea class="form-control" rows="3" id="texto_2"></textarea>
                        <label for="exampleInputFile" name="foto_texto_2">Insira um arquivo</label>
                        <input type="file" id="foto_texto_2">

                        <br/>
                        <label>Cor Hexadecimal para o fundo da pagina</label>
                        <input type="color" class="form-control" placeholder="Cor Hexadecimal para o fundo da pagina" name="background_color">
                      </div>
                    </div>
                    <div class="modal-footer">
                      <input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['id_usuario']->value;?>
" name="id_usuario">
                      <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                      <button type="button" class="btn btn-info" id="texto_home">Salvar Alterações</button>
                    </div>
                  </div>
                </div>
              </div>


              <div class="panel panel-primary" id="quem_somos">
                <div class="panel-heading">
                  <h3 class="panel-title">Pagina Quem Somos</h3>
                </div>
                <div class="panel-body">

                  <div class="form-group">
                    <label>Title</label>
                    <input class="form-control" placeholder="Title que vai está nesta pagina" name="title_quem_somos">
                    <label>Description</label>
                    <input class="form-control" placeholder="Description que vai está nesta pagina" name="description_quem_somos">
                    <label>Keywords</label>
                    <input class="form-control" placeholder="Keywords que vai está nesta pagina" name="keywords_quem_somos">
                    <label>Nome da empresa</label>
                    <input class="form-control" placeholder="Nome da empresa que vai está nesta pagina" name="empresa_quem_somos">
                    <input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['id_usuario']->value;?>
" name="id_usuario">
                    <br/>
                    <button type="button" class="btn btn-default" id="atualizar_dados_quem_somos">Atualizar dados</button>
                    <button class="btn btn-primary" data-toggle="modal" data-target="#modal_quem_somos">Atualizar Texto da Quem Somos</button>
                  </div>

                </div>

          
                <div class="modal fade" id="modal_quem_somos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Atualizar textos e fotos da pagina Quem Somos</h4>
                      </div>
                        <div class="modal-body">
                        <div id="texto_pagina_home">
                          <label>Titulo texto 1</label>
                          <input class="form-control" placeholder="Titulo texto 1" name="titulo_quem_somos">
                          <label>Texto 1</label>
                          <textarea class="form-control" rows="3" id="texto_quem_somos"></textarea>
                          <label for="exampleInputFile" name="foto_texto_1">Insira um arquivo</label>
                          <input type="file" id="foto_texto_1">
                          <br/>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['id_usuario']->value;?>
" name="id_usuario">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-info" id="texto_quem_somos">Salvar Alterações</button>
                      </div>
                    </div>
                  </div>
                </div><!-- modal -->
              </div><!--panel-->
            </form>
        </div><!-- /.row -->

        <div class="row">
          <div class="col-lg-6">

            <form role="form">

              <div class="panel panel-primary" id="blog">
                <div class="panel-heading">
                  <h3 class="panel-title">Pagina Blog</h3>
                </div>
                <div class="panel-body">

                  <div class="form-group">
                    <label>Title</label>
                    <input class="form-control" placeholder="Title que vai está nesta pagina" name="title_blog">
                    <label>Description</label>
                    <input class="form-control" placeholder="Description que vai está nesta pagina" name="description_blog">
                    <label>Keywords</label>
                    <input class="form-control" placeholder="Keywords que vai está nesta pagina" name="keywords_blog">
                    <label>Nome da empresa</label>
                    <input class="form-control" placeholder="Nome da empresa que vai está nesta pagina" name="empresa_blog">
                    <input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['id_usuario']->value;?>
" name="id_usuario">
                    <br/>
                    <button type="button" class="btn btn-primary" id="atualizar_dados_blog">Atualizar dados</button>
                  </div>

                </div>
              </div>
              <div class="panel panel-primary" id="contato">
                <div class="panel-heading">
                  <h3 class="panel-title">Pagina Contato</h3>
                </div>
                <div class="panel-body">

                  <div class="form-group">
                    <label>Title</label>
                    <input class="form-control" placeholder="Title que vai está nesta pagina" name="title_contato">
                    <label>Description</label>
                    <input class="form-control" placeholder="Description que vai está nesta pagina" name="description_contato">
                    <label>Keywords</label>
                    <input class="form-control" placeholder="Keywords que vai está nesta pagina" name="keywords_contato">
                    <label>Nome da empresa</label>
                    <input class="form-control" placeholder="Nome da empresa que vai está nesta pagina" name="empresa_contato">
                    <input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['id_usuario']->value;?>
" name="id_usuario">
                    <br/>
                    <button type="button" class="btn btn-primary" id="atualizar_dados_contato">Atualizar dados</button>
                  </div>

                </div>
              </div>

            </form>
        </div><!-- /.row -->

      </div><!-- /#page-wrapper -->

    </div><!-- /#wrapper -->
  <!--Fim conteudo-->

  <!-- JavaScript -->
  <script src="assets/js/jquery-1.10.2.js"></script>
  <script src="assets/js/bootstrap.js"></script>
  <!-- Page Specific Plugins -->
  <script src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
  <script src="http://cdn.oesmith.co.uk/morris-0.4.3.min.js"></script>
  <script src="assets/js/morris/chart-data-morris.js"></script>
  <script src="assets/js/tablesorter/jquery.tablesorter.js"></script>
  <script src="assets/js/tablesorter/tables.js"></script>
  <script src="../assets/js/funcoes.js"></script>

  </body>
</html>
<?php }} ?>
