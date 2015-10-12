<?php

interface GatewayInterface{

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
	* @param Array Produtos a serem adicionados
	**/
	public function adicionarProdutos($produtos);
	
	public function removerProdutos($produto);
	public function getProdutos();
	public function finalizarPedido();

}