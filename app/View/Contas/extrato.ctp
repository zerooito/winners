
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Extrato - <?php echo $extrato_contas[0]['Contas']['nome'] ?></h1>
    </div>

    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-extrato">
                            <thead>
                                <tr>
                                    <th>Conta</th>
                                    <th>Valor</th>
                                    <th>Descrição</th>
                                </tr>
                            </thead>
                            <tbody>                   
                            <?php if (!$this->Permissoes->usuario_possui_permissao_para('financeiro', 'read')): ?>
                                <tr>
                                    <td>Você não possui permissão para visualizar extrato da conta.</td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($extrato_contas as $indice => $extrato): ?>             
                                    <tr class="odd gradeX">
                                        <td>
                                            <?php echo $extrato['Contas']['nome'] ?>
                                        </td>
                                        <td>
                                            R$ <?php echo number_format($extrato['ExtratoContas']['valor'], 2, ',', '.') ?>
                                        </td>
                                        <td>
                                            <?php echo $extrato['ExtratoContas']['descricao'] ?>
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
