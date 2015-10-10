
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default" style="margin-top: 12px;">
                <div class="panel-heading">
                    Dados da Categoria Banner
                </div>
                <div class="panel-body">
                    <form role="form" action="/categoria_banner/s_editar_cadastro/<?php echo $dados['CategoriaBanner']['id'] ?>" method="post">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Nome</label>
                                    <input class="form-control" name="dados[nome]" value="<?php echo $dados['CategoriaBanner']['nome'] ?>">
                                    <!-- <p class="help-block">Example block-level help text here.</p> -->
                                </div>
                                <div class="form-group">
                                    <label>Largura (Width) px</label>
                                    <input class="form-control" name="dados[width]" value="<?php echo $dados['CategoriaBanner']['width'] ?>" required>
                                </div>
                                <div class="form-group">
                                    <label>Altura (Height) px</label>
                                    <input class="form-control" name="dados[height]" value="<?php echo $dados['CategoriaBanner']['height'] ?>" required>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-success">Salvar Edição</button>
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