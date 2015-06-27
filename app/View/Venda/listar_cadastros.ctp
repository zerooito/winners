
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Venda - Listar Cadastros</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-9">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Listagem das vendas
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-cliente">
                            <thead>
                                <tr>
                                    <th>#ID</th>
                                    <th>Valor</th>
                                    <th>Data Venda</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach ($vendas as $indice => $venda) {
                            ?>
                                <tr class="odd gradeX" id="<?php echo $venda['Venda']['id'] ?>">
                                    <td><?php echo $venda['Venda']['id'] ?></td>
                                    <td><?php echo number_format($venda['Venda']['valor'], '2', ',', '.') ?></td>
                                    <td><?php echo receber_data($venda['Venda']['data_venda']) ?></td>
                                    <td class="center">
                                        <button onclick="remover_produto(<?php echo $venda['Venda']['id'] ?>);" type="button" class="btn btn-danger btn-circle"><i class="fa fa-times"></i></button>
                                        <!-- <button onclick="editar_produto(<?php echo $venda['Venda']['id'] ?>);" type="button" class="btn btn-info btn-circle"><i class="fa fa-edit"></i></button> -->
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

        <div class="col-lg-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Ações
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
    
                    <button type="button" class="btn btn-primary"><i class="fa fa-plus"><a href="/venda/adicionar_cadastro" style="color: #FFF;"> Adicionar venda</a></i></button>
                    
                    <!-- Split button -->
                    <div class="btn-group" style="margin-top: 10px;">
                      <button type="button" class="btn btn-info">Ações</button>
                      <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>
                      </button>
                      <ul class="dropdown-menu">
                        <li><a href="/venda/relatorio_diario">Exportar Relatorio Diário</a></li>
                      </ul>
                    </div>
    
                </div>
                <!-- /.panel-body -->

            </div>
            <!-- /.panel -->
        </div>
    </div>
</div>

<script type="text/javascript">
    function remover_venda(id) {
        $.ajax({
            type: "post",
            dataType: "json",
            url: "/venda/exlcluir_cadastro",
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
</script>
