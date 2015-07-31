<?php

class ApiController extends AppController {

	public function beforeFilter()
	{
		return true;
   	}

	public function wishlist()
	{
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

	public function client($id_cliente = null)
	{
	    $this->loadModel('Cliente');
		$this->autoRender = false;
		$this->response->type('json');
		
		$type = $this->request;

	    if (!$this->validate_use_api($type)) {
	    	echo '{message: Você não tem permissão para usar nossa API}';
	    	return;
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

	    	if (empty($dados)) {
				$this->response->body(json_encode(array('message' => 'Ocorreu algum erro com os parametros passados')));
				return;
	    	}

	    	if (!empty($dados['nome1']) && !empty($dados['nome2']) && !empty($dados['email']) && !empty($dados['senha'])) {
	    		$this->postClient($dados);
	    	} 

	    	$this->loginClient($dados);
	    } else if ($type->is('put')) {
	    	$dados = $this->request->data;
	    	
			if (empty($dados)) {
				$this->response->body(json_encode(array('message' => 'Ocorreu algum erro com os parametros passados')));
				return;
	    	}

	    	if ($id_cliente == null) {
	    		$this->response->body(json_encode(array('message' => 'Você não passou o id do usuario')));
	    		return;
	    	}

	    	$this->putClient($dados, $id_cliente);
	    } else if ($type->is('delete')) {
	    	
	    	if ($id_cliente == null) {
	    		$this->response->body(json_encode(array('message' => 'Você não passou o id do usuario')));
	    		return;
	    	}

	    	$this->inactiveClient($id_cliente);
	    }
	}

	public function loginClient($dados)
	{

    	$conditions = array(
			'ativo' => 1,
			'id_usuario' => $this->getIdUser(),
			'email' => $dados['email'],
			'senha' => sha1($dados['senha'])
		);

	    $cliente = $this->Cliente->find('all', 
			array('conditions' => 
				$conditions
			)
		);

	    if (!empty($cliente)) {
			$this->response->body('{"message": "success", "result":'.json_encode($cliente).'}');
			return;
	    } else {
			$this->response->body('{"message": "error"}');
			return;
	    }
	}

	public function postClient($dados)
	{
    	$dados['senha'] = sha1($dados['senha']);
		$dados['ativo'] = 1;
		$dados['id_usuario'] = $this->instancia;
		
		if ($this->Cliente->save($dados)) {
			$this->response->body('{"message": "success", "result":'.json_encode($dados).'}');
			return;
		} else {
			$this->response->body('{"message": "error"}');
			return;
		}		
	}

	public function inactiveClient($id_cliente) 
	{
		$dados['ativo'] = 0;
		
		$this->Cliente->id = $id_cliente;

		if ($this->Cliente->save($dados)) {
			$this->response->body('{"message": "success", "result":'.json_encode($dados).'}');
			return;
		} else {
			$this->response->body('{"message": "error"}');
			return;
		}	
	}

	public function putClient($dados, $id_cliente) 
	{
		if (!empty($dados['senha'])) {
			$dados['senha'] = sha1($dados['senha']);
		}

		$this->Cliente->id = $id_cliente;

		if ($this->Cliente->save($dados)) {
			$this->response->body('{"message": "success", "result":'.json_encode($dados).'}');
			return;
		} else {
			$this->response->body('{"message": "error"}');
			return;
		}		
	}


	/**
	* Valida o usuario que está tentando usar a api
	*/
	public function validate_use_api($req)
	{
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

	public function setIdUser($id)
	{
		$this->instancia = $id;
	}

	public function getIdUser()
	{
		return $this->instancia;
	}
}