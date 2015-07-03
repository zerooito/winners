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
                    <input class='form-control' type='text' name="endereco[cep]">
                  </div>
                </div>
              
                <div class='form-row'>
                  <div class='col-xs-12 form-group required'>
                    <label class='control-label'>Endereço</label>
                    <input class='form-control' type='text' name="endereco[endereco]">
                  </div>
                </div>

                <div class='form-row'>
                  <div class='col-xs-12 form-group required'>
                    <label class='control-label'>Nº</label>
                    <input class='form-control' type='text' name="endereco[numero]">
                  </div>
                </div>

                <div class='form-row'>
                  <div class='col-xs-12 form-group required'>
                    <label class='control-label'>Bairro</label>
                    <input class='form-control' type='text' name="endereco[bairro]">
                  </div>
                </div>

                <div class='form-row'>
                  <div class='col-xs-12 form-group required'>
                    <label class='control-label'>Cidade</label>
                    <input class='form-control' type='text' name="endereco[cidade]">
                  </div>
                </div>

                <div class='form-row'>
                  <div class='col-xs-12 form-group required'>
                    <label class='control-label'>Estado</label>
                    <input class='form-control' type='text' name="endereco[estado]">
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
                    <input class='form-control' type='text' name="cliente[nome]">
                  </div>
                </div>
              
                <div class='form-row'>
                  <div class='col-xs-12 form-group required'>
                    <label class='control-label'>E-mail</label>
                    <input class='form-control' type='text' name="cliente[email]">
                  </div>
                </div>

                <div class='form-row'>
                  <div class='col-xs-12 form-group required'>
                    <label class='control-label'>DDD</label>
                    <input class='form-control' type='text' name="cliente[ddd]">
                  </div>
                </div>

                <div class='form-row'>
                  <div class='col-xs-12 form-group required'>
                    <label class='control-label'>Telefone</label>
                    <input class='form-control' type='text' name="cliente[telefone]">
                  </div>
                </div>

                <div class='form-row'>
                  <div class='col-xs-12 form-group required'>
                    <label class='control-label'>CPF</label>
                    <input class='form-control' type='text' name="cliente[cpf]">
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
                <div class="col-xs-6">
                  <h5><span class="glyphicon glyphicon-shopping-cart"></span> Checkout</h5>
                </div>
                <div class="col-xs-6">
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
                  <h4 class="text-right">Total <strong>R$ <?php echo number_format($total, 2, ',', '.') ?></strong></h4>
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

<script type="text/javascript">
  $(function() {
  $('form.require-validation').bind('submit', function(e) {
    var $form         = $(e.target).closest('form'),
        inputSelector = ['input[type=email]', 'input[type=password]',
                         'input[type=text]', 'input[type=file]',
                         'textarea'].join(', '),
        $inputs       = $form.find('.required').find(inputSelector),
        $errorMessage = $form.find('div.error'),
        valid         = true;

    $errorMessage.addClass('hide');
    $('.has-error').removeClass('has-error');
    $inputs.each(function(i, el) {
      var $input = $(el);
      if ($input.val() === '') {
        $input.parent().addClass('has-error');
        $errorMessage.removeClass('hide');
        e.preventDefault(); // cancel on first error
      }
    });
  });
});

$(function() {
  var $form = $("#payment-form");

  $form.on('submit', function(e) {
    if (!$form.data('cc-on-file')) {
      e.preventDefault();
      Stripe.setPublishableKey($form.data('stripe-publishable-key'));
      Stripe.createToken({
        number: $('.card-number').val(),
        cvc: $('.card-cvc').val(),
        exp_month: $('.card-expiry-month').val(),
        exp_year: $('.card-expiry-year').val()
      }, stripeResponseHandler);
    }
  });

  function stripeResponseHandler(status, response) {
    if (response.error) {
      $('.error')
        .removeClass('hide')
        .find('.alert')
        .text(response.error.message);
    } else {
      // token contains id, last4, and card type
      var token = response['id'];
      // insert the token into the form so it gets submitted to the server
      $form.find('input[type=text]').empty();
      $form.append("<input type='hidden' name='reservation[stripe_token]' value='" + token + "'/>");
      $form.get(0).submit();
    }
  }
})
</script>