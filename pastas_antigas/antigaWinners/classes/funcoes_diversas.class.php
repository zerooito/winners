<?php 
	class funcoes_diversas{
		function upload_foto($nome){
			// Recupera os dados dos campos 
			$nome = $_POST['nome'];
			$email = $_POST['email']; 
			$foto = $_FILES["foto"];   
			
	 		// Extensões permitidas 
	 		$extensoes = array(".doc", ".txt", ".pdf", ".docx", ".jpg"); 

	 		// Caminho onde ficarão os arquivos 
	 		$caminho = "uploads/"; 
	 		// Recuperando informações do arquivo 
	 		$nome = $_FILES['arquivo']['name']; 
	 		$temp = $_FILES['arquivo']['tmp_name']; 
	 		// Verifica se a extensão é permitida 
	 		if (!in_array(strtolower(strrchr($nome, ".")), $extensoes)) { 
	 			$erro = 'Extensão inválida'; 
	 		} 

	 		// Se não houver erro 
	 		if (!isset($erro)) { 
	 			// Gerando um nome aleatório para o arquivo 
	 			$nomeAleatorio = md5(uniqid(time())) . strrchr($nome, "."); 
	 			// Movendo arquivo para servidor 
	 			if (!move_uploaded_file($temp, $caminho . $nomeAleatorio)) 
	 				$erro = 'Não foi possível anexar o arquivo'; 
	 		} 
		}
	}