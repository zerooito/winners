
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?php echo $produto['Produto']['nome'] ?> - Custos Adicionais</h1>
    </div>

    <!-- /.row -->
    <div class="row">
        <div class="col-lg-9">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Listagem dos custos
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-produtos">
                            <thead>
                                <tr>
                                    <th>SKU</th>
                                    <th>Valor</th>
                                    <th>Descrição</th>
                                    <th>Data</th>
                                    <th>Ação</th>
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
                            <a href="javascript:;" class="addCusto btn btn-primary" style="color: #FFF; margin-bottom: 10px; width:100%;"><i class="fa fa-plus"></i> Adicionar Custo</a>
                        <?php else: ?>
                            <b>Sem acesso</b>
                        <?php endif; ?>
                    </div>

                </div>
            </div>
        </div>
        <!-- /.col-lg-12 -->
    </div>

    <!-- Modal -->
    <div class="modal fade" id="addCusto" role="dialog" aria-labelledby="myModalLabel">
        <form class="form" action="/produto/adicionar_custo/<?php echo $produto['Produto']['id'] ?>" method="POST">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel">Adicionar Custo</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nome">Descrição:</label>
                            <input type="text" class="form-control" id="descricao" name="custo[descricao]">
                        </div>
                        <div class="form-group">
                            <label for="nome">Valor:</label>
                            <input type="text" class="moeda form-control" id="valor" name="custo[valor]">
                        </div>
                        <div class="form-group">
                            <label for="nome">Data:</label>
                            <input type="date" class="form-control" id="data" name="custo[data]">
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
</div>

<script type="text/javascript">
    
    $(document).ready(function(){
        
        datatable = $('#dataTables-produtos').dataTable({
            "bServerSide": true,
            "iDisplayStart": 0,
            "sAjaxDataProp": "data",
            "aaSorting": [[ 1, "desc" ]],
            "sAjaxSource": "/produto/listar_custos_adicionais/<?php echo $produto['Produto']['id'] ?>"
        });

        $('.addCusto').click(function() { 
            $('#addCusto').modal('show');
        });

    });

    function removerCusto(id) {
        var idGlobal = id;
    
        swal({
          title: 'Você tem certeza?',
          text: "Somente confirme se você tiver certeza desta ação!",
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Sim!',
          cancelButtonText: 'Não.'
        }).then(function(){ 
            $.ajax({
                type: "post",
                dataType: "json",
                url: "/produto/remover_custo/" + id,
                async: true,
                success: function(data){
                    swal(
                        'Deletado!',
                        'Seu registro foi deletado do sistema.',
                        'success'
                    );

                    window.location.reload();            
                }
            });
        });
    }
    
    function imgError(image) {
        image.onerror = "";
        image.src = "/images/no_image.png";
        return true;
    }
</script>
