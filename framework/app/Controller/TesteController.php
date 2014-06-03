<?php
class TesteController extends AppController{
	function index(){
		$teste = $this->TesteModel->find('all');
		$this->set('teste', $teste);
		echo 'index';
	}

	function listar(){
		$this->layout = 'teste';
		echo 'listar';
	}

	function cadastrar(){
		echo 'cadastrar';
	}

	function salvar_cadastro(){

	}
}