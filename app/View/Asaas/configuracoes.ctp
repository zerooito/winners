
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default" style="margin-top: 12px;">
                <div class="panel-heading">
                    Configurações Asaas
                </div>
                <div class="panel-body">
                    <form action="/asaas/save" method="POST">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>API Asaas</label>
                                    <input type="text" class="form-control" name="key_api" value="<?php echo isset($asaas['Asaas']['api_key']) ? $asaas['Asaas']['api_key'] : '' ?>">
                                    <!-- <p class="help-block">Example block-level help text here.</p> -->
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-success">Salvar</button>
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