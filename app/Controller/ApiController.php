<?php

class ApiController extends AppController {

	public function beforeFilter()
	{
		return true;
   	}

	public function wishlist($dados)
	{
		return true;
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

	public function parent($id_cliente = null, $id_parente = null)
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

	    	$this->loginParent($dados);
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

	public function occurrences($id_cliente = null) 
	{
		$api = 'parente';	

		$this->autoRender = false;
		$this->response->type('json');
		$this->loadModel('Ocorrencias');

		$type = $this->request;

	    if ($type->is('get'))
	    {
	    	$conditions = array(
				'ativo' => 1,
				'cliente_id' => $id_cliente,
			);

			$conditions['cliente_id'] = $id_cliente;

		    $ocorrencias = $this->Ocorrencias->find('all', 
				array('conditions' => 
					$conditions
				)
			);

			$this->response->body(json_encode($ocorrencias));	    	
	    }
	}

	public function newsletter()
	{
		$api = 'newsletter';

		$this->loadModel('Newsletter');

		$this->autoRender = false;
		$this->response->type('json');
		
		$type = $this->request;

	    if (!$this->validate_use_api($type, $api)) {
	    	echo '{message: Você não tem permissão para usar nosso modulo}';
	    	return;
	    }

    	$request = $this->request->data;
    	
    	if (empty($request)) {
			$this->response->body(json_encode(array('message' => 'Ocorreu algum erro com os parametros passados')));
			return;
    	}

		$dados = array(
			'email'  => $request['email'],
			'origem' => $request['origem'],
			'ativo'  => 1,
			'usuario_id' => $this->getIdUser()
		);

		$this->Newsletter->save($dados);

		$this->response->body('{"message": "success", "result":'.json_encode($dados).'}');
		return;		
	}

	public function banner()
	{
		$api = 'banner';

		$this->loadModel('Banner');

		$this->autoRender = false;
		$this->response->type('json');

		$type = $this->request;

		if (!$this->validate_use_api($type, $api)) {
	    	echo '{message: Você não tem permissão para usar nosso modulo}';
	    	return;
	    }

    	$conditions = array(
			'ativo' => 1,
			'id_usuario' => $this->getIdUser()
		);

	    $banner = $this->Banner->find('all', 
			array('conditions' => 
				$conditions
			)
		);

	    if (!empty($banner)) {
			$this->response->body('{"message": "success", "result":'.json_encode($banner).'}');
			return;
	    }
		
		$this->response->body('{"message": "error"}');
		return;	
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
		$this->loadModel('Cliente');

    	$dados['senha'] = sha1($dados['senha']);
		$dados['ativo'] = 1;
		$dados['id_usuario'] = $this->instancia;
		
		if ($this->Cliente->save($dados)) {
			$this->response->body('{"message": "success", "result":'.json_encode($dados).'}');
			return;
		}

		$this->response->body('{"message": "error"}');
		return true;
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

	public function loginParent($dados) 
	{
    	$conditions = array(
			'ativo' => 1,
			'usuario_id' => $this->getIdUser(),
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
		if (!is_numeric($this->instancia))
		{
			return false;
		}

		return $this->instancia;
	}
}
