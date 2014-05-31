<?php
	
	include '../Connections/conexao.php';
	include '../configs/config.php';
	require '../classes/BD.class.php';
	require '../classes/pagina_site.class.php';
	require '../classes/endereco_usuario.class.php';
	require '../classes/contato_usuario.class.php';
	require '../classes/pagina_home_site.class.php';

	$pagina_site = new pagina_site();
	$endereco_usuario = new endereco_usuario();
	$contato_usuario = new contato_usuario();
	$pagina_home_site = new pagina_home_site();

	if(isset($_GET['id'])){
		$id_usuario = $_GET['id'];
	}

	//$endereco_usuario->cadastrar_endereco($id_usuario,'07252000','Viela do Contorno, 19','Nova Cidade','Guarulhos','sp','');

	$pagina = 'home';
	$smarty->assign('id_usuario',$id_usuario);

	$dados_pagina = $pagina_site->recuperar_dados_site_id($id_usuario,$pagina);
	//recupera os dados da class e tabela pagina_Site
	foreach ($dados_pagina as $indice => $valor){
		$smarty->assign('title_pagina',$valor['title_pagina']);
		$smarty->assign('description_pagina',$valor['description_pagina']);
		$smarty->assign('nome_empresa_pagina',$valor['nome_empresa_pagina']);		
	}

	$dados_endereco = $endereco_usuario->recuperar_endereco($id_usuario);
	foreach($dados_endereco as $indice => $valor){
		$smarty->assign('bairro',$valor['bairro']);
		$smarty->assign('rua',$valor['rua']);
		$smarty->assign('cidade',$valor['cidade']);
		$smarty->assign('estado',$valor['estado']);
	}

	$dados_contato = $contato_usuario->recuperar_contato($id_usuario);
	foreach($dados_contato as $indice => $valor){
		$smarty->assign('telefone',$valor['telefone']);
	}

	$dados_home_site = $pagina_home_site->recuperar_pagina_home($id_usuario);
	foreach($dados_home_site as $indice => $valor){
		$smarty->assign('titulo_texto_1',$valor['titulo_texto_1']);
		$smarty->assign('texto1',$valor['texto1']);
		$smarty->assign('titulo_texto_2',$valor['titulo_texto_2']);
		$smarty->assign('texto2',$valor['texto_2']);
	}


	$smarty->assign('estilophp','css_dinamico.php?id='.$id_usuario);//declara o estilo php dinamico de acordo com o id get que foi recuperado no carregar pagina

	//$arr = $teste->teste();
	//foreach ($arr as $stmt) {
	//	echo ''
	//}


 	$smarty->display('index.phtml');


