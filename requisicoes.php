<?php
	include 'Connections/conexao.php';
	include 'configs/config.php';
	require 'classes/BD.class.php';
	require 'classes/user.class.php';
	require 'classes/pagina_site.class.php';
	require 'classes/postagens_blog_site.class.php';
	require 'classes/pagina_home_site.class.php';

	$user = new user();
	$pagina_site = new pagina_site();
	$postagens_blog_site = new postagens_blog_site();
	$pagina_home_site = new pagina_home_site();
	
	$acao = $_POST['acao'];

	switch($acao)
	{
		case 'inserir':
			$nome = $_POST['nome'];
			$email = $_POST['email'];
			$senha = $_POST['senha'];
			$erp = $_POST['erp'];
			$ead = $_POST['ead'];
			$site = $_POST['site'];

			$new = $user->cadastrar($nome,$email,$senha,$erp,$ead,$site);
			
			if($site == '1'){
				//recupera o id do usuario que acabou de se cadastrar
				foreach ($user->meus_dados_email($email,$senha) as $indice => $valor) {
					$id_usuario = $valor['id_usuario'];
				}
				//faz o cadastro das configuracoes iniciais do site
				$pagina_site->cadastrar_pagina_site($id_usuario);
				mail($email, 'Cadastro Winners', 'Cadastro efetuado com sucesso', $headers);
			}else{}

			$x = json_encode($new);
			echo $x;
		break;
		case 'logar':
			$email = $_POST['email'];
			$senha = $_POST['senha'];

			$new = $user->logar($email, $senha);
			if($new == true){
				session_start();
				$_SESSION['email'] = $email;
				$_SESSION['senha'] = $senha;
			}			
			$x = json_encode($new);
			echo $x;
		break;
		case 'verifica_email':
			$email = $_POST['email'];

			$new = $user->verifica_user($email);

			$x = json_encode($new);
			echo $x;
		break;
		case 'atualizar_blog':
			$id_usuario = $_POST['id_usuario'];

			$postagens = $postagens_blog_site->recuperar_posts_blog_site($id_usuario);
			$post = '';
			foreach($postagens as $indice => $valor) {
				$post .= '<img class="img-responsive img-border img-full" src="img/slide-1.jpg" alt=""><h2>'.$valor['titulo_postagem'].'<br><small>'.$valor['data_postagem'].'</small></h2><p>'.$valor['texto_postagem'].'.</p><hr>';
			}

			$x = json_encode($post);
			echo $x;
		break;
		case 'contar_postagens':
			$id_usuario = $_POST['id_usuario'];

			$cont = $postagens_blog_site->contar_posts_blog_site($id_usuario);

			$x = json_encode('Blog ('.$cont.')');
			echo $x;
		break;
		case 'enviar_email':
			$email_remetente = $_POST['email_remetente'];
			$email_destinario = $_POST['email_destinario'];
			$nome = $_POST['nome'];
			$telefone = $_POST['telefone'];
			$mensagem = $_POST['mensagem'];
			$assunto = 'email de contato automatico da pagina de contato do wsite';

			$mensagem .= '| Quem enviou este email: '.$email_remetente.' | Nome da pessoa: '.$nome.'| Telefone: '.$telefone;

			$x = mail($email_destinario, $assunto, $mensagem, $headers);
			echo $x;
		break;
		case 'atualizar_dados_pagina_home':
			$title_home = $_POST['title_home'];
			$description_home = $_POST['description_home'];
			$keywords_home = $_POST['keywords_home'];
			$empresa_home = $_POST['empresa_home'];
			$id_usuario = base64_decode($_POST['id_usuario']);
			$pagina = 'home';

			$new = $pagina_site->editar_dados_pagina_site($title_home,$description_home,$keywords_home,$empresa_home,$id_usuario,$pagina);

			$x = json_encode($new);
			echo $x;
		break;
		case 'atualizar_texto_home':
			$titulo_1 = $_POST['titulo_1'];
			$texto_1 = $_POST['texto_1'];
			$titulo_2 = $_POST['titulo_2'];
			$texto_2 = $_POST['texto_2'];
			$id_usuario = base64_decode($_POST['id_usuario']);
			$background_color = $_POST['background_color'];

			$new = $pagina_home_site->atualizar_texto_pagina_home($titulo_1,$texto_1,$titulo_2,$texto_2,$id_usuario,$background_color);

			$x = json_encode($new);
			echo $x;
		break;
		case 'atualizar_dados_pagina_blog':
			$title_blog = $_POST['title_blog'];
			$description_blog = $_POST['description_blog'];
			$keywords_blog = $_POST['keywords_blog'];
			$empresa_blog = $_POST['empresa_blog'];
			$id_usuario = base64_decode($_POST['id_usuario']);
			$pagina = 'blog';

			$new = $pagina_site->editar_dados_pagina_site($title_blog,$description_blog,$keywords_blog,$empresa_blog,$id_usuario,$pagina);

			$x = json_encode($new);
			echo $x;
		break;
		case 'atualizar_dados_pagina_quem_somos':
			$title_quem_somos = $_POST['title_quem_somos'];
			$description_quem_somos = $_POST['description_quem_somos'];
			$keywords_quem_somos = $_POST['keywords_quem_somos'];
			$empresa_quem_somos = $_POST['empresa_quem_somos'];
			$id_usuario = base64_decode($_POST['id_usuario']);
			$pagina = 'quem_somos';

			$new = $pagina_site->editar_dados_pagina_site($title_quem_somos,$description_quem_somos,$keywords_quem_somos,$empresa_quem_somos,$id_usuario,$pagina);

			$x = json_encode($new);
			echo $x;
		break;
		case 'atualizar_dados_pagina_contato':
			$title_contato = $_POST['title_contato'];
			$description_contato = $_POST['description_contato'];
			$keywords_contato = $_POST['keywords_contato'];
			$empresa_contato = $_POST['empresa_contato'];
			$id_usuario = base64_decode($_POST['id_usuario']);
			$pagina = 'contato';

			$new = $pagina_site->editar_dados_pagina_site($title_contato,$description_contato,$keywords_contato,$empresa_contato,$id_usuario,$pagina);

			$x = json_encode($new);
			echo $x;
		break;
	}
?>

