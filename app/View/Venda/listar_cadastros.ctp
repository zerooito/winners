
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
                                    <th>Forma de Pagamento</th>
                                    <th>Data Venda</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($vendas as $i => $venda): ?>
                                <tr class="odd gradeX" id="<?php echo $venda['Venda']['id'] ?>">
                                    <td><?php echo $venda['Venda']['id'] ?></td>
                                    <td><?php echo number_format($venda['Venda']['valor'], '2', ',', '.') ?></td>

                                    <?php if (isset($venda['Lancamento']['forma_pagamento'])): ?>
                                        <td><?php echo strtoupper($venda['Lancamento']['forma_pagamento']) ?></td>
                                    <?php else: ?>
                                        <td>Não informado</td>
                                    <?php endif; ?>

                                    <td><?php echo receber_data($venda['Venda']['data_venda']) ?></td>

                                    <td class="center">
                                        <button onclick="remover_venda(<?php echo $venda['Venda']['id'] ?>);" type="button" class="btn btn-danger"><i class="fa fa-times"></i></button>

                                        <a href="javascript:printNotaNaoFiscal(<?php echo $venda['Venda']['id'] ?>);" target="_blank" class="btn btn-info">
                                            <i class="fa fa-file-text" aria-hidden="true"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
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
    
                    <button type="button" class="btn btn-primary" style="margin-bottom: 10px; width:100%;">
                        <i class="fa fa-plus">
                            <a href="/venda/adicionar_cadastro" style="color: #FFF;"> 
                                Adicionar venda
                            </a>
                        </i>
                    </button>

                    <button type="button" class="btn btn-info" style="margin-bottom: 10px; width:100%;">
                        <i class="fa fa-eye">
                            <a href="/venda/relatorio_diario" style="color: #FFF;"> 
                                Relatorio do dia atual
                            </a>
                        </i>
                    </button>
                    
                </div>
                <!-- /.panel-body -->

            </div>
            <!-- /.panel -->
        </div>
    </div>
</div>

<iframe id="textfile" src=""></iframe>

<script type="text/javascript">
    function remover_venda(id) {
        $.ajax({
            type: "post",
            dataType: "json",
            url: "/venda/excluir_cadastro",
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

    function printNotaNaoFiscal(id) {
        $.ajax({
            type: "get",
            dataType: "json",
            url: "/venda/imprimir_nota_nao_fiscal/" + id,
            error: function(data){
                alert('Ocorreu um erro.');
                console.log(data);
            },
            success: function(data){
                $('#textfile').attr('src', '/impressao_fiscal/exibir?arquivo=' + data['file']);
                var iframe = document.getElementById('textfile');
                iframe.contentWindow.print();
            }
        });
    }

    function editar_produto(id) {
        window.location.href = "/produto/editar_cadastro/"+id;
    }

</script>
