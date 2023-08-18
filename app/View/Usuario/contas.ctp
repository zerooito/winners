<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Minhas Contas e Carteiras</h1>
    </div>

    <!-- /.row -->
    <div class="row">
        <?php foreach ($contas as $conta): ?>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <?php if ($conta['Contas']['principal'] == true): ?>
                            <h5 class="card-title"><?php echo $conta['Contas']['nome'] ?> (principal)</h5>
                        <?php else: ?>
                            <h5 class="card-title"><?php echo $conta['Contas']['nome'] ?></h5>
                        <?php endif; ?>
                        <p class="card-text">R$ <?php echo number_format($conta['Contas']['saldo'], 2, ',', '.') ?></p>
                        <a href="javascript:;" class="btn btn-primary">Ver Detalhes</a>
                        <a href="javascript:depositarValor('<?php echo $conta['Contas']['id'] ?>', '<?php echo $conta['Contas']['nome'] ?>');" class="btn btn-danger">Depositar/Retirar</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Conta Não Encontrada?</h5>
                    <p class="card-text">R$ 0.00.</p>
                    <a href="javascript:$('#addConta').modal('show');" class="btn btn-success">Adicionar Conta</a>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="addDeposito" role="dialog" aria-labelledby="myModalLabel">
    <form class="form" action="/contas/depositar" method="POST">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Depositar ou Retirar Valor <span id="conta-nome-deposito"></span></h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nome">Ação:</label>
                        <select name="dados[acao]" class="form-control">
                            <option value="retirar">Retirar</option>
                            <option value="depositar">Depositar</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="nome">Valor:</label>
                        <input type="text" class="form-control moeda" id="deposito" name="dados[valor]">
                    </div>
                    <div class="form-group">
                        <label for="nome">Descrição:</label>
                        <input type="text" class="form-control" name="dados[descricao]">
                    </div>
                    <input type="hidden" value="" name="dados[conta_id]" id="conta-id-deposito" />
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Salvar</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- Modal -->
<div class="modal fade" id="addConta" role="dialog" aria-labelledby="myModalLabel">
    <form class="form" action="/contas/adicionar_conta" method="POST">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Adicionar Conta</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nome">Nome:</label>
                        <input type="text" class="form-control" id="nome" name="dados[nome]">
                    </div>
                    <div class="form-group">
                        <label for="nome">Saldo:</label>
                        <input type="text" class="form-control moeda" id="saldo" name="dados[saldo]">
                    </div>
                    <div class="form-group">
                        <label for="nome">Taxa Débito(%):</label>
                        <input type="text" class="form-control moeda" name="dados[taxa_debito]">
                    </div>
                    <div class="form-group">
                        <label for="nome">Taxa Crédito(%):</label>
                        <input type="text" class="form-control moeda" name="dados[taxa_credito]">
                    </div>
                    <div class="form-group">
                        <label for="nome">Taxa Outros (Pix)(%):</label>
                        <input type="text" class="form-control moeda" name="dados[taxa_outros]">
                    </div>
                    <div class="form-group">
                        <label for="nome">Principal:</label>
                        <select type="principal" class="form-control" id="principal" name="dados[principal]">
                            <option value="0">Não</option>
                            <option value="1">Sim</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Salvar</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </form>
</div>

<style>
    .col-lg-4 {
        margin-bottom: 25px !important;
    }
</style>

<script type="text/javascript">
    function depositarValor(id, nome) {
        $('#conta-nome-deposito').html(nome)
        $('#conta-id-deposito').val(id);
        $('#addDeposito').modal('show');
    }
</script>