<?php
	class user{

		private $Nome;
		private $Email;
		private $Senha;
		private $Erp;
		private $Ead;
		private $Site;

		//função que transformar uma string em criptografia sha
		//pega um parametro senha e transformado a private e retonado ela
		function criptografar($senha){
			$this->Senha = sha1($senha);
			return $this->Senha;
		}

		
		/*
		Função que retorna todos os dados da Nome pelo seu id
		*/
		public function meus_dados($id){
			$qr = "SELECT * FROM usuario WHERE id_usuario = ?";

			$stmt = BD::conn()->prepare($qr);
	        $stmt->execute(array($id));
	        return $stmt->fetchAll();
		}
		
		public function meus_dados_email($email,$senha){
			$this->Email = $email;
			$this->Senha = $this->criptografar($senha);

			$qr = "SELECT * FROM usuario WHERE email = ? AND senha = ?";

			$stmt = BD::conn()->prepare($qr);
	        $stmt->execute(array($this->Email,$this->Senha));
	        return $stmt->fetchAll();
		}
		/*
		*
		Função que verifica se o email já está cadastrado no banco
		*/
		function verifica_user($email){
			$this->Email = $email;

			$qr = "SELECT * FROM usuario WHERE email = ?" or die(mysql_error());
			
			$stmt = BD::conn()->prepare($qr);
			$stmt->execute(array($this->Email));

			$cont = $stmt->rowCount();
			if($cont >= 1){
				return false;
			}else{
				return true;
			}
		}


		function cadastrar($nome,$email,$senha,$erp,$ead,$site){
			$this->Nome = $nome;
			$this->Email = $email;
			$this->Senha = $this->criptografar($senha);
			$this->Erp = $erp;
			$this->Ead = $ead;
			$this->Site = $site;

			if($this->verifica_user($this->Email) == true){
			
				$qr = "INSERT INTO usuario (nome,email,senha,erp_situacao,ead_situacao,site_situacao,usuario_ativo) VALUES (?,?,?,?,?,?,?)" or die(mysql_error());

				$stmt = BD::conn()->prepare($qr);
				$stmt->execute(array($this->Nome,$this->Email,$this->Senha,$this->Erp,$this->Ead,$this->Site,"1"));
				if($stmt = true){
					return true;
				}else{
					return false;
				}
			}else{
				return 'Email já cadastrado';
			}
		}
		
		/*
		*
		Função que faz o logn da instituição
		*
		*/
		function logar($email, $senha){
			$this->Email = $email;
			$this->Senha = $this->criptografar($senha);

			$qr = "SELECT * FROM usuario WHERE EMAIL = ? AND SENHA = ?" or die(mysql_error());

			$stmt = BD::conn()->prepare($qr);
			$stmt->execute(array($this->Email,$this->Senha));

			if($stmt->rowCount() <= 0){
				return false;
			}else{
				return true;
			}
		}

		//function cadastrar_aluno($id_turma,$)

	}