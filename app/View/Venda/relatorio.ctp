<div id="page-wrapper">
    <div class="row">
        <!-- /.row -->
        <div class="row"  style="margin-top:10px;">
            <div class="col-lg-4 col-md-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-2">
                                <i class="fa fa-money fa-5x"></i>
                            </div>
                            <div class="col-xs-10 text-right">
                                <div class="huge">
                                    R$ <?php echo number_format($dinheiro, 2, ',', '.'); ?>
                                </div>
                                <div>Total Dinheiro</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="panel panel-green">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-credit-card fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">
                                    R$ <?php echo number_format($cartao_credito, 2, ',', '.'); ?>
                                </div>
                                <div>Total Cartão Credito</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="panel panel-yellow">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-credit-card fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">
                                    R$ <?php echo number_format($cartao_debito, 2, ',', '.'); ?>
                                </div>
                                <div>Total Cartão Debito</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-12">
                <div class="panel">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-usd fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">
                                    R$ <?php echo number_format($valorTotalVendasPeriodo, 2, ',', '.'); ?>
                                </div>
                                <div>Total Vendas</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-12">
                <div class="panel">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-minus-square fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">
                                    R$ <?php echo number_format($totalCustoPeriodo, 2, ',', '.'); ?>
                                </div>
                                <div>Total Custo</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-12">
                <div class="panel panel-green">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-minus-square fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">
                                    R$ <?php echo number_format($totalLucro, 2, ',', '.'); ?>
                                </div>
                                <div>Total Lucro</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div id="container" style="min-width: 310px; height: 400px;margin-top:20px;"></div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(function () {
    $('#container').highcharts({
        title: {
            text: 'Gráfico de Vendas Dinheiro, Cartão de Credito e Debito',
            x: -20 //center
        },
        xAxis: {
            categories: ['Dinheiro', 'Cartão Crédito', 'Cartão Debito']
        },
        yAxis: {
            title: {
                text: 'Valor R$'
            },
            plotLines: [{
                value: 0,
                width: 1,
                color: '#808080'
            }]
        },
        tooltip: {
            valuePrefix: 'R$ '
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle',
            borderWidth: 0
        },
        series: [
            {
                name: 'Valor', 
                data: [
                    <?php echo number_format($dinheiro, 2, ',', '.'); ?>, 
                    <?php echo number_format($cartao_credito, 2, ',', '.'); ?>,
                    <?php echo number_format($cartao_debito, 2, ',', '.'); ?>
                ]
            }            
        ]
    });
});
</script>