<?php

class UsuarioController extends AppController{
	function login(){
		$this->layout = "ajax";

		$login_email = $this->request->data['email'];
		$login_senha = $this->request->data['senha'];

		if($this->autentica_email($login_email,$login_senha)){
			echo json_encode('dados corretos');
		}else{
			echo json_encode('dados incorretos');
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
}