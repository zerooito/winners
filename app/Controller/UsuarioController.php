<?php

class UsuarioController extends AppController{
	const MODULO_VENDA = 1;
	const MODULO_PRODUTO = 2;
	const MODULO_CLIENTE = 3;
	const MODULO_ORCAMENTO = 11;
	const MODULO_FINANCEIRO = 13;
	const MODULO_HIERAQUIA = 10;

	public function beforeFilter(){
		App::import('Helper', 'Permissoes');
		$this->PermissoesHelper = new PermissoesHelper(new View());
		return true;
   	}

	//faz o login no sistema, com a função autentica_email
	public function login(){
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
			$this->Session->write('Usuario.subusuario_id', $valor['Usuario']['subusuario_id']);
		}

		$this->Session->setFlash('Bem vindo, ' . $this->Session->read('Usuario.nome') . '!');
        return $this->redirect('/dashboard/home');
	}

	public function processar_logout() {
		$this->Session->Destroy();
		return $this->redirect('/home/login');
	}

	public function logout(){
		$this->Session->Destroy();

		echo '<script>location.href="/winners/framework/"</script>';
	}

	//autentica email verifica se o email e senha existem para efetuar o login, ou outra acao.
	public function autentica_email($email,$senha){
		$this->loadModel('Usuario');
		$resposta = $this->Usuario->find('count', 
								array('conditions' => array('AND' => array('Usuario.email' => $email, 'Usuario.senha' => sha1($senha))
										)
									)
								);
		$this->set('resposta', $resposta);

		return $resposta;
	}

	public function verifica_se_status_mudou()
	{
		$this->layout = 'ajax';

		$id = $this->Session->Read('Usuario')['id'];

		$status = $this->atualiza_status_pagamento($id);

		echo json_encode($status);
	}

	//se o email estiver livre retorna false, senão retorna true
	public function verificar_email($email){
		$this->layout = 'ajax';

		if(empty($email)){
			$email = $this->request->data['email'];
		}

		$this->loadModel('Usuario');

		$resposta = $this->Usuario->find('count',
											array(
												'conditions' => array('Usuario.email' => $email)
											)
										);
		$this->set('resposta', $resposta);

		if($resposta >= 1){
			return true;
		}else{
			return false;
		}
	}

	public function recuperar_dados($email,$senha){
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

		if (isset($dados['senha']) && !empty($dados['senha_repeat'])) {
			if ($dados['senha'] != $dados['senha_repeat']) {
				$this->Session->setFlash('Senhas digitadas não estão corretas.');
				$this->redirect('/');
			}
		}
		
		unset($dados['senha_repeat']);
		$dados['senha'] = sha1($dados['senha']);
		$dados['name'] = $dados['nome1'] . ' ' . $dados['nome2'];
		$dados['nome'] = $dados['nome1'] . ' ' . $dados['nome2'];
		$dados['loja'] = 0;
		$dados['loja_active'] = 0;
		$dados['layout_loja'] = 'default';
		$dados['cep_origem'] = '';
		$dados['descricao'] = '';
		$dados['email_pagseguro'] = '';
		$dados['folder_view'] = '';
		$dados['token_pagseguro'] = '';
		
		if ($this->verificar_email($dados['email']) !== false) {
			$this->Session->setFlash('Email já cadastrado no sistema!');
			$this->redirect('/');
		}

		if ($this->Usuario->save($dados)) {
			$this->relacionar_modulos_teste($this->Usuario->id);

			$this->notificar_cadastro($dados['nome'], $dados['email']);
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
		mail($to, $email_subject, $email_body, $headers);
	}

	public function notificar_cadastro($nome, $email) {
		$headers = "From: noreply@ciawn.com.br\n"; // This is the email address the generated message will be from. We recommend using something like noreply@yourdomain.com.
		$headers .= "Reply-To: $email";	
		mail('winnersdevelopers@gmail.com, reginaldo@ciawn.com.br', 'Notificação de cadastro', 'O usuario ' . $nome . ' email ' . $email . ' ', $headers);
	}

	public function relacionar_modulos_teste($id) {
		$this->loadModel('ModuloRelacionaUsuario');
		
		$modulos = [
			[
				'id_usuario' => $id,
				'id_modulo' => self::MODULO_VENDA,
				'ativo' => 1
			],
			[
				'id_usuario' => $id,
				'id_modulo' => self::MODULO_PRODUTO,
				'ativo' => 1
			],
			[
				'id_usuario' => $id,
				'id_modulo' => self::MODULO_CLIENTE,
				'ativo' => 1
			],
			[
				'id_usuario' => $id,
				'id_modulo' => self::MODULO_ORCAMENTO,
				'ativo' => 1
			],
			[
				'id_usuario' => $id,
				'id_modulo' => self::MODULO_FINANCEIRO,
				'ativo' => 1
			],
			[
				'id_usuario' => $id,
				'id_modulo' => self::MODULO_HIERAQUIA,
				'ativo' => 1			
			]
		];

		$this->ModuloRelacionaUsuario->saveAll($modulos);

		return true;
	}

	public function s_editar_dados() {
		$this->verificar_acesso();

		$this->layout = 'wadmin';

		$estoque_minimo = $this->request->data['estoque_minimo'];

		$sale_without_stock = $this->request->data['sale_without_stock'];

		$template = isset($_FILES['template']) ? $_FILES['template'] : '';
		$layout_loja = isset($this->request->data['layout_loja']) ? $this->request->data['layout_loja'] : '';
		
		if (!empty($template['name']) && isset($template['name']))
			$layout_loja = $this->uploadZipTemplate($template);
		
		$data = array(
			'estoque_minimo' => $estoque_minimo, 
			'sale_without_stock' => $sale_without_stock
		);

		$data['loja'] = 0;
		$data['loja_active'] = 0;
		$data['layout_loja'] = 'default';
		$data['cep_origem'] = '';
		$data['descricao'] = '';
		$data['email_pagseguro'] = '';
		$data['folder_view'] = '';
		$data['token_pagseguro'] = '';
		$data['template'] = '';
		$data['telefone'] = $this->request->data['telephone'];

		$this->loadModel('Usuario');

		$this->Usuario->id = $this->instancia;

		$retorno = $this->Usuario->save($data);

		if(!$retorno) {
			$this->Session->setFlash('Ocorreu um erro ao salvar as novas infomações, tente novamente!');
            return $this->redirect('/usuario/meus_dados');
		}

		$this->Session->setFlash('Dados atualizados com sucesso!');
        
        return $this->redirect('/usuario/meus_dados');
	}

	public function meus_dados() {
		$this->verificar_acesso();

		$this->layout = 'wadmin';

		$dadosUsuario = $this->Usuario->find('all', array(
				'conditions' => array(
					'Usuario.id' => $this->instancia
				)
			)
		);

    	$this->set('modulos', $this->modulos);
    	$this->set('usuario', $dadosUsuario);
	}

	public function new_token() {
		$this->verificar_acesso();

		$this->loadModel('Usuario');

		$response = $this->Usuario->find('all', array(
				'conditions' => array(
					'Usuario.id' => $this->instancia
				)
			)
		);

		$token = md5(uniqid());

		$this->Usuario->id = $this->instancia;

		$dados['token'] = $token;

		$this->Usuario->save($dados);

		echo json_encode($token);
		exit();
	}

	public function uploadZipTemplate($template) {
		$z = new ZipArchive();
		
		$abriu = $z->open($template['tmp_name']);
		
		if ($abriu === true) {
		    // Listando os nomes dos elementos
		    for ($i = 0; $i < $z->numFiles; $i++) {
        		$nome = $z->getNameIndex($i);
		        $response = $z->extractTo(ROOT . DS . "app/View/");
		    }

		    // Fechando o arquivo
		    $z->close();
		} else {
		    echo 'Erro: ' . $abriu;
		}
        
        $nomeLayout = substr($template['name'], 0, -4);

        $origem  = ROOT . DS . "app/View/" . $nomeLayout . DS . "Layouts" . DS . $nomeLayout . ".ctp";
        $destino = ROOT . DS . "app/View/" . "Layouts" . DS . $nomeLayout . ".ctp";
        
		shell_exec("mv " . $origem . " " . $destino);

		shell_exec("rm -R " . ROOT . DS . "app/View/" . $nomeLayout . "Layouts/");

		return $nomeLayout;
	}

}