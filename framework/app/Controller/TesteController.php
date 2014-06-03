<?php
class TesteController extends AppController{
	function index(){
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