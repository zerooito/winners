
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default" style="margin-top: 12px;">
                <div class="panel-heading">
                    Dados da Venda
                </div>
                <div class="panel-body">
                    <form role="form" action="/venda/s_adicionar_cadastro" method="post">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Cliente</label>
                                    <select class="form-control" name="venda[id_cliente]">
                                        <?php foreach ($clientes as $cliente): ?>
                                            <option value="<?php echo $cliente['Cliente']['id'] ?>"><?php echo $cliente['Cliente']['nome1'] . ' ' . $cliente['Cliente']['nome2'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <!-- <p class="help-block">Example block-level help text here.</p> -->
                                </div>
                                <div class="form-group">
                                    <label>Valor</label>
                                    <input class="form-control moeda" name="venda[valor]" id="valor_venda" value="0.00">
                                </div>
                                <div class="form-group">
                                    <label>Custo Medio</label>
                                    <input class="form-control moeda" name="venda[custo]">
                                </div>
                            </div>
                            <!-- /.col-lg-6 (nested) -->
                            <div class="col-lg-6">
                                <div id="formas">
                                    <div class="form-group">
                                        <label>Selecione a forma de Pagamento</label>
                                        <select class="form-control" name="lancamento[forma_pagamento]">
                                            <option value="1">Boleto</option>
                                            <option value="2">Cartão de Credito</option>
                                            <option value="3">Cartão de Debito</option>
                                            <option value="4">Cheque</option>
                                        </select>
                                        <!-- <p class="help-block">Example block-level help text here.</p> -->
                                    </div>
                                    <div class="form-group">
                                        <label>Selecione o valor Pago</label>
                                        <input class="form-control moeda" name="lancamento[valor]">
                                        <!-- <p class="help-block">Example block-level help text here.</p> -->
                                    </div>
                                </div>

                                <button type="button" class="btn btn-info" aria-label="Left Align">
                                  <span class="glyphicon glyphicon glyphicon-plus" aria-hidden="true"></span>
                                  Adicionar Forma de Pagamento
                                </button>
                            </div>
                            <!-- /.col-lg-6 (nested) -->
                            <div class="col-lg-12">
                                <div class="panel panel-default">
                                    <!-- Default panel contents -->
                                    <div class="panel-heading">
                                        Produtos da Venda
                                    </div>

                                    <!-- Table -->
                                    <table class="table">
                                        <thead>
                                            <th>#</th>
                                            <th>Nome Produto</th>
                                            <th>Preço</th>
                                            <th>Quantidade</th>
                                            <th>Total</th>
                                        </thead>
                                        <tbody id="produtos">

                                        </tbody>
                                    </table>


                                    <div class="panel-footer">
                                        <div class="row">

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Produto</label>
                                                    <select class="form-control" id="produto_item">
                                                        <?php foreach ($produtos as $produto): ?>
                                                            <option value="<?php echo $produto['Produto']['id'] ?>"><?php echo $produto['Produto']['nome'] ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Quantidade</label>
                                                    <input class="form-control" id="quantidade_produto">
                                                    <!-- <p class="help-block">Example block-level help text here.</p> -->
                                                </div>

                                                <a href="javascript:;" class="btn btn-primary" id="adicionar_item" onclick="adicionar_produto();">Adicionar Item</a>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-success">Salvar Venda</button>
                        <button type="reset" class="btn btn-danger" onclick="history.go(-1);">Cancelar</button>
                    </form>
                    <!-- /.row (nested) -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
</div>
<script type="text/javascript">
    function adicionar_produto() {
        var produto_item        = $('#produto_item').val();
        var quantidade_produto  = $('#quantidade_produto').val();
        var valor_venda_atual   = $('#valor_venda').val();

        $.ajax({
            type: "post",
            dataType: "json",
            url: "/produto/carregar_dados_venda_ajax",
            data: {
                id:  produto_item,
                qnt: quantidade_produto
            },
            success: function(data){
                var html = '';
                
                html += '<tr>';
                html +=    '<input type="hidden" name="produto[' + data['Produto']['id'] + '][id_produto]" value="' + data['Produto']['id'] + '"/>';
                html +=    '<input type="hidden" name="produto[' + data['Produto']['id'] + '][quantidade]" value="' + quantidade_produto + '"/>';
                html +=    '<td>' + data['Produto']['id'] + '</td>';
                html +=    '<td>' + data['Produto']['nome'] + '</td>';
                html +=    '<td>' + data['Produto']['preco'] + '</td>';
                html +=    '<td>' + quantidade_produto + '</td>';
                html +=    '<td>' + data['Produto']['total'] + '</td>';
                html += '</tr>';

                $('#produtos').append(html);

                var novo_valor_venda = parseFloat(valor_venda_atual) + parseFloat(data['Produto']['total']);
                $('#valor_venda').val(number_format(novo_valor_venda, 2, ',', '.'));
            }
        });
    }
</script>