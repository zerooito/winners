<?php
	class endereco_usuario{
		public $Id_endereco;
		private $Cep;
		private $Rua;
		private $Bairro;
		private $Cidade;
		private $Estado;
		private $Complemento;
		public $Id_usuario;

		function cadastrar_endereco($id_usuario,$cep,$rua,$bairro,$cidade,$estado,$complemento){
			$this->Cep = $cep;
			$this->Rua = $rua;
			$this->Bairro = $bairro;
			$this->Cidade = $cidade;
			$this->Estado = $estado;
			$this->Complemento = $complemento;
			$this->Id_usuario = $id_usuario;

			$qr = "INSERT INTO endereco_usuario (cep,rua,bairro,cidade,estado,complemento,id_usuario) VALUES (?,?,?,?,?,?,?)" or die(mysql_error());
			$stmt = BD::conn()->prepare($qr);
			$stmt->execute(array($this->Cep,$this->Rua,$this->Bairro,$this->Cidade,$this->Estado,$this->Complemento,$this->Id_usuario));

			return $stmt;
		}	

		function recuperar_endereco($id_usuario){
			$this->Id_usuario = $id_usuario;

			$qr = "SELECT * FROM endereco_usuario WHERE id_usuario = ?" or die(mysql_error());
			$stmt = BD::conn()->prepare($qr);
			$stmt->execute(array($this->Id_usuario));

			return $stmt->fetchAll();
		}
	}