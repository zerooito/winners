
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Orçamentos - Listar Cadastros</h1>
    </div>

    <!-- Content Row -->
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
                                    <th>ID</th>
                                    <th>Cliente</th>
                                    <th>Valor</th>
                                    <th>Data Cadastro</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php if (!$this->Permissoes->usuario_possui_permissao_para('orcamento', 'read')): ?>
                                <tr>
                                    <td colspan="5">
                                        Você não possui permissão para visualizar orçamentos.
                                    </td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($vendas as $indice => $venda): ?>
                                    <tr class="odd gradeX" id="<?php echo $venda['Venda']['id'] ?>">
                                        <td><?php echo $venda['Venda']['id'] ?></td>
                                        <td>
                                            <?php if (isset($venda['Cliente']['nome1']) && !empty($venda['Cliente']['nome2'])): ?>
                                                <?php echo $venda['Cliente']['nome1'] . ' ' . $venda['Cliente']['nome2']; ?>
                                            <?php else: ?>
                                                N/C
                                            <?php endif ?>
                                        </td>
                                        <td><?php echo number_format($venda['Venda']['valor'], '2', ',', '.') ?></td>
                                        <td><?php echo receber_data($venda['Venda']['data_venda']) ?></td>
                                        <td class="center">
                                            <?php if ($this->Permissoes->usuario_possui_permissao_para('orcamento', 'write')): ?>
                                                <a target="_blank" href="/venda/conveter_venda/<?php echo $venda['Venda']['id'] ?>" class="btn btn-info" style="margin-right: 5px;">
                                                    <i class="fa fa-reply"></i> 
                                                </button>
                                            <?php endif; ?>
                                            
                                            <?php if ($this->Permissoes->usuario_possui_permissao_para('orcamento', 'read')): ?>
                                                <a target="_blank" href="/orcamento/pdf/<?php echo $venda['Venda']['id'] ?>" class="btn btn-primary">
                                                    <i class="fas fa-file-pdf"></i>
                                                </a>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
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
