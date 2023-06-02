<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Vendas - <?php echo $funcionario['Usuario']['nome'] ?></h1>
    </div>

    <!-- /.row -->
    <div class="row">
        <div class="col-lg-9">
            <div class="panel panel-default">
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-funcionarios">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Valor</th>
                                    <th>Data Venda</th>
                                </tr>
                            </thead>
                            <tbody>                   
                            <?php foreach ($vendas as $indice => $venda): ?>   
                                <tr class="odd gradeX" id="<?php echo $venda['Venda']['id'] ?>">
                                    <td class="center">
                                        #<?php echo $venda['Venda']['id']; ?>
                                    </td>
                                    <td>
                                        <?php echo 'R$ ' . number_format($venda['Venda']['valor'], 2, ',', '.'); ?>
                                    </td>
                                    <td>
                                        <?php echo date('d/m/Y', strtotime($venda['Venda']['data_venda'])); ?>
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

        <div class="col-lg-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Ações
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <?php if (isset($ultimo_pagamento) && !empty($ultimo_pagamento)): ?>
                        <hr>
                        <b>Último pagamento:</b> <?php echo date('d/m/Y', strtotime(@$ultimo_pagamento[0]['PagamentoFuncionario']['data'])); ?>
                        <a href="/funcionario/pdf/<?php echo $ultimo_pagamento[0]['PagamentoFuncionario']['id'] ?>?nome=<?php echo $funcionario['Usuario']['nome'] ?>" class="pull-right btn btn-success"><i class="fa fa-arrow-down"></i> Extrato Pagamento</a>
                    <?php endif; ?>
                    <hr>

                    <p>De: </p>

                    <input type="date" id="from" class="col-lg-12" style="margin-bottom: 10px;">

                    <p>Até: </p>

                    <input type="date" id="to" class="col-lg-12" style="margin-bottom: 10px;">

                    <a href="javascript:;" onclick="calcularPagamento(<?php echo $funcionario['Funcionario']['id'] ?>)" class="pull-right btn btn-primary"><i class="fa fa-plus"></i> Gerar Pagamento</a>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
    </div>
</div>


<div class="modal fade" id="showModalGerarPagamento" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <form action="/funcionario/gerar_pagamento" method="POST">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Gerar Pagamento</h4>
        </div>
        <div class="modal-body text-center">
            <div class="row">
                <div class="col-lg-12">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nome">Total Vendas</label>
                            <input type="text" class="moeda form-control" id="total-vendas" name="dados[total_vendas]" disabled="disabled" />
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nome">Total Comissão</label>
                            <input type="text" class="moeda form-control" id="total-comissao" name="dados[total_comissao]" disabled="disabled" />
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nome">Salário</label>
                            <input type="text" class="moeda form-control" id="total-salario" name="dados[total_salario]" disabled="disabled" />
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nome">Total a Pagar</label>
                            <input type="text" class="moeda form-control" id="total-a-pagar" name="dados[total_pago]" disabled="disabled" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
            <div class="modal-footer">
                <a class="btn btn-success" href="javascript:;" onClick="gerarPagamento();">Confirmar</a>
                <a class="btn btn-danger text-white" class="close" data-dismiss="modal" aria-label="Close">Cancelar</a>
            </div>
        </div>
    </div>
    </form>
</div>

<script type="text/javascript">

    var dadosPagamento = {}
    
    function calcularPagamento(funcionarioId) {
        var from = $('#from').val();
        var to = $('#to').val();

        $.ajax({
            url: '/funcionario/calcular_pagamento',
            dataType: 'json',
            method: "POST",
            data: {
                dados: {
                    from: from,
                    to: to,
                    funcionario_id: funcionarioId
                }
            },
            success: function(data) {
                dadosPagamento = data;
                $('#total-vendas').val(number_format(data['total_vendas'], 2));
                $('#total-a-pagar').val(number_format(data['total_pago'], 2));
                $('#total-salario').val(number_format(data['salario'], 2));
                $('#total-comissao').val(number_format(data['comissao'], 2));
            }
        });

        $('#showModalGerarPagamento').modal('show');
    }

    function gerarPagamento()
    {
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
                url: "/funcionario/gerar_pagamento_funcionario",
                data: { dados: dadosPagamento },
                success: function(x){
                    swal(
                        'Feito!',
                        'Pagamento Gerado Com Sucesso.',
                        'success'
                    );

                    $('#showModalGerarPagamento').modal('hide');
                }
            });
        });
    }

    function capitalizeFirstLetter(string) {
        return string.charAt(0).toUpperCase() + string.slice(1);
    }
</script>