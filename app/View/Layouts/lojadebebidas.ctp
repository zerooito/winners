<!DOCTYPE html>
<html lang="en">
  <head>
    <title>
        <?php echo $usuario['Usuario']['nome']; ?>
    </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link href="https://fonts.googleapis.com/css2?family=Spectral:ital,wght@0,200;0,300;0,400;0,500;0,700;0,800;1,200;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="/lojadebebidas/css/animate.css">
    
    <link rel="stylesheet" href="/lojadebebidas/css/owl.carousel.min.css">
    <link rel="stylesheet" href="/lojadebebidas/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="/lojadebebidas/css/magnific-popup.css">
    
    <link rel="stylesheet" href="/lojadebebidas/css/flaticon.css">
    <link rel="stylesheet" href="/lojadebebidas/css/style.css">
  </head>
  <body>

  	<div class="wrap">
			<div class="container">
				<div class="row">
					<div class="col-md-6 d-flex align-items-center">
						<p class="mb-0 phone pl-md-2">
							<a href="api.whatsapp.com/send?phone=<?php echo $usuario['Usuario']['telefone']; ?>" class="mr-2"><span class="fa fa-phone mr-1"></span> <?php echo $usuario['Usuario']['telefone']; ?>
							</a>
						</p>
					</div>
					<div class="col-md-6 d-flex justify-content-md-end">
						<div class="social-media mr-4">
			    		<p class="mb-0 d-flex">
			    			<a href="#" class="d-flex align-items-center justify-content-center"><span class="fa fa-facebook"><i class="sr-only">Facebook</i></span></a>
			    			<a href="<?php echo @$usuario['Usuario']['instagram']; ?>" class="d-flex align-items-center justify-content-center"><span class="fa fa-instagram"><i class="sr-only">Instagram</i></span></a>
			    		</p>
						</div>
					</div>
				</div>
			</div>
		</div>
    
	  <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
	    <div class="container">
	      <a class="navbar-brand" href="/"><?php echo $usuario['Usuario']['nome']; ?></a>
	      <div class="order-lg-last btn-group">
          <a href="#" class="btn-cart dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          	<!-- <span class="flaticon-shopping-bag"></span>
          	<div class="d-flex justify-content-center align-items-center"><small>3</small></div> -->
          </a>
          <div class="dropdown-menu dropdown-menu-right">
			<a class="dropdown-item text-center btn-link d-block w-100" href="cart.html">
				View All
				<span class="ion-ios-arrow-round-forward"></span>
			</a>
		  </div>
        </div>

	      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
	        <span class="oi oi-menu"></span> Menu
	      </button>

	      <div class="collapse navbar-collapse" id="ftco-nav">
	        <ul class="navbar-nav ml-auto">
	          <li class="nav-item active"><a href="/" class="nav-link">Home</a></li>
	          <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="/" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Products</a>
              <div class="dropdown-menu" aria-labelledby="dropdown04">
                <?php foreach($categorias as $indice => $valor): ?>
              	    <a class="dropdown-item" href="/category/<?php echo $valor['Categoria']['id'] ?>/<?php echo $valor['Categoria']['nome'] ?>"><?php echo $valor['Categoria']['nome'] ?></a>
                <?php endforeach; ?>
              </div>
            </li>
	        </ul>
	      </div>
	    </div>
	  </nav>
    <!-- END nav -->
    
    <div class="hero-wrap" style="background-image: url('/lojadebebidas/images/bg-shisha.jpg');" data-stellar-background-ratio="0.5">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
          <div class="col-md-8 ftco-animate d-flex align-items-end">
          	<div class="text w-100 text-center">
	            <h1 class="mb-4">Boas <span>Bebidas</span> para Bons <span>Momentos</span>.</h1>
	            <p><a href="/" class="btn btn-primary py-2 px-4">Ver Catalogo</a> <a href="#" class="btn btn-white btn-outline-white py-2 px-4">Endereço</a></p>
            </div>
          </div>
        </div>
      </div>
    </div>


    <?php echo $this->fetch('content'); ?>
  		
    <footer class="ftco-footer">
      <div class="container">
        <div class="row mb-5">
          <div class="col-sm-12 col-md">
            <div class="ftco-footer-widget mb-4">
              <h2 class="ftco-heading-2 logo"><a href="/"><?php echo $usuario['Usuario']['nome']; ?></a></h2>
              <p>As melhores bebidas da região.</p>
              <ul class="ftco-footer-social list-unstyled mt-2">
                <li class="ftco-animate"><a href="#"><span class="fa fa-facebook"></span></a></li>
                <li class="ftco-animate"><a href="#"><span class="fa fa-instagram"></span></a></li>
              </ul>
            </div>
          </div>
          <div class="col-sm-12 col-md">
            <div class="ftco-footer-widget mb-4 ml-md-4">
              <h2 class="ftco-heading-2">Informações</h2>
              <ul class="list-unstyled">
                <li><a href="/"><span class="fa fa-chevron-right mr-2"></span>Catalogo</a></li>
              </ul>
            </div>
          </div>
          <div class="col-sm-12 col-md">
            <div class="ftco-footer-widget mb-4">
            	<h2 class="ftco-heading-2">Endereço</h2>
            	<div class="block-23 mb-3">
	              <ul>
	                <li><span class="icon fa fa-map marker"></span><span class="text">R. Maria Antônieta de Campos Arruda, 268 - Jardim Angelica, Guarulhos - SP, 07260-500</span></li>
	                <li><a href="api.whatsapp.com/send?phone=5511989569254"><span class="icon fa fa-phone"></span><span class="text">+55 11 989569254</span></a></li>
	              </ul>
	            </div>
            </div>
          </div>
        </div>
      </div>
      <div class="container-fluid px-0 py-5 bg-black">
      	<div class="container">
      		<div class="row">
	          <div class="col-md-12">
	            <p class="mb-0" style="color: rgba(255,255,255,.5);"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart color-danger" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib.com</a> and Builded By <a href="https://ciawn.com.br" target="_blank">Winners</a>
                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
	          </div>
	        </div>
      	</div>
      </div>
    </footer>
    
  

  <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>


  <script src="/lojadebebidas/js/jquery.min.js"></script>
  <script src="/lojadebebidas/js/jquery-migrate-3.0.1.min.js"></script>
  <script src="/lojadebebidas/js/popper.min.js"></script>
  <script src="/lojadebebidas/js/bootstrap.min.js"></script>
  <script src="/lojadebebidas/js/jquery.easing.1.3.js"></script>
  <script src="/lojadebebidas/js/jquery.waypoints.min.js"></script>
  <script src="/lojadebebidas/js/jquery.stellar.min.js"></script>
  <script src="/lojadebebidas/js/owl.carousel.min.js"></script>
  <script src="/lojadebebidas/js/jquery.magnific-popup.min.js"></script>
  <script src="/lojadebebidas/js/jquery.animateNumber.min.js"></script>
  <script src="/lojadebebidas/js/scrollax.min.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
  <script src="/lojadebebidas/js/google-map.js"></script>
  <script src="/lojadebebidas/js/main.js"></script>
    
  </body>
</html>