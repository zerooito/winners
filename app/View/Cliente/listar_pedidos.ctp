
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Pedidos cliente <?php echo $cliente['Cliente']['nome1'] . ' ' . $cliente['Cliente']['nome2']; ?>
            </h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-9">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Listagem dos Clientes
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-cliente">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Valor</th>
                                    <th>Data Venda</th>
                                    <th>Pago</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>                   
                            <?php foreach ($vendas as $indice => $venda): ?>   
                                <tr class="odd gradeX" id="<?php echo $venda['Venda']['id'] ?>">
                                    <td class="center">
                                        <?php echo $venda['Venda']['id']; ?>
                                    </td>
                                    <td>
                                        <?php echo 'R$ ' . number_format($venda['Venda']['valor'], 2, ',', '.'); ?>
                                    </td>
                                    <td>
                                        <?php echo date('d/m/Y', strtotime($venda['Venda']['data_venda'])); ?>
                                    </td>
                                    <td>
                                        <?php if ($venda['LancamentoVenda']['valor_pago'] == $venda['LancamentoVenda']['valor']): ?>
                                            <b style="color:green;" id="paid-<?php echo $venda['Venda']['id'] ?>">Sim</b>
                                        <?php else: ?>
                                            <b style="color:red;" id="paid-<?php echo $venda['Venda']['id'] ?>">Não</b>
                                        <?php endif; ?>
                                    </td>
                                    <td class="center" id="button-cancel-<?php echo $venda['Venda']['id'] ?>">
                                        <?php if ($venda['LancamentoVenda']['valor_pago'] == $venda['LancamentoVenda']['valor']): ?>
                                            <a class="btn btn-danger btn-circle" title="Cancelar Pagamento" href="javascript:changePayment('<?php echo $venda['Venda']['id'] ?>', '<?php echo $cliente['Cliente']['id'] ?>', 'cancelar');">
                                                <i class="fa fa-reply" aria-hidden="true"></i>
                                            </a>
                                        <?php else: ?>
                                            <a class="btn btn-success btn-circle" title="Pagamento Realizado" href="javascript:changePayment('<?php echo $venda['Venda']['id'] ?>', '<?php echo $cliente['Cliente']['id'] ?>', 'aprovar');">
                                                <i class="fa fa-check" aria-hidden="true"></i>
                                            </a>
                                        <?php endif; ?>
                                        <?php if (isset($modulos['asaas'])): ?>
                                            <a class="btn btn-primary btn-circle" 
                                                <?php if (isset($venda['Venda']['asaas_boleto'])): ?>
                                                    href="<?php echo $venda['Venda']['asaas_boleto'] ?>"
                                                    target="_blank"
                                                <?php else: ?>
                                                    href="/cliente/emitir_boleto/<?php echo $venda['Venda']['id'] ?>"
                                                <?php endif; ?>
                                            >
                                                <?php if ($venda['Venda']['asaas_boleto']): ?>
                                                    <i class="fa fa-list"></i>
                                                <?php else: ?>
                                                    <i class="fa fa-university"></i>
                                                <?php endif; ?>
                                            </a>
                                        <?php endif; ?>
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
                    Gastos Cliente
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <h2>Pago</h2>
                    <input type="hidden" id="total" value="<?php echo $total; ?>">
                    <p id="total-texto"><?php echo 'R$ ' . number_format($total, 2, ',', '.'); ?></p>

                    <hr>

                    <h2>Devendo</h2>
                    <input type="hidden" id="devendo" value="<?php echo $devendo; ?>">
                    <p id="devendo-texto"><?php echo 'R$ ' . number_format($devendo, 2, ',', '.'); ?></p>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
    </div>
</div>

<script type="text/javascript">
    
    function changePayment(vendaId, clienteId, type){
        var vendaId = vendaId;
        var clienteId = clienteId;
        var type = type;

        swal({
            title: capitalizeFirstLetter(type) + ' pagamento?',
            text: "Tem certeza que deseja " + type + " o pagamento deste pedido?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sim',
            cancelButtonText: 'Não'
        }).then(function(){ 
            $.ajax({
                type: "get",
                dataType: "json",
                url: '/lancamento_vendas/' + type + '/' + vendaId + '/' + clienteId,
                async: true,
                success: function(data){
                    if (type == "cancelar") 
                        str = "Cancelado";

                    if (type == "aprovar")
                        str = "Aprovado";

                    swal(
                        str + '!',
                        'O pagamento do seu pedido foi ' + str + '.',
                        'success'
                    );      

                    window.location.reload();
                }
            });
        });
    }

    function capitalizeFirstLetter(string) {
        return string.charAt(0).toUpperCase() + string.slice(1);
    }
</script>