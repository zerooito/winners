<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dados do SubUsuário</h1>
    </div>

    <div class="row">
        <form role="form" action="/hieraquia/s_adicionar_usuario" method="post">
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
                                    <label>Email</label>
                                    <input class="form-control" name="dados[email]">
                                    <!-- <p class="help-block">Example block-level help text here.</p> -->
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Senha</label>
                                    <input class="form-control" name="dados[password]">
                                    <!-- <p class="help-block">Example block-level help text here.</p> -->
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Confirmar Senha</label>
                                    <input class="form-control" name="dados[password_confirm]">
                                    <!-- <p class="help-block">Example block-level help text here.</p> -->
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <span class="badge badge-success">Hieraquia</span>
                                </div>
                                <div class="form-group">
                                    <select class="form-control" name="dados[hieraquia_id]">
                                    <?php foreach ($hieraquias as $i => $hieraquia): ?>
                                        <option value="<?php echo $hieraquia['Hieraquia']['id']; ?>"><?php echo $hieraquia['Hieraquia']['nome']; ?></option>
                                    <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <!-- /.col-lg-6 (nested) -->
                        </div>
                        <!-- /.row (nested) -->
                    </div>
                    <!-- /.panel-body -->

                    <div class="pull-right">
                        <input type="submit" class="btn btn-success" value="Salvar Usuario"/>
                        <button type="reset" class="btn btn-danger" onclick="history.go(-1);">Cancelar</button>
                    </div>
                </div>
                <!-- /.panel -->
            </div>
        </form>
        <!-- /.col-lg-12 -->
    </div>
</div>