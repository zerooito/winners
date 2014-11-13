<?php

class ClienteController extends AppController{
	public $nome;
	public $data_de_nascimento;
	public $cpf;
	public $email;
	public $senha;
	public $id;

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

	function listar_cadastros() {
		$this->layout = 'layout';
	}

}