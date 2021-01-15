
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Hieraquias - Listar Hieraquias</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-9">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Listagem das Hieraquias
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-cliente">
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Email</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>                   
                            <?php
                            foreach ($hieraquias as $i => $hieraquia) {
                            ?>             
                                <tr class="odd gradeX" id="<?php echo $hieraquia['Hieraquia']['id'] ?>">
                                    <td><?php echo $hieraquia['Hieraquia']['nome'] ?></td>
                                    <td class="center">
                                        <button onclick="remover_hieraquia(<?php echo $hieraquia['Hieraquia']['id'] ?>);" type="button" class="btn btn-danger btn-circle"><i class="fa fa-times"></i></button>
                                        <button onclick="editar(<?php echo $hieraquia['Hieraquia']['id'] ?>);" type="button" class="btn btn-info btn-circle"><i class="fa fa-edit"></i></button>
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
                    <a class="btn btn-success" href="/hieraquia/listar_subusuarios" style="color: #FFF;margin-top: 10px;">
                        <i class="fa fa-plus"></i> Usuarios
                    </a>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
    </div>
</div>

<script type="text/javascript">
    function remover_cliente(id) {
        $.ajax({
            type: "post",
            dataType: "json",
            url: "/cliente/excluir_cliente",
            async: true,
            data: {id: id},
            error: function(x){
                window.reload();
            },
            success: function(x){
                window.location.reload();                
            }
        });
    }
    function editar_cliente(id) {
        window.location.href = "/cliente/editar_cliente/"+id;
    }
</script>
