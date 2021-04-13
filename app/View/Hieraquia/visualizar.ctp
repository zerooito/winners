<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dados da Hieraquia</h1>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Nome</label>
                                <input class="form-control" name="dados[nome]" value="<?php echo $hieraquia[0]['Hieraquia']['nome'] ?>" readonly>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <span class="badge badge-success">Modulos</span>
                            </div>
                            <div class="form-group">
                            <?php foreach ($hieraquia as $i => $hieraquia): ?>
                                <div class="checkbox">
                                    <b>
                                        <?php echo utf8_encode($hieraquia['Modulo']['nome_modulo']) ?>
                                    </b>
                                    <br>
                                    <?php if ($hieraquia['HieraquiaModulo']['tipo_de_permissao'] == "read"): ?>
                                        <input type="checkbox" checked name="dados[modulos][read][]" id="modulo-read-<? echo $i; ?>" readonly> <label for="modulo-read-<? echo $i; ?>">Leitura</label><br>
                                    <?php endif; ?>
                                    <?php if ($hieraquia['HieraquiaModulo']['tipo_de_permissao'] == "write"): ?>
                                        <input type="checkbox" checked name="dados[modulos][write][]" id="modulo-write-<? echo $i; ?>" readonly> <label for="modulo-write-<? echo $i; ?>">Escrita</label>
                                    <?php endif; ?>
                                    <hr>
                                </div>
                            <?php endforeach; ?>
                            </div>
                        </div>
                        <!-- /.col-lg-6 (nested) -->
                    </div>
                    <!-- /.row (nested) -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
</div>