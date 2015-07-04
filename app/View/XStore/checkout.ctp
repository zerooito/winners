<div class="container">
  <div class="row form-group">
        <div class="col-xs-12">
            <ul class="nav nav-pills nav-justified thumbnail setup-panel">
                <li class="disabled"><a href="#step-1">
                    <h4 class="list-group-item-heading">Passo 1</h4>
                    <p class="list-group-item-text">Carrinho</p>
                </a></li>
                <li class="active"><a href="#step-2">
                    <h4 class="list-group-item-heading">Passo 2</h4>
                    <p class="list-group-item-text">Identificação</p>
                </a></li>
            </ul>
        </div>
  </div>
</div>

<form action="/payment" id="payment-form" method="post">
<div class="container">
    <div class='row'>
        <div class='col-md-4'>
            <div class="panel panel-default">
              <div class="panel-heading">
                <h3 class="panel-title">Seu Endereço</h3>
              </div>
              <div class="panel-body">
                <div class='form-row'>
                  <div class='col-xs-12 form-group required'>
                    <label class='control-label'>CEP</label>
                    <input class='form-control cep' type='text' name="endereco[cep]" id="cep" required>
                  </div>
                </div>
              
                <div class='form-row'>
                  <div class='col-xs-12 form-group required'>
                    <label class='control-label'>Endereço</label>
                    <input class='form-control' type='text' name="endereco[endereco]" id="endereco" readonly>
                  </div>
                </div>

                <div class='form-row'>
                  <div class='col-xs-12 form-group required'>
                    <label class='control-label'>Nº</label>
                    <input class='form-control' type='text' name="endereco[numero]" required>
                  </div>
                </div>

                <div class='form-row'>
                  <div class='col-xs-12 form-group required'>
                    <label class='control-label'>Bairro</label>
                    <input class='form-control' type='text' name="endereco[bairro]" id="bairro" readonly>
                  </div>
                </div>

                <div class='form-row'>
                  <div class='col-xs-12 form-group required'>
                    <label class='control-label'>Cidade</label>
                    <input class='form-control' type='text' name="endereco[cidade]" id="cidade" readonly>
                  </div>
                </div>

                <div class='form-row'>
                  <div class='col-xs-12 form-group required'>
                    <label class='control-label'>Estado</label>
                    <input class='form-control' type='text' name="endereco[estado]" id="estado" readonly>
                  </div>
                </div>
              </div>
            </div>
        </div>
        <div class='col-md-4'>
            <div class="panel panel-default">
              <div class="panel-heading">
                <h3 class="panel-title">Suas informações</h3>
              </div>
              <div class="panel-body">
                <div class='form-row'>
                  <div class='col-xs-12 form-group required'>
                    <label class='control-label'>Nome</label>
                    <input class='form-control' type='text' name="cliente[nome]" required>
                  </div>
                </div>
              
                <div class='form-row'>
                  <div class='col-xs-12 form-group required'>
                    <label class='control-label'>E-mail</label>
                    <input class='form-control' type='email' name="cliente[email]" required>
                  </div>
                </div>

                <div class='form-row'>
                  <div class='col-xs-12 form-group required'>
                    <label class='control-label'>DDD</label>
                    <input class='form-control' type='text' name="cliente[ddd]" required>
                  </div>
                </div>

                <div class='form-row'>
                  <div class='col-xs-12 form-group required'>
                    <label class='control-label'>Telefone</label>
                    <input class='form-control' type='text' name="cliente[telefone]" required>
                  </div>
                </div>

                <div class='form-row'>
                  <div class='col-xs-12 form-group required'>
                    <label class='control-label'>CPF</label>
                    <input class='form-control' type='text' name="cliente[cpf]" id="cpf" required>
                  </div>
                </div>
              </div>
            </div>

        </div>
        <div class='col-md-4'>
          
          <div class="panel panel-default">
          <div class="panel-heading">
            <div class="panel-title">
              <div class="row">
                <div class="col-xs-12">
                  <h5><span class="glyphicon glyphicon-shopping-cart"></span> Checkout</h5>
                </div>
                <div class="col-xs-12">
                  <button type="button" class="btn btn-primary btn-sm btn-block">
                    <span class="glyphicon glyphicon-share-alt"></span> Continue comprando
                  </button>
                </div>
              </div>
            </div>
          </div>
          <div class="panel-body">
            <?php foreach($products as $indice => $product) { ?>
            <div class="row">
              <div class="col-xs-6"><img class="img-responsive" src="/uploads/produto/imagens/<?php echo $product['Produto']['imagem'] ?>" alt="Foto do produto <?php echo $product['Produto']['nome'] ?>">
              </div>
              <div class="col-xs-6">
                <h4 class="product-name"><strong><?php echo $product['Produto']['nome'] ?></strong></h4><h4><small><?php echo $product['Produto']['descricao'] ?></small></h4>
              </div>
            </div>
            <hr>
            <?php } ?>
          </div>
          <div class="panel-footer">
              <div class="row text-center">
                <div class="col-xs-6">
                  <h4 class="text-right"><strong>Frete:</strong> </h4>
                </div>
                <div class="col-xs-6">
                  <h4 id="frete">R$ 0,00</h4>
                </div>
                <div class="col-xs-6">
                  <h4 class="text-right"><strong>Subtotal:</strong> </h4>
                </div>
                <div class="col-xs-6">
                  <h4>R$ <?php echo number_format($total, 2, ',', '.') ?></h4>
                </div>
                <div class="col-xs-6">
                  <h4 class="text-right"><strong>Total:</strong> </h4>
                </div>
                <div class="col-xs-6">
                  <h4 id="total">R$ <?php echo number_format($total, 2, ',', '.') ?></h4>
                </div>
                <div class="col-xs-6">
                </div>
                <div class="col-xs-6">
                  <button type="submit" class="btn btn-success">
                    Finalizar
                  </button>
                </div>
              </div>
          </div>
          </div>
        </div>
    </div>
</div>
</form>

<style type="text/css">
  .submit-button {
    margin-top: 10px;
  }
</style>

<!--Mascaras-->
<?php echo $this->Html->script('jquery.maskedinput.min'); ?>

<script type="text/javascript">
  $('#cep').mask('99999-999');
  $('#cpf').mask('999.999.999-99');
  $('#cep').change(function() {
    var cep_destino = $(this).val()
      , cep_origem  = '07252-000'
      , url         = '/loja/calcTransportAjax';

      $.ajax({
        url: url,
        data: {
          cep_origem:  cep_origem, 
          cep_destino: cep_destino
        },
        dataType: 'json',
        method: "post",
        success: function(data) {
          atualizacep(cep_destino);
          $('#frete').html('R$ ' + data['frete']);
          $('#total').html('R$ ' + data['total']);
        },
        error: function() {
          console.log('erro');
        }
      });
  });

  function atualizacep(cep){
      console.log('oila');
      cep = cep.replace(/\D/g,"")
      url="http://cep.correiocontrol.com.br/"+cep+".js"
      s=document.createElement('script')
      s.setAttribute('charset','utf-8')
      s.src=url
      document.querySelector('head').appendChild(s)
  }

  function correiocontrolcep(valor){
      if (valor.erro) {
        alert('Cep não encontrado');
        return;
      };

      document.getElementById('endereco').value=valor.logradouro
      document.getElementById('bairro').value=valor.bairro
      document.getElementById('cidade').value=valor.localidade
      document.getElementById('estado').value=valor.uf
  }
</script>