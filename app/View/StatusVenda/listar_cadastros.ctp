
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Status Vendas - Listar Cadastros</h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-lg-9">
            <div class="panel panel-default">
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-status-venda">
                            <thead>
                                <tr>
                                    <th>#ID</th>
                                    <th>Status</th>
                                    <th>Color</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
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
                    <?php if ($this->Permissoes->usuario_possui_permissao_para('venda', 'write')): ?>
                    <a href="javascript:;" class="add-status btn btn-primary" 
                        style="margin-bottom: 10px; width:100%;color: #FFF;"
                    > 
                        <i class="fa fa-plus"></i>
                        Adicionar Status
                    </a>
                    <?php endif; ?>
                </div>
                <!-- /.panel-body -->

            </div>
            <!-- /.panel -->
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="addStatus" role="dialog" aria-labelledby="myModalLabel">
    <form class="form" action="/status_venda/adicionar_cadastro" method="POST">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Adicionar Status</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="date">Status:</label>
                        <input type="text" class="form-control" id="status" name="status[text]">
                    </div>
                    <div class="form-group">
                        <label for="date">Cor:</label>
                        <input type="color" class="form-control" id="color" name="status[color]">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Salvar</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </form>
</div>

<script type="text/javascript">
    var url;
    
    $(document).ready(function(){
        var datatable = $('#dataTables-status-venda').dataTable({
            "bServerSide": true,
            "iDisplayStart": 0,
            "sAjaxDataProp": "data",
            "aaSorting": [[ 0, "desc" ]],
            "sAjaxSource": "/status_venda/listar_cadastros_ajax"
        });

        $('.add-status').click(function() { 
            $('#addStatus').modal('show');
        });
    });
</script>
