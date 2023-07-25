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
                        <h5 class="card-title">Bradesco (principal)</h5>
                        <p class="card-text">R$ 35.655,75.</p>
                        <a href="javascript:;" class="btn btn-primary">Ver Detalhes</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Conta Não Encontrada?</h5>
                    <p class="card-text">R$ 0.00.</p>
                    <a href="javascript:;" class="btn btn-success">Adicionar Conta</a>
                </div>
            </div>
        </div>
    </div>
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
                        <input type="text" class="form-control" id="nome" name="contas[nome]">
                    </div>
                    <div class="form-group">
                        <label for="nome">Saldo:</label>
                        <input type="text" class="form-control moeda" id="saldo" name="contas[saldo]">
                    </div>
                    <div class="form-group">
                        <label for="nome">Principal:</label>
                        <select type="principal" class="form-control" id="principal" name="contas[principal]">
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