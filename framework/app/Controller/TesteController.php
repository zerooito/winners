<?php
class TesteController extends AppController{
	function index(){
		$teste = $this->TesteModel->find('all');
		$this->set('teste', $teste);
		echo 'index';
	}

	function listar(){
		echo 'listar';
	}

	function cadastrar(){
		echo 'cadastrar';
	}
}