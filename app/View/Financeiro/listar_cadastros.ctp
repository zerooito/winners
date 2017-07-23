
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Financeiro - Geral</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <?php
        pr($lancamentos);
    ?>
    <div class="row">
        <div class="col-lg-3">  
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-2">
                            <i class="fa fa-level-up fa-5x"></i>
                        </div>
                        <div class="col-xs-10 text-right">
                            <div class="huge">
                                <b>R$</b> <?php echo number_format($lancamentos['a_receber'], 2, ',', '.'); ?>
                            </div>
                            <div>A Receber</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3">  
            <div class="panel panel-danger">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-2">
                            <i class="fa fa-level-down fa-5x"></i>
                        </div>
                        <div class="col-xs-10 text-right">
                            <div class="huge">
                                <b>R$</b> <?php echo number_format($lancamentos['a_pagar'], 2, ',', '.'); ?>
                            </div>
                            <div>A Pagar</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3">  
            <div class="panel panel-success">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-2">
                            <i class="fa fa-thumbs-up fa-5x"></i>
                        </div>
                        <div class="col-xs-10 text-right">
                            <div class="huge">
                                <b>R$</b> <?php echo number_format($lancamentos['pago'], 2, ',', '.'); ?>
                            </div>
                            <div>Pago</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3">  
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-12 text-right">
                            <div class="huge">
                                <b>R$</b> <?php echo number_format($lancamentos['total'], 2, ',', '.'); ?><br>
                                <small style="font-size:12px;">-<b>R$</b> <?php echo number_format($lancamentos['total_saidas'], 2, ',', '.'); ?></small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- /.row -->
    <div class="row">
        <div class="col-lg-9">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Transações Financeiras
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="datatable-financeiro">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Pedido</th>
                                    <th>Vencimento</th>
                                    <th>Valor</th>
                                    <th>Categoria</th>
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

        <div class="col-lg-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Ações
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <a href="/cupom/adicionar_cupom" style="color: #FFF;" class="btn btn-primary"> 
                        <i class="fa fa-plus"></i> 
                        Adicionar Transação
                    </a>
                    
                    <hr>

                    <a href="javascript:$('#addCategoria').modal('show');" style="color: #FFF;" class="btn btn-success"> 
                        <i class="fa fa-plus"></i> 
                        Cadastrar Categorias
                    </a>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="addCategoria" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <form class="form" action="/financeiro/adicionar_categoria" method="POST">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Adicionar Categorias Financeiro</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nome">Nome:</label>
                        <input type="nome" class="form-control" id="nome" name="categoria[nome]">
                    </div>
                    <div class="form-group">
                        <label for="tipo">Tipo: </label>
                        <select class="form-control" style="width: 100%;" name="categoria[tipo]">
                            <option value="receita">Receita</option>
                            <option value="despesa">Despesa</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Salvar</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </form>
</div>

<script type="text/javascript">
    
    $(document).ready(function(){
        
        var datatable = $('#datatable-financeiro').dataTable({
            "bServerSide": true,
            "iDisplayStart": 0,
            "sAjaxDataProp": "data",
            "aaSorting": [[ 0, "desc" ]],
            "sAjaxSource": "/financeiro/listar_cadastros_ajax"
        });

    });

</script>

<style type="text/css">
    
    .huge {
        font-size: 25px;
    }


</style>