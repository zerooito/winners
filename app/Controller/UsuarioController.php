<?php

class UsuarioController extends AppController{
	public function beforeFilter(){
		return true;
   	}

	//faz o login no sistema, com a função autentica_email
	function login(){
		$this->layout = 'ajax';//chama o layout para executar uma função ajax

		$login_email = $this->request->data['email'];//recebe o post email
		$login_senha = $this->request->data['senha'];//recebe o post senha
		echo json_encode(true);
	}

	public function processar_login() {
		//destroe alguma session criada anteriomente
		$this->Session->Destroy();

		$dados = $this->request->data('dados');
		$this->loadModel('Usuario');
		$resposta = $this->Usuario->find('all',
			array('conditions' => 
				array('Usuario.email' => $dados['email'], 
					  'Usuario.senha' => sha1($dados['senha'])
				)
			)
		);
		
		if (count($resposta) < 1) {
			$this->Session->setFlash('Ocorreu um erro ao logar na sua conta, verifique seus dados!');
            return $this->redirect('/home/login');
		}

		//faz o foreach com o array de dados do usuario
		foreach($resposta as $valor) {
			//escreve a sessao do usuario
			$this->Session->write('Usuario.id',   $valor['Usuario']['id']);
			$this->Session->write('Usuario.nome', $valor['Usuario']['nome']);//nome do usuario
			$this->Session->write('Usuario.email',$valor['Usuario']['email']);//email do usuario
			$this->Session->write('Usuario.senha',$valor['Usuario']['senha']);//senha do usuario criptografada
			$this->Session->write('Usuario.erp',  $valor['Usuario']['erp']);//situacao ativa(1) ou nao(0) no erp
			$this->Session->write('Usuario.ead',  $valor['Usuario']['ead']);//situacao ativa(1) ou nao(0) no ead
			$this->Session->write('Usuario.site', $valor['Usuario']['site']);//situacao ativa(1) ou nao(0) no site
		}

		$this->Session->setFlash('Bem vindo, '.$this->Session->read('Usuario.nome').'!');
        return $this->redirect('/dashboard/home');
	}

	public function processar_logout() {
		$this->Session->Destroy();
		return $this->redirect('/home/login');
	}

	function logout(){
		$this->Session->Destroy();

		echo '<script>location.href="/winners/framework/"</script>';
	}

	//autentica email verifica se o email e senha existem para efetuar o login, ou outra acao.
	function autentica_email($email,$senha){
		$this->loadModel('Usuario');
		$resposta = $this->Usuario->find('count', 
								array('conditions' => array('AND' => array('Usuario.email' => $email, 'Usuario.senha' => sha1($senha))
										)
									)
								);
		$this->set('resposta', $resposta);

		return $resposta;
	}			

	//se o email estiver livre retorna false, senão retorna true
	function verificar_email($email){
		$this->layout = 'ajax';
		
		if(empty($email)){
			$email = $this->request->data['email'];
		}

		$this->loadModel('Usuario');
		$resposta = $this->Usuario->find('count',
											array('conditions' => array('Usuario.email' => $email))
										);
		$this->set('resposta', $resposta);

		if($resposta >= 1){
			return true;
		}else{
			return false;
		}
	}

	function recuperar_dados($email,$senha){
		$this->loadModel('Usuario');
		$resposta = $this->Usuario->find('all', 
								array('conditions' => array('AND' => array('Usuario.email' => $email, 'Usuario.senha' => sha1($senha))
										)
									)
								);

		$this->set('resposta', $resposta);

		return $resposta;
	}

	public function novo_usuario() {
		$dados = $this->request->data('dados');
		$dados['senha'] = sha1($dados['senha']);

		if ($this->verificar_email($dados['email']) !== false) {
			$this->Session->setFlash('Email já cadastrado no sistema!');
			$this->redirect('/');
		}

		if ($this->Usuario->save($dados)) {
			$this->processar_login();
		}

		$this->Session->setFlash('Ocorreu um erro, tente novamente!');
		$this->redirect('/');
	}

	public function enviar_email_sucesso($email, $nome) {	
		$name = $dados['name'];
		$email_address = $dados['email'];
	
		// Create the email and send the message
		$to = 'winnersdevelopers@gmail.com'; // Add your email address inbetween the '' replacing yourname@yourdomain.com - This is where the form will send a message to.
		$email_subject = "Contato Winners Desenvolvimento";
		$email_body = "Muito Obrigado por nos contactar";
		$headers = "From: noreply@winnersdevelopers.com\n"; // This is the email address the generated message will be from. We recommend using something like noreply@yourdomain.com.
		$headers .= "Reply-To: $email_address";	
		mail($to,$email_subject,$email_body,$headers);
	}

}