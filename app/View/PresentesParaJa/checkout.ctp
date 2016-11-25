
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

	<form action="/<?php echo explode('/', $_SERVER['REQUEST_URI'])[1] ?>/payment" id="payment-form" method="post">

  		<div class="row">
			<div class="billing-info">
				<div class="billing-info-header">
			  		<h2 class="left">
			    		Seu endereço
			  		</h2>
				</div>
			</div>
		</div>

  		<div class="row">
    		<div class="col l4 s12">
      			<input name="endereco[cep]" id="cep" required>
      			<label for="cep" class="active">CEP</label>
    		</div>
    
	    	<div class="col l4 s12">
	      		<input id="endereco" name="endereco[endereco]" type="text" placeholder="" />
	      		<label for="endereco" class="active">Endereço</label>
	    	</div>   

	    	<div class="col l4 s12">
	      		<input id="numero" name="endereco[numero]" type="text" placeholder="" />
	      		<label for="numero" class="active">Nº</label>
	    	</div>              
  		</div>  

  		<div class="row">
    		<div class="col l4 s12">
      			<input name="endereco[bairro]" id="bairro" required>
      			<label for="bairro" class="active">Bairro</label>
    		</div>
    
	    	<div class="col l4 s12">
	      		<input id="cidade" name="endereco[cidade]" type="text" placeholder="" />
	      		<label for="cidade" class="active">Cidade</label>
	    	</div>   

	    	<div class="col l4 s12">
	      		<input id="estado" name="endereco[estado]" type="text" placeholder="" />
	      		<label for="estado" class="active">Nº</label>
	    	</div>              
  		</div>  

  		<div class="row">
			<div class="billing-info">
				<div class="billing-info-header">
			  		<h2 class="left">
			    		Suas Informações
			  		</h2>
				</div>
			</div>
		</div>

  		<div class="row">
    		<div class="col l6 s12">
      			<input name="cliente[nome]" id="nome" required>
      			<label for="nome" class="active">Nome</label>
    		</div>
    
	    	<div class="col l6 s12">
	      		<input id="email" name="cliente[email]" type="text" placeholder="" />
	      		<label for="email" class="active">E-mail</label>
	    	</div>   
     
  		</div> 

  		<div class="row">
    		<div class="col l6 s12">
      			<input name="cliente[cpf]" id="nome" required>
      			<label for="nome" class="active">CPF</label>
    		</div>  

	    	<div class="col l2 s12">
	      		<input id="estado" name="cliente[ddd]" type="text" placeholder="" />
	      		<label for="estado" class="active">DDD</label>
	    	</div>  

	    	<div class="col l4 s12">
	      		<input id="estado" name="cliente[telefone]" type="text" placeholder="" />
	      		<label for="estado" class="active">Telefone</label>
	    	</div>         
  		</div>  

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
				Total
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
					R$ <?php echo number_format($product['Produto']['preco'], 2, ',', '.') ?>
				</div>
			</div>
		<?php endforeach; ?>

		<br>

		<div class="row text-right">
			<p>Subtotal: R$ <?php echo number_format($total, 2, ',', '.') ?></p>
			<p id="frete">Frete: R$ 0,00</p>
			<p id="total">Total: R$ <?php echo number_format($total, 2, ',', '.') ?></p>
		</div>

		<br>

		<div class="row">
			<a class="waves-effect waves-light btn red">Continuar Comprando</a>
			<button type="submit" class="waves-effect waves-light btn blue">
				<i class="material-icons left"></i> Pagar PagSeguro
			</button>
		</div>

	</form>

</div>

<!--Mascaras-->
<?php echo $this->Html->script('jquery.maskedinput.min'); ?>

<script type="text/javascript">
  $('#cep').mask('99999-999');
  $('#cpf').mask('999.999.999-99');

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

				$('#frete').html('Frete: R$ ' + data['frete']);

				$('#total').html('Total: R$ ' + data['total']);
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