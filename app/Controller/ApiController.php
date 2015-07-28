<?php

class ApiController extends AppController {

	public function beforeFilter(){
		return true;
   	}

	public function wishlist() {
		$this->autoRender = false;
		$this->response->type('json');

		$type = $this->request;
	    
	    if (!$this->validate_use_api($type))
	    	echo '{message: Você não tem permissão para usar nossa API}';

	    if ($type->is('get')) {
	    	echo 'get';
	    } else if ($type->is('post')) {
	    	echo 'post';
	    } else if ($type->is('put')) {
	    	echo 'put';
	    } else if ($type->is('delete')) {
	    	echo 'delete';
	    }
	}

	public function client($id_cliente = null) {
	    $this->loadModel('Cliente');
		$this->autoRender = false;
		$this->response->type('json');
		
		$type = $this->request;

	    if (!$this->validate_use_api($type)) {
	    	echo '{message: Você não tem permissão para usar nossa API}';
	    	exit();
	    }

	    if ($type->is('get')) {
	    	$conditions = array(
				'ativo' => 1,
				'id_usuario' => $this->getIdUser(),
			);

			if (isset($id_cliente))
			 	$conditions['id'] = $id_cliente;


		    $cliente = $this->Cliente->find('all', 
				array('conditions' => 
					$conditions
				)
			);

			$this->response->body(json_encode($cliente));
	    } else if ($type->is('post')) {
	    	$dados = $this->request->data;

	    	if (empty($dados['nome1']) && empty($dados['nome2']) && !empty($dados['email']) && !empty($dados['senha'])) {
		    	$conditions = array(
					'ativo' => 1,
					'id_usuario' => $this->getIdUser(),
					'email' => $dados['email'],
					'senha' => $dados['senha']
				);

			    $cliente = $this->Cliente->find('all', 
					array('conditions' => 
						$conditions
					)
				);

				$this->response->body(json_encode($cliente));
	    	}

	    	$dados['senha'] = sha1($dados['senha']);
			$dados['ativo'] = 1;
			$dados['id_usuario'] = $this->instancia;
			
			if ($this->Cliente->save($dados)) {
				$this->response->body('{message: success, result:'.json_encode($dados).'}');
			} else {
				$this->response->body('{message: error}');
			}
	    } else if ($type->is('put')) {
	    	echo 'put';
	    } else if ($type->is('delete')) {
	    	echo 'delete';
	    }
	}

	/**
	* Valida o usuario que está tentando usar a api
	*/
	public function validate_use_api($req) {
		$this->loadModel('Usuario');
		
		$data['auth'] = $req->query;
		
		$resposta = $this->Usuario->find('all',
			array('conditions' => 
				array('Usuario.email' => $data['auth']['email'], 
					  'Usuario.senha' => sha1($data['auth']['senha'])
				)
			)
		)[0];

		if (empty($resposta)) {
			return false;
		}

		$this->setIdUser($resposta['Usuario']['id']);

		return true;
	}

	public function setIdUser($id) {
		$this->instancia = $id;
	}

	public function getIdUser() {
		return $this->instancia;
	}
}