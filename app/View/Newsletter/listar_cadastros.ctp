
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Newsletter - Listar Cadastros</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Listagem dos Cadastros
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-cliente">
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Origem</th>
                                    <th>Email</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>                   
                            <?php
                            foreach ($newsletters as $indice => $newsletter) {
                            ?>             
                                <tr class="odd gradeX" id="<?php echo $newsletter['Newsletter']['id'] ?>">
                                    <td><?php echo !empty($newsletter['Newsletter']['nome']) ? $newsletter['Newsletter']['nome'] : '-' ?></td>
                                    <td><?php echo !empty($newsletter['Newsletter']['origem']) ? $newsletter['Newsletter']['nome'] : '-' ?></td>
                                    <td><?php echo $newsletter['Newsletter']['email'] ?></td>
                                    <td class="center">
                                        <button onclick="remover_newsletter(<?php echo $newsletter['Newsletter']['id'] ?>);" type="button" class="btn btn-danger btn-circle"><i class="fa fa-times"></i></button>
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

    function remover_newsletter(id) 
    {
        $.ajax({
            type: "GET",
            dataType: "json",
            url: "/newsletter/excluir_newsletter/" + id,
            error: function(x){
                window.location.reload();
            },
            success: function(x){
                window.location.reload();                
            }
        });
    }

</script>
