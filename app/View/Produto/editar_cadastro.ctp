
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default" style="margin-top: 12px;">
                <div class="panel-heading">
                    Dados do Produto
                </div>
                <div class="panel-body">
                    <form role="form" action="/produto/s_editar_cadastro" method="post">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Nome</label>
                                    <input class="form-control" name="dados[nome]" value="<?php echo $produto[0]['Produto']['nome'] ?>">
                                    <!-- <p class="help-block">Example block-level help text here.</p> -->
                                </div>
                                <div class="form-group">
                                    <label>Preço</label>
                                    <input class="form-control" name="dados[preco]" value="<?php echo $produto[0]['Produto']['preco'] ?>">
                                </div>
                                <div class="form-group">
                                    <label>Peso Bruto</label>
                                    <input class="form-control" name="dados[peso_bruto]" value="<?php echo $produto[0]['Produto']['peso_bruto'] ?>">
                                </div>                                
                                <div class="form-group">
                                    <label>Peso Liquido</label>
                                    <input class="form-control" name="dados[peso_liquido]" value="<?php echo $produto[0]['Produto']['peso_liquido'] ?>">
                                </div>
                            </div>
                            <!-- /.col-lg-6 (nested) -->
                        </div>

                        <input type="hidden" value="<?php echo $produto[0]['Produto']['id'] ?>" name="id" />
                        <button type="submit" class="btn btn-success">Editar Produto</button>
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