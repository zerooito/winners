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

		//dados da sessao
		echo 'Sessaão pessoa: '. $this->Session->read('Pessoa.nome');
		
		echo 'listar';
	}

	function cadastrar(){
		$this->request->data['cadastro']['cadastrar'] == null;

		if($this->request->data['cadastro']['cadastrar'] == 'cadastrar'){
			$this->Session->write('Pessoa.nome', $this->request->data['cadastro']['nome']);
			echo $this->request->data['cadastro']['email']."\n";
			echo $this->request->data['cadastro']['senha']."\n";
		}

		echo 'cadastrar';
	}

	function salvar_cadastro(){

	}
}