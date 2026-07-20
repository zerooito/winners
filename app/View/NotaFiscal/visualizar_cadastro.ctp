
<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Nota Fiscal #<?php echo $nota['NotaFiscal']['id']; ?></h1>
        <div>
            <a href="/nota_fiscal/listar_cadastros" class="btn btn-secondary">
                <i class="fa fa-arrow-left"></i> Voltar
            </a>
            <?php if ($nota['NotaFiscal']['status'] == 'issued'): ?>
            <a href="/nota_fiscal/download_danfe/<?php echo $nota['NotaFiscal']['id']; ?>"
               class="btn btn-success" target="_blank">
                <i class="fas fa-file-pdf"></i> DANFE
            </a>
            <a href="/nota_fiscal/download_xml/<?php echo $nota['NotaFiscal']['id']; ?>"
               class="btn btn-info" target="_blank">
                <i class="fas fa-file-code"></i> XML
            </a>
            <?php endif; ?>
            <?php if ($nota['NotaFiscal']['status'] == 'queued' || $nota['NotaFiscal']['status'] == 'processing'): ?>
            <button class="btn btn-warning" onclick="verificar_status();">
                <i class="fas fa-sync"></i> Verificar Status
            </button>
            <?php endif; ?>
        </div>
    </div>

    <div class="row">
        <!-- Dados da Nota -->
        <div class="col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Dados da Nota Fiscal</h6>
                </div>
                <div class="card-body">
                    <table class="table table-sm">
                        <tr>
                            <td><strong>ID Interno:</strong></td>
                            <td><?php echo $nota['NotaFiscal']['id']; ?></td>
                        </tr>
                        <tr>
                            <td><strong>Invoice ID (NotaAs):</strong></td>
                            <td><?php echo $nota['NotaFiscal']['invoice_id'] ?? '-'; ?></td>
                        </tr>
                        <tr>
                            <td><strong>Modelo:</strong></td>
                            <td><?php echo $nota['NotaFiscal']['modelo'] == 55 ? 'NF-e (55)' : 'NFC-e (65)'; ?></td>
                        </tr>
                        <tr>
                            <td><strong>Nº Nota Fiscal:</strong></td>
                            <td><?php echo $nota['NotaFiscal']['numero_nf'] ?? '-'; ?></td>
                        </tr>
                        <tr>
                            <td><strong>Série:</strong></td>
                            <td><?php echo $nota['NotaFiscal']['serie'] ?? '-'; ?></td>
                        </tr>
                        <tr>
                            <td><strong>Chave de Acesso:</strong></td>
                            <td><small><?php echo $nota['NotaFiscal']['chave_acesso'] ?? '-'; ?></small></td>
                        </tr>
                        <tr>
                            <td><strong>Protocolo:</strong></td>
                            <td><?php echo $nota['NotaFiscal']['protocolo'] ?? '-'; ?></td>
                        </tr>
                        <tr>
                            <td><strong>Status:</strong></td>
                            <td>
                                <?php
                                    $statusMap = array(
                                        'queued' => '<span class="badge badge-secondary">Na Fila</span>',
                                        'processing' => '<span class="badge badge-info">Processando</span>',
                                        'issued' => '<span class="badge badge-success">Emitida</span>',
                                        'error' => '<span class="badge badge-danger">Erro</span>',
                                        'cancelled' => '<span class="badge badge-dark">Cancelada</span>',
                                        'inutilized' => '<span class="badge badge-warning">Inutilizada</span>'
                                    );
                                    echo $statusMap[$nota['NotaFiscal']['status']] ?? $nota['NotaFiscal']['status'];
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>SEFAZ:</strong></td>
                            <td><?php echo ($nota['NotaFiscal']['c_stat'] ?? '') . ' - ' . ($nota['NotaFiscal']['x_motivo'] ?? '-'); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Natureza da Operação:</strong></td>
                            <td><?php echo $nota['NotaFiscal']['natureza_operacao']; ?></td>
                        </tr>
                        <tr>
                            <td><strong>Valor Total:</strong></td>
                            <td><strong>R$ <?php echo number_format($nota['NotaFiscal']['valor_total'], 2, ',', '.'); ?></strong></td>
                        </tr>
                        <tr>
                            <td><strong>Data Emissão:</strong></td>
                            <td><?php echo !empty($nota['NotaFiscal']['data_emissao']) ? date('d/m/Y H:i:s', strtotime($nota['NotaFiscal']['data_emissao'])) : '-'; ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <!-- Destinatário -->
        <div class="col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Destinatário</h6>
                </div>
                <div class="card-body">
                    <table class="table table-sm">
                        <tr>
                            <td><strong>Nome:</strong></td>
                            <td><?php echo $nota['NotaFiscal']['nome_destinatario']; ?></td>
                        </tr>
                        <tr>
                            <td><strong>CPF/CNPJ:</strong></td>
                            <td><?php echo $nota['NotaFiscal']['cpf_cnpj_destinatario'] ?? '-'; ?></td>
                        </tr>
                        <tr>
                            <td><strong>IE:</strong></td>
                            <td><?php echo $nota['NotaFiscal']['ie_destinatario'] ?? 'Não informado'; ?></td>
                        </tr>
                        <tr>
                            <td><strong>Endereço:</strong></td>
                            <td>
                                <?php echo $nota['NotaFiscal']['logradouro_destinatario']; ?>,
                                <?php echo $nota['NotaFiscal']['numero_destinatario']; ?>
                                <?php if (!empty($nota['NotaFiscal']['complemento_destinatario'])): ?>
                                    - <?php echo $nota['NotaFiscal']['complemento_destinatario']; ?>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Bairro:</strong></td>
                            <td><?php echo $nota['NotaFiscal']['bairro_destinatario']; ?></td>
                        </tr>
                        <tr>
                            <td><strong>Cidade/UF:</strong></td>
                            <td><?php echo $nota['NotaFiscal']['cidade_destinatario']; ?>/<?php echo $nota['NotaFiscal']['uf_destinatario']; ?></td>
                        </tr>
                        <tr>
                            <td><strong>CEP:</strong></td>
                            <td><?php echo $nota['NotaFiscal']['cep_destinatario']; ?></td>
                        </tr>
                        <tr>
                            <td><strong>Email:</strong></td>
                            <td><?php echo $nota['NotaFiscal']['email_destinatario'] ?? '-'; ?></td>
                        </tr>
                    </table>
                </div>
            </div>

            <?php if (!empty($nota['NotaFiscal']['informacoes_complementares'])): ?>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Informações Complementares</h6>
                </div>
                <div class="card-body">
                    <?php echo nl2br($nota['NotaFiscal']['informacoes_complementares']); ?>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Itens -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Itens da Nota</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-sm">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Descrição</th>
                                    <th>NCM</th>
                                    <th>CFOP</th>
                                    <th>CST</th>
                                    <th>Qtd</th>
                                    <th>Vl. Unitário</th>
                                    <th>Vl. Total</th>
                                    <th>Un.</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($nota['NotaFiscalItem'] as $item): ?>
                                <tr>
                                    <td><?php echo $item['descricao']; ?></td>
                                    <td><?php echo $item['ncm']; ?></td>
                                    <td><?php echo $item['cfop']; ?></td>
                                    <td><?php echo $item['cst'] ?? $item['csosn'] ?? '-'; ?></td>
                                    <td><?php echo $item['quantidade']; ?></td>
                                    <td>R$ <?php echo number_format($item['valor_unitario'], 2, ',', '.'); ?></td>
                                    <td>R$ <?php echo number_format($item['valor_total'], 2, ',', '.'); ?></td>
                                    <td><?php echo $item['unidade']; ?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="6" class="text-right"><strong>Total:</strong></td>
                                    <td colspan="2"><strong>R$ <?php echo number_format($nota['NotaFiscal']['valor_total'], 2, ',', '.'); ?></strong></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pagamentos -->
    <div class="row">
        <div class="col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Formas de Pagamento</h6>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-sm">
                        <thead class="thead-dark">
                            <tr>
                                <th>Tipo</th>
                                <th>Valor</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $tiposPagamento = array(
                                '01' => 'Dinheiro', '03' => 'Cartão de Crédito', '04' => 'Cartão de Débito',
                                '17' => 'PIX', '15' => 'Boleto', '99' => 'Outros'
                            );
                            foreach ($nota['NotaFiscalPagamento'] as $pag):
                            ?>
                            <tr>
                                <td><?php echo $tiposPagamento[$pag['tipo_pagamento']] ?? $pag['tipo_pagamento']; ?></td>
                                <td>R$ <?php echo number_format($pag['valor'], 2, ',', '.'); ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function verificar_status() {
        swal({ title: 'Verificando...', text: 'Aguarde...', showCancelButton: false, showConfirmButton: false });

        $.ajax({
            type: "get",
            dataType: "json",
            url: "/nota_fiscal/verificar_status/<?php echo $nota['NotaFiscal']['id']; ?>",
            success: function(data) {
                swal.close();
                if (data.error) {
                    swal('Erro', data.error, 'error');
                } else {
                    swal({
                        title: 'Status Atualizado',
                        text: 'Status: ' + data.status + (data.xMotivo ? '\n' + data.xMotivo : ''),
                        type: 'info'
                    }).then(function() {
                        location.reload();
                    });
                }
            },
            error: function() {
                swal.close();
                swal('Erro', 'Falha ao verificar status.', 'error');
            }
        });
    }
</script>
