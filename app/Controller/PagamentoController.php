<?php

require 'PagseguroController.php';

class PagamentoController extends AppController
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

	/**
	* @return void
	* @param Array $produtos
	**/
	public function setProdutos($produto)
	{
		$this->gateway->setProdutos($produto);
	}

	/**
	* @return Array $produto
	**/
	public function getProdutos()
	{
		return $this->gateway->getProdutos();
	}

	public function adicionarProdutosGateway()
	{
		return $this->gateway->adicionarProdutosGateway();
	}

	public function removerProdutos($produto)
	{
		return true;
	}

	public function finalizarPedido()
	{
		return true;
	}
}