<?php
	class contato_usuario{
		public $Id_contato;
		private $Telefone;
		private $Celular;
		public $Id_usuario;

		function recuperar_contato($id_usuario){
			$this->Id_usuario = $id_usuario;

			$qr = "SELECT * FROM contato_usuario WHERE id_usuario = ?" or die(mysql_error());
			$stmt = BD::conn()->prepare($qr);
			$stmt->execute(array($this->Id_usuario));

			return $stmt->fetchAll();
		}
	}