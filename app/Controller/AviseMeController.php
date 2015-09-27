<?php

App::uses('AppController', 'Controller');

class AviseMeController extends AppController
{
	
	public function listar_cadastros()
	{
		
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

	public function enviar_email_aviseme($produto_id)
	{
		try {
			return false;
		} catch (Exception $e) {
			throw new Exception("Error Processing Request", 1);
		}
	}

}