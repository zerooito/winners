
<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Emitir Nota Fiscal</h1>
    </div>

    <form action="/nota_fiscal/s_adicionar_cadastro" method="POST" id="formNotaFiscal">
        <div class="row">
            <!-- Dados Gerais -->
            <div class="col-lg-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Dados Gerais</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Modelo</label>
                                    <select class="form-control" name="nota_fiscal[modelo]" id="modelo" required>
                                        <option value="55">NF-e (Modelo 55)</option>
                                        <option value="65">NFC-e - Cupom Fiscal (Modelo 65)</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Natureza da Operação</label>
                                    <input type="text" class="form-control" name="nota_fiscal[natureza_operacao]"
                                        value="Venda de mercadoria" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Destino da Operação</label>
                                    <select class="form-control" name="nota_fiscal[destino_operacao]">
                                        <option value="1">Interna</option>
                                        <option value="2">Interestadual</option>
                                        <option value="3">Exterior</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Presença do Comprador</label>
                                    <select class="form-control" name="nota_fiscal[presenca_comprador]">
                                        <option value="1">Presencial</option>
                                        <option value="2">Não presencial, internet</option>
                                        <option value="4">Entrega em domicílio</option>
                                        <option value="5">Presencial, fora do estabelecimento</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Vincular Venda (opcional)</label>
                                    <select class="form-control" name="nota_fiscal[venda_id]">
                                        <option value="">Nenhuma</option>
                                        <?php foreach ($vendas as $id => $label): ?>
                                        <option value="<?php echo $id; ?>">Venda #<?php echo $id; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="form-group">
                                    <label>Informações Complementares</label>
                                    <input type="text" class="form-control" name="nota_fiscal[informacoes_complementares]"
                                        placeholder="Texto livre (opcional)">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Destinatário -->
            <div class="col-lg-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Destinatário</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Cliente Cadastrado</label>
                                    <select class="form-control" id="cliente_select" onchange="carregar_cliente();">
                                        <option value="">Novo destinatário</option>
                                        <?php foreach ($clientes as $cliente): ?>
                                        <option value="<?php echo $cliente['Cliente']['id']; ?>">
                                            <?php echo $cliente['Cliente']['nome1'] . ' ' . $cliente['Cliente']['nome2']; ?>
                                        </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <input type="hidden" name="nota_fiscal[cliente_id]" id="cliente_id_hidden">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>CPF / CNPJ</label>
                                    <input type="text" class="form-control" name="nota_fiscal[dest_cpf_cnpj]"
                                        id="dest_cpf_cnpj" placeholder="000.000.000-00 ou 00.000.000/0001-00">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Nome / Razão Social *</label>
                                    <input type="text" class="form-control" name="nota_fiscal[dest_nome]"
                                        id="dest_nome" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Inscrição Estadual</label>
                                    <input type="text" class="form-control" name="nota_fiscal[dest_ie]"
                                        id="dest_ie" placeholder="Omitir para consumidor final">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>E-mail</label>
                                    <input type="email" class="form-control" name="nota_fiscal[dest_email]"
                                        id="dest_email">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Logradouro *</label>
                                    <input type="text" class="form-control" name="nota_fiscal[dest_logradouro]"
                                        id="dest_logradouro" required>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Número</label>
                                    <input type="text" class="form-control" name="nota_fiscal[dest_numero]"
                                        id="dest_numero" value="SN">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Complemento</label>
                                    <input type="text" class="form-control" name="nota_fiscal[dest_complemento]"
                                        id="dest_complemento">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Bairro *</label>
                                    <input type="text" class="form-control" name="nota_fiscal[dest_bairro]"
                                        id="dest_bairro" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Código IBGE Município *</label>
                                    <input type="text" class="form-control" name="nota_fiscal[dest_codigo_municipio]"
                                        id="dest_codigo_municipio" maxlength="7" required>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Cidade *</label>
                                    <input type="text" class="form-control" name="nota_fiscal[dest_cidade]"
                                        id="dest_cidade" required>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="form-group">
                                    <label>UF *</label>
                                    <input type="text" class="form-control" name="nota_fiscal[dest_uf]"
                                        id="dest_uf" maxlength="2" required>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>CEP *</label>
                                    <input type="text" class="form-control" name="nota_fiscal[dest_cep]"
                                        id="dest_cep" maxlength="8" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Itens -->
            <div class="col-lg-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex justify-content-between align-items-center">
                        <h6 class="m-0 font-weight-bold text-primary">Itens da Nota</h6>
                        <button type="button" class="btn btn-sm btn-success" onclick="adicionar_item();">
                            <i class="fa fa-plus"></i> Adicionar Item
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="tabela-itens">
                                <thead class="thead-dark">
                                    <tr>
                                        <th style="width:5%">#</th>
                                        <th style="width:5%">Código</th>
                                        <th style="width:20%">Descrição</th>
                                        <th style="width:8%">NCM</th>
                                        <th style="width:6%">CFOP</th>
                                        <th style="width:5%">CST</th>
                                        <th style="width:6%">CSOSN</th>
                                        <th style="width:5%">Qtd</th>
                                        <th style="width:10%">Valor Unit.</th>
                                        <th style="width:10%">Valor Total</th>
                                        <th style="width:6%">Unidade</th>
                                        <th style="width:5%">ICMS %</th>
                                        <th style="width:5%">Ação</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr id="item-row-0">
                                        <td>1</td>
                                        <td>
                                            <input type="text" class="form-control form-control-sm"
                                                name="nota_fiscal[itens][codigo][]" style="width:80px;">
                                        </td>
                                        <td>
                                            <select class="form-control form-control-sm select-produto"
                                                data-row="0" onchange="carregar_produto(this, 0);">
                                                <option value="">Selecione ou digite</option>
                                                <?php foreach ($produtos as $produto): ?>
                                                <option value="<?php echo $produto['Produto']['id']; ?>"
                                                    data-nome="<?php echo $produto['Produto']['nome']; ?>"
                                                    data-preco="<?php echo $produto['Produto']['preco']; ?>"
                                                    data-sku="<?php echo $produto['Produto']['sku']; ?>"
                                                    data-ncm=""
                                                    data-cfop="5102">
                                                    <?php echo $produto['Produto']['nome']; ?>
                                                    (<?php echo number_format($produto['Produto']['preco'], 2, ',', '.'); ?>)
                                                </option>
                                                <?php endforeach; ?>
                                            </select>
                                            <input type="hidden" name="nota_fiscal[itens][descricao][]" class="input-desc">
                                            <input type="hidden" name="nota_fiscal[itens][produto_id][]" class="input-produto-id">
                                        </td>
                                        <td><input type="text" class="form-control form-control-sm input-ncm"
                                            name="nota_fiscal[itens][ncm][]" maxlength="8" placeholder="61091000"></td>
                                        <td><input type="text" class="form-control form-control-sm input-cfop"
                                            name="nota_fiscal[itens][cfop][]" maxlength="4" value="5102"></td>
                                        <td><input type="text" class="form-control form-control-sm input-cst"
                                            name="nota_fiscal[itens][cst][]" maxlength="3" placeholder="00"></td>
                                        <td><input type="text" class="form-control form-control-sm input-csosn"
                                            name="nota_fiscal[itens][csosn][]" maxlength="4" placeholder="102"></td>
                                        <td><input type="number" class="form-control form-control-sm input-qtd"
                                            name="nota_fiscal[itens][quantidade][]" value="1" min="1"
                                            onchange="calcular_total(0);"></td>
                                        <td><input type="text" class="form-control form-control-sm input-valor-unit"
                                            name="nota_fiscal[itens][valor_unitario][]" value="0.00"
                                            onchange="calcular_total(0);"></td>
                                        <td><input type="text" class="form-control form-control-sm input-valor-total"
                                            name="nota_fiscal[itens][valor_total][]" value="0.00" readonly></td>
                                        <td><input type="text" class="form-control form-control-sm"
                                            name="nota_fiscal[itens][unidade][]" value="UN" style="width:50px;"></td>
                                        <td><input type="text" class="form-control form-control-sm input-icms"
                                            name="nota_fiscal[itens][aliquota_icms][]" value="" style="width:60px;"></td>
                                        <td>
                                            <button type="button" class="btn btn-danger btn-sm"
                                                onclick="remover_item(0);">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="text-right mt-2">
                            <strong>Total: R$ <span id="total-geral">0,00</span></strong>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pagamentos -->
            <div class="col-lg-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex justify-content-between align-items-center">
                        <h6 class="m-0 font-weight-bold text-primary">Formas de Pagamento</h6>
                        <button type="button" class="btn btn-sm btn-success" onclick="adicionar_pagamento();">
                            <i class="fa fa-plus"></i> Adicionar Pagamento
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="tabela-pagamentos">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Tipo</th>
                                        <th>Valor</th>
                                        <th>Ação</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr id="pag-row-0">
                                        <td>
                                            <select class="form-control form-control-sm"
                                                name="nota_fiscal[pagamentos][tipo][]">
                                                <option value="01">01 - Dinheiro</option>
                                                <option value="03">03 - Cartão de Crédito</option>
                                                <option value="04">04 - Cartão de Débito</option>
                                                <option value="17">17 - PIX</option>
                                                <option value="15">15 - Boleto Bancário</option>
                                                <option value="99">99 - Outros</option>
                                            </select>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control form-control-sm input-valor-pag"
                                                name="nota_fiscal[pagamentos][valor][]" value="0.00">
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-danger btn-sm"
                                                onclick="remover_pagamento(0);">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="text-right mt-2">
                            <strong>Total Pagamentos: R$ <span id="total-pagamentos">0,00</span></strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-lg-12 text-center">
                <a href="/nota_fiscal/listar_cadastros" class="btn btn-secondary" style="margin-right: 10px;">
                    <i class="fa fa-arrow-left"></i> Voltar
                </a>
                <button type="submit" class="btn btn-primary btn-lg">
                    <i class="fas fa-paper-plane"></i> Emitir Nota Fiscal
                </button>
            </div>
        </div>
    </form>
</div>

<script type="text/javascript">
    var itemCounter = 1;
    var pagCounter = 1;

    function carregar_cliente() {
        var clienteId = $('#cliente_select').val();

        if (!clienteId) {
            $('#cliente_id_hidden').val('');
            return;
        }

        $('#cliente_id_hidden').val(clienteId);

        $.ajax({
            type: "post",
            dataType: "json",
            url: "/nota_fiscal/carregar_cliente_ajax",
            data: { id: clienteId },
            success: function(data) {
                if (data.found) {
                    $('#dest_nome').val(data.nome);
                    $('#dest_cpf_cnpj').val(data.documento);
                    $('#dest_email').val(data.email);
                }
            }
        });
    }

    function carregar_produto(el, rowIndex) {
        var option = $(el).find('option:selected');
        var produtoId = $(el).val();

        if (!produtoId) return;

        var row = $('#item-row-' + rowIndex);
        row.find('.input-desc').val(option.data('nome'));
        row.find('.input-valor-unit').val(parseFloat(option.data('preco')).toFixed(2));
        row.find('.input-produto-id').val(produtoId);
        row.find('input[name="nota_fiscal[itens][codigo][]"]').val(option.data('sku'));

        calcular_total(rowIndex);
    }

    function calcular_total(rowIndex) {
        var row = $('#item-row-' + rowIndex);
        var qtd = parseFloat(row.find('.input-qtd').val()) || 0;
        var valorUnit = parseFloat(row.find('.input-valor-unit').val().replace(',', '.')) || 0;
        var total = qtd * valorUnit;

        row.find('.input-valor-total').val(total.toFixed(2));
        calcular_total_geral();
    }

    function calcular_total_geral() {
        var total = 0;
        $('.input-valor-total').each(function() {
            total += parseFloat($(this).val().replace(',', '.')) || 0;
        });
        $('#total-geral').text(total.toFixed(2).replace('.', ','));
    }

    function adicionar_item() {
        var html = '<tr id="item-row-' + itemCounter + '">';
        html += '<td>' + (itemCounter + 1) + '</td>';
        html += '<td><input type="text" class="form-control form-control-sm" name="nota_fiscal[itens][codigo][]" style="width:80px;"></td>';
        html += '<td>';
        html += '<select class="form-control form-control-sm select-produto" data-row="' + itemCounter + '" onchange="carregar_produto(this, ' + itemCounter + ');">';
        html += '<option value="">Selecione ou digite</option>';
        <?php foreach ($produtos as $produto): ?>
        html += '<option value="<?php echo $produto["Produto"]["id"]; ?>" data-nome="<?php echo addslashes($produto["Produto"]["nome"]); ?>" data-preco="<?php echo $produto["Produto"]["preco"]; ?>" data-sku="<?php echo $produto["Produto"]["sku"]; ?>"><?php echo addslashes($produto["Produto"]["nome"]); ?></option>';
        <?php endforeach; ?>
        html += '</select>';
        html += '<input type="hidden" name="nota_fiscal[itens][descricao][]" class="input-desc">';
        html += '<input type="hidden" name="nota_fiscal[itens][produto_id][]" class="input-produto-id">';
        html += '</td>';
        html += '<td><input type="text" class="form-control form-control-sm input-ncm" name="nota_fiscal[itens][ncm][]" maxlength="8"></td>';
        html += '<td><input type="text" class="form-control form-control-sm input-cfop" name="nota_fiscal[itens][cfop][]" maxlength="4" value="5102"></td>';
        html += '<td><input type="text" class="form-control form-control-sm input-cst" name="nota_fiscal[itens][cst][]" maxlength="3"></td>';
        html += '<td><input type="text" class="form-control form-control-sm input-csosn" name="nota_fiscal[itens][csosn][]" maxlength="4"></td>';
        html += '<td><input type="number" class="form-control form-control-sm input-qtd" name="nota_fiscal[itens][quantidade][]" value="1" min="1" onchange="calcular_total(' + itemCounter + ');"></td>';
        html += '<td><input type="text" class="form-control form-control-sm input-valor-unit" name="nota_fiscal[itens][valor_unitario][]" value="0.00" onchange="calcular_total(' + itemCounter + ');"></td>';
        html += '<td><input type="text" class="form-control form-control-sm input-valor-total" name="nota_fiscal[itens][valor_total][]" value="0.00" readonly></td>';
        html += '<td><input type="text" class="form-control form-control-sm" name="nota_fiscal[itens][unidade][]" value="UN" style="width:50px;"></td>';
        html += '<td><input type="text" class="form-control form-control-sm input-icms" name="nota_fiscal[itens][aliquota_icms][]" value="" style="width:60px;"></td>';
        html += '<td><button type="button" class="btn btn-danger btn-sm" onclick="remover_item(' + itemCounter + ');"><i class="fas fa-trash"></i></button></td>';
        html += '</tr>';

        $('#tabela-itens tbody').append(html);
        itemCounter++;
    }

    function remover_item(index) {
        if ($('#tabela-itens tbody tr').length <= 1) {
            swal('Atenção', 'Deve haver pelo menos um item.', 'warning');
            return;
        }
        $('#item-row-' + index).remove();
        calcular_total_geral();
    }

    function adicionar_pagamento() {
        var html = '<tr id="pag-row-' + pagCounter + '">';
        html += '<td><select class="form-control form-control-sm" name="nota_fiscal[pagamentos][tipo][]">';
        html += '<option value="01">01 - Dinheiro</option>';
        html += '<option value="03">03 - Cartão de Crédito</option>';
        html += '<option value="04">04 - Cartão de Débito</option>';
        html += '<option value="17">17 - PIX</option>';
        html += '<option value="15">15 - Boleto Bancário</option>';
        html += '<option value="99">99 - Outros</option>';
        html += '</select></td>';
        html += '<td><input type="text" class="form-control form-control-sm input-valor-pag" name="nota_fiscal[pagamentos][valor][]" value="0.00"></td>';
        html += '<td><button type="button" class="btn btn-danger btn-sm" onclick="remover_pagamento(' + pagCounter + ');"><i class="fas fa-trash"></i></button></td>';
        html += '</tr>';

        $('#tabela-pagamentos tbody').append(html);
        pagCounter++;
    }

    function remover_pagamento(index) {
        if ($('#tabela-pagamentos tbody tr').length <= 1) {
            swal('Atenção', 'Deve haver pelo menos uma forma de pagamento.', 'warning');
            return;
        }
        $('#pag-row-' + index).remove();
    }

    $('#formNotaFiscal').on('submit', function(e) {
        var totalItens = parseFloat($('#total-geral').text().replace('.', '').replace(',', '.')) || 0;

        if (totalItens <= 0) {
            e.preventDefault();
            swal('Atenção', 'O valor total dos itens deve ser maior que zero.', 'warning');
            return false;
        }

        $('.input-desc').each(function(i) {
            var row = $(this).closest('tr');
            if (!$(this).val()) {
                var select = row.find('.select-produto');
                $(this).val(select.find('option:selected').text() || 'Produto');
            }
        });
    });
</script>
