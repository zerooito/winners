<?php

class UsuarioController extends AppController{
	function login(){
		$this->layout = "ajax";

		$login_email = $this->request->data['email'];
		$login_senha = $this->request->data['senha'];

		if($this->autentica_email($login_email,$login_senha)){
			echo json_encode(true);
		}else{
			echo json_encode(false);
		}
	}

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

	function novo_cadastro(){
		$this->layout = 'ajax';

		$nome = $this->request->data['nome'];
		$email = $this->request->data['email'];
		$senha = $this->request->data['senha'];
		$erp = $this->request->data['erp'];
		$ead = $this->request->data['ead'];
		$site = $this->request->data['site'];

		$data = array('nome' => $nome, 'email' => $email, 'senha' => $senha, 'erp_situacao' => $erp, 'ead' => $ead, 'site' => $site);
		$this->Usuario->save($data);
	}
}