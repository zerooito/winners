<?php
class HomeController extends AppController{
	function index(){
		$this->layout = 'winners';

	}

	function requisicoes(){
		if($this->request->data['login']['acao'] == 'logar'){
			echo 'entrou aqui';
			echo $this->request->data['login']['login_email'];
		}else{
			echo 'ainda não';
			echo $this->request->data['login']['login_email'];
		}
	}

	function tema(){
		$this->layout = 'winners';
	}
}