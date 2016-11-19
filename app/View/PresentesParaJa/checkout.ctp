<!DOCTYPE html>
<html>
<head>

	<meta charset="utf-8">

	<title>Presentes Para Já</title>

	<!--Import Google Icon Font-->
	<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

	<!-- Compiled and minified CSS -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/css/materialize.min.css">

	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<!-- Compiled and minified JavaScript -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/js/materialize.min.js"></script>
	
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>

	<nav class="custom-color">
		<div class="nav-wrapper">
			<a href="#" class="brand-logo">Presentes Para Já</a>
			<ul id="nav-mobile" class="right hide-on-med-and-down">
				<li><a href="sass.html">Como Funciona</a></li>
				<li><a href="badges.html">Cestas Prontas</a></li>
				<li><a href="collapsible.html">Quadros</a></li>
				<li><a href="collapsible.html">Monte Sua Cesta</a></li>
				<li><a href="collapsible.html">Contato</a></li>
			</ul>
		</div>
	</nav>

	<div class="container cart flow-text" style="margin-top: 10px;">

		<form action="/payment" id="payment-form" method="post">

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

			<div class="shipping-method">
			<h2>Forma de Entrega</h2>
				<div class="col s12">
				  	<div class="row">
						<div class=" col l6 m12">
							<input type="checkbox" class="filled-in" id="express" />
							<label for="express">
								<strong>Sedex:</strong>
								3 à 4 dias úteis
								<br />
								R$ 38,90
							</label>              
						</div> 
						<div class=" col l6 m12">
							<input type="checkbox" class="filled-in" id="express" />
							<label for="express">
								<strong>PAC:</strong>
								3 à 4 dias úteis
								<br />
								R$ 38,90
							</label>              
						</div>    
					 </div>
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
						R$ <?php echo $product['Produto']['preco'] ?>
					</div>
					<div class="col s3 m3 m3">
						<?php echo $product['Produto']['quantidade'] ?>
					</div>
					<div class="col s3 m3 m3">
						R$ <?php echo $product['Produto']['preco'] ?>
					</div>
				</div>
			<?php endforeach; ?>

			<div class="row text-right">
				<p>Subtotal: R$ <?php echo number_format($total, 2, ',', '.') ?></p>
				<p>Frete: R$ 0,00</p>
				<p>Desconto: R$ 0,00</p>
				<p>Total: R$ <?php echo number_format($total, 2, ',', '.') ?></p>
			</div>

			<div class="row">
				<a class="waves-effect waves-light btn red">Continuar Comprando</a>
				<button type="submit" class="waves-effect waves-light btn blue">
					<i class="material-icons left"></i> Pagar PagSeguro
				</button>
			</div>

		</form>

	</div>

	<footer class="page-footer custom-color">
		<div class="container custom-color">
			<div class="row">
				<div class="col l6 s12">
					<h5 class="white-text">Presentes Para Já</h5>
		
					<p class="grey-text text-lighten-4">Companhia especializada em envio de presentes, cestas, e quadros personalizados para ocasiões especiais, como, aniversário de namoro, casamento, noivados ou datas especiais.</p>
				</div>
				<div class="col l3 s12">
					<h5 class="white-text">Mapa do Site</h5>
					<ul>
						<li><a class="white-text" href="#!">Como Funciona</a></li>
						<li><a class="white-text" href="#!">Cestas Prontas</a></li>
						<li><a class="white-text" href="#!">Quadros</a></li>
						<li><a class="white-text" href="#!">Monte sua Cesta</a></li>
					</ul>
				</div>
				<div class="col l3 s12">
					<h5 class="white-text">Institucional</h5>
					<ul>
						<li><a class="white-text" href="#!">Contato</a></li>
					</ul>
				</div>
			</div>
		</div>
		<div class="footer-copyright">
			<div class="container">
				Plataforma <a class="brown-text text-lighten-3" href="http://www.ciawn.com.br">Winners</a>
			</div>
		</div>
	</footer>

    <script type="text/javascript">
	    	
	    $(document).ready(function(){
			$('.parallax').parallax();
	    });

		$(document).ready(function(){
			$('.slider').slider({full_width: true});
		});
        
	        
    </script>

</body>
</html>