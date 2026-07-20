
<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Notas Fiscais - Listar</h1>
    </div>

    <div class="row">
        <div class="col-lg-9">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-notas">
                            <thead>
                                <tr>
                                    <th>#ID</th>
                                    <th>Modelo</th>
                                    <th>Nº NF</th>
                                    <th>Destinatario</th>
                                    <th>Valor</th>
                                    <th>Status</th>
                                    <th>Data</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3">
            <div class="panel panel-default">
                <div class="panel-heading">Ações</div>
                <div class="panel-body">
                    <?php if ($this->Permissoes->usuario_possui_permissao_para('nota_fiscal', 'write')): ?>
                    <a href="/nota_fiscal/adicionar_cadastro" class="btn btn-primary"
                        style="margin-bottom: 10px; width:100%; color: #FFF;">
                        <i class="fa fa-plus"></i> Emitir Nota Fiscal
                    </a>
                    <?php endif; ?>

                    <?php if ($this->Permissoes->usuario_possui_permissao_para('nota_fiscal', 'write')): ?>
                    <a href="/nota_fiscal/configuracoes" class="btn btn-secondary"
                        style="margin-bottom: 10px; width:100%; color: #FFF;">
                        <i class="fa fa-cog"></i> Configurações
                    </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Cancelar -->
<div class="modal fade" id="modalCancelarNota" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Cancelar Nota Fiscal</h4>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Motivo do cancelamento (min. 15 caracteres)</label>
                    <textarea class="form-control" id="motivo-cancelamento" rows="3" minlength="15"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                <button type="button" class="btn btn-danger" onclick="confirmar_cancelamento();">Confirmar Cancelamento</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    var notaIdCancelar = null;

    $(document).ready(function() {
        $('#dataTables-notas').dataTable({
            "bServerSide": true,
            "iDisplayStart": 0,
            "sAjaxDataProp": "data",
            "aaSorting": [[ 0, "desc" ]],
            "sAjaxSource": "/nota_fiscal/listar_cadastros_ajax"
        });
    });

    function cancelar_nota(id) {
        notaIdCancelar = id;
        $('#motivo-cancelamento').val('');
        $('#modalCancelarNota').modal('show');
    }

    function confirmar_cancelamento() {
        var motivo = $('#motivo-cancelamento').val();

        if (motivo.length < 15) {
            swal('Atenção', 'O motivo deve ter no minimo 15 caracteres.', 'warning');
            return;
        }

        $.ajax({
            type: "post",
            dataType: "json",
            url: "/nota_fiscal/cancelar_nota/" + notaIdCancelar,
            data: { motivo: motivo },
            success: function(data) {
                if (data.error) {
                    swal('Erro', data.error, 'error');
                } else {
                    swal('Cancelado!', 'Nota fiscal cancelada com sucesso.', 'success')
                    .then(function() {
                        location.reload();
                    });
                }
            },
            error: function() {
                swal('Erro', 'Ocorreu um erro ao cancelar.', 'error');
            }
        });

        $('#modalCancelarNota').modal('hide');
    }
</script>
