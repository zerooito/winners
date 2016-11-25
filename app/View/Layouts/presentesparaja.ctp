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
	
	<link rel="stylesheet" type="text/css" href="/presentesparaja/css/style.css">

	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>

    <?php echo $this->fetch('content'); ?>

    <div class="fixed-action-btn" style="bottom: 45px; right: 24px;">
		<a class="btn-floating btn-large custom-color">
			<i class="fa fa-bars"></i>
		</a>
		<ul>
			<li>
				<a href="/<?php echo explode('/', $_SERVER['REQUEST_URI'])[1] ?>/cart" class="btn-floating red" style="transform: scaleY(0.4) scaleX(0.4) translateY(40px) translateX(0px); opacity: 0;">
					<i class="fa fa-shopping-cart"></i>
				</a>
			</li>

			<li>
				<a href="/<?php echo explode('/', $_SERVER['REQUEST_URI'])[1] ?>/checkout" class="btn-floating red" style="transform: scaleY(0.4) scaleX(0.4) translateY(40px) translateX(0px); opacity: 0;">
					<i class="fa fa-money"></i>
				</a>
			</li>
		</ul>
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
	        
    </script>

</body>
</html>