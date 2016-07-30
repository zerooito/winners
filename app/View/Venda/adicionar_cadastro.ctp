<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default" style="margin-top: 12px;">
                <div class="panel-heading">
                    Dados da Venda
                </div>
                <div class="panel-body">
                    <form role="form" action="/venda/s_adicionar_cadastro" method="post" id="form-venda">
                        <div class="row">
                            <div class="col-lg-6">
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
                                <hr>
                                <div class="row" id="opcoes_pagamento">

                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Forma de Pagamento</label>
                                            <select class="form-control" id="forma_pagamento" name="lancamento[forma_pagamento]">
                                                <option value="cartao_debito">Cartão Debito</option>
                                                <option value="cartao_credito">Cartão Credito</option>
                                                <option value="dinheiro">Dinheiro</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Desconto %</label>
                                            <input class="form-control" id="valor_desconto">
                                            <input type="hidden" value="0" name="venda[desconto]" id="desconto">
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Valor Pago</label>
                                            <input class="form-control moeda" id="valor_pago">
                                            <!-- <p class="help-block">Example block-level help text here.</p> -->
                                        </div>

                                        <a href="javascript:;" class="btn btn-primary" onclick="finalizar_venda();">Finalizar Venda</a>
                                    </div>

                                </div>
                            </div>  

                            <div class="col-lg-6"></div>
                            <div class="col-lg-6">
                                <div class="jumbotron">
                                  <p>Valor total</p>
                                  <h1 id="valor-atual" data-preco="0.00" style="color: green">R$ 0.00</h1>
                                  <p>Valor troco</p>
                                  <h3 id="troco" data-troco="0.00" style="color: red">R$ 0.00</h3>
                                </div>                                
                            </div>
                            <!-- /.col-lg-6 (nested) -->
                            
                            <!-- /.col-lg-6 (nested) -->
                            <div class="col-lg-12" style="margin-top: 10px;">
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

                                    </div>
                                </div>
                            </div>                          
                        </div>

                        <div class="text-right">
                            <input type="hidden" name="venda[orcamento]" value="0" id="orcamento">
                            <?php if (isset($modulos['orcamento'])): ?>
                                <a href="javascript:salvarOrcamento();" class="btn btn-info">Salvar Orçamento</a>
                            <?php endif; ?>
                            <button type="submit" class="btn btn-success">Salvar Venda</button>
                        </div>
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
        var quantidade_produto  = parseFloat($('#quantidade_produto').val());
        var valor_venda_atual   = $('#valor-atual').attr('data-preco');

        if (isNaN(quantidade_produto))
        {
            $('#produto_item').focus();
            return;
        }

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
                $('#valor-atual').attr('data-preco', novo_valor_venda).html('R$ ' + number_format(novo_valor_venda, 2, ',', '.'));
                $('#quantidade_produto').val('');
            }
        });
    }

    function finalizar_venda() {
        var valor_venda_atual   = $('#valor-atual').attr('data-preco');
        var valor_pago          = $('#valor_pago').val();

        troco = valor_pago - valor_venda_atual.replace(',', '.');
            
        if (troco < 0)
            troco = 0.00; 

        $('#troco').attr('data-troco', troco).html('R$ ' + number_format(troco, 2, ',', '.'));

        $('#form-venda').attr('action', '/venda/s_adicionar_cadastro');
    }

    function continuar_venda() {        
        $('input').removeAttr('disabled');
        $('select').removeAttr('disabled');
    }
    
    function salvarOrcamento() {
        $('#orcamento').val(1);

        $('#form-venda').submit();
    }

    $('#valor_desconto').change(function(){
        var valor_venda_atual = $('#valor-atual').attr('data-preco');
        var valor_desconto    = $('#valor_desconto').val();

        novo_valor_venda = parseFloat(valor_venda_atual) - ((parseFloat(valor_desconto) * parseFloat(valor_venda_atual)) / 100);

        $('#desconto').val((parseFloat(valor_desconto) * parseFloat(valor_venda_atual)) / 100);
        $('#valor-atual').attr('data-preco', number_format(novo_valor_venda, 2, ',', '.')).html('R$ ' + number_format(novo_valor_venda, 2, ',', '.'));
    });

    $("#quantidade_produto").keyup(function() {
        v = $(this).val();
        $(this).val(v.replace(/\D/g,"")); //Remove tudo o que não é dígito
    });

    /* ATALHOS TECLADO */
    
    $('body').keydown(function(e) {
        var key = e.keyCode; // this value
        console.log(key);

        // CONTINUAR VENDA (q);
        if (key == 81)
        {
            finalizar_venda();
        }
        // ADICIONAR ITEM (w)
        if (key == 87)
        {
            adicionar_produto();
        }
    }); 
</script>