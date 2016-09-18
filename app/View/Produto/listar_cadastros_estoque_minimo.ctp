
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Produto - Listar Cadastros Estoque Minimo</h1>
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

        <div class="col-lg-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Ações
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">

                    <div class="row" style="padding-left:10px;padding-right:10px;">
                        <button type="button" class="btn btn-primary" style="margin-bottom: 10px; width:100%;"><i class="fa fa-file-pdf-o"><a href="/produto/baixar_estoque_minimo_pdf" style="color: #FFF;"> Baixar como PDF</a></i></button>
                    </div>

                </div>
            </div>
        </div>
        <!-- /.col-lg-12 -->
    </div>
</div>

<script type="text/javascript">
    
    $(document).ready(function(){
        
        datatable = $('#dataTables-produtos').dataTable({
            "bServerSide": true,
            "iDisplayStart": 0,
            "sAjaxDataProp": "data",
            "aaSorting": [[ 1, "desc" ]],
            "sAjaxSource": "/produto/listar_cadastros_estoque_minimo_ajax"
        });

    });

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
