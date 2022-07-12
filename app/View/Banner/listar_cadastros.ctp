
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Banner - Listar Cadastros</h1>
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
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>                   
                            <?php
                            foreach ($banners as $indice => $banner) {
                            ?>             
                                <tr class="odd gradeX" id="<?php echo $banner['Banner']['id'] ?>">
                                    <td><?php echo $banner['Banner']['id'] ?></td>
                                    <td class="center"><?php echo $banner['Banner']['nome_banner'] ?></td>
                                    <td class="center">
                                        <button onclick="remover_banner(<?php echo $banner['Banner']['id'] ?>);" type="button" class="btn btn-danger btn-circle"><i class="fa fa-times"></i></button>
                                        <button onclick="editar_cadastro(<?php echo $banner['Banner']['id'] ?>);" type="button" class="btn btn-info btn-circle"><i class="fa fa-edit"></i></button>
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
                    <a href="/categoria_banner/listar_cadastros" style="margin-bottom: 10px; width:100%;color: #FFF;" class="btn btn-primary"><i class="fa fa-plus"></i> Categoria de Banners</a>

                    <a href="/banner/adicionar_cadastro"  style="margin-bottom: 10px; width:100%;color: #FFF;" class="btn btn-info"><i class="fa fa-plus"></i> Adicionar Banner</a>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
    </div>
</div>

<script type="text/javascript">
    function remover_banner(id) {
        $.ajax({
            type: "post",
            dataType: "json",
            url: "/banner/excluir_cadastro",
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
        window.location.href = "/banner/editar_cadastro/"+id;
    }
</script>
