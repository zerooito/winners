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
					  'Admin.senha' => $dados['senha'],
					  'Admin.ativo' => 1
				)
			)
		);

		if (empty($retorno)) {
			$this->Session->setFlash('Erro os dados inseridos não foram encotrados!');
	        return $this->redirect('/admin/usuarios');
		}

		$this->Session->write('Admin.logado', true);

		$this->Session->setFlash('Sucesso!');
        return $this->redirect('/admin/usuarios');
	}

	public function usuarios() {
		$this->verificar_acesso_admin();
	}
}