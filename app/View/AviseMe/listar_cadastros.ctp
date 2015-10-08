
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Avise Me - Listar Cadastros</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Listagem dos Clientes que Precisam ser Avisados
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-categoria">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nome Produto</th>
                                    <th>Email</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>                   
                            <?php
                            foreach ($cadastros as $indice => $cadastro) {
                            ?>             
                                <tr class="odd gradeX" id="<?php echo $cadastro['AviseMe']['id'] ?>">
                                    <td><?php echo $cadastro['AviseMe']['id'] ?></td>
                                    <td class="center"><?php echo $cadastro['Produto']['nome'] ?></td>
                                    <td class="center"><?php echo $cadastro['AviseMe']['email'] ?></td>
                                    <td class="center">
                                        <button onclick="remover_cadastro(<?php echo $cadastro['AviseMe']['id'] ?>);" type="button" class="btn btn-danger btn-circle"><i class="fa fa-times"></i></button>
                                        <button onclick="enviar_email(<?php echo $cadastro['Produto']['id'] ?>, '<?php echo $cadastro['AviseMe']['email'] ?>');" type="button" class="btn btn-info btn-circle"><i class="fa fa-send"></i></button>
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
    function remover_cadastro(id) {
        $.ajax({
            type: "post",
            dataType: "json",
            url: "/avise_me/excluir_cadastro",
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

    function enviar_email(produto_id, email) {
        window.location.href = "/avise_me/enviar_email_aviseme/" + produto_id + '/' + email;
    }
</script>
