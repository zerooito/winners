<?php

class CampanhasController extends AppController{
	public $marca;
	public $nome;
	public $estrategia_de_marketing;
	public $publicidade;

	function cadastrar() {
		$cadastro = $this->request->data;

		pr($cadastro);
	}

	function consultar() {
		return true;
	}

	function excluir($id) {
		return true;
	}

	function editar($id) {
		return true;
	}
	
}