<?php
	class pagina_site{
		public $Id_pagina;
		private $Titulo_pagina;
		private $Description_pagina;
		private $Keywords_pagina;
		public $Id_usuario;
		private $Pagina;
		private $Nome_empresa_pagina;

		/*
		*função que cadastar as parametros iniciais do site
		*/
		function cadastrar_pagina_site($id_usuario){
			$this->Titulo_pagina = 'Bem Vindo';
			$this->Description_pagina = 'Sites grátis winners';
			$this->Keywords_pagina = 'Sites grátis keywords';
			$this->Id_usuario = $id_usuario;
			
			for($cont = '0'; $cont < '4'; $cont++)
			{
				$qr = "INSERT INTO pagina_site (title_pagina,description_pagina,keywords_pagina,id_usuario,pagina) VALUES (?,?,?,?,?)" or die(mysql_error());
				$stmt = BD::conn()->prepare($qr);
				switch($cont)
				{
					case '0':
						$this->Pagina = 'home';	
					break;
					case '1':
						$this->Pagina = 'quem_somos';	
					break;
					case '2':
						$this->Pagina = 'blog';	
					break;
					case '3':
						$this->Pagina = 'contato';	
					break;
					default:
						# code...
					break;
				}
				$stmt->execute(array($this->Titulo_pagina,$this->Description_pagina,$this->Keywords_pagina,$this->Id_usuario,$this->Pagina));
			}

			if($stmt == true){
				return true;
			}else{
				return false;
			}
		}

		function editar_dados_pagina_site($title_pagina,$description_pagina,$keywords_pagina,$nome_empresa_pagina,$id_usuario,$pagina){
			$this->Titulo_pagina = $title_pagina;
			$this->Description_pagina = $description_pagina;
			$this->Keywords_pagina = $keywords_pagina;
			$this->Nome_empresa_pagina = $nome_empresa_pagina;
			$this->Id_usuario = $id_usuario;
			$this->Pagina = $pagina;

			$qr = "UPDATE pagina_site SET title_pagina = ?,
										  description_pagina = ?,
										  keywords_pagina = ?,
										  nome_empresa_pagina = ? WHERE id_usuario = ? AND pagina = ?" or die(mysql_error());
			$stmt = BD::conn()->prepare($qr);
			$stmt->execute(array($this->Titulo_pagina,$this->Description_pagina,$this->Keywords_pagina,$this->Nome_empresa_pagina,$this->Id_usuario,$this->Pagina));

			return $stmt;

		}

		function recuperar_dados_site_id($id_usuario,$pagina){
			$this->Id_usuario = $id_usuario;
			$this->Pagina = $pagina;
			$qr = "SELECT * FROM pagina_site WHERE id_usuario = ? AND pagina = ?" or die(mysql_error());

			$stmt = BD::Conn()->prepare($qr);
			$stmt->execute(array($this->Id_usuario,$this->Pagina));

			return $stmt->fetchAll();
		}
	}