<?php
      $useragent = $_SERVER['HTTP_USER_AGENT'];
      $ipe = $_SERVER['SERVER_ANDRESS'];

      if (preg_match('|MSIE ([0-9].[0-9]{1,2})|',$useragent,$matched)) {
        echo 'Não fornecemos suporte para IE8 e IE9.<br/>
              A internet está sempre evoluindo então evolua e baixe o navegador mais recente.
              Escolha: Google Chorme | Firefox | Safari';
        die;
      }
      //mail('jr.design_2010@hotmail.com','ip visitante',$ip);
	  include 'Connections/conexao.php';
	  include 'configs/config.php';
	  require 'classes/BD.class.php';
	  require 'classes/user.class.php';
	  require 'classes/pagina_quem_somos_site.class.php';

	  $user = new user();
	  $pagina_quem_somos_site = new pagina_quem_somos_site();

		$smarty->assign('titulo', 'Bem Vindo, Logue na sua conta user');
		$smarty->assign('h1', 'Faça o Cadastro, Grátis !');

		/*if(isset($_POST['acao']) == 'inserir'){
			$nome = $_POST['nome'];
			$email = $_POST['email'];
			$senha = $_POST['senha'];

			$new = $user->cadastrar($nome,$email,$senha);
			
			$new = json_encode($new);
			echo $new;
		}

		/*if(isset($_POST['acao']) == 'verificar'){
			$email = $_POST['email'];
			$new = $user->verifica_user($email);
			$new = json_encode($new);

			echo $new;
		}*/

//		print_r($user->meus_dados(1));
		$cifrao = "$";
		//print_r($user->meus_dados_email('jr.design_2010@hotmail.com','grafic79'));

		$smarty->assign('script',"<!--Start of Zopim Live Chat Script--><script type='text/javascript'>
    window.".$cifrao."zopim||(function(d,s){var z=".$cifrao."zopim=function(c){z._.push(c)},".$cifrao."=z.s=
    d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
    _.push(o)};z._=[];z.set._=[];$.async=!0;".$cifrao.".setAttribute('charset','utf-8');
    ".$cifrao.".src='//v2.zopim.com/?29Cgb0x8PWQ3X1FKXZXUNJx4D9TjDD5d';z.t=+new Date;".$cifrao.".
    type='text/javascript';e.parentNode.insertBefore(".$cifrao.",e)})(document,'script');
    </script>
    <!--End of Zopim Live Chat Script-->");
		$smarty->display('index.phtml');

