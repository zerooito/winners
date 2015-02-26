<?php
	class pagina_home_site{


		function recuperar_pagina_home($id_usuario){
			$qr = "SELECT * FROM pagina_home_site WHERE id_usuario = ?" or die(mysql_error());
			$stmt = BD::conn()->prepare($qr);
			$stmt->execute(array($id_usuario));

			return $stmt->fetchAll();
		}

		function atualizar_texto_pagina_home($titulo_texto_1,$texto_1,$titulo_texto_2,$texto_2,$id_usuario,$background_color){
			
			if($this->verificar_pagina($id_usuario) == true){
				$qr = "INSERT INTO pagina_home_site (titulo_texto_1,texto1,titulo_texto_2,texto_2,id_usuario,background_color) VALUES (?,?,?,?,?,?)" or die(mysql_error());
				$stmt = BD::conn()->prepare($qr);
				$stmt->execute(array($titulo_texto_1,$texto_1,$titulo_texto_2,$texto_2,$id_usuario,$background_color));
				if($stmt = true){
					return true;
				}else{
					return false;
				}
			}else{
				$qr = "UPDATE pagina_home_site SET  titulo_texto_1 = ?,
													texto1 = ?,
													titulo_texto_2 = ?,
													texto_2 = ?,
													background_color = ? WHERE id_usuario = ?"
												or die(mysql_error());
				$stmt = BD::conn()->prepare($qr);
				$stmt->execute(array($titulo_texto_1,$texto_1,$titulo_texto_2,$texto_2,$background_color,$id_usuario));
				if($stmt = true){
					return true;
				}else{
					return false;
				}
			}

		}

		function verificar_pagina($id_usuario){
			$qr = "SELECT * FROM pagina_home_site WHERE id_usuario = ?" or die(mysql_error());
			$stmt = BD::conn()->prepare($qr);
			$stmt->execute(array($id_usuario));

			$cont = $stmt->rowCount();

			if($cont >= 1){
				return false;
			}else{
				return true;
			}
		}
	}