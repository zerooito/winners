<?php require('menu-transparent.ctp'); ?>

<div class="container cart flow-text" style="margin-top: 10px;">

	<div class="row">
		<div class="col s6 m3 l3">
			Produto
		</div>
		<div class="col s3 m3 m3">
			Valor Unitário
		</div>
		<div class="col s3 m3 m3">
			Quantidade
		</div>
		<div class="col s3 m3 m3">
			Ações
		</div>
	</div>

	<?php foreach($products as $indice => $product): ?>
		<div class="row">
			<div class="col s6 m3 l3 img">
				<img class="responsive-img" src="/uploads/produto/imagens/<?php echo $product['Produto']['imagem'] ?>">
			</div>
			<div class="col s3 m3 m3">
				R$ <?php echo number_format($product['Produto']['preco'], 2, ',', '.') ?>
			</div>
			<div class="col s3 m3 m3">
				<?php echo $product['Produto']['quantidade'] ?>
			</div>
			<div class="col s3 m3 m3">
				<a class="btn-floating red">
					<i class="material-icons">remove</i>
				</a>
			</div>
		</div>
	<?php endforeach; ?>

	<div class="row text-right">
		<div class="col s8">
			<input type="text" name="cep" id="cep">
			<label name="cep" for="cep">Digite seu CEP</label>
		</div>
		<div class="col s4">
			<a class="btn-floating blue">
				<i class="fa fa-car"></i>
			</a>
		</div>
	</div>

	<div class="row text-right">
		<div class="col s8">
			<input type="text" name="cupom" id="cupom">
			<label name="cupom" for="cupom">Digite seu Cupom de Desconto</label>
		</div>
		<div class="col s4">
			<a class="btn-floating blue">
				<i class="fa fa-money"></i>
			</a>
		</div>
	</div>

	<div class="row text-right">
		<p>Subtotal: R$ <?php echo number_format($total, 2, ',', '.') ?></p>
		<p id="frete">Frete: R$ 0,00</p>
		<p id="total">Total: R$ <?php echo number_format($total, 2, ',', '.') ?></p>
	</div>

	<div class="row">
		<a class="waves-effect waves-light btn red" onclick="window.location.href=''">Continuar Comprando</a>
		<a class="waves-effect waves-light btn blue" onclick="window.location.href = '/checkout'">
			<i class="material-icons left"></i> Finalizar Pedido
		</a>
	</div>
</div>

<!--Mascaras-->
<?php echo $this->Html->script('jquery.maskedinput.min'); ?>

<script type="text/javascript">
  $('#cep').mask('99999-999');

  $('#cep').change(function() {
    var cep_destino = $(this).val()
      , cep_origem  = '<?php echo $usuario['Usuario']['cep_origem']; ?>'
      , url         = '/calcTransportAjax';

      $.ajax({
        url: url,
        data: {
          cep_origem:  cep_origem, 
          cep_destino: cep_destino
        },
        dataType: 'json',
        method: "post",
        success: function(data) {          
          $('#frete').html('Frete: R$ ' + data['frete']);
          $('#total').html('Total: R$ ' + data['total']);
        }
      });
  });
</script>
