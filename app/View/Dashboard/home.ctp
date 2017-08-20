
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Dashboard</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div id="container" style="min-width: 310px; height: 400px;"></div>
</div>
<!-- /#page-wrapper -->
<script type="text/javascript">
    $(function() {
        $('#container').highcharts({
            title: {
                text: 'Gráfico de Vendas',
                x: -20 //center
            },
            xAxis: {
                categories: ['Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab', 'Domingo']
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
            series: [<?php echo $vendas; ?>]
        });
    });
</script>