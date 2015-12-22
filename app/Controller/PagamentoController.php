<?php

require 'PagseguroController.php';

class PagamentoController
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

	public function setEndereco($endereco)
	{
		$this->gateway->setEndereco($endereco);
	}

	public function getEndereco()
	{
		return $this->gateway->getEndereco();
	}

	public function setEnderecoClienteGateway()
	{
		return $this->gateway->setEnderecoClienteGateway();
	}

	public function setReference($reference)
	{
		$this->gateway->setReference($reference);
	}

	public function getReference()
	{
		return $this->gateway->getReference();
	}

	public function setValorFrete($valor_frete)
	{
		$this->gateway->setValorFrete($valor_frete);
	}

	public function getValorFrete()
	{
		return $this->gateway->getValorFrete();
	}

	public function setCliente($cliente)
	{
		$this->gateway->setCliente($cliente);
	}

	public function getCliente()
	{
		return $this->gateway->getCliente();
	}

	public function setClienteGateway()
	{
		return $this->gateway->setClienteGateway();
	}

	public function finalizarPedido()
	{
		return $this->gateway->finalizarPedido();
	}

}