<?php

App::uses('AppController', 'Controller');

class AviseMeController extends AppController
{
	
	public function listar_cadastros()
	{
		$this->loadModel('AviseMe');

		$query = array (
			'joins' => array(
				    array(
				        'table' => 'produtos',
				        'alias' => 'Produto',
				        'type' => 'LEFT',
				        'conditions' => array(
				            'AviseMe.produto_id = Produto.id',
				        ),
				    )
				),
	        'conditions' => array('AviseMe.ativo' => 1, 'AviseMe.usuario_id' => $this->instancia),
	        'fields' => array('Produto.nome, AviseMe.email, AviseMe.id, Produto.id'),
		);

		$cadastros = $this->AviseMe->find('all', $query);
		$this->set('cadastros', $cadastros);

		$this->layout = 'wadmin';
	}

	public function excluir_cadastro($id)
	{
		$this->loadModel('AviseMe');
		$this->layout = 'ajax';

		$id = $this->request->data('id');

		$dados = array ('ativo' => '0');
		$parametros = array ('id' => $id);

		if ($this->AviseMe->updateAll($dados, $parametros)) {
			echo json_encode(true);
		} else {
			echo json_encode(false);
		}
	}

	/**
	* @return boolean
	* Cadastra as informações
	**/
	public function cadastrar_avise_me()
	{	
		try 
		{
			$this->loadModel('AviseMe');

			$this->AviseMe->set($this->request->data);

			if (!$this->AviseMe->validates())
			{
				return $this->AviseMe->validationErrors;
			}

			if (!$this->AviseMe->save($this->request->data))
			{
				return false;
			}

			return true;
		} 
		catch (Exception $e) 
		{
			throw new Exception("Error Processing Request", 1);
		}

		return false;
	}

	public function enviar_email_aviseme($produto_id, $email)
	{
		try {
			$this->loadModel('Produto');

			$produto = $this->Produto->find('all',
				array('conditions' => 
					array('Produto.id' => $produto_id
					)
				)
			);

			App::uses('CakeEmail', 'Network/Email');

			$email = new CakeEmail('aviseme');
			
			$email->from('jr.design_2010@hotmail.com', 'reginaldo')
				  ->to($email)
				  ->subject('Seu produto Chegou');
			
			$mensagem = '
						<p><strong>Nome</strong>: '. $produto['Produto']['nome'] .'</p>
					    ';
			
			if ($email->send($mensagem)) {
				return true;
			}
			
			return false;
		} catch (Exception $e) {
			throw new Exception("Error Processing Request", 1);
		}
	}

}