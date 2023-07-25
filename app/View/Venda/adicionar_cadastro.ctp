<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Vendas - PDV</h1>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Dados da Venda 

                    (<a href="javascript:;" onclick="$('#showHints').modal();"> Dicas </a>) 

                    (<a href="javascript:;" onclick="$('#startSales').modal();"> Iniciar Caixa </a>) 

                    (<a href="javascript:;" onclick="closeSales();"> Fechar Caixa </a>) 
                </div>
                <div class="panel-body">
                    <br>
                    <div class="alert alert-primary" style="display: none;" id="status_caixa"></div> 
                    <form role="form" action="/venda/s_adicionar_cadastro" method="post" id="form-venda">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Produto</label>
                                            <select class="select2 form-control" id="produto_item"></select>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Quantidade</label>
                                            <input class="form-control" id="quantidade_produto">
                                        </div>

                                        <a href="javascript:;" class="btn btn-primary" id="adicionar_item" onclick="adicionar_produto();">Adicionar Item</a>
                                    </div>

                                </div>
                                
                                <hr>

                                <div class="row" style="margin-top: 15px;">
                                    <div class="col-lg-6">
                                        <label>Desconto</label>
                                        <div class="input-group input-group-sm">
                                            <span class="input-group-addon" id="sizing-addon3">%</span>
                                            <input type="text" class="form-control" placeholder="%" aria-describedby="sizing-addon3" id="valor_desconto_porcento" disabled>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <label>Desconto</label>
                                        <div class="input-group input-group-sm">
                                            <span class="input-group-addon" id="sizing-addon3">R$</span>
                                            <input type="text" class="form-control" placeholder="R$" aria-describedby="sizing-addon3" id="valor_desconto_fixo" disabled>
                                        </div>
                                    </div>

                                    <input type="hidden" value="0" name="venda[desconto]" id="desconto">
                                </div>

                                <hr>

                                <div class="row" id="opcoes_pagamento">
                                    <div class="col-lg-12">
                                        <div class="form-group">

                                           <!-- Tabs navs -->
                                            <ul class="nav nav-tabs" role="tablist" role="tablist">
                                                <li class="nav-item" role="presentation">
                                                    <a href="#tab-01" class="nav-link active" aria-controls="tab-01" role="tab" data-toggle="tab">Pagamento Único</a>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <a href="#tab-02" class="nav-link" aria-controls="tab-02" role="tab" data-toggle="tab">Pagamento Múltiplos</a>
                                                </li>
                                            </ul>
                                            <!-- Tabs navs -->

                                            <!-- Tabs content -->
                                            <div class="tab-content" id="ex1-content">
                                                <div role="tabpanel" class="tab-pane active" id="tab-01">
                                                    <br/>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <label>Forma de Pagamento</label>
                                                            <select class="form-control" id="forma_pagamento" name="lancamento[forma_pagamento]">
                                                                <option value="dinheiro">Dinheiro</option>
                                                                <option value="pix">Pix</option>
                                                                <option value="cartao_debito">Cartão Debito</option>
                                                                <option value="cartao_credito">Cartão Credito</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label>Valor Pago</label>
                                                                <input class="form-control moeda" id="valor_pago" name="lancamento[valor_pago]">
                                                            </div>
                                                            <a href="javascript:;" class="btn btn-primary" onclick="finalizar_venda();">Calcular Troco</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div role="tabpanel" class="tab-pane" id="tab-02">
                                                    <br/>
                                                    <div class="pagamentos">
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <label>Forma de Pagamento</label>
                                                                <select class="form-control forma_pagamento_multiplo" id="forma_pagamento_multiplo0" name="lancamento[forma_pagamento_multiplo][]">
                                                                    <option value="dinheiro">Dinheiro</option>
                                                                    <option value="pix">Pix</option>
                                                                    <option value="cartao_debito">Cartão Debito</option>
                                                                    <option value="cartao_credito">Cartão Credito</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="form-group">
                                                                    <label>Valor Pago</label>
                                                                    <input class="form-control moeda" id="valor_pago_multiplo0" name="lancamento[valor_pago_multiplo][]">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-12 text-right">
                                                            <a href="javascript:;" class="btn btn-success" onclick="add_mais_pagamento();">+ Pagamento</a>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row text-right">
                                                        <div class="col-lg-12">
                                                            <span class="badge badge-info" id="restante" data-preco="0"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <hr>

                                <div class="row" id="opcoes_cliente">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Cliente</label>
                                            <select class="select2 form-control" id="cliente" name="venda[cliente_id]">
                                                <option value="">Escolha o Cliente</option>
                                                <?php foreach ($clientes as $cliente): ?>
                                                    <option value="<?php echo $cliente['Cliente']['id']; ?>">
                                                        <?php echo $cliente['Cliente']['nome1'] . ' ' . $cliente['Cliente']['nome2']; ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>  

                            <div class="col-lg-6">
                                <div class="jumbotron" style="padding-left: 15px;">
                                  <p>Valor total </p>
                                  <h1 id="valor-atual" data-preco="0.00" style="color: green">R$ 0.00</h1>
                                  <p>Desconto</p>
                                  <h3 id="desconto-label" data-troco="0.00" style="color: red">R$ 0.00</h3>
                                  <p>Valor troco</p>
                                  <h3 id="troco" data-troco="0.00" style="color: red">R$ 0.00</h3>

                                  <hr>

                                  <h5>Valor sem desconto </h5>
                                  <h5 id="valor-original" data-preco="0.00" style="color: gray">R$ 0.00</h5>
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
                                            <th>Em estoque</th>
                                            <th>Total</th>
                                            <th>Ações</th>
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
                            <?php if ($this->Permissoes->usuario_possui_permissao_para('orcamento', 'write')): ?>
                                <?php if (isset($modulos['orcamento'])): ?>
                                    <a href="javascript:salvarOrcamento();" class="btn btn-info">Salvar Orçamento</a>
                                <?php endif; ?>
                            <?php endif; ?>
                            <?php if ($this->Permissoes->usuario_possui_permissao_para('venda', 'write')): ?>
                                <button type="submit" class="btn btn-success">Salvar Venda</button>
                            <?php endif; ?>
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

<?php if (isset($vendaId)): ?>
    <!-- Modal -->
    <div class="modal fade" id="showCupomUltimaVenda" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Imprimir Cupom Fiscal</h4>
          </div>
          <div class="modal-body text-center">
            <h3>Deseja imprimir cupom fiscal da última venda</h3>
          </div>
          <div class="modal-footer">
            <a class="btn btn-info" href="javascript:printNotaNaoFiscal(<?php echo $vendaId; ?>);">Preparar Impressão</a>
            <a href="javascript:;" style="display: none;" class="btn btn-success" id="download-txt-sale" download>Pronto Para Imprimir</a>
            <a class="btn btn-danger" href="javascript:hideModalNota(<?php echo $vendaId; ?>);">Cancelar</a>
          </div>
        </div>
      </div>
    </div>
<?php endif; ?>

<!-- Modal -->
<div class="modal fade" id="showHints" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Atalhos e Dicas do PDV</h4>
      </div>
      <div class="modal-body">
        <ul>
            <li>Procurar Produto: <b>CTRL + F</b></li>
            <li>Adicionar Produto: <b>CTRL + W</b></li>
            <li>Selecionar Metodo de Pagamento: <b>CTRL + F2</b></li>
            <li>Continuar Venda: <b>CTRL + Q</b></li>            
            <li>Salvar Venda: <b>CTRL + S</b></li>           
            <li>Salvar Orçamento: <b>CTRL + O</b></li>
            <li>Navegar entre campos: <b>TAB</b></li>
        </ul>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="startSales" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <form action="/caixa/iniciar_caixa" method="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Iniciar Caixa</h4>
                </div>
                <div class="modal-body">

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Valor Inicial Caixa</label>
                                <input type="text" required class="moeda form-control" value="0" name="caixa[valor_inicial]" id="valor_inicial">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Data</label>
                                <input type="datetime-local" required class="form-control" name="caixa[data_abertura]" id="data_abertura">
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success">Iniciar</button>
                </div>
            </div>
        </form>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="endSales" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <form action="/caixa/finalizar_caixa" method="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Finalizar Caixa</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Valor Inicial Caixa</label>
                                <input type="text" required class="moeda form-control" value="0" name="caixa[valor_inicial]" id="valor_inicial_final" readonly="">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Valor Final</label>
                                <input type="text" required class="moeda form-control" value="0" name="caixa[valor_final_total]" id="valor_final_total" readonly="">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Valor Crédito</label>
                                <input type="text" required class="moeda form-control" value="0" name="caixa[valor_final_cartao_credito]" id="valor_final_cartao_credito" readonly="">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Valor Débito</label>
                                <input type="text" required class="moeda form-control" value="0" name="caixa[valor_final_cartao_debito]" id="valor_final_cartao_debito" readonly="">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Valor Dinheiro</label>
                                <input type="text" required class="moeda form-control" value="0" name="caixa[valor_final_dinheiro]" id="valor_final_dinheiro" readonly="">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Valor PIX (Outros)</label>
                                <input type="text" required class="moeda form-control" value="0" name="caixa[valor_final_outros]" id="valor_final_outros" readonly="">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Data Abertura</label>
                                <input type="datetime-local" required class="form-control" name="caixa[data_abertura]" id="data_abertura_final" readonly="">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Data Fechamento</label>
                                <input type="datetime-local" required class="form-control" name="caixa[data_fechamento]" id="data_fechamento">
                            </div>
                        </div>
                        <input type="hidden" id="id_caixa" name="caixa[id]">
                        <div class="col-lg-6">
                            <p> Total Caixa: <i id="total_caixa"></i> </p>
                            <p> Total Vendido: <i id="vendido"></i> </p>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-danger">Finalizar</button>
                </div>
            </div>
        </form>
    </div>
</div>


<script type="text/javascript">
    var controle_pagamentos = 0;

    /* ATALHOS TECLADO */  
    $('body').keydown(function(e){  
        var evt = evt || window.event;
        
        var key = evt.keyCode; // this value

        if (key == 13)
            return e.preventDefault(); 

        if (e.ctrlKey || e.metaKey) {

            e.preventDefault();

            // CONTINUAR VENDA (q);
            if (key == 81)
            {
                finalizar_venda();
            }

            if (key == 113) //f2
            {
                $('#forma_pagamento').select2("open");
            }
            
            // ADICIONAR ITEM (A)
            if (key == 65)
            {
                adicionar_produto();
            }

            // PROCURAR ITEM (F)
            if (key == 70)
            {
                $("#produto_item").select2("open");
            }

            // REGISTRAR VENDA
            if (key == 83) 
            {
                $('#form-venda').submit();
            }

            if (key == 79)
            {
                salvarOrcamento();
            }
        }

    }); 

    <?php if (isset($vendaId)): ?>
        $('#showCupomUltimaVenda').modal('show');
    <?php endif; ?>

    function hideModalNota(id) {

        $('#showCupomUltimaVenda').modal('hide');

        $.ajax({
            type: "get",
            dataType: "json",
            url: "/venda/clear_session_venda/" + id,
            error: function(data){
                console.log(data);
            },
            success: function(data){
                console.log(data);
            }
        });

    }

    function printNotaNaoFiscal(id) {
        $.ajax({
            type: "get",
            dataType: "json",
            url: "/venda/imprimir_nota_nao_fiscal/" + id,
            error: function(data){
                alert('Ocorreu um erro.');
                console.log(data);
            },
            success: function(data){
                url = '/uploads/venda/fiscal/' + data['file'];
                $('#download-txt-sale').css('display', 'initial').attr('href', url);
            }
        });

        $.ajax({
            type: "get",
            dataType: "json",
            url: "/venda/clear_session_venda/" + id,
            error: function(data){
                console.log(data);
            },
            success: function(data){
                console.log(data);
            }
        });
    }

    function openInNewTab(url) {
        var win = window.open(url, '_blank');
        win.focus();
    }

    function closeSales() {
        $.ajax({
            type: "GET",
            dataType: "json",
            url: "/caixa/carregar_fechamento_caixa_dia_ajax",
            success: function(data) {
                $('#data_abertura_final').val(data['caixa_atual']['Caixa']['data_abertura']);
                $('#valor_inicial_final').val(number_format(data['caixa_atual']['Caixa']['valor_inicial'],2,',','.'));
                $('#data_fechamento').val(data['caixa_atual']['Caixa']['data_fechamento']);
                $('#valor_final_total').val(number_format(data['total_vendas'], 2, ',', '.'));
                $('#valor_final_dinheiro').val(number_format(data['total_dinheiro'], 2, ',', '.'));
                $('#valor_final_cartao_debito').val(number_format(data['total_cartao_debito'], 2, ',', '.'));
                $('#valor_final_cartao_credito').val(number_format(data['total_cartao_credito'], 2, ',', '.'));
                $('#valor_final_outros').val(number_format(data['total_outros'], 2, ',', '.'));
                $('#id_caixa').val(data['caixa_atual']['Caixa']['id']);

                $('#vendido').html('R$ ' + number_format(data['vendido'], 2, ',', '.'));
                $('#total_caixa').html('R$ ' + number_format(data['total_vendas'], 2, ',', '.'));

                $('#endSales').modal();
            },
            error: function(data) {
                console.log(data);
            }
        })
    }

    function adicionar_produto(id=null, quantidade_produto=null) {
        $('#desconto').val('');
        $('#desconto-label').html('R$ 0.00');
        
        var produto_item        = (id != null) ? id : $('#produto_item').val();
        var quantidade_produto  = quantidade_produto != null ? quantidade_produto : parseFloat($('#quantidade_produto').val());
        var valor_venda_atual   = $('#valor-atual').attr('data-preco');

        if (isNaN(quantidade_produto))
        {
            $('#produto_item').css('border-color', 'red').focus();
            return;
        }

        $('#produto_item').css('border-color', 'gray');

        $.ajax({
            type: "post",
            dataType: "json",
            url: "/produto/carregar_dados_venda_ajax",
            data: {
                id:  produto_item,
                qnt: quantidade_produto
            },
            success: function(data){
                if (data['status'] === false) {
                    alert(data['msg']);
                    return;
                }

                var html = '';

                if ($('#' + + data['Produto']['id']).length > 0) {
                    alert('Produto já adicionado');
                    return;
                }
                
                html += '<tr id="' + data['Produto']['id'] + '">';
                html +=    '<input type="hidden" name="produto[' + data['Produto']['id'] + '][id_produto]" value="' + data['Produto']['id'] + '"/>';
                html +=    '<input type="hidden" name="produto[' + data['Produto']['id'] + '][quantidade]" value="' + quantidade_produto + '"/>';
                html +=    '<td>' + data['Produto']['id'] + '</td>';
                html +=    '<td>' + data['Produto']['nome'] + '</td>';
                html +=    '<td>' + data['Produto']['preco'] + '</td>';
                html +=    '<td><input type="number" class="form-control" onchange="changeItem(' + data['Produto']['id'] + ');" id="qnt-' + data['Produto']['id'] + '" value="' + quantidade_produto + '"></td>';
                html +=    '<td>' + data['Produto']['estoque'] + '</td>';
                html +=    '<td id="' + data['Produto']['id'] + '-total">' + data['Produto']['total'] + '</td>';
                html +=    '<td><a href="javascript:removeItem(\'' + data['Produto']['id'] + '\');" class="btn btn-danger btn-sm"><i class="fa fa-times"></i></a></td>';
                html += '</tr>';

                $('#produtos').append(html);

                var novo_valor_venda = parseFloat(valor_venda_atual) + parseFloat(data['Produto']['total']);
                
                $('#valor-atual').attr('data-preco', novo_valor_venda).html('R$ ' + number_format(novo_valor_venda, 2, ',', '.'));
                $('#restante').attr('data-preco', novo_valor_venda).html('R$ ' + number_format(novo_valor_venda, 2, ',', '.'));

                $('#valor-original').attr('data-preco', novo_valor_venda).html('R$ ' + number_format(novo_valor_venda, 2, ',', '.'));

                $('#quantidade_produto').val('');

                $('#valor_desconto_porcento').removeAttr('disabled');
                $('#valor_desconto_fixo').removeAttr('disabled');
            }
        });
    }

    function removeItem(id) {
        total = $('#' + id + '-total').html();

        var valor_venda_atual = $('#valor-atual').attr('data-preco');

        var novo_valor_venda = parseFloat(valor_venda_atual) - parseFloat(total);

        $('#valor-atual').attr('data-preco', novo_valor_venda).html('R$ ' + number_format(novo_valor_venda, 2, ',', '.'));

        $('#' + id).remove();
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

    function add_mais_pagamento() {
        var valor_venda_atual = $('#valor-atual').attr('data-preco') * 1.0;
        var restante = $('#restante').attr('data-preco') * 1.0;

        for (var i = 0; i <= controle_pagamentos; i++) {
            valor = $('#valor_pago_multiplo' + i).val();

            if (valor == "") {
                alert('O valor não pode ser vazio.');
                return;
            }

            if (valor > restante) {
                alert('O valor inserido é maior que o valor faltante para pagar.');
                return;
            }

            restante -= valor;
        }
        
        if (restante <= 0 || isNaN(restante)) {
            $('#restante').html('R$ ' + number_format(0, 2, ',', '.'));
            alert('Não existe mais valor a ser pago.');
            return;
        }

        controle_pagamentos++;

        html = '';
        html += '<div class="row">';
        html += '    <div class="col-lg-6">';
        html += '        <label>Forma de Pagamento</label>';
        html += '        <select class="form-control forma_pagamento_multiplo" id="forma_pagamento_multiplo' + controle_pagamentos + '" name="lancamento[forma_pagamento_multiplo][]">';
        html += '            <option value="dinheiro">Dinheiro</option>';
        html += '            <option value="pix">Pix</option>';
        html += '            <option value="cartao_debito">Cartão Debito</option>';
        html += '            <option value="cartao_credito">Cartão Credito</option>';
        html += '        </select>';
        html += '    </div>';
        html += '    <div class="col-lg-6">';
        html += '        <div class="form-group">';
        html += '            <label>Valor Pago</label>';
        html += '            <input class="form-control moeda" id="valor_pago_multiplo' + controle_pagamentos + '" name="lancamento[valor_pago_multiplo][]" value="' + number_format(restante, 2, '.', ',') + '">';
        html += '        </div>';
        html += '    </div>';
        html += '</div>';

        $('.pagamentos').append(html);
        $('#restante').html('R$ ' + number_format(restante, 2, ',', '.'));

        $('.moeda').maskMoney();
    }

    function continuar_venda() {        
        $('input').removeAttr('disabled');
        $('select').removeAttr('disabled');
    }
    
    function salvarOrcamento() {
        $('#orcamento').val(1);

        $('#form-venda').submit();
    }

    function caixaEstaAbertoOuFechado() {
        $.ajax({
            type: "GET",
            dataType: "json",
            url: "/caixa/caixa_foi_aberto",
            success: function(data) {
                if (data['status'] == 'nao_aberto') {
                    $('#status_caixa').show().html('Você ainda não abriu o caixa');
                }

                if (data['status'] == 'aberto') {
                    $('#status_caixa').show().html('Você abriu o caixa no dia: ' + data['data_abertura']);
                }
            },
            error: function(data) {
                console.log(data);
            }
        })
    }

    $('#valor_desconto_porcento').change(function(){
        var valor_venda_atual = $('#valor-original').attr('data-preco');
        var valor_desconto    = $('#valor_desconto_porcento').val();

        novo_valor_venda = parseFloat(valor_venda_atual) - ((parseFloat(valor_desconto) * parseFloat(valor_venda_atual)) / 100);

        $('#desconto').val((parseFloat(valor_desconto) * parseFloat(valor_venda_atual)) / 100);
        $('#desconto-label').html(number_format(((parseFloat(valor_desconto) * parseFloat(valor_venda_atual)) / 100), 2, ',', '.'));
        $('#valor-atual').attr('data-preco', number_format(novo_valor_venda, 2, ',', '.')).html('R$ ' + number_format(novo_valor_venda, 2, ',', '.'));
        $('#restante').attr('data-preco', novo_valor_venda).html('R$ ' + number_format(novo_valor_venda, 2, ',', '.'));

        $('#valor_desconto_fixo').val('');
    });

    $('#valor_desconto_fixo').change(function(){
        var valor_venda_atual = $('#valor-original').attr('data-preco');
        var valor_desconto    = $('#valor_desconto_fixo').val();

        novo_valor_venda = parseFloat(valor_venda_atual) - parseFloat(valor_desconto);

        $('#desconto').val(parseFloat(valor_desconto));
        $('#desconto-label').html(number_format(parseFloat(valor_desconto), 2, ',', '.'));
        $('#valor-atual').attr('data-preco', number_format(novo_valor_venda, 2, ',', '.')).html('R$ ' + number_format(novo_valor_venda, 2, ',', '.'));
        $('#restante').attr('data-preco', novo_valor_venda).html('R$ ' + number_format(novo_valor_venda, 2, ',', '.'));

        $('#valor_desconto_porcento').val('');
    });

    $(window).load(function(){
        caixaEstaAbertoOuFechado();
        $('#produto_item').select2({        
            ajax: {
                url: "/produto/produto_item",
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

    $("#quantidade_produto").keyup(function() {
        v = $(this).val();

        $(this).val(v.replace(/[^\d.-]/g, '')); //Remove tudo o que não é dígito
    });

    function changeItem(id) {
        val = $('#qnt-' + id).val();

        removeItem(id);

        adicionar_produto(id, val);
    }

</script>
