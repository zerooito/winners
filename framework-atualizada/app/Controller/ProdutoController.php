<?php

class ProdutoController extends AppController{
	public $codigo;
	public $nome;
	public $preco;
	public $estoque;
	
	function cadastrar(){
		return true;
	}

	function editar($codigo) {
		return true;
	}

	function excluir($codigo) {
		return true;
	}

	function consultar($codigo) {
		return true;
	}

}