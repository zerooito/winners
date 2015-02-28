<?php

class AtendimentoController extends AppController{
	public $telefone;
	public $email;
	public $nome_do_produto;
	public $sugestoes;
	public $reclamacoes;

	function cadastrar() {
		$cadastro = $this->request->data;

		pr($cadastro);
	}

	function consultar() {
		return 'teste';
	}

	function excluir($id) {
		return true;
	}

	function editar($id) {
		return true;
	}
	
}