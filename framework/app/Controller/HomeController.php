<?php
class HomeController extends AppController{
	function index(){
		$this->layout = 'winners';
$produtos = array(array('nome' => 'produto1', 'id_produto' => '442'));

print_r($produtos);

array_push($produtos, array('nome' => 'produto7', 'id_produto' => '542'));

print_r($produtos);

foreach($produtos as $valor){
	echo 'Nome produto: '. $valor['nome'].'<br>';
}
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