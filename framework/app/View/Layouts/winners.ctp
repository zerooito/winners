
<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Winners desenvolvimento de Sites e Sistemas</title>
<link href='http://fonts.googleapis.com/css?family=Raleway:400,200,300,600,700,800' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800,600,300,200' rel='stylesheet' type='text/css'>
<?php
    echo $this->Html->css('style');
    echo $this->Html->css('font-awesome.min');
    echo $this->Html->css('responsive');
    echo $this->Html->script('sidr/stylesheets/jquery.sidr.dark');
    echo $this->Html->script('jquery.min');
    echo $this->Html->script('jquery.sidr.min');
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
</head>

<body>
  <div class="header">
      <div class="container">
        <div class="logo-menu">
            <div class="logo">
                <h1><a href="#">Winners</a></h1>
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
                    </ul>
              </div>
          </div>
        </div>
    </div>
    
    <div class="banner">
      <div class="container">
          <div class="header-text">
              <p class="big-text">Gestão Inovadora</p>
                <h2>100% Customizavel</h2>
                <p class="small-text">Aumente suas vendas com nosso sistema de gestão</p>
                <div class="button-section">
                  <ul>
                      <li><a href="#" class="top-button white">Leia mais</a></li>
                        <li><a href="#" class="top-button green">Cadastre-se Já</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    
    <div class="color-border">
    </div>
    
    <div class="desc">
      <div class="container">
          <h2>Sistema de Gestão Inovador</h2>
            <p>Tenha total controle de suas vendas, estoque, funcionarios e muito mais, faça seu cadastro grátis e aproveite a versão free. Sistema 100% customizavel, precisa de algo e não achou entre em contato com nossa equipe comercial e faça uma cotação.</p>
        </div>
    </div>
    
    <div class="features" id="features">
      <div class="container">
          <h3 class="text-head">Produtos</h3>
          <div class="features-section">
                <ul>
                  <li>
                      <div class="feature-icon icon1"></div>
                      <h4>Sites Comporativos</h4>
                        <p>O melhor cms de site corporativos da internet, com sistema de conteudo 100% amigavel podendo fazer posts de qualquer hora e lugar.</p>
                     </li>
                     <li>
                      <div class="feature-icon icon2"></div>
                      <h4>Tempo Livre</h4>
                        <p>Sistema 100% na nuvem podendo ser acessado de qualquer dispositivo móvel, assim mantendo você totalmente atualizado do que acontece na sua empresa.</p>
                     </li>
                     <li>
                      <div class="feature-icon icon3"></div>
                      <h4>100% Customizavel</h4>
                        <p>Trabalhamos com a melhor equipe de desenvolvedores do mercado, 100% aptos a qualquer tipo de customização no sistema desde um simples cadastro as varias integrações web.</p>
                     </li>
                </ul>
            </div>
        </div>
    </div>
    
    <div class="stories" id="stories">
      <div class="container">
          <h3 class="text-head">Métodos</h3>
            <p class="box-desc">Como funciona os novos projetos.</p>
          <div class="stories-section">
              <ul>
                  <li>
                      <a href="#">
                      <div class="story-img"><img src="images/story1.png"/></div>
                          <div class="story-box">
                              <h4>Você</h4>
                              <p>Você cliente entra em contato conosco informando suas necessidades.</p>
                            
                            </div>
                        </a>
                    </li>
                    <li>
                      <a href="#">
                      <div class="story-img"><img src="images/story2.png"/></div>
                          <div class="story-box">
                              <h4>Call Alinhamento</h4>
                              <p>Call de alinhamento dos pontos necessários do projeto, assim mantendo os dois lados cientes do que vai ser feito.</p>                            
                            </div>
                        </a>
                    </li>
                    <li>
                      <a href="#">
                      <div class="story-img"><img src="images/story3.png"/></div>
                          <div class="story-box">
                              <h4>Contato comercial</h4>
                              <p>Comercial entra em contato com você alinhado valores e prazos do projeto.</p>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    
    <div class="contact" id="contact">
      <div class="container">
          <h3 class="text-head">Contato</h3>
            <p class="box-desc">Ainda ficou com dúvidas, não deixe de entrar em contato com nós !</p>
              <div class="contact-section">
                
                    <form>
                        <input type="text" name="Name" placeholder="Name" />
                          <input type="email" name="email" placeholder="Email"/>
                          <textarea placeholder="Message" rows="6"></textarea>
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
        <script type="text/javascript" src="js/jquery.nicescroll.min.js"></script>
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
      }
      );
    </script>
</body>
</html>
