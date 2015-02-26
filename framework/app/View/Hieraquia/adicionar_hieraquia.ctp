
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-6">
            <div class="panel panel-default" style="margin-top: 12px;">
                <div class="panel-heading">
                    Dados da Hieraquia
                </div>
                <div class="panel-body">
                    <form role="form" action="/hieraquia/s_adicionar_hieraquia" method="post">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Nome</label>
                                    <input class="form-control" name="dados[nome]">
                                    <!-- <p class="help-block">Example block-level help text here.</p> -->
                                </div>
                                <div class="form-group">
                                    <label>Modulos</label>
                                </div>
                                <div class="form-group">
                                <?php
                                    foreach ($modulos as $i => $modulo) {
                                ?>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="dados[modulos][]" value="<?php echo $modulo['modulo'] ?>"><?php echo $modulo['nome'] ?>
                                        </label>
                                    </div>
                                <?php
                                    }
                                ?>
                                </div>
                            </div>
                            <!-- /.col-lg-6 (nested) -->
                        </div>

                        <button type="submit" class="btn btn-success">Salvar Hieraquia</button>
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