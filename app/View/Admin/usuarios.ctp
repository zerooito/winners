
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Cliente - Listar Cadastros</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
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
                                    <th>E-mail</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>    
                                <?php foreach ($usuarios as $usuario): ?>
                                <tr class="odd gradeX">
                                    <td><?php echo $usuario['nome'] ?></td>
                                    <td><?php echo $usuario['email'] ?></td>
                                    <td class="center">
                                        <button type="button" class="btn btn-danger btn-circle">
                                            <i class="fa fa-times"></i>
                                        </button>
                                        <button type="button" class="btn btn-info btn-circle">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                    </td>
                                </tr>   
                                <?php endforeach; ?>
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
