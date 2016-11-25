
<nav class="custom-color">
	<div class="nav-wrapper">
		<a href="#" class="brand-logo">Presentes Para Já</a>
		<ul id="nav-mobile" class="right hide-on-med-and-down">
			<li><a href="sass.html">Como Funciona</a></li>
        	<?php foreach($categorias as $indice => $valor): ?>
				<li>
					<a href="/<?php echo explode('/', $_SERVER['REQUEST_URI'])[1] ?>/category/<?php echo $valor['Categoria']['id'] ?>/<?php echo $valor['Categoria']['nome'] ?>">
						<?php echo $valor['Categoria']['nome'] ?>
					</a>
				</li>
			<?php endforeach; ?>
			<li><a href="collapsible.html">Monte Sua Cesta</a></li>
			<li><a href="collapsible.html">Contato</a></li>
		</ul>
	</div>
</nav>

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
		<p>Subtotal: R$ 30,00</p>
		<p>Frete: R$ 30,00</p>
		<p>Desconto: R$ 30,00</p>
		<p>Total: R$ <?php echo number_format($total, 2, ',', '.') ?></p>
	</div>

	<div class="row">
		<a class="waves-effect waves-light btn red" onclick="window.location.href='/<?php echo explode('/', $_SERVER['REQUEST_URI'])[1] ?>'">Continuar Comprando</a>
		<a class="waves-effect waves-light btn blue" onclick="window.location.href = '/<?php echo explode('/', $_SERVER['REQUEST_URI'])[1] ?>/checkout'">
			<i class="material-icons left"></i> Finalizar Pedido
		</a>
	</div>
</div>


<script type="text/javascript">
  $('#cep').mask('99999-999');

  $('#cep').change(function() {
    var cep_destino = $(this).val()
      , cep_origem  = '07252-000'
      , url         = '/<?php echo explode('/', $_SERVER['REQUEST_URI'])[1] ?>/calcTransportAjax';

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
        }
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