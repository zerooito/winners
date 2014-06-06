<?php
class TesteController extends AppController{
	function index(){
		//$teste = $this->TesteModel->find('all');
		//$this->set('teste', $teste);

		echo 'index';
	}

	function abre_session($email,$senha){
		$email_ver = 'jr.design_2010@hotmail.com';
		$senha_ver = 'grafic79';

		if($email == $email_ver){
			if($senha == $senha_ver){
				return 'dados corretos';
			}else{
				return 'senha incorreta';
			}
		}else{
			return 'email incorreto';
		}
	}

	function listar(){
		$this->layout = 'teste';
		echo $this->request->query['id_user'];
		echo $this->request->query['nome_user'];
		$pessoa = $this->Session->read('Pessoa.nome');
		
		echo 'listar';
	}

	function cadastrar(){
		if($this->request->data['cadastro']['cadastrar'] == 'cadastrar'){
			$this->Session->write('Pessoa.nome', $this->request->data['cadastro']['nome']);
			$nome = $this->Session->read('Pessoa.nome');
			$this->Session->write('Pessoa.email',$this->request->data['cadastro']['email']);
			$email = $this->Session->read('Pessoa.email');
			$this->Session->write('Pessoa.senha',$this->request->data['cadastro']['senha']);
			$senha = $this->Session->read('Pessoa.senha');

			echo $this->abre_session($email,$senha);
		}

		echo 'cadastrar';
	}

	function salvar_cadastro(){

	}
}