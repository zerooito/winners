<form role="form" action="/usuario/s_editar_dados" method="post" enctype="multipart/form-data">

    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default" style="margin-top: 12px;">
                    <div class="panel-heading">
                        Dados do Perfil
                    </div>
                    <div class="panel-body">
                        <div class="col-md-12">
                            <label>Estoque Minimo Produtos</label>
                            <div class="row">
                                <div class="col-md-8 col-xs-12">
                                    <input class="form-control" type="text" name="estoque_minimo" value="<?php echo @$usuario[0]['Usuario']['estoque_minimo']; ?>">
                                </div>
                            </div>                       
                        </div>

                        <div class="col-md-12" style="margin-top:10px;">
                            <label>Vender produtos sem estoque?</label>
                            <div class="row">
                                <div class="col-md-4 col-xs-6">
                                    <select class="form-control" name="sale_without_stock">
                                        <option value="1"
                                            <?php if (@$usuario[0]['Usuario']['sale_without_stock']): ?>
                                                selected
                                            <?php endif; ?>
                                        >
                                            Sim
                                        </option>
                                        <option value="0"
                                            <?php if (@!$usuario[0]['Usuario']['sale_without_stock']): ?>
                                                selected
                                            <?php endif; ?>
                                        >
                                            Não
                                        </option>
                                    </select>
                                </div>
                            </div>                       
                        </div>

                        <div class="col-md-12" style="margin-top:10px;">
                            <label>Telefone: </label>
                            <div class="row">
                                <div class="col-md-8 col-xs-12">
                                    <input class="form-control" type="text" id="telephone" name="telephone" value="<?php echo $usuario[0]['Usuario']['telefone']; ?>">
                                </div>
                            </div>                       
                        </div>

                        <div class="col-md-12" style="margin-top:10px;">
                            <label>Token API: </label>
                            <div class="row">
                                <div class="col-md-8 col-xs-12">
                                    <input class="form-control" type="text" id="_token" readonly name="token" value="<?php echo $usuario[0]['Usuario']['token']; ?>">
                                </div>
                                <div class="col-md-4 col-xs-12">
                                    <a href="javascript:generateNewToken();" class="btn btn-small btn-info">Gerar Novo Token</a>
                                </div>  
                                <div class="col-md-12" style="margin-top:10px;">
                                    <small>Atenção mudar o token, vai parar todas as comunicações que já estejam sendo feitas com a API.</small>
                                </div>
                            </div>                       
                        </div>

                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>

            <div class="row" style="text-align: right;">
                <div class="col-lg-12" style="right: 15px;">
                    <button type="submit" class="btn btn-success">Salvar Alterações</button>
                </div>
            </div>
        </div>
    </div>
    
</form>

<script type="text/javascript">
    
    function generateNewToken() {
        $.ajax({
            url: '/usuario/new_token',
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                $('#_token').val(data);
            }
        });
    }

</script>