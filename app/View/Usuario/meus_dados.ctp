<form role="form" action="/usuario/s_editar_dados" method="post" enctype="multipart/form-data">

    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-6">
                <div class="panel panel-default" style="margin-top: 12px;">
                    <div class="panel-heading">
                        Dados do Perfil
                    </div>
                    <div class="panel-body">
                        <div class="col-md-12">
                            <label>Estoque Minimo Produtos</label>
                            <div class="row">
                                <div class="col-md-12 col-xs-12">
                                    <input class="form-control" type="text" name="estoque_minimo" value="<?php echo @$usuario[0]['Usuario']['estoque_minimo']; ?>">
                                </div>
                            </div>                       
                        </div>
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
            <!-- /.col-lg-6 -->
            <div class="col-lg-6">
                <div class="panel panel-default" style="margin-top: 12px;">
                    <div class="panel-heading">
                        Dados de Integrações
                    </div>
                    <div class="panel-body">
                        <div class="col-md-12">
                            <label>Token API: </label>
                            <div class="row">
                                <div class="col-md-7 col-xs-12">
                                    <input class="form-control" type="text" id="_token" readonly name="token" value="<?php echo $usuario[0]['Usuario']['token']; ?>">
                                </div>
                                <div class="col-md-4 col-xs-12">
                                    <a href="javascript:generateNewToken();" class="btn btn-small btn-info">Gerar Novo Token</a>
                                </div>  
                                <div class="col-md-12">                              
                                    <small>Atenção mudar o token, vai parar todas as comunicações que já estejam sendo feitas com a API.</small>
                                </div>
                            </div>                       
                        </div>
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
            <!-- /.col-lg-6 -->

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