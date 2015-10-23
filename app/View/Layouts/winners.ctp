
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Winners desenvolvimento de Sites e Sistemas</title>

<link rel='shortcut icon' type='image/x-icon' href='/app/webroot/images/favicon.ico' />

<link href='http://fonts.googleapis.com/css?family=Raleway:400,200,300,600,700,800' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800,600,300,200' rel='stylesheet' type='text/css'>
<?php
    echo $this->Html->css('style');
    echo $this->Html->css('font-awesome.min');
    echo $this->Html->css('responsive');
    echo $this->Html->css('sidr/stylesheets/jquery.sidr.dark');
    echo $this->Html->script('jquery.min');
    echo $this->Html->script('jquery.ninescroll.min');

    echo $this->Html->script('sidr/jquery.sidr.min');
    echo $this->Html->script('smoothscroll');
?>

<!--Start of Zopim Live Chat Script-->
<script type="text/javascript">
window.$zopim||(function(d,s){var z=$zopim=function(c){z._.push(c)},$=z.s=
d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
_.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute('charset','utf-8');
$.src='//v2.zopim.com/?29Cgb0x8PWQ3X1FKXZXUNJx4D9TjDD5d';z.t=+new Date;$.
type='text/javascript';e.parentNode.insertBefore($,e)})(document,'script');
</script>
<!--End of Zopim Live Chat Script-->

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-60234652-1', 'auto');
  ga('send', 'pageview');
</script>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>

</head>

<body>
  <?php echo $this->Session->flash(); ?>
  <a href="https://github.com/reginaldojunior/winners"><img style="z-index: 1;position: absolute; top: 0; right: 0; border: 0;" src="https://camo.githubusercontent.com/38ef81f8aca64bb9a64448d0d70f1308ef5341ab/68747470733a2f2f73332e616d617a6f6e6177732e636f6d2f6769746875622f726962626f6e732f666f726b6d655f72696768745f6461726b626c75655f3132313632312e706e67" alt="Fork me on GitHub" data-canonical-src="https://s3.amazonaws.com/github/ribbons/forkme_right_darkblue_121621.png"></a>
  <div class="header">
      <div class="container">
        <div class="logo-menu">
            <div class="logo">
                <h1 style="margin-top: 0px;"><a href="#">Winners</a></h1>
              </div>
                <!--<a id="simple-menu" href="#sidr">Toggle menu</a>-->
                <div id="mobile-header">
                  <a class="responsive-menu-button" href="#"><img src="images/11.png"/></a>
                </div>
              <div class="menu" id="navigation">
                <ul>
                    <li><a href="#">Inicio</a></li>
                    <li><a href="#features">Produtos</a></li>
                    <li><a href="#stories">Métodos</a></li>
                    <li><a href="#contact">Contato</a></li>
                    <li><a href="/home/login">Login</a></li>
                    <li><a target="_blank" href="https://github.com/reginaldojunior/winners">Winners OpenSource</a></li>
                </ul>
              </div>
          </div>
        </div>
    </div>
    
    <div class="banner">
      <div class="container">
          <div class="header-text">
              <p class="big-text">Soluções Inovadora</p>
                <h2>As melhores ferramentas</h2>
                <p class="small-text">Plataforma E-commerce Winners OpenSource</p>
                <div class="button-section">
                  <ul>
                      <li><a href="#" class="top-button green" data-toggle="modal" data-target="#myModal">Contrate um Especialista</a></li>
                  </ul>
                </div>
            </div>
        </div>
    </div>
    
    <div class="color-border">
    </div>
    
    <div class="desc">
      <div class="container">
          <h2>Desenvolvimento orientado a resultado</h2>
            <p>A Winners trabalha pensando no resultado final, ou seja, em lucro para sua empresa, escolhemos as melhores soluções para seu caso e então criamos sua ideia ou projeto.</p>
        </div>
    </div>
   
    <div class="features" id="features">
      <div class="container">
          <h3 class="text-head">Produto e Soluções</h3>
          <div class="features-section">
                <ul>
                  <li>
                      <div class="feature-icon icon1"></div>
                      <h4>Gráficos</h4>
                      <p>Possuimos gráficos de vendas, produtos com estoque baixo e muito mais.</p>
                     </li>
                     <li>
                      <div class="feature-icon icon2"></div>
                      <h4>Ecommerce</h4>
                      <p>Plataforma de e-commerce open source, os melhores desenvolvedores do mundo.</p>
                     </li>
                     <li>
                      <div class="feature-icon icon3"></div>
                      <h4>Nosso código é seu código</h4>
                      <p>Suporte para instalação do software ou consultoria para desenvolvimento especifico.</p>
                     </li>
                </ul>
            </div>
        </div>
    </div>
    
    <div class="contact" id="contact">
      <div class="container">
          <h3 class="text-head">Contato</h3>
            <p class="box-desc">Ainda ficou com dúvidas? Não deixe de entrar em contato conosco!</p>
              <div class="contact-section">
                
                    <form action="/home/enviar_email" method="post">
                        <input type="text" name="dados[name]" placeholder="Nome" />
                          <input type="email" name="dados[email]" placeholder="Email"/>
                          <textarea placeholder="Mensagem" name="dados[message]" rows="6"></textarea>
                          <button type="submit" class="submit">Enviar Mensagem</button>
                      </form>
                  
              </div>
        </div>
    </div>
    <div class="color-border">
    </div>
    <div class="footer">
          <div class="container">
              <div class="infooter">
                <p class="copyright">Copyright &copy; Winners Desenvolvimento de Sites e Sistemas <?php echo date('Y') ?></p>
              </div>
            <ul class="socialmedia">
                <li><a href=""><i class="icon-twitter"></i></a></li>
                <li><a href=""><i class="icon-facebook"></i></a></li>
                <li><a href=""><i class="icon-dribbble"></i></a></li>
                <li><a href=""><i class="icon-linkedin"></i></a></li>
                <li><a href=""><i class="icon-instagram"></i></a></li>
            </ul>
            </div>
        </div>
        <script type="text/javascript">   
       $(document).ready(function() {
        $('#simple-menu').sidr({
        side: 'right'
      });
      });
      $('.responsive-menu-button').sidr({
        name: 'sidr-main',
        source: '#navigation',
        side: 'right'

        });
      $(document).ready(
      function() {
      $("html").niceScroll({cursorborder:"0px solid #fff",cursorwidth:"5px",scrollspeed:"70"});
      });
    </script>

    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <form action="/usuario/novo_usuario" method="post">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Informe seus Dados</h4>
            <h5 style="color: red">Logo após preencher seus dados, você será redirecionado para nosso sistema e entraremos em contato em breve</h5>
          </div>
          <div class="modal-body">
              <label style="margin-bottom: -15px;">Nome </label>
              <input type="text" name="dados[nome]" style="margin-left:0px;margin-bottom: 15px;" placeholder="Digite seu nome"/>
              <label style="margin-bottom: -15px;">Email </label>
              <input type="text" name="dados[email]" style="margin-left:0px;margin-bottom: 15px;" placeholder="Digite seu e-mail" />
              <label style="margin-bottom: -15px;">Senha </label>
              <input type="password" name="dados[senha]" style="margin-left:0px;margin-bottom: 15px;"  placeholder="Digite sua senha"/>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary">Salvar</button>
          </div>
        </div>
      </div>
      </form>
    </div>

    <div class="modal fade" id="valores" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            Tabela de Valores Gestor Winners
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-md-12">
                <div class="col-md-4 list-group">
                  <a href="#" class="list-group-item list-group-item-info">
                    Basico
                  </a>
                  <a href="#" class="list-group-item">Venda</a>
                  <a href="#" class="list-group-item">Produto</a>
                  <a href="#" class="list-group-item">Fornecedor</a>
                  <a href="#" class="list-group-item">Cliente</a>
                  <a href="#" class="list-group-item">Fabricante</a>
                  <a href="#" class="list-group-item">->
                    <span class="glyphicon glyphicon glyphicon-remove" aria-hidden="true"></span>
                  </a>
                  <a href="#" class="list-group-item">->
                    <span class="glyphicon glyphicon glyphicon-remove" aria-hidden="true"></span>
                  </a>
                  <a href="#" class="list-group-item">->
                    <span class="glyphicon glyphicon glyphicon-remove" aria-hidden="true"></span>
                  </a>
                  <a href="#" class="list-group-item">->
                    <span class="glyphicon glyphicon glyphicon-remove" aria-hidden="true"></span>
                  </a>
                  <a href="#" class="list-group-item list-group-item-danger">R$ 49,99 (Mensais)</a>
                </div>

                <div class="col-md-4 list-group">
                  <a href="#" class="list-group-item list-group-item-warning">
                    Empresarial
                  </a>
                  <a href="#" class="list-group-item">Venda</a>
                  <a href="#" class="list-group-item">Produto</a>
                  <a href="#" class="list-group-item">Fornecedor</a>
                  <a href="#" class="list-group-item">Cliente</a>
                  <a href="#" class="list-group-item">Fabricante</a>
                  <a href="#" class="list-group-item">NF-e</a>
                  <a href="#" class="list-group-item">Transportadora</a>
                  <a href="#" class="list-group-item">Compra</a>
                  <a href="#" class="list-group-item">->
                    <span class="glyphicon glyphicon glyphicon-remove" aria-hidden="true"></span>
                  </a>
                  <a href="#" class="list-group-item list-group-item-danger">R$ 99,99 (Mensais)</a>
                </div>


                <div class="col-md-4 list-group">
                  <a href="#" class="list-group-item list-group-item-success">
                    Full
                  </a>
                  <a href="#" class="list-group-item">Venda</a>
                  <a href="#" class="list-group-item">PDV</a>
                  <a href="#" class="list-group-item">Produto</a>
                  <a href="#" class="list-group-item">Fornecedor</a>
                  <a href="#" class="list-group-item">Cliente</a>
                  <a href="#" class="list-group-item">Fabricante</a>
                  <a href="#" class="list-group-item">NF-e</a>
                  <a href="#" class="list-group-item">Transportadora</a>
                  <a href="#" class="list-group-item">Compra</a>
                  <a href="#" class="list-group-item list-group-item-danger">R$ 149,99 (Mensais)</a>
                </div>

              </div>
            </div>
          </div>
          <div class="modal-footer">

          </div>
        </div>
      </div>
    </div>

</body>
</html>
