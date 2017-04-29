
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Produto - Listar Cadastros</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-9">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Listagem dos produtos
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-produtos">
                            <thead>
                                <tr>
                                    <th>SKU</th>
                                    <th>Imagem</th>
                                    <th>Nome</th>
                                    <th>Preço</th>
                                    <th>Estoque</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>   

                            </tbody>
                        </table>
                    </div>
                    <!-- /.table-responsive -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->

        <div class="col-lg-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Ações
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">

                        <div class="row" style="padding-left:10px;padding-right:10px;">
                            <button type="button" class="btn btn-primary" style="margin-bottom: 10px; width:100%;"><i class="fa fa-plus"><a href="/produto/adicionar_cadastro" style="color: #FFF;"> Adicionar produto</a></i></button>
                        </div>

                        <div class="row" style="padding-left:10px;padding-right:10px;">
                            <button type="button" class="btn btn-primary" style="margin-bottom: 10px; width:100%;"><i class="fa fa-plus"><a href="/categoria/listar_cadastros" style="color: #FFF;"> Categorias</a></i></button>
                        </div>

                        <div class="row" style="padding-left:10px;padding-right:10px;">
                            <button type="button" class="btn btn-info" style="margin-bottom: 10px; width:100%;"><i class="fa fa-file-excel-o"><a href="/produtos/exportar_excel_exemplo" style="color: #FFF;"> Exportar Excel Exemplo</a></i></button>
                        </div>

                        <div class="row" style="padding-left:10px;padding-right:10px;">
                            <button  data-toggle="modal" data-target="#importarProdutos" type="button" class="btn btn-info" style="margin-bottom: 10px; width:100%;"><i class="fa fa-upload"><a style="color: #FFF;"> Importar Produtos</a></i></button>
                        </div>

                        <div class="row" style="padding-left:10px;padding-right:10px;">
                            <button type="button" class="btn btn-warning" style="margin-bottom: 10px; width:100%;"><i class="fa fa-warning"><a href="/produto/listar_cadastros_estoque_minimo" style="color: #FFF;"> Produtos com Estoque Minimo</a></i></button>
                        </div>

                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
    </div>
</div>

<div class="modal fade" id="importarProdutos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

    <form method="POST" enctype="multipart/form-data" action="/produto/importar_produtos_planilha">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Importar Produtos</h4>
          </div>
          <div class="modal-body">
            <p>Escolha o arquivo que deseja enviar.</p>
            <input type="file" name="arquivo">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary">Importar</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </form>
</div><!-- /.modal -->

<script type="text/javascript">
    
    $(document).ready(function(){
        
        datatable = $('#dataTables-produtos').dataTable({
            "bServerSide": true,
            "iDisplayStart": 0,
            "sAjaxDataProp": "data",
            "aaSorting": [[ 1, "desc" ]],
            "sAjaxSource": "/produto/listar_cadastros_ajax"
        });

    });

    function fnCallback() {
        console.log('oi');
    }

    function remover_produto(id) {
        $.ajax({
            type: "post",
            dataType: "json",
            url: "/produto/excluir_cadastro",
            async: true,
            data: {id: id},
            error: function(x){
                window.reload();
            },
            success: function(x){
                window.location.reload();                
            }
        });
    }

    function editar_produto(id) {
        window.location.href = "/produto/editar_cadastro/"+id;
    }
    
    function visualizar_cadastro(id) {
        window.location.href = "/produto/visualizar_cadastro/"+id;
    }
    
    function imgError(image) {
        image.onerror = "";
        image.src = "/images/no_image.png";
        return true;
    }

</script>
