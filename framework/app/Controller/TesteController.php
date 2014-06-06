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
		$pessoa = $this->Session->read('Pessoa.nome');
		
			$this->Session->write('Person.eyeColor', 'Green');
		$green = $this->Session->read('Person.eyeColor');

		//dados da sessao
		echo 'Sessaão pessoa: '. $pessoa;
		echo ' cor:'. $green;
		
		echo 'listar';
	}

	function cadastrar(){
		//$this->request->data['cadastro']['cadastrar'] = null;

		if($this->request->data['cadastro']['cadastrar'] == 'cadastrar'){
			$this->Session->write('Pessoa.nome', $this->request->data['cadastro']['nome']);
			echo $this->Session->read('Pessoa.nome');
			$this->Session->write('Pessoa.email',$this->request->data['cadastro']['email']);
			echo $this->Session->read('Pessoa.email');
			$this->Session->write('Pessoa.senha',$this->request->data['cadastro']['senha']);
			echo $this->Session->read('Pessoa.senha');
			if($this->Session->read('Pessoa.nome') == 'teste'){
				echo 'teste ok';
			}else{
				echo 'ainda nao';
			}
		}

		echo 'cadastrar';
	}

	function salvar_cadastro(){

	}
}