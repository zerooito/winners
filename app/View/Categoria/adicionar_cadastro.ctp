
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default" style="margin-top: 12px;">
                <div class="panel-heading">
                    Dados da Categoria
                </div>
                <div class="panel-body">
                    <form role="form" action="/categoria/s_adicionar_cadastro" method="post">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Nome</label>
                                    <input class="form-control" name="dados[nome]">
                                    <!-- <p class="help-block">Example block-level help text here.</p> -->
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-success">Salvar Categoria</button>
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