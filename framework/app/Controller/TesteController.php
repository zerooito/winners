<?php
class TesteController extends AppController{
	function index(){
		//$teste = $this->TesteModel->find('all');
		//$this->set('teste', $teste);

		echo 'index';
	}

	function listar(){
		$this->layout = 'teste';
		echo $this->request->query['id_user'];
		echo $this->request->query['nome_user'];
		
		echo 'listar';
	}

	function cadastrar(){
		$this->request->data['cadastro']['cadastrar'] == null;
		
		if($this->request->data['cadastro']['cadastrar'] == 'cadastrar'){
			echo $this->request->data['cadastro']['nome']."\n";
			echo $this->request->data['cadastro']['email']."\n";
			echo $this->request->data['cadastro']['senha']."\n";
		}

		echo 'cadastrar';
	}

	function salvar_cadastro(){

	}
}