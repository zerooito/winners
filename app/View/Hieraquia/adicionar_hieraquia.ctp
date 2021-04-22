<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dados da Hieraquia</h1>
    </div>

    <form role="form" action="/hieraquia/s_adicionar_hieraquia" method="post">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Nome</label>
                                    <input class="form-control" name="dados[nome]">
                                    <!-- <p class="help-block">Example block-level help text here.</p> -->
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <span class="badge badge-success">Modulos</span>
                                </div>
                                <div class="form-group">
                                <?php foreach ($modulos as $i => $modulo): ?>
                                    <div class="checkbox">
                                        <label>
                                            <b>
                                                <?php echo utf8_encode($modulo['nome']) ?>
                                            </b>
                                            <br>
                                            <input type="checkbox" name="dados[modulos][read][]" value="<?php echo $modulo['id'] ?>" id="modulo-read-<? echo $i; ?>"> <label for="modulo-read-<? echo $i; ?>">Leitura</label><br>
                                            <input type="checkbox" name="dados[modulos][write][]" value="<?php echo $modulo['id'] ?>" id="modulo-write-<? echo $i; ?>"> <label for="modulo-write-<? echo $i; ?>">Escrita</label>
                                            <hr>
                                        </label>
                                    </div>
                                <?php endforeach; ?>
                                </div>
                            </div>
                            <!-- /.col-lg-6 (nested) -->
                        </div>
                        <!-- /.row (nested) -->
                    </div>
                    <!-- /.panel-body -->

                    <div class="pull-right" style="float: right;">
                        <input type="submit" class="btn btn-success" value="Salvar Hieraquia">
                        <button type="reset" class="btn btn-danger" onclick="history.go(-1);">Cancelar</button>
                    </div>
                </div>
                <!-- /.panel -->
            </div>
            <!-- /.col-lg-12 -->
        </div>
    </form>
</div>