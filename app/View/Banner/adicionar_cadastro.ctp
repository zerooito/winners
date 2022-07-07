<form role="form" action="/banner/s_adicionar_cadastro" method="post" enctype="multipart/form-data">


<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Categoria Banner - Listar Cadastros</h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default" style="margin-top: 12px;">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="form-group">
                                    <label>Nome</label>
                                    <input class="form-control" name="dados[nome_banner]">
                                    <!-- <p class="help-block">Example block-level help text here.</p> -->
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Categoria</label>
                                <select class="form-control js-example-basic-single" name="dados[categoria_banner_id]">
                                    <?php foreach ($categorias as $key => $categoria): ?>
                                    <option 
                                        value="<?php echo $categoria['CategoriaBanner']['id'] ?>"
                                    >
                                    <?php echo $categoria['CategoriaBanner']['nome'] ?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>
                                Imagem
                            </label>
                            <input type="file" name="imagem" />
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <button type="submit" class="btn btn-success">Adicionar Banner</button>
                        <button type="reset" class="btn btn-danger" onclick="history.go(-1);">Cancelar</button>
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
    
</form>