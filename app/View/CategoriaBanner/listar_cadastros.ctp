
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Categoria Banner - Listar Cadastros</h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-lg-9">
            <div class="panel panel-default">
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-categoria">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nome</th>
                                    <th>Altura (Height)</th>
                                    <th>Largura (Width)</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>                   
                            <?php
                            foreach ($categorias as $indice => $categoria) {
                            ?>             
                                <tr class="odd gradeX" id="<?php echo $categoria['CategoriaBanner']['id'] ?>">
                                    <td><?php echo $categoria['CategoriaBanner']['id'] ?></td>
                                    <td class="center"><?php echo $categoria['CategoriaBanner']['nome'] ?></td>
                                    <td class="center"><?php echo $categoria['CategoriaBanner']['height'] ?>px</td>
                                    <td class="center"><?php echo $categoria['CategoriaBanner']['width'] ?>px</td>
                                    <td class="center">
                                        <button onclick="editar_cadastro(<?php echo $categoria['CategoriaBanner']['id'] ?>);" type="button" class="btn btn-info"><i class="fa fa-edit"></i></button>
                                        <button onclick="remover_categoria(<?php echo $categoria['CategoriaBanner']['id'] ?>);" type="button" class="btn btn-danger"><i class="fa fa-times"></i></button>
                                    </td>
                                </tr>   
                            <?php
                            }// fim foreach
                            ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.table-responsive -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->

        <div class="col-lg-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Ações
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <a href="/categoria_banner/adicionar_cadastro" style="color: #FFF;width:100%;" class="btn btn-primary"><i class="fa fa-plus"></i> Adicionar categoria</a>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
    </div>
</div>

<script type="text/javascript">
    function remover_categoria(id) {
        $.ajax({
            type: "post",
            dataType: "json",
            url: "/categoria_banner/excluir_cadastro",
            async: true,
            data: {id: id},
            error: function(x){
                window.location.reload();
            },
            success: function(x){
                window.location.reload();                
            }
        });
    }
    function editar_cadastro(id) {
        window.location.href = "/categoria_banner/editar_cadastro/" + id;
    }
</script>
