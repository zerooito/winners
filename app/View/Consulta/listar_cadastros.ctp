
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Consulta/Visita - Listar Cadastros</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Listagem das Consultas/Visitas
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-cliente">
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>E-mail</th>
                                    <th>Data</th>
                                    <th>Hora</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>                   
                            <?php
                            foreach ($consultas as $indice => $consulta) {
                            ?>             
                                <tr class="odd gradeX" id="<?php echo $consulta['Consulta']['id'] ?>">
                                    <td><?php echo $consulta['Consulta']['nome'] ?></td>
                                    <td><?php echo $consulta['Consulta']['email'] ?></td>
                                    <td class="center"><?php echo $consulta['Consulta']['data'] ?></td>
                                    <td class="center"><?php echo $consulta['Consulta']['hora'] ?></td>
                                    <td class="center">
                                        <button onclick="excluir_consulta(<?php echo $consulta['Consulta']['id'] ?>);" type="button" class="btn btn-danger btn-circle"><i class="fa fa-times"></i></button>
                                        <button onclick="editar_consulta(<?php echo $consulta['Consulta']['id'] ?>);" type="button" class="btn btn-info btn-circle"><i class="fa fa-edit"></i></button>
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
    </div>
</div>

<script type="text/javascript">
    function excluir_consulta(id) {
        $.ajax({
            type: "post",
            dataType: "json",
            url: "/consulta/excluir_consulta",
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
    function editar_consulta(id) {
        window.location.href = "/consulta/editar_consulta/"+id;
    }
</script>
