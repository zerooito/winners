<?php

class ClienteController extends AppController{

	function home() {
		$this->layout = 'layout';
	}

	function adicionar_cliente() {
		$this->layout = 'layout';
	}

	function s_adicionar_cliente() {
		$array = array('nome1' => 'Teste', 'nome2' => 'teste');
		pr($array);
		exit();
		$this->Cliente->Save($array
	}

	function listar_cadastros() {
		$this->layout = 'layout';
	}

		

}