<?php

class UsuarioController extends AppController{
	//faz o login no sistema, com a função autentica_email
	function login(){
		$this->layout = 'ajax';

		$login_email = $this->request->data['email'];
		$login_senha = $this->request->data['senha'];

		if($this->autentica_email($login_email,$login_senha)){
			echo json_encode(true);
		}else{
			echo json_encode(false);
		}
	}

	//autentica email verifica se o email e senha existem para efetuar o login, ou outra acao.
	function autentica_email($email,$senha){
		$this->loadModel('Usuario');
		$resposta = $this->Usuario->find('count', 
								array('conditions' => array('AND' => array('Usuario.email' => $email, 'Usuario.senha' => sha1($senha))
										)
									)
								);
		$this->set('resposta', $resposta);

		return $resposta;
	}			

	//se o email estiver livre retorna false, senão retorna true
	function verificar_email($email){
		$this->layout = 'ajax';
		
		if(empty($email)){
			$email = $this->request->data['email'];
		}

		$this->loadModel('Usuario');
		$resposta = $this->Usuario->find('count',
											array('conditions' => array('Usuario.email' => $email))
										);
		$this->set('resposta', $resposta);

		if($resposta >= 1){
			return true;
		}else{
			return false;
		}
	}

	//se o email estiver livre retorna false, senão retorna true
	function verificar_email_ajax(){
		$this->layout = 'ajax';

		$email = $this->request->data['email'];

		echo  json_encode($this->verificar_email($email));
	}

	//efetua um novo cadastro via ajax com os dados passados pelo metodo postS
	function novo_cadastro(){
		$this->layout = 'ajax';

		$nome  = $this->request->data['nome'];
		$email = $this->request->data['email'];
		$senha = sha1($this->request->data['senha']);
		$erp   = $this->request->data['erp'];
		$ead   = $this->request->data['ead'];
		$site  = $this->request->data['site'];

		if($this->verificar_email($email) == false){
			$data = array('nome' => $nome, 'email' => $email, 'senha' => $senha, 'erp_situacao' => $erp, 'ead_situacao' => $ead, 'site_situacao' => $site, 'usuario_ativo' => 1);
			if($this->Usuario->save($data)){
				echo true;
			}else{
				echo false;
			}
		}else{
			echo false;
		}
	}
}