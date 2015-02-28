<?php
	class pagina_quem_somos_site{
		private $Id_pagina_quem_somos;
		private $Titulo_texto1;
		private $Texto1;
		private $Id_usuario;

		function cadastrar_pagina_quem_somos_site($id_usuario){

		}

		function editar_pagina_quem_somos_site($titulo, $texto1, $id_usuario){
			$this->Titulo_texto1 = $titulo;
			$this->Texto1 = $texto1;
			$this->Id_usuario = $id_usuario;

			$qr = "SELECT * FROM pagina_quem_somos_site WHERE id_usuario = ?" or die(mysql_error());
			$stmt = BD::conn()->prepare($qr);
			$stmt->execute(array($this->Id_usuario));
			$cont = $stmt->rowCount();
			if($cont >= 1){
				$qr = "UPDATE pagina_quem_somos_site SET
													titulo_texto_1 = ?,
													texto1 = ?
													WHERE id_usuario = ?" or die(mysql_error());
				$stmt = BD::conn()->prepare($qr);
				$stmt->execute(array($this->Titulo_texto1,$this->Texto1,$this->Id_usuario));

				if($stmt == true){
					return true;
				}else{
					return false;
				}
			}else{
				$qr = "INSERT INTO pagina_quem_somos_site (titulo_texto_1,texto1,id_usuario) VALUES (?,?,?)" or die(mysql_error());
				$stmt = BD::conn()->prepare($qr);
				$stmt->execute(array($this->Titulo_texto1,$this->Texto1,$this->Id_usuario));

				if($stmt == true){
					return true;
				}else{
					return false;
				}
			}

		}

		function recuperar_pagina_quem_somos_site($id_usuario){
			$this->Id_usuario = $id_usuario;

			$qr = "SELECT * FROM pagina_quem_somos_site WHERE id_usuario = ?" or die(mysql_error());
			$stmt = BD::conn()->prepare($qr);
			$stmt->execute(array($this->Id_usuario));

			return $stmt->fetchAll();
		}
	}