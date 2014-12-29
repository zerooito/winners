<?php

class PedidoController extends AppController{
	public $cod_ped;
	public $valor;
	public $data;
	
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