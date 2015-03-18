<?php

class AdminController extends AppController{

	public function beforeFilter(){
		return true;
   	}

	public function login() {
		$this->set('admin', true);
		$this->layout = 'login';
	}

	public function processar_login() {
		$dados = $this->request->data('dados');
		
		$retorno = $this->Admin->find('all',
			array('conditions' => 
				array('Admin.login' => $dados['email'], 
					  'Admin.senha' => sha1($dados['senha']),
					  'Admin.ativo' => 1
				)
			)
		);

		if (empty($dados)) {
			echo 'Ocorreu algum erro ao tentar logar tente novamente';
		}

		$this->Session->setFlash('Sucesso!');
        return $this->redirect('/admin/instancias');
	}

}