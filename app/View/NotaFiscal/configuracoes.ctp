
<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Configurações - Nota Fiscal</h1>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">API NotaAs</h6>
                </div>
                <div class="card-body">
                    <form action="/nota_fiscal/salvar_configuracoes" method="POST">
                        <div class="form-group">
                            <label><strong>API Key</strong></label>
                            <input type="text" class="form-control" name="api_key"
                                value="<?php echo isset($configuracao['NotaFiscalConfiguracao']['api_key']) ? $configuracao['NotaFiscalConfiguracao']['api_key'] : ''; ?>"
                                placeholder="Sua API Key da NotaAs">
                            <small class="form-text text-muted">
                                Obtenha sua API Key em
                                <a href="https://platform.notaas.com.br/dashboard" target="_blank">
                                    platform.notaas.com.br
                                </a>
                            </small>
                        </div>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Salvar
                        </button>
                        <a href="/nota_fiscal/listar_cadastros" class="btn btn-secondary" style="margin-left: 10px;">
                            <i class="fa fa-arrow-left"></i> Voltar
                        </a>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Status da Conexão</h6>
                </div>
                <div class="card-body">
                    <?php if (!empty($configuracao['NotaFiscalConfiguracao']['api_key'])): ?>
                    <div class="alert alert-success">
                        <i class="fas fa-check-circle"></i> API Key configurada.
                    </div>
                    <?php else: ?>
                    <div class="alert alert-warning">
                        <i class="fas fa-exclamation-triangle"></i> API Key não configurada.
                        Configure abaixo para emitir notas fiscais.
                    </div>
                    <?php endif; ?>

                    <h6>Links Úteis:</h6>
                    <ul class="list-unstyled">
                        <li><a href="https://docs.notaas.com.br/docs/nfe/endpoints" target="_blank">
                            <i class="fas fa-book"></i> Documentação da API</a></li>
                        <li><a href="https://platform.notaas.com.br/dashboard" target="_blank">
                            <i class="fas fa-tachometer-alt"></i> Dashboard NotaAs</a></li>
                    </ul>

                    <hr>
                    <h6>Modelos Disponíveis:</h6>
                    <table class="table table-sm">
                        <tr>
                            <td><span class="badge badge-primary">55</span></td>
                            <td>NF-e (Nota Fiscal Eletrônica)</td>
                        </tr>
                        <tr>
                            <td><span class="badge badge-success">65</span></td>
                            <td>NFC-e (Cupom Fiscal Eletrônico)</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
