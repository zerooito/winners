
  <!--Conteudo-->
  <div id="wrapper">

      <div id="page-wrapper">

        <div class="row" style="width: 100%; padding-left: 40px; padding-top:40px; padding-right: 40px; padding-bottom: 10px;">
            <h1>Paginas <small>Configure as pagina do seu site</small></h1>
            <ol class="breadcrumb">
              <li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
              <li class="active"><i class="fa fa-edit"></i> Paginas</li>
            </ol>
            <div class="alert alert-info alert-dismissable">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              Configure a pagina do seu site para exibir o conteudo que deseja !
            </div>
        </div><!-- /.row -->


        <div class="row" style="width: 100%; padding-left: 30px; padding-top:0px; padding-right: 40px;">
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
                    <input type="hidden" value="{$id_usuario}" name="id_usuario">
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
                      <input type="hidden" value="{$id_usuario}" name="id_usuario">
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
                    <input type="hidden" value="{$id_usuario}" name="id_usuario">
                    <br/>
                    <button type="button" class="btn btn-default" id="atualizar_dados_quem_somos">Atualizar dados</button>
                    <button class="btn btn-primary" data-toggle="modal" data-target="#modal_quem_somos">Atualizar Texto da Quem Somos</button>
                    <button type="button" class="btn btn-default">
                      <a href="foto_quem_somos.php"><span class="glyphicon glyphicon-picture"></span> + Fotos</a>
                    </button>
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
                          <br/>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <input type="hidden" value="{$id_usuario}" name="id_usuario">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-info" id="bt_texto_quem_somos">Salvar Alterações</button>
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
                    <input type="hidden" value="{$id_usuario}" name="id_usuario">
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
                    <input type="hidden" value="{$id_usuario}" name="id_usuario">
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