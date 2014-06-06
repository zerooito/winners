<?php
class TesteController extends AppController{
	function index(){
		//$teste = $this->TesteModel->find('all');
		//$this->set('teste', $teste);

		echo 'index';
	}

	function abre_session($nome,$email,$senha){
		$email_ver = 'jr.design_2010@hotmail.com';
		$senha_ver = 'grafic79';

		if($email == $email_ver){
			if($senha == $senha_ver){
				$this->Session->write('Pessoa.nome', $nome);
				$nomeSession = $this->Session->read('Pessoa.nome');
				$this->Session->write('Pessoa.email',$email);
				$emailSession = $this->Session->read('Pessoa.email');
				$this->Session->write('Pessoa.senha',$senha);
				$senhaSession = $this->Session->read('Pessoa.senha');

				return 'Session contruida com sucesso, '.print_r($this->Session->read());
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
			$nome =  $this->request->data['cadastro']['nome'];
			$email = $this->request->data['cadastro']['email'];
			$senha = $this->request->data['cadastro']['senha'];

			echo $this->abre_session($nome,$email,$senha);
		}

		echo 'cadastrar';
	}

	function salvar_cadastro(){

	}
}