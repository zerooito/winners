<div id="page-wrapper">
    <div class="row" style="margin:10px;">
        <div class="col-lg-4">  
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
        <div class="col-lg-4">  
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
        <div class="col-lg-4">  
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
    </div>

    <div class="row">
        <div id="container" style="min-width: 310px; height: 400px;margin-top:20px;"></div>
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