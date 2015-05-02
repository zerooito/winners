<?php
class HomeController extends AppController{

	public function beforeFilter(){
		return true;
   	}

	function index(){
		$this->layout = 'winners';
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
   			!filter_var($dados['email'],FILTER_VALIDATE_EMAIL)){
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

	// public function loja() {
	// 	$curl = curl_init('http://ecommissi.local/produtos/2');
 //        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
 //            'Content-Type: application/json'
 //        ));
 //        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
 //        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); //IMP if the url has https and you don't want to verify source certificate
 //        $curl_response = curl_exec($curl);
        
 //        $response = json_decode($curl_response);
 //        curl_close($curl);
        
 //        $this->set('resposta', $response->Produtos[0]);
	// 	$this->layout = 'ajax';
	// }

	// public function adicionar_produto() {
	// 	$curl = curl_init('http://ecommissi.local/produtos');
 //        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
 //            'Content-Type: application/json'
 //        ));

 //        $dados = array(
 //        	'nome' => 'Debora Proudot',
 //        	'preco' => '1000000',
 //        	'data_inclusao' => date('Y-m-d'),
 //        	'idCategoria' => 1
 //        )
 //        $json = json_encode($dados);

 //        curl_setopt($curl, CURLOPT_POST, true);
 //        curl_setopt($curl, CURLOPT_POSTFIELDS, $json);
 //        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
 //        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); //IMP if the url has https and you don't want to verify source certificate
 //        $curl_response = curl_exec($curl);
        
 //        $response = json_decode($curl_response);
 //        curl_close($curl);
        
	// 	$this->layout = 'ajax';		
	// }

}
