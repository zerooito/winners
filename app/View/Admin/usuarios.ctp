
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

        <div class="col-lg-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Ações
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <a href="#" class="top-button green" data-toggle="modal" data-target="#myModal">Adicionar Usuário</a>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <form action="/usuario/novo_usuario" method="post">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Informe seus Dados</h4>
      </div>
      <div class="modal-body">
          <label style="margin-bottom: 5px;">Nome </label>
          <input type="text" class="form-control" name="dados[nome]" style="margin-left:0px;margin-bottom: 15px;" placeholder="Digite seu nome"/>
          <label style="margin-bottom: 5px;">Email </label>
          <input type="text" class="form-control" name="dados[email]" style="margin-left:0px;margin-bottom: 15px;" placeholder="Digite seu e-mail" />
          <label style="margin-bottom: 5px;">Senha </label>
          <input type="password" class="form-control" name="dados[senha]" style="margin-left:0px;margin-bottom: 15px;"  placeholder="Digite sua senha"/>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-primary">Salvar</button>
      </div>
    </div>
  </div>
  </form>
</div>