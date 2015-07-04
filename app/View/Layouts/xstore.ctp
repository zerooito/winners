<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>X Store</title>

    <?php echo $this->Html->css('font-awesome/css/font-awesome.min'); ?>

    <!-- Bootstrap Core CSS -->
    <link href="/app/webroot/xstore/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="/app/webroot/xstore/css/shop-homepage.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!--Start of Zopim Live Chat Script-->
    <script type="text/javascript">
    window.$zopim||(function(d,s){var z=$zopim=function(c){z._.push(c)},$=z.s=
    d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
    _.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute('charset','utf-8');
    $.src='//v2.zopim.com/?29Cgb0x8PWQ3X1FKXZXUNJx4D9TjDD5d';z.t=+new Date;$.
    type='text/javascript';e.parentNode.insertBefore($,e)})(document,'script');
    </script>
    <!--End of Zopim Live Chat Script-->

</head>

<body>

    <!-- Navigation -->
    <div class="header">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-sm-2">
                  <!-- Logo -->
                  <div class="logo">
                     <h1><a href="/">bitStore</a></h1>
                  </div>
               </div>
                <div class="col-md-4 col-sm-5">
                    <div class="kart-links">
                        <a data-toggle="modal" href="#shoppingcart"><i class="fa fa-shopping-cart"></i> 3 Items - R$ 300</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <?php echo $this->fetch('content'); ?>

    <div class="container">

        <hr>

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; XStore <?php echo date('Y') ?> - Desenvolvido por Winners Desenvolvimento de Sites e Sistemas</p>
                </div>
            </div>
        </footer>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="/app/webroot/xstore/js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="/app/webroot/xstore/js/bootstrap.min.js"></script>

</body>

</html>
