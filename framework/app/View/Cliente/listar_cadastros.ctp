
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Cliente - Listar Cadastros</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-9">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Listagem dos Clientes
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-cliente">
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Sobrenome</th>
                                    <th>E-mail</th>
                                    <th>Documento</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>                   
                            <?php
                            foreach ($clientes as $indice => $cliente) {
                            ?>             
                                <tr class="odd gradeX" id="<?php echo $cliente['Cliente']['id'] ?>">
                                    <td><?php echo $cliente['Cliente']['nome1'] ?></td>
                                    <td><?php echo $cliente['Cliente']['nome2'] ?></td>
                                    <td><?php echo $indice ?></td>
                                    <td class="center"><?php echo $cliente['Cliente']['documento1'] ?></td>
                                    <td class="center">
                                        <button onclick="remover_cliente(<?php echo $cliente['Cliente']['id'] ?>);" type="button" class="btn btn-danger btn-circle"><i class="fa fa-times"></i></button>
                                        <button onclick="editar_cliente(<?php echo $cliente['Cliente']['id'] ?>);" type="button" class="btn btn-info btn-circle"><i class="fa fa-edit"></i></button>
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
                    <button type="button" class="btn btn-primary"><i class="fa fa-plus"><a href="/cliente/adicionar_cliente" style="color: #FFF;"> Adicionar Cliente</a></i>
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
