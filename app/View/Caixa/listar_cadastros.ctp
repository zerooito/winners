
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Caixa - Listar Cadastros</h1>
    </div>

    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Listagem dos caixas
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-caixa">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Valor Inicial</th>
                                    <th>Valor Final Total</th>
                                    <th>Valor Final Cartão</th>
                                    <th>Valor Final Dinheiro</th>
                                    <th>Valor Final Pix</th>
                                    <th>Data Abertura</th>
                                    <th>Data Fechamento</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>   

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


<!-- Modal -->
<div class="modal fade" id="endSales" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <form action="/caixa/finalizar_caixa" method="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Finalizar Caixa</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Valor Inicial Caixa</label>
                                <input type="text" required class="moeda form-control" value="0" name="caixa[valor_inicial]" id="valor_inicial_final" readonly="">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Valor Final</label>
                                <input type="text" required class="moeda form-control" value="0" name="caixa[valor_final_total]" id="valor_final_total" readonly="">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Valor Crédito</label>
                                <input type="text" required class="moeda form-control" value="0" name="caixa[valor_final_cartao_credito]" id="valor_final_cartao_credito" readonly="">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Valor Débito</label>
                                <input type="text" required class="moeda form-control" value="0" name="caixa[valor_final_cartao_debito]" id="valor_final_cartao_debito" readonly="">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Valor Dinheiro</label>
                                <input type="text" required class="moeda form-control" value="0" name="caixa[valor_final_dinheiro]" id="valor_final_dinheiro" readonly="">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Valor PIX (Outros)</label>
                                <input type="text" required class="moeda form-control" value="0" name="caixa[valor_final_outros]" id="valor_final_outros" readonly="">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Data Abertura</label>
                                <input type="datetime-local" required class="form-control" name="caixa[data_abertura]" id="data_abertura_final" readonly="">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Data Fechamento</label>
                                <input type="datetime-local" required class="form-control" name="caixa[data_fechamento]" id="data_fechamento">
                            </div>
                        </div>
                        <input type="hidden" id="id_caixa" name="caixa[id]">
                        <div class="col-lg-6">
                            <p> Total Caixa: <i id="total_caixa"></i> </p>
                            <p> Total Vendido: <i id="vendido"></i> </p>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-danger">Finalizar</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script type="text/javascript">
    
    $(document).ready(function(){
        datatable = $('#dataTables-caixa').dataTable({
            "bServerSide": true,
            "iDisplayStart": 0,
            "sAjaxDataProp": "data",
            "aaSorting": [[ 0, "desc" ]],
            "sAjaxSource": "/caixa/listar_cadastros_ajax"
        });
    });


    $(window).load(function(){
        $('.fechar-caixa').click(function() {
            let id = $(this).attr('data-id');
            $.ajax({
                type: "GET",
                dataType: "json",
                url: "/caixa/carregar_fechamento_do_caixa/" + id,
                success: function(data) {
                    $('#data_abertura_final').val(data['caixa_atual']['Caixa']['data_abertura']);
                    $('#valor_inicial_final').val(number_format(data['caixa_atual']['Caixa']['valor_inicial'],2,',','.'));
                    $('#data_fechamento').val(data['caixa_atual']['Caixa']['data_fechamento']);
                    $('#valor_final_total').val(number_format(data['total_vendas'], 2, ',', '.'));
                    $('#valor_final_dinheiro').val(number_format(data['total_dinheiro'], 2, ',', '.'));
                    $('#valor_final_cartao_debito').val(number_format(data['total_cartao_debito'], 2, ',', '.'));
                    $('#valor_final_cartao_credito').val(number_format(data['total_cartao_credito'], 2, ',', '.'));
                    $('#valor_final_outros').val(number_format(data['total_outros'], 2, ',', '.'));
                    $('#id_caixa').val(data['caixa_atual']['Caixa']['id']);

                    $('#vendido').html('R$ ' + number_format(data['vendido'], 2, ',', '.'));
                    $('#total_caixa').html('R$ ' + number_format(data['total_vendas'], 2, ',', '.'));

                    $('#endSales').modal();
                },
                error: function(data) {
                    console.log(data);
                }
            })
        });
    });

</script>
