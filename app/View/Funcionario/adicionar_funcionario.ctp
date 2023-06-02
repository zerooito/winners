
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Funcionario - Adicionar Cadastro</h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default" style="margin-top: 12px;">
                <div class="panel-heading">
                    Dados do Funcionario
                </div>

                <div class="panel-body">
                    <form role="form" action="/funcionario/s_adicionar_funcionario" method="post">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Nome</label>
                                    <input class="form-control" name="subusuario[nome]">
                                    <!-- <p class="help-block">Example block-level help text here.</p> -->
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input class="form-control" name="subusuario[email]">
                                </div>
                                <div class="form-group">
                                    <label>Senha</label>
                                    <input type="password" class="form-control" name="subusuario[password]">
                                </div>
                                <div class="form-group">
                                    <label>CPF</label>
                                    <input class="form-control" name="dados[cpf]" id="cpf">
                                </div>                                
                                <div class="form-group">
                                    <label>RG</label>
                                    <input class="form-control" name="dados[rg]" id="rg">
                                </div>
                                <div class="form-group">
                                    <label>Data de Nascimento</label>
                                    <input class="form-control" name="dados[data_nascimento]" id="date">
                                </div>
                                <div class="form-group">
                                    <label>Celular</label>
                                    <input class="form-control" name="dados[celular]" id="celular">
                                </div>
                                <div class="form-group">
                                    <label>Salário</label>
                                    <input class="form-control moeda" name="dados[salario]">
                                </div>
                                <div class="form-group">
                                    <label>Comissão (%)</label>
                                    <input class="form-control" name="dados[comissao]" type="number">
                                </div>
                                <div class="form-group">
                                    <span class="badge badge-success">Hieraquia</span>
                                    <select class="form-control" name="subusuario[hieraquia_id]">
                                    <?php foreach ($hieraquias as $i => $hieraquia): ?>
                                        <option value="<?php echo $hieraquia['Hieraquia']['id']; ?>"><?php echo $hieraquia['Hieraquia']['nome']; ?></option>
                                    <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Cep</label>
                                    <input class="form-control" name="dados[cep]" id="cep">
                                </div>
                                <div class="form-group">
                                    <label>Endereço</label>
                                    <input class="form-control" name="dados[endereco]" id="endereco">
                                </div>
                                <div class="form-group">
                                    <label>Nº</label>
                                    <input class="form-control" name="dados[numero]">
                                </div>
                                <div class="form-group">
                                    <label>Complemento</label>
                                    <input class="form-control" name="dados[complemento]">
                                </div>
                                <div class="form-group">
                                    <label>Bairro</label>
                                    <input class="form-control" name="dados[bairro]" id="bairro">
                                </div>
                                <div class="form-group">
                                    <label>Cidade</label>
                                    <input class="form-control" name="dados[cidade]" id="cidade">
                                </div>
                                <div class="form-group">
                                    <label>Estado</label>
                                    <input class="form-control" name="dados[estado]" id="estado">
                                </div>
                            </div>
                            <!-- /.col-lg-6 (nested) -->
                        </div>

                        <button type="submit" class="btn btn-success pull-right">Salvar Funcionário</button>
                        <button type="reset" class="btn btn-danger pull-right" onclick="history.go(-1);">Cancelar</button>
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
           $('#rg').mask("99.99.99.99-9", {placeholder:"__.__.__.__-_"});
           $('#celular').mask('(99) 99999-9999'), {placeholder:"(__) _____-____"};
           $('#cep').mask('99999-999'), {placeholder:"_____-___"};
        });

        $('#cep').change(function() {
            atualizacep($(this).val());
        });
    });


    function atualizacep(cep){
      cep = cep.replace(/\D/g,"")
      
      var url = "http://viacep.com.br/ws/" + cep + "/json/";

      $.ajax({
        url: url,
        dataType: 'json',
        method: "get",
        success: function(data) {
          document.getElementById('endereco').value = data['logradouro'];
          document.getElementById('bairro').value = data['bairro'];
          document.getElementById('cidade').value = data['localidade'];
          document.getElementById('estado').value = data['uf'];
        }
      });
    }
</script>