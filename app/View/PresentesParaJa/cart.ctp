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
	
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

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

		<div class="row">
			<div class="col s6 m3 l3 img">
				<img class="responsive-img" src="http://lorempixel.com/400/200/">
			</div>
			<div class="col s3 m3 m3">
				R$ 9,90
			</div>
			<div class="col s3 m3 m3">
				1
			</div>
			<div class="col s3 m3 m3">
				<a class="btn-floating red">
					<i class="material-icons">remove</i>
				</a>
			</div>
		</div>

		<div class="row">
			<div class="col s6 m3 l3 img">
				<img class="responsive-img" src="http://lorempixel.com/400/200/">
			</div>
			<div class="col s3 m3 m3">
				R$ 9,90
			</div>
			<div class="col s3 m3 m3">
				1
			</div>
			<div class="col s3 m3 m3">
				<a class="btn-floating red">
					<i class="material-icons">remove</i>
				</a>
			</div>
		</div>

		<div class="row">
			<div class="col s6 m3 l3 img">
				<img class="responsive-img" src="http://lorempixel.com/400/200/">
			</div>
			<div class="col s3 m3 m3">
				R$ 9,90
			</div>
			<div class="col s3 m3 m3">
				1
			</div>
			<div class="col s3 m3 m3">
				<a class="btn-floating red">
					<i class="material-icons">remove</i>
				</a>
			</div>
		</div>

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
			<p>Total: R$ 30,00</p>
		</div>

		<div class="row">
			<a class="waves-effect waves-light btn red">Continuar Comprando</a>
			<a class="waves-effect waves-light btn blue">
				<i class="material-icons left"></i> Finalizar Pedido
			</a>
		</div>
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