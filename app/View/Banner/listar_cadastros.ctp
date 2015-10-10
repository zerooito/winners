
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Banner - Listar Cadastros</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-9">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Listagem dos Banners
                </div>
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
                    <button type="button" class="btn btn-primary"><i class="fa fa-plus"><a href="/categoria_banner/adicionar_cadastro" style="color: #FFF;"> Adicionar categoria</a></i></button>

                    <br>

                    <button type="button" class="btn btn-info" style="margin-top:10px;"><i class="fa fa-plus"><a href="/banner/adicionar_cadastro" style="color: #FFF;"> Adicionar Banner</a></i></button>
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
