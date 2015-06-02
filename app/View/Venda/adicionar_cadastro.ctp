
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default" style="margin-top: 12px;">
                <div class="panel-heading">
                    Dados da Venda
                </div>
                <div class="panel-body">
                    <form role="form" action="/venda/s_adicionar_cadastro" method="post">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Cliente</label>
                                    <input class="form-control" name="dados[nome]">
                                    <!-- <p class="help-block">Example block-level help text here.</p> -->
                                </div>
                                <div class="form-group">
                                    <label>Valor</label>
                                    <input class="form-control moeda" name="dados[preco]">
                                </div>
                                <div class="form-group">
                                    <label>Custo Medio</label>
                                    <input class="form-control peso" name="dados[peso_bruto]">
                                </div>
                            </div>
                            <!-- /.col-lg-6 (nested) -->
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Selecione a forma de Pagamento</label>
                                    <input class="form-control" name="dados[nome]">
                                    <!-- <p class="help-block">Example block-level help text here.</p> -->
                                </div>
                                <div class="form-group">
                                    <label>Selecione o valor Pago</label>
                                    <input class="form-control" name="dados[nome]">
                                    <!-- <p class="help-block">Example block-level help text here.</p> -->
                                </div>
                                <button type="button" class="btn btn-info" aria-label="Left Align">
                                  <span class="glyphicon glyphicon glyphicon-plus" aria-hidden="true"></span>
                                  Adicionar Forma de Pagamento
                                </button>
                            </div>
                            <!-- /.col-lg-6 (nested) -->
                        </div>

                        <button type="submit" class="btn btn-success">Salvar Produto</button>
                        <button type="reset" class="btn btn-danger" onclick="history.go(-1);">Cancelar</button>
                    </form>
                    <!-- /.row (nested) -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
</div>
