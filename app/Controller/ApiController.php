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
		$api = 'cliente';
	    $this->loadModel('Cliente');
		$this->autoRender = false;
		$this->response->type('json');
		
		$type = $this->request;

	    if (!$this->validate_use_api($type, $api)) {
	    	echo '{message: Você não tem permissão para usar nosso modulo}';
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

	public function parent($id_cliente, $id_parente = null)
	{
		$api = 'parente';

	    $this->loadModel('Parente');

		$this->autoRender = false;
		$this->response->type('json');
		
		$type = $this->request;

	    if (!$this->validate_use_api($type, $api)) {
	    	echo '{message: Você não tem permissão para usar nosso modulo}';
	    	return;
	    }

	    if ($type->is('get')) {
	    	$conditions = array(
				'ativo' => 1,
				'usuario_id' => $this->getIdUser(),
			);

			$conditions['cliente_id'] = $id_cliente;

			if (isset($id_parente)) {
				$conditions['id'] = $id_parente;
			}

		    $parentes = $this->Parente->find('all', 
				array('conditions' => 
					$conditions
				)
			);

			$this->response->body(json_encode($parentes));
	    } else if ($type->is('post')) {
	    	$dados = $this->request->data;
	    	
	    	if (empty($dados)) {
				$this->response->body(json_encode(array('message' => 'Ocorreu algum erro com os parametros passados')));
				return;
	    	}

	    	if (!empty($dados['cliente_id'])) {
	    		$this->postParent($dados);
	    	} 

	    	$this->loginParent($dados, $id_cliente);
	    } else if ($type->is('put')) {

	    	$dados = $this->request->data;
	    	
			if (empty($dados)) {
				$this->response->body(json_encode(array('message' => 'Ocorreu algum erro com os parametros passados')));
				return;
	    	}

	    	if ($id_parente == null) {
	    		$this->response->body(json_encode(array('message' => 'Você não passou o id do usuario')));
	    		return;
	    	}

	    	$this->putParent($dados, $id_parente);
	    } else if ($type->is('delete')) {
	    	
	    	if ($id_parente == null) {
	    		$this->response->body(json_encode(array('message' => 'Você não passou o id do usuario')));
	    		return;
	    	}

	    	$this->inactiveClient($id_parente);
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
	    }
		
		$this->response->body('{"message": "error"}');
		return;	    
	}

	public function postClient($dados)
	{
    	$dados['senha'] = sha1($dados['senha']);
		$dados['ativo'] = 1;
		$dados['id_usuario'] = $this->instancia;
		
		if ($this->Cliente->save($dados)) {
			$this->response->body('{"message": "success", "result":'.json_encode($dados).'}');
			return;
		}

		$this->response->body('{"message": "error"}');
		return;
	}

	public function putClient($dados, $id_cliente)
	{
		if ($dados['senha'] != '') {
			$dados['senha'] = sha1($dados['senha']);
		}

		$this->Cliente->id = $id_cliente;
		$this->Cliente->id_usuario = $this->getIdUser();

		if ($this->Cliente->save($dados)) {
			$this->response->body('{"message": "success", "result": '. json_encode($dados) .'}');
			return;
		}

		$this->response->body('{"message": "error"}');
		return;
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


	public function postParent($dados)
	{
    	$dados = array(
			'senha'      => sha1($dados['senha']),
			'usuario_id' => $this->getIdUser(),
			'cliente_id' => $dados['cliente_id'],
			'login'      => $dados['login'],
			'ativo'      => 1,
		);
		
		if ($this->Parente->save($dados)) {
			$this->response->body('{"message": "success", "result":'.json_encode($dados).'}');
			return;
		}

		$this->response->body('{"message": "error"}');
		return;
	}

	public function loginParent($dados, $id_cliente) 
	{
    	$conditions = array(
			'ativo' => 1,
			'usuario_id' => $this->getIdUser(),
			'cliente_id' => $id_cliente,
			'login' => $dados['login'],
			'senha' => sha1($dados['senha'])
		);

	    $parente = $this->Parente->find('all', 
			array('conditions' => 
				$conditions
			)
		);

	    if (!empty($parente)) {
			$this->response->body('{"message": "success", "result":'.json_encode($parente).'}');
			return;
	    }
		
		$this->response->body('{"message": "error"}');
		return;	
	}

	public function putParent($dados, $id_parente) 
	{
		if ($dados['senha'] != '') {
			$dados['senha'] = sha1($dados['senha']);
		}

		$this->Parente->id = $id_parente;
		$this->Parente->id_usuario = $this->getIdUser();

		if ($this->Parente->save($dados)) {
			$this->response->body('{"message": "success", "result": '. json_encode($dados) .'}');
			return;
		}

		$this->response->body('{"message": "error"}');
		return;
	}

	public function inactiveParent($id_parente) 
	{
		$dados['ativo'] = 0;
		
		$this->Parente->id = $id_parente;

		if ($this->Parente->save($dados)) {
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
	public function validate_use_api($req, $api)
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

		if (empty($resposta))
		{
			return false;
		}

		$this->setIdUser($resposta['Usuario']['id']);

		if (!$this->verifyUseApi($api)) 
		{
			return false;
		}

		return true;
	}

	public function verifyUseApi($api)
	{
		$this->loadModel('ModuloRelacionaUsuario');

		$modulos = $this->ModuloRelacionaUsuario->find('all',
		array('conditions' => 
			array('ModuloRelacionaUsuario.id_usuario' => $this->getIdUser(), 
				  'ModuloRelacionaUsuario.ativo' => 1,
				  'Modulo.ativo' => 1
				)
			)
		);

		foreach ($modulos as $i => $modulo) {
			if ($modulo['Modulo']['modulo'] == $api) {
				return true;
			}
		}

		return false;
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
