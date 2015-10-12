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
	public function setProduto($produto)
	{
		$this->gateway->setProduto($produto);
	}

	/**
	* @return Array $produto
	**/
	public function getProduto()
	{
		return $this->gateway->getProduto();
	}

	public function adicionarProdutos()
	{
		return $this->gateway->adicionarProdutos();
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