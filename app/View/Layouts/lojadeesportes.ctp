<!doctype html>
<html class="no-js" lang="zxx">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Fashion | Teamplate</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="manifest" href="site.webmanifest">
    <link rel="shortcut icon" type="image/x-icon" href="/lojadeesportes/img/favicon.ico">

    <!-- CSS here -->
    <link rel="stylesheet" href="/lojadeesportes/css/bootstrap.min.css">
    <link rel="stylesheet" href="/lojadeesportes/css/owl.carousel.min.css">
    <link rel="stylesheet" href="/lojadeesportes/css/slicknav.css">
    <link rel="stylesheet" href="/lojadeesportes/css/flaticon.css">
    <link rel="stylesheet" href="/lojadeesportes/css/progressbar_barfiller.css">
    <link rel="stylesheet" href="/lojadeesportes/css/gijgo.css">
    <link rel="stylesheet" href="/lojadeesportes/css/animate.min.css">
    <link rel="stylesheet" href="/lojadeesportes/css/animated-headline.css">
    <link rel="stylesheet" href="/lojadeesportes/css/magnific-popup.css">
    <link rel="stylesheet" href="/lojadeesportes/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="/lojadeesportes/css/themify-icons.css">
    <link rel="stylesheet" href="/lojadeesportes/css/slick.css">
    <link rel="stylesheet" href="/lojadeesportes/css/nice-select.css">
    <link rel="stylesheet" href="/lojadeesportes/css/style.css">
    
</head>
<body class="full-wrapper">
    <!-- ? Preloader Start -->
    <div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
                <div class="preloader-circle"></div>
                <div class="preloader-img pere-text">
                  <?php echo $usuario['Usuario']['nome']; ?>
                </div>
            </div>
        </div>
    </div>
    <!-- Preloader Start-->
    <header>
        <!-- Header Start -->
        <div class="header-area ">
            <div class="main-header header-sticky">
                <div class="container-fluid">
                    <div class="menu-wrapper d-flex align-items-center justify-content-between">
                        <div class="header-left d-flex align-items-center">
                            <!-- Logo -->
                            <div class="logo">
                                <a href="/">
                                  <img src="<?php echo $usuario['Usuario']['logo']; ?>" alt="<?php echo $usuario['Usuario']['nome']; ?>" width="54">
                                </a>
                            </div>
                            <!-- Main-menu -->
                            <div class="main-menu  d-none d-lg-block">
                                <nav>
                                    <ul id="navigation">
                                        <li><a href="/">Home</a></li>
                                        <li><a href="/sobre">Sobre</a></li>
                                        <li><a href="javascript:;">Categorias</a>
                                            <ul class="submenu">
                                                <?php foreach($categorias as $indice => $valor): ?>
                                                    <li>
                                                        <a class="dropdown-item" href="/category/<?php echo $valor['Categoria']['id'] ?>/<?php echo $valor['Categoria']['nome'] ?>"><?php echo $valor['Categoria']['nome'] ?></a>
                                                    </li>
                                                <?php endforeach; ?>
                                            </ul>
                                        </li>
                                        <li><a href="/contato">Contato</a></li>
                                    </ul>
                                </nav>
                            </div>   
                        </div>
                        <div class="header-right1 d-flex align-items-center">
                            <!-- Social -->
                            <div class="header-social d-none d-md-block">
                                <a href="<?php echo @$usuario['Usuario']['instagram']; ?>"><i class="fab fa-instagram"></i></a>
                                <a href="<?php echo @$usuario['Usuario']['facebook']; ?>"><i class="fab fa-facebook-f"></i></a>
                            </div>
                            <!-- Search Box -->
                            <div class="search d-none d-md-block">
                                <ul class="d-flex align-items-center">
                                    <li class="mr-15">
                                        <div class="nav-search search-switch">
                                            <i class="ti-search"></i>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="card-stor">
                                            <img src="/lojadeesportes/img/gallery/card.svg" alt="">
                                            <span>0</span>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- Mobile Menu -->
                        <div class="col-12">
                            <div class="mobile_menu d-block d-lg-none"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Header End -->
    </header>
    <!-- header end -->
    <main>
        <!--? Hero Area Start-->
        <div class="container-fluid">
            <div class="slider-area">
                <!-- Mobile Device Show Menu-->
                <div class="header-right2 d-flex align-items-center">
                    <!-- Social -->
                    <div class="header-social  d-block d-md-none">
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="https://bit.ly/sai4ull"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-pinterest-p"></i></a>
                    </div>
                    <!-- Search Box -->
                    <div class="search d-block d-md-none" >
                        <ul class="d-flex align-items-center">
                            <li class="mr-15">
                                <div class="nav-search search-switch">
                                    <i class="ti-search"></i>
                                </div>
                            </li>
                            <li>
                                <div class="card-stor">
                                    <img src="/lojadeesportes/img/gallery/card.svg" alt="">
                                    <span>0</span>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- /End mobile  Menu-->

                <div class="slider-active dot-style">
                    <!-- Single -->
                    <div class="single-slider slider-bg1 hero-overly slider-height d-flex align-items-center">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-xl-8 col-lg-9">
                                    <!-- Hero Caption -->
                                    <div class="hero__caption">
                                        <h1><?php echo $usuario['Usuario']['nome'] ?></h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Hero -->
</div>
</div>
</div>
<!-- Popular Items End -->

<?php echo $this->fetch('content'); ?>

<!--? Services Area Start -->
<div class="categories-area section-padding40 gray-bg">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="single-cat mb-50 wow fadeInUp" data-wow-duration="1s" data-wow-delay=".2s">
                    <div class="cat-icon">
                        <img src="/lojadeesportes/img/icon/services1.svg" alt="">
                    </div>
                    <div class="cat-cap">
                        <h5>Entrega Rápida e Segura</h5>
                        <p>Todos os pedidos enviados com segurança</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="single-cat mb-50 wow fadeInUp" data-wow-duration="1s" data-wow-delay=".2s">
                    <div class="cat-icon">
                        <img src="/lojadeesportes/img/icon/services2.svg" alt="">
                    </div>
                    <div class="cat-cap">
                        <h5>Pagamento com PagSeguro</h5>
                        <p>Escolha a melhor forma de pagamento com a maior redes de pagamentos da America Látina</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="single-cat mb-30 wow fadeInUp" data-wow-duration="1s" data-wow-delay=".4s">
                    <div class="cat-icon">
                        <img src="/lojadeesportes/img/icon/services3.svg" alt="">
                    </div>
                    <div class="cat-cap">
                        <h5>Sistema de troca</h5>
                        <p>Seu produto não deu certo, trocamos para você.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="single-cat wow fadeInUp" data-wow-duration="1s" data-wow-delay=".5s">
                    <div class="cat-icon">
                        <img src="/lojadeesportes/img/icon/services4.svg" alt="">
                    </div>
                    <div class="cat-cap">
                        <h5>Entregas em 24 horas</h5>
                        <p>Pedidos de pronta entrega em até 24 horas para regiões especificas.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--? Services Area End -->
</main>

<footer>
    <!-- Footer Start-->
    <div class="footer-area footer-padding">
        <div class="container-fluid ">
            <div class="row d-flex justify-content-between">
                <div class="col-xl-3 col-lg-3 col-md-8 col-sm-8">
                 <div class="single-footer-caption mb-50">
                   <div class="single-footer-caption mb-30">
                      <!-- logo -->
                      <div class="footer-logo mb-35">
                        <a href="/">
                          <img src="<?php echo $usuario['Usuario']['logo']; ?>" alt="<?php echo $usuario['Usuario']['nome']; ?>" width="54">
                        </a>
                   </div>
                   <div class="footer-tittle">
                      <div class="footer-pera">
                        <p>
                          <?php echo $usuario['Usuario']['descricao']; ?>
                        </p>
                      </div>
                   </div>
                   <!-- social -->
                   <div class="footer-social">
                    <a href="<?php echo @$usuario['Usuario']['instagram']; ?>"><i class="fab fa-instagram"></i></a>
                    <a href="<?php echo @$usuario['Usuario']['facebook']; ?>"><i class="fab fa-facebook-f"></i></a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-2 col-lg-2 col-md-4 col-sm-4">
        <div class="single-footer-caption mb-50">
        </div>
    </div>
    <div class="col-xl-2 col-lg-2 col-md-4 col-sm-4">
        <div class="single-footer-caption mb-50">
        </div>
    </div>
    <div class="col-xl-2 col-lg-2 col-md-4 col-sm-4">
        <div class="single-footer-caption mb-50">
            <div class="footer-tittle">
                <h4>Links Rápidos</h4>
                <ul>
                    <li><a href="/termos-de-uso">Termos de Uso</a></li>
                    <li><a href="/politica-de-troca">Politica de Troca</a></li>
                    <li><a href="/politica-de-envio">Politica de Envio</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-4">
        <div class="single-footer-caption mb-50">
            <div class="footer-tittle">
                <h4>Entre em contato</h4>
                <ul>
                    <li><a href="#"><?php echo $usuario['Usuario']['telefone'] ?></a></li>
                    <li><a href="#"><?php echo $usuario['Usuario']['email'] ?></a></li>
                    <li><a href="#"><?php echo @$usuario['Usuario']['endereco'] ?></a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
</div>
</div>
<!-- footer-bottom area -->
<div class="footer-bottom-area">
    <div class="container">
        <div class="footer-border">
           <div class="row d-flex align-items-center">
               <div class="col-xl-12 ">
                   <div class="footer-copy-right text-center">
                       <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                          Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a> and Builder By <a href="https://colorlib.com" target="_blank">Winners</a>
                          <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
  <!-- Footer End-->
</footer>
<!--? Search model Begin -->
<div class="search-model-box">
    <div class="h-100 d-flex align-items-center justify-content-center">
        <div class="search-close-btn">+</div>
        <form class="search-model-form">
            <input type="text" id="search-input" placeholder="Busque por algo...">
        </form>
    </div>
</div>
<!-- Search model end -->
<!-- Scroll Up -->
<div id="back-top" >
    <a title="Go to Top" href="#"> <i class="fas fa-level-up-alt"></i></a>
</div>

<!-- JS here -->
<!-- Jquery, Popper, Bootstrap -->
<script src="/lojadeesportes/js/vendor/modernizr-3.5.0.min.js"></script>
<script src="/lojadeesportes/js/vendor/jquery-1.12.4.min.js"></script>
<script src="/lojadeesportes/js/popper.min.js"></script>
<script src="/lojadeesportes/js/bootstrap.min.js"></script>

<!-- Slick-slider , Owl-Carousel ,slick-nav -->
<script src="/lojadeesportes/js/owl.carousel.min.js"></script>
<script src="/lojadeesportes/js/slick.min.js"></script>
<script src="/lojadeesportes/js/jquery.slicknav.min.js"></script>

<!-- One Page, Animated-HeadLin, Date Picker -->
<script src="/lojadeesportes/js/wow.min.js"></script>
<script src="/lojadeesportes/js/animated.headline.js"></script>
<script src="/lojadeesportes/js/jquery.magnific-popup.js"></script>
<script src="/lojadeesportes/js/gijgo.min.js"></script>

<!-- Nice-select, sticky,Progress -->
<script src="/lojadeesportes/js/jquery.nice-select.min.js"></script>
<script src="/lojadeesportes/js/jquery.sticky.js"></script>
<script src="/lojadeesportes/js/jquery.barfiller.js"></script>

<!-- counter , waypoint,Hover Direction -->
<script src="/lojadeesportes/js/jquery.counterup.min.js"></script>
<script src="/lojadeesportes/js/waypoints.min.js"></script>
<script src="/lojadeesportes/js/jquery.countdown.min.js"></script>
<script src="/lojadeesportes/js/hover-direction-snake.min.js"></script>

<!-- contact js -->
<script src="/lojadeesportes/js/contact.js"></script>
<script src="/lojadeesportes/js/jquery.form.js"></script>
<script src="/lojadeesportes/js/jquery.validate.min.js"></script>
<script src="/lojadeesportes/js/mail-script.js"></script>
<script src="/lojadeesportes/js/jquery.ajaxchimp.min.js"></script>

<!-- Jquery Plugins, main Jquery -->	
<script src="/lojadeesportes/js/plugins.js"></script>
<script src="/lojadeesportes/js/main.js"></script>

</body>
</html>