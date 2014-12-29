<?php

class ProdutoController extends AppController{
	public $codigo;
	public $nome;
	public $preco;
	public $estoque;
	
	function listar_cadastros() {
		$this->layout = 'wadmin';
	}
}