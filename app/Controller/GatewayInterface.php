<?php

interface GatewayInterface{

	public function __construct();

	/**
	* @return void
	* @param String $token
	**/
	public function setToken($token);

	/**
	* @return void
	* @param String $email
	**/
	public function setEmail($email);

	/**
	* @return String $token
	**/
	public function getToken();

	/**
	* @return String $email
	**/
	public function getEmail();
	
	/**
	* @return void
	* @param Array $produtos
	**/
	public function setProdutos($produtos);

	/**
	* @return Array $produto
	**/
	public function getProdutos();

	/**
	* @param Array Produtos a serem adicionados
	**/
	public function adicionarProdutosGateway();

	public function finalizarPedido();

}