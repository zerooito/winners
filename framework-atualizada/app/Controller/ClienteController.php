<?php

class ClienteController extends AppController{

	function home() {
		$this->layout = 'layout';
	}

	function adicionar_cliente() {
		$this->layout = 'layout';
	}

	function s_adicionar_cliente() {
		$dados = $this->request->data;
		pr($dados);
		if ($this->Cliente->save($dados['dados'])) {
			echo 'oila';
			exit();
		} else {
			echo 'oila2';
			exit();
		}
		exit();
	}

	function listar_cadastros() {
		$this->layout = 'layout';
	}

		

}