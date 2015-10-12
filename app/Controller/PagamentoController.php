<?php

require 'GatewayInterface.php';
require 'PagseguroController.php';

class PagamentoController extends AppController implements GatewayInterface
{

	private $gateway = '';	

	public function __construct($gateway)
	{
		$this->gateway = new $gateway();
	}

	/**
	* @return void
	* @param String $token
	**/
	public function setToken($token)
	{
		$this->gateway->setToken($token);
	}

	/**
	* @return void
	* @param String $email
	**/
	public function setEmail($email)
	{
		$this->gateway->setEmail($email);
	}

	/**
	* @return String $token
	**/
	public function getToken()
	{
		return $this->gateway->getToken();
	}

	/**
	* @return String $email
	**/
	public function getEmail()
	{
		return $this->gateway->getEmail();
	}

	public function adicionarProdutos($produtos)
	{
		return true;
	}

	public function removerProdutos($produto)
	{
		return true;
	}

	public function getProdutos()
	{
		return true;
	}

	public function finalizarPedido()
	{
		return true;
	}
}