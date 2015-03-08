
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default" style="margin-top: 12px;">
                <div class="panel-heading">
                    Dados do Cliente
                </div>
                <div class="panel-body">
                    <form role="form" action="/cliente/s_adicionar_cliente" method="post">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Nome</label>
                                    <input class="form-control" name="dados[nome1]">
                                    <!-- <p class="help-block">Example block-level help text here.</p> -->
                                </div>
                                <div class="form-group">
                                    <label>Sobrenome</label>
                                    <input class="form-control" name="dados[nome2]">
                                </div>
                                <div class="form-group">
                                    <label>CPF</label>
                                    <input class="form-control" name="dados[documento1]" id="cpf">
                                </div>                                
                                <div class="form-group">
                                    <label>RG</label>
                                    <input class="form-control" name="dados[documento2]">
                                </div>
                                <div class="form-group">
                                    <label>Data de Nascimento</label>
                                    <input class="form-control" name="dados[data_de_nascimento]" id="date">
                                </div>
                                <div class="form-group">
                                    <label>Telefone</label>
                                    <input class="form-control" name="dados[data_de_nascimento]" id="telefone">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Cep</label>
                                    <input class="form-control" name="endereco[cep]" id="cep">
                                </div>
                                <div class="form-group">
                                    <label>Endereço</label>
                                    <input class="form-control" name="endereco[endereco]" >
                                </div>
                                <div class="form-group">
                                    <label>Nº</label>
                                    <input class="form-control" name="endereco[numero]">
                                </div>
                                <div class="form-group">
                                    <label>Bairro</label>
                                    <input class="form-control" name="endereco[bairro]">
                                </div>
                                <div class="form-group">
                                    <label>Cidade</label>
                                    <input class="form-control" name="endereco[cidade]">
                                </div>
                                <div class="form-group">
                                    <label>Estado</label>
                                    <input class="form-control" name="endereco[estado]">
                                </div>
                            </div>
                            <!-- /.col-lg-6 (nested) -->
                        </div>

                        <button type="submit" class="btn btn-success">Salvar Cliente</button>
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
    $(document).ready(function(){
        jQuery(function($){
           $("#date").mask("99/99/9999",{placeholder:"__/__/____"});
           $('#cpf').mask("999.999.999-99", {placeholder:"___.___.___-__"});
           $('#telefone').mask('(99) 9999-9999'), {placeholder:"(__) ____-____"};
           $('#cep').mask('99999-999'), {placeholder:"_____-___"};

        });
    });
</script>