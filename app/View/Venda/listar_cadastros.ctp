
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Vendas - Listar Cadastros</h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-lg-9">
            <div class="panel panel-default">
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-vendas">
                            <thead>
                                <tr>
                                    <th>#ID</th>
                                    <th>Valor</th>
                                    <th>Forma de Pagamento</th>
                                    <th>Data Venda</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
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

                    <a href="/venda/adicionar_cadastro" class="btn btn-primary" 
                        style="margin-bottom: 10px; width:100%;color: #FFF;"
                    > 
                        <i class="fa fa-plus"></i>
                        Adicionar venda
                    </a>

                    <hr>

                    <p>De: </p>

                    <input type="date" id="from" class="col-lg-12" style="margin-bottom: 10px;">

                    <p>Até: </p>

                    <input type="date" id="to" class="col-lg-12" style="margin-bottom: 10px;">

                    <button type="button" class="btn btn-info" style="margin-bottom: 10px; width:100%;">
                        <i class="fa fa-eye">
                            <a href="javascript:;" onclick="printSalesPeriod();" style="color: #FFF;"> 
                                Relatório Período
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

<!-- Modal -->

<div class="modal fade" id="showModalCupomFiscal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Imprimir Cupom Fiscal</h4>
      </div>
      <div class="modal-body text-center">
        <h3>Deseja imprimir cupom fiscal da venda</h3>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
        <a href="javascript:;" class="btn btn-success" id="download-txt-sale" download>Imprimir</a>
      </div>
    </div>
  </div>
</div>

<iframe id="textfile" src="" style="display: none;"></iframe>

<script type="text/javascript">
    var url;
    
    $(document).ready(function(){
        var datatable = $('#dataTables-vendas').dataTable({
            "bServerSide": true,
            "iDisplayStart": 0,
            "sAjaxDataProp": "data",
            "aaSorting": [[ 0, "desc" ]],
            "sAjaxSource": "/venda/listar_cadastros_ajax"
        });
    });

    function printSalesPeriod() {
        var from = $('#from').val();
        var to = $('#to').val();

        $.ajax({
            type: "get",
            dataType: "json",
            url: "/venda/relatorio/?from=" + from + "&to=" + to,
            error: function(data) {
                openInNewTab("/venda/relatorio/?from=" + from + "&to=" + to);
            },
            success: function(data) {
                console.log(data);
            }
        });
    }

    function remover_venda(id) {
        var idGlobal = id;
    
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
                url: "/venda/excluir_cadastro",
                async: true,
                data: {id: idGlobal},
                success: function(data){
                    swal(
                        'Deletado!',
                        'Seu registro foi deletado do sistema.',
                        'success'
                    );      
                    
                    $('#' + idGlobal).parents('tr').remove();
                }
            });
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
                url = '/uploads/venda/fiscal/' + data['file'];
                $('#download-txt-sale').attr('href', url);
                $('#showModalCupomFiscal').modal('show');
            }
        });

    }

    function openInNewTab(url) {
        var win = window.open(url, '_blank');
        win.focus();
    }

    function editar_produto(id) {
        window.location.href = "/produto/editar_cadastro/"+id;
    }

</script>
