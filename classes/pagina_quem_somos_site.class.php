<?php
	class pagina_quem_somos_site{
		private $Id_pagina_quem_somos;
		private $Titulo_texto1;
		private $Texto1;
		private $Id_usuario;

		function cadastrar_pagina_quem_somos_site($id_usuario){

		}

		function editar_pagina_quem_somos_site($id_usuario){

		}

		function recuperar_pagina_quem_somos_site($id_usuario){
			$this->Id_usuario = $id_usuario;

			$qr = "SELECT * FROM pagina_quem_somos_site WHERE id_usuario = ?" or die(mysql_error());
			$stmt = BD::conn()->prepare($qr);
			$stmt->execute(array($this->Id_usuario));

			return $stmt->fetchAll();
		}
	}