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

	public function client($id_cliente) {
	    $this->loadModel('Cliente');
		$this->autoRender = false;
		$this->response->type('json');
		
		$type = $this->request;

	    if (!$this->validate_use_api($type))
	    	echo '{message: Você não tem permissão para usar nossa API}';

	    if ($type->is('get')) {
		    $cliente = $this->Cliente->find('all', 
				array('conditions' => 
					array(
						'ativo' => 1,
						'id_usuario' => $this->getIdUser(),
						'id' => $id_cliente
					)
				)
			);

			$this->response->body(json_encode($cliente));
	    } else if ($type->is('post')) {
	    	$this->request->data;

			$dados['ativo'] = 1;
			$dados['id_usuario'] = $this->instancia;

			pr($dados);
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