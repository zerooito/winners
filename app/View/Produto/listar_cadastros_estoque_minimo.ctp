
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Produtos - Estoque minimo</h1>
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
                        <?php if ($this->Permissoes->usuario_possui_permissao_para('produto', 'read')): ?>
                            <a href="/produto/baixar_estoque_minimo_pdf" class="btn btn-primary" target="_blank" style="color: #FFF; margin-bottom: 10px; width:100%;"><i class="fa fa-file-pdf-o"></i> Baixar como PDF</a>
                        <?php else: ?>
                            <b>Sem acesso</b>
                        <?php endif; ?>
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
    
    function imgError(image) {
        image.onerror = "";
        image.src = "/images/no_image.png";
        return true;
    }
</script>
