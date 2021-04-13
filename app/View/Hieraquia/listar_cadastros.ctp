
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Hieraquias - Listar Hieraquias</h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-lg-9">
            <div class="panel panel-default">
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-cliente">
                            <thead>
                                <tr>
                                    <th width="80%">Nome</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>                   
                            <?php
                            foreach ($hieraquias as $i => $hieraquia) {
                            ?>             
                                <tr class="odd gradeX" id="<?php echo $hieraquia['Hieraquia']['id'] ?>">
                                    <td><?php echo $hieraquia['Hieraquia']['nome'] ?></td>
                                    <td class="right">
                                        <a href="/hieraquia/visualizar/<?php echo $hieraquia['Hieraquia']['id'] ?>" class="btn btn-info">
                                            <i class="fa fa-eye" aria-hidden="true"></i>
                                        </a>
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
                    <a href="/hieraquia/adicionar_hieraquia" style="color: #FFF;width: 100%;" class="btn btn-primary">
                        <i class="fa fa-plus"></i> Adicionar Hieraquia
                    </a>

                    <a href="/hieraquia/listar_subusuarios" class="btn btn-success" style="color: #FFF;margin-top: 10px;width: 100%;">
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
