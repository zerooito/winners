<?php
	class instituicao{

		function meus_dados($id_instituicao){
			$qr = BD::conn()->prepare("SELECT * FROM table_instituicao WHERE ID_INSTITUICAO = ?");
			$qr->execute(array($id_instituicao));

			return $stmt->fetchAll();
		}

	}