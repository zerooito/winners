
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Orçamentos - Listar Cadastros</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Listagem dos Orçamentos
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-cliente">
                            <thead>
                                <tr>
                                    <th>#ID</th>
                                    <th>Cliente</th>
                                    <th>Valor</th>
                                    <th>Data Cadastro</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach ($vendas as $indice => $venda) {
                            ?>
                                <tr class="odd gradeX" id="<?php echo $venda['Venda']['id'] ?>">
                                    <td><?php echo $venda['Venda']['id'] ?></td>
                                    <td></td>
                                    <td><?php echo number_format($venda['Venda']['valor'], '2', ',', '.') ?></td>
                                    <td><?php echo receber_data($venda['Venda']['data_venda']) ?></td>
                                    <td class="center">
                                        <button onclick="remover_venda(<?php echo $venda['Venda']['id'] ?>);" type="button" class="btn btn-danger btn-circle"><i class="fa fa-times"></i></button>

                                        <a target="_blank" href="/orcamento/pdf/<?php echo $venda['Venda']['id'] ?>" class="btn btn-primary btn-circle">
                                            <i class="fa fa-file-pdf-o"></i>
                                        </a>

                                        <a target="_blank" href="/venda/conveter_venda/<?php echo $venda['Venda']['id'] ?>" class="btn btn-info btn-circle">
                                            <i class="fa fa-reply"></i> 
                                        </button> 
                                    </td>
                                </tr>
                            <?php
                            }// fim foreach
                            ?>
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
    </div>
</div>

<script type="text/javascript">
    
    function remover_venda(id) {
        $.ajax({
            type: "get",
            dataType: "json",
            url: "/orcamento/excluir_cadastro/" + id,
            async: true,
            error: function(x){
                window.location.reload();
            },
            success: function(x){
                window.location.reload();
            }
        });
    }

</script>
