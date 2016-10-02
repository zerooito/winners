<?php

class HomeController extends AppController{	
	
	public function beforeFilter(){
		return true;
   	}

	function index(){
		$this->layout = 'winners';
	}

	function servicos(){
		$this->layout = 'servicos';
	}

	function login() {
		$this->set('admin', false);
		$this->layout = 'login';
	}

	function enviar_email() {
		$dados = $this->request->data('dados');

		// Check for empty fields
		if(empty($dados['name'])  		||
   			empty($dados['email']) 		||
   			empty($dados['message'])	||
   			!filter_var($dados['email'], FILTER_VALIDATE_EMAIL)) {
				$this->Session->setFlash('Você deve preencher todos os dados!');
	            return $this->redirect('/');
		}	
	
		$name = $dados['name'];
		$email_address = $dados['email'];
		$message = $dados['message'];
	
		// Create the email and send the message
		$to = 'winnersdevelopers@gmail.com'; // Add your email address inbetween the '' replacing yourname@yourdomain.com - This is where the form will send a message to.
		$email_subject = "Contato Winners Desenvolvimento";
		$email_body = "Mensagem site: ".$message;
		$headers = "From: noreply@winnersdevelopers.com\n"; // This is the email address the generated message will be from. We recommend using something like noreply@yourdomain.com.
		$headers .= "Reply-To: $email_address";	
		mail($to,$email_subject,$email_body,$headers);
		//resposta automatica ao cliente
		$to = $email_address;
		$email_subject = 'winnersdevelopers@gmail.com';
		$email_body = "A sua mensagem foi recebida, em breve responderemos";
		$headers = "From: noreply@winnersdevelopers.com\n"; // This is the email address the generated message will be from. We recommend using something like noreply@yourdomain.com.
		$headers .= "Reply-To: $email_address";	
		mail($to,$email_subject,$email_body,$headers);

		$this->Session->setFlash('Seu e-mail foi enviado com sucesso em breve responderemos!');
        return $this->redirect('/');
	}

	public function sendmail() {
		App::uses('CakeEmail', 'Network/Email');

		$email = new CakeEmail('default');
		$email->from('jr.design_2010@hotmail.com', 'reginaldo')
			->to('jr.design_2010@hotmail.com')
			->subject('Contato CakePHP MyStore');
		$mensagem = '
				<p><strong>Nome</strong>: adfasdf</p>
				<p><strong>Email</strong>: fasdf@laksjdf</p>
				<p><strong>Telefone</strong>: asdfasdf</p>
				<p><strong>Mensagem</strong>:fasdf</p>
			';
		
		if ($email->send($mensagem)) {
			echo('Mensagem enviada com sucesso');
		} else {
			echo('Sua mensagem não foi enviada, tente denovo');
		}

		exit();
	}

}
