<?php
class TesteController extends AppController{
	function index(){
		//$teste = $this->TesteModel->find('all');
		//$this->set('teste', $teste);

		$array = array('teste1','teste2','teste3');

		echo $array[0];
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