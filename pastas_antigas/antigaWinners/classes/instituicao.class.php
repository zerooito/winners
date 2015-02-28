<?php
	class instituicao{

		private $Instituicao;
		private $Email;
		private $Senha;
		private $Erp;
		private $Ead;
		private $Site;

		//função que transformar uma string em criptografia sha
		//pega um parametro senha e transformado a private e retonado ela
		public function criptografar($senha){
			$this->Senha = sha1($senha);
			return $this->Senha;
		}

		
		/*
		Função que retorna todos os dados da instituicao pelo seu id
		*/
		public function meus_dados($id){
			$qr = "SELECT * FROM usuario WHERE id_usuario = ?";

			$stmt = BD::conn()->prepare($qr);
	        $stmt->execute(array($id));
	        return $stmt->fetchAll();
		}

		/*
		*
		Função que verifica se o email já está cadastrado no banco
		*/
		function verifica_instituicao($email){
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


		function cadastrar($instituicao,$email,$senha,$ead,$erp,$site){
			$this->Instituicao = $instituicao;
			$this->Email 	   = $email;
			$this->Senha       = $this->criptografar($senha);
			$this->Ead = $ead;
			$this->Erp = $erp;
			$this->Site = $site;

			if($this->verifica_instituicao($this->Email) == true){
			
				$qr = "INSERT INTO usuario (nome,email,senha,ead_situacao,erp_situacao,site_situacao) VALUES (?,?,?,?,?,?)" or die(mysql_error());

				$stmt = BD::conn()->prepare($qr);
				$stmt->execute(array($this->Instituicao,$this->Email,$this->Senha,$this->Ead,$this->Erp,$this->Site));
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