
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Financeiro - Geral</h1>
    </div>

    <!-- /.row -->
    <div class="row">
        <div class="col-lg-6">  
            <div class="text-right">
                <div class="card bg-danger text-white shadow">
                    <div class="card-body">
                        <b>R$</b> <?php echo number_format($lancamentos['a_pagar'], 2, ',', '.'); ?>
                        <div class="text-white-50 small">A Pagar</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">  
            <div class="text-right">
                <div class="card bg-success text-white shadow">
                    <div class="card-body">
                        <b>R$</b> <?php echo number_format($lancamentos['pago'], 2, ',', '.'); ?>
                        <div class="text-white-50 small">Pago</div>
                    </div>
                </div>

                <small>As informações listadas são referentes ao ano <?php echo date('Y'); ?> para informações de outros periodos utilize os filtros abaixo.</small>
            </div>
        </div>
    </div>
    <br>

    <!-- /.row -->
    <div class="row">
        <div class="col-lg-9">
            <div class="panel panel-default">
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="datatable-financeiro">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Tipo</th>
                                    <th>Vencimento</th>
                                    <th>Valor</th>
                                    <th>Categoria</th>
                                    <th>Descrição</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>                  

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
                    <?php if ($this->Permissoes->usuario_possui_permissao_para('financeiro', 'write')): ?>
                        <a href="#" style="width:100%;" class="btn btn-primary add-fornecedor"> 
                            <i class="fa fa-truck"></i>
                            Fornecedores
                        </a>

                        <a href="#" style="margin-top:10px;color: #FFF;width:100%;" class="btn btn-primary add-transacao"> 
                            <i class="fa fa-plus"></i> 
                            Adicionar Transação
                        </a>

                        <a href="#" style="margin-top:10px;width:100%;" class="btn btn-success add-categoria"> 
                            <i class="fa fa-plus"></i> 
                            Cadastrar Categorias
                        </a>
                    <?php else: ?>
                        <b>Você nao possui acesso para executar ações</b>
                    <?php endif; ?>
                    <hr>

                    <?php if ($this->Permissoes->usuario_possui_permissao_para('financeiro', 'read')): ?>
                        <h3>Filtros</h3>

                        <div class="form-group">
                            <label>Por categoria: </label>
                            <select id="categorias" style="width:100%;"></select>
                        </div>

                        <div class="form-group">
                            <label>Tipo: </label>
                            <select id="tipo" style="width:100%;">
                                <option value="-1">Todos</option>
                                <option value="despesa">Despesa</option>
                                <option value="receita">Receita</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Data Pagamento: </label>
                            <input type="date" name="pagamento" id="pagamento" style="width:100%;">
                        </div>

                        <div class="form-group">
                            <label>Data Vencimento: </label>
                            <input type="date" name="vencimento" id="vencimento" style="width:100%;">
                        </div>

                        <div class="form-group">
                            <label>Fornecedor: </label>
                            <select id="fornecedor" style="width:100%;"></select>
                        </div>

                        <a href="javascript:;" style="margin-top:10px;width:100%;" class="btn btn-primary" id="clear-filter"> 
                            <i class="fa fa-eraser"></i> 
                            Limpar Filtros
                        </a>
                    <?php endif; ?>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
    </div>
</div>

<?php if ($this->Permissoes->usuario_possui_permissao_para('financeiro', 'write')): ?>
    <!-- Modal -->
    <div class="modal fade" id="addCategoria" role="dialog" aria-labelledby="myModalLabel">
        <form class="form" action="/financeiro/adicionar_categoria" method="POST">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel">Adicionar Categorias Financeiro</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nome">Nome:</label>
                            <input type="nome" class="form-control" id="nome" name="categoria[nome]">
                        </div>
                        <div class="form-group">
                            <label for="tipo">Tipo: </label>
                            <select class="form-control" style="width: 100%;" name="categoria[tipo]">
                                <option value="receita">Receita</option>
                                <option value="despesa">Despesa</option>
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

    <!-- Modal -->
    <div class="modal fade" id="addFornecedor" role="dialog" aria-labelledby="myModalLabel">
        <form class="form" action="/financeiro/adicionar_fornecedor" method="POST">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel">Adicionar Fornecedor</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nome">Nome:</label>
                            <input type="nome" class="form-control" id="nome" name="fornecedor[nome]">
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

    <!-- Modal -->
    <div class="modal fade" id="addTransacao" role="dialog" aria-labelledby="myModalLabel">
        <form class="form" action="/financeiro/adicionar_transacao" method="POST">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel">Adicionar Transação</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="date">Data de Vencimento:</label>
                            <input type="date" class="form-control" id="data_vencimento" name="transacao[data_vencimento]" required>
                        </div>
                        <div class="form-group">
                            <label for="date">Data de Pagamento:</label>
                            <input type="date" class="form-control" id="data_pgt" name="transacao[data_pgt]" required>
                        </div>
                        <div class="form-group">
                            <label for="tipo">Tipo: </label>
                            <select class="form-control" name="transacao[tipo]" style="width:100%;">
                                <option value="receita">Receita</option>
                                <option value="despesa">Despesa</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="conta">Contas:</label>
                            <select class="form-control" name="transacao[conta_id]" style="width:100%;">
                                <option value="-1">Sem Conta</option>
                                <?php foreach ($contas as $conta): ?>
                                    <option value="<?php echo $conta['Contas']['id'] ?>"><?php echo $conta['Contas']['nome'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="categoria">Categoria:</label>
                            <select class="form-control" name="transacao[lancamento_categoria_id]" id="categoria-transacao" style="width:100%;"></select>
                        </div>
                        <div class="form-group">
                            <label for="categoria">Fornecedor:</label>
                            <select class="form-control" name="transacao[fornecedore_id]" id="fornecedor-transacao" style="width:100%;"></select>
                        </div>
                        <div class="form-group">
                            <label for="valor">Valor:</label>
                            <input type="valor" class="form-control moeda" id="valor" name="transacao[valor]">
                        </div>
                        <div class="form-group">
                            <label for="descricao">Descrição:</label>
                            <input type="descricao" class="form-control descricao" id="descricao" name="transacao[descricao]">
                        </div>
                        <div class="form-group">
                            <label for="valor">Pago:</label>
                            <select class="form-control" name="transacao[pago]" style="width:100%;">
                                <option value="1">Sim</option>
                                <option value="0">Não</option>
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
<?php endif; ?>

<script type="text/javascript">
    $(window).load(function(){
        $('#categoria-conta').select2({
            dropdownParent: "#addContas",
            placeholder: 'Escolha a conta',
            ajax: {
                url: "/financeiro/carregar_contas",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        q: params.term // search term
                    };
                },
                processResults: function (data) {
                    // parse the results into the format expected by Select2.
                    // since we are using custom formatting functions we do not need to
                    // alter the remote JSON data
                    return {
                        results: data
                    };
                },
                cache: true
            },
            minimumInputLength: 2
        });

        $('#categorias, #categoria-transacao').select2({
            dropdownParent: "#addTransacao",
            placeholder: 'Escolha a categoria',
            ajax: {
                url: "/financeiro/carregar_categorias",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        q: params.term // search term
                    };
                },
                processResults: function (data) {
                    // parse the results into the format expected by Select2.
                    // since we are using custom formatting functions we do not need to
                    // alter the remote JSON data
                    return {
                        results: data
                    };
                },
                cache: true
            },
            minimumInputLength: 2
        });

        $('#fornecedor, #fornecedor-transacao').select2({
            dropdownParent: "#addTransacao",
            placeholder: 'Escolha um fornecedor',
            ajax: {
                url: "/financeiro/carregar_fornecedores",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        q: params.term // search term
                    };
                },
                processResults: function (data) {
                    // parse the results into the format expected by Select2.
                    // since we are using custom formatting functions we do not need to
                    // alter the remote JSON data
                    return {
                        results: data
                    };
                },
                cache: true
            },
            minimumInputLength: 2
        });

        $('#clientes').select2({
            placeholder: 'Escolha o cliente',
            ajax: {
                url: "/cliente/carregar_clientes",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        q: params.term // search term
                    };
                },
                processResults: function (data) {
                    // parse the results into the format expected by Select2.
                    // since we are using custom formatting functions we do not need to
                    // alter the remote JSON data
                    return {
                        results: data
                    };
                },
                cache: true
            },
            minimumInputLength: 2
        });
    });
    
    $(document).ready(function(){
        $('.add-fornecedor').click(function() { 
            $('#addFornecedor').modal('show');
        });

        $('.add-transacao').click(function() { 
            $('#addTransacao').modal('show');
        });

        $('.add-categoria').click(function() { 
            $('#addCategoria').modal('show');
        });
        
        var datatable = $('#datatable-financeiro').dataTable({
            "bServerSide": true,
            // "bFilter": false,
            "iDisplayStart": 0,
            "sAjaxDataProp": "data",
            "aaSorting": [
                [ 0, "desc" ]
            ],
            "sAjaxSource": "/financeiro/listar_cadastros_ajax"
        });

        // $(document.body).on("change", "#clientes", function() {
        //     $('#datatable-financeiro').dataTable().fnFilter('lancamento_categoria_id:' + this.value);
        // });

        $(document.body).on("change", "#categorias", function() {
            $('#datatable-financeiro').dataTable().fnFilter('lancamento_categoria_id:' + this.value);
        });

        $(document.body).on("change", "#tipo", function() {
            console.log(this.value);
            $('#datatable-financeiro').dataTable().fnFilter('tipo:' + this.value);
        });

        $(document.body).on("change", "#pagamento", function() {
            $('#datatable-financeiro').dataTable().fnFilter('pagamento:' + this.value);
        });

        $(document.body).on("change", "#vencimento", function() {
            $('#datatable-financeiro').dataTable().fnFilter('vencimento:' + this.value);
        });

        $(document.body).on("change", "#fornecedor", function() {
            $('#datatable-financeiro').dataTable().fnFilter('fornecedor:' + this.value);
        });

        $('#clear-filter').click(function(){
            $('#categorias').val("-1").change();
            $('#tipo').val("-1").change();
            $('#pagamento').val("");
            $('#vencimento').val("");
        });
    });

</script>

<style type="text/css">
    
    .huge {
        font-size: 25px;
    }

    select {
         width: 100%;
    }

</style>