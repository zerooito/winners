
<div id="page-wrapper">
    <div class="row" style="margin:10px;">
        <div class="col-lg-12 pull-right" style="text-align: right;margin-bottom: 5px;">
            <a href="#" class="btn btn-info imprimir">Preparar impressão</a>
            <a href="#" style="display: none;" class="btn btn-success" id="download-txt-sale" download>Imprimir</a>
        </div>
        <div class="col-lg-3">  
            <div class="text-right">
                <div class="card text-center h-100 bg-secondary text-white shadow" style="padding:15px;">
                    <div class="card-block">
                        <h2>
                            <i class="far fa-money-bill-alt fa-2x"></i>
                        </h2>
                        <h4 class="card-title">
                            R$ <?php echo number_format(@$dinheiro, 2, ',', '.'); ?>
                        </h4>
                        <i>Total dinheiro</i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3">  
            <div class="text-right">
                <div class="card text-center h-100 bg-secondary text-white shadow" style="padding:15px;">
                    <div class="card-block">
                        <h2>
                            <i class="fa fa-qrcode fa-2x"></i>
                        </h2>
                        <h4 class="card-title">
                            R$ <?php echo number_format(@$pix, 2, ',', '.'); ?>
                        </h4>
                        <i>Total PIX</i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3">  
            <div class="text-right">
                <div class="card text-center h-100 bg-secondary text-white shadow" style="padding:15px;">
                    <div class="card-block">
                        <h2>
                            <i class="far fa-credit-card fa-2x"></i>
                        </h2>
                        <h4 class="card-title">
                            R$ <?php echo number_format(@$cartao_credito, 2, ',', '.'); ?>
                        </h4>
                        <i>Total Cartão de Crédito</i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3">  
            <div class="text-right">
                <div class="card text-center h-100 bg-secondary text-white shadow" style="padding:15px;">
                    <div class="card-block">
                        <h2>
                            <i class="fas fa-credit-card fa-2x"></i>
                        </h2>
                        <h4 class="card-title">
                            R$ <?php echo number_format(@$cartao_debito, 2, ',', '.'); ?>
                        </h4>
                        <i>Total Cartão de Debito</i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row" style="margin:10px;">
        <div class="col-lg-4">  
            <div class="text-right">
                <div class="card text-center h-100 bg-success text-white shadow" style="padding:15px;">
                    <div class="card-block">
                        <h2>
                            <i class="fas fa-search-dollar fa-2x"></i>
                        </h2>
                        <h4 class="card-title">
                            R$ <?php echo number_format(@$valorTotalVendasPeriodo, 2, ',', '.'); ?>
                        </h4>
                        <i>Total Faturamento</i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">  
            <div class="text-right">
                <div class="card text-center h-100 bg-warning text-white shadow" style="padding:15px;">
                    <div class="card-block">
                        <h2>
                            <i class="fas fa-box fa-2x"></i>
                        </h2>
                        <h4 class="card-title">
                            R$ <?php echo number_format(@$totalCustoPeriodo, 2, ',', '.'); ?>
                        </h4>
                        <i>Total Custo</i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">  
            <div class="text-right">
                <div class="card text-center h-100 bg-info text-white shadow" style="padding:15px;">
                    <div class="card-block">
                        <h2>
                            <i class="far fa-smile fa-2x"></i>
                        </h2>
                        <h4 class="card-title">
                            R$ <?php echo number_format(@$totalLucro, 2, ',', '.'); ?>
                        </h4>
                        <i><b>Total:</b> Custo - Faturamento</i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-12" style="margin-top: 25px">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="dataTables-relatorio-produtos">
                    <thead>
                        <tr>
                            <th>Venda</th>
                            <th>Valor Venda</th>
                            <th>Nome Produto</th>
                            <th>Quantidade Vendida</th>
                            <th>Estoque Atual</th>
                            <th>Preço Produto</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>    
                        <?php $lastVendaId = -1; ?>
                        
                        <?php foreach (@$produtos_vendidos as $venda_id => $produto): ?>
                            <?php foreach($produto['produto'] as $prod): ?>
                            <tr>
                                <?php if ($lastVendaId != $venda_id): ?>
                                    <?php $lastVendaId = $venda_id; ?>
                                    <td valign="center" rowspan="<?php echo count($produto['produto']) ?>">#<?php echo $venda_id ?></td>
                                    <td valign="center" rowspan="<?php echo count($produto['produto']) ?>">R$ <?php echo number_format($produto['valor_venda'], 2, ',', '.') ?></td>
                                <?php endif; ?>
                                <td><?php echo $prod['nome'] ?></td>
                                <td><?php echo $prod['quantidade_vendida'] ?></td>
                                <td><?php echo $prod['estoque_atual'] ?></td>
                                <td>R$ <?php echo number_format($prod['preco'], 2, ',', '.'); ?></td>
                                <td class="center">
                                    <a class="btn btn-primary" target="_blank" href="/produto/movimentacoes_estoque/<?php echo $prod['produto_id'] ?>">
                                        <i class="fa fa-bars"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="row">
        <div id="container" style="min-width: 310px; height: 400px;margin-top:20px;"></div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        var urlParams = new URLSearchParams(window.location.search);
        var from = urlParams.get('from');
        var to = urlParams.get('to');

        $('.imprimir').click(function() {
            $.ajax({
                type: "get",
                dataType: "json",
                url: "/venda/imprimir_relatorio?from=" + from + "&to=" + to,
                error: function(data){
                    alert('Ocorreu um erro.');
                    console.log(data);
                },
                success: function(data){
                    url = '/uploads/venda/fiscal/' + data['file'];
                    $('#download-txt-sale').css('display', 'initial').attr('href', url);
                }
            });
        })
    });
</script>