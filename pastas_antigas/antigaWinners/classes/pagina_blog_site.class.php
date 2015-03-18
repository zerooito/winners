<?php
	class pagina_blog_site{
		private $Id_pagina_blog;
		private $Titulo_texto_1;
		private $Texto1;
		private $Id_usuario;

		function cadastrar_pagina_blog_site($id_usuario){

		}

		function recuperar_pagina_blog_site($id_usuario){
			$this->Id_usuario = $id_usuario;

			$qr = "SELECT * FROM pagina_blog_site WHERE id_usuario = ?";
			$stmt = BD::conn()->prepare($qr);
			$stmt->execute(array($this->Id_usuario));

			return $stmt->fetchAll();
		}	

		function editar_pagina_blog_site($id_usuario){

		}

	}