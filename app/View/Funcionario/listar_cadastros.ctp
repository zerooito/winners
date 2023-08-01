
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Funcionários - Listar Cadastros</h1>
    </div>

    <!-- /.row -->
    <div class="row">
        <div class="col-lg-9">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Listagem dos Funcionários
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
                            <?php if (!$this->Permissoes->usuario_possui_permissao_para('funcionario', 'read')): ?>
                                <tr>
                                    <td>Você não possui permissão para visualizar funcionarios.</td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($funcionarios as $indice => $funcionario): ?>             
                                    <tr class="odd gradeX" id="<?php echo $funcionario['Funcionario']['id'] ?>">
                                        <td>
                                            <?php echo $funcionario['Usuario']['nome'] ?>
                                        </td>
                                        <td>
                                            R$ <?php echo number_format($funcionario['Funcionario']['salario'], 2, ',', '.') ?>
                                        </td>
                                        <td>
                                            <?php echo $funcionario['Usuario']['email'] ?>
                                        </td>
                                        <td class="center">
                                            <?php echo $funcionario['Funcionario']['cpf'] ?>
                                        </td>
                                        <td class="center">
                                            <?php if ($this->Permissoes->usuario_possui_permissao_para('funcionario', 'write')): ?>
                                                <button onclick="remover_funcionario(<?php echo $funcionario['Funcionario']['id'] ?>);" type="button" class="btn btn-danger">
                                                    <i class="fa fa-times"></i>
                                                </button>
                                            <?php endif; ?>

                                            <?php  if ($this->Permissoes->usuario_possui_permissao_para('funcionario', 'read')): ?>
                                                <a class="btn btn-primary" title="Listar Pedidos deste Funcionario" href="/funcionario/listar_pedidos/<?php echo $funcionario['Funcionario']['id'] ?>">
                                                    <i class="fa fa-list"></i>
                                                </a>
                                            <?php endif; ?>
                                        </td>
                                    </tr>   
                                <?php endforeach; ?>
                            <?php endif; ?>
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
                <?php if ($this->Permissoes->usuario_possui_permissao_para('funcionario', 'write')): ?>
                    <div class="panel-body">
                        <a href="/funcionario/adicionar_funcionario" class="btn btn-primary" style="width: 100%; color: #FFF;"><i class="fa fa-plus"></i> Adicionar Funcionário</a>
                    </div>
                <?php endif; ?>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
    </div>
</div>

<script type="text/javascript">
    function remover_funcionario(id) {
        swal({
          title: 'Você tem certeza?',
          text: "Somente confirme se você tiver certeza desta ação!",
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Sim!',
          cancelButtonText: 'Não.'
        }).then(function(){      
            $.ajax({
                type: "post",
                dataType: "json",
                url: "/funcionario/excluir_funcionario",
                async: true,
                data: {id: id},
                error: function(x){
                    swal(
                        'Deletado!',
                        'Seu registro foi deletado do sistema.',
                        'success'
                    );

                    window.location.reload();            
                },
                success: function(x){
                    window.location.reload();                
                }
            });
        });
    }
</script>
