<?php
/**
 * @package Framework Cakephp Adaptada para Winners Desenvolvimento de Sites e Sistemas
 * @version 1.0
 *
 * @author Winners
 * @link http://www.winnersdesenvolvimento.com.br
 *
 * @name Controller
 *
 */

App::uses('Controller', 'Controller');

class AppController extends Controller {
	private $paymentUrl = 'https://winners-payments-service.herokuapp.com/';

	public $modulos = array();
	public $instancia = 'winners';
	public $subusuario = null;
	public $nome = null;

	public $debug = false;

	/*
	* Metodo que funciona como construct para setar os modulos da instancia logada
	* Toda vez que determinado controller não precisa de verificação de acesso o
	* o mesmo precisa ter essa função rescrita somente com um return true
	*/
	public function beforeFilter(){
		if ($this->debug) {
			return true;
		}

		App::import('Helper', 'Permissoes');
		
		$this->verificar_acesso();
		
		$GLOBALS['subusuario'] = $this->subusuario;
		$GLOBALS['modulos'] = $this->modulos;
		
		$this->PermissoesHelper = new PermissoesHelper(new View());

    	$this->set('modulos', $this->modulos);
   	}

   	/*
   	* Metodo que verificar o acesso do usuario e chama os metodos adicionais para setar os 
   	* modulos ativos e configurações
   	*/
	function verificar_acesso() {
		$dados = $this->Session->Read('Usuario');

		if (count($dados) < 1) {
			$this->Session->setFlash('Você não tem acesso a esta area do sistema!');
            return $this->redirect('/');
		}

		if (isset($dados['subusuario_id']) && !empty($dados['subusuario_id'])) {
			$this->loadModel('SubUsuarios');
			$this->loadModel('Usuario');

			$dados_subusuario = $this->SubUsuarios->find('first', array(
					'conditions' => array(
						'SubUsuarios.id' => $dados['subusuario_id']
					)
				)
			);

			$dados_usuario_root = $this->Usuario->find('first', array(
					'conditions' => array(
						'Usuario.id' => $dados_subusuario['SubUsuarios']['id_usuario']
					)
				)
			);
			
			$this->instancia = $dados_usuario_root['Usuario']['id'];
			$this->subusuario = $dados['subusuario_id'];
			$this->nome = $dados['nome'];
			$this->verificar_modulos_subusuario($dados_subusuario['SubUsuarios']['id_hieraquia']);
		} else {
			$this->instancia = $dados['id'];
			$this->nome = $dados['nome'];
			$this->verificar_modulos();
		}

		$GLOBALS['qrcode'] = $this->verificar_se_esta_ativo($this->instancia);
		
		return true;
	}

	public function verificar_se_esta_ativo($instancia)
	{
		$this->loadModel('Usuario');

		$usuario = $this->Usuario->find('all',
			array('conditions' => 
				array(
					'Usuario.id' => $instancia
				)
			)
		)[0]['Usuario'];

		$curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL => $this->paymentUrl . 'pix/status/' . $instancia,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_HTTPHEADER => array(
				'Content-Type: application/json'
			),
			)
		);

		$response = json_decode(curl_exec($curl));

		$status_pagamento = $this->atualiza_status_pagamento($instancia);

		if (isset($status_pagamento->status) && !empty($status_pagamento->status) && $status_pagamento->status == 'PAID') {
			$dados = array(
				'Usuario.ativo' => '1', 
				'Usuario.ultimo_pagamento' => date('Y-m-d')
			);
			$parametros = array('Usuario.id' => $instancia);
	
			$this->Usuario->updateAll($dados, $parametros);
		} else {
			if (isset($response->status) && !empty($response->status) && $response->status == 'PENDING') {
				return $response->qrcode;
			} else {
				$pagamento_gerado = $this->gerar_pagamento($instancia, $usuario);

				if (!empty($pagamento_gerado) && isset($pagamento_gerado->qrcode)) {
					return $pagamento_gerado->qrcode;
				}
			}
		}
	}

	public function atualiza_status_pagamento($instancia)
	{
		$curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL => $this->paymentUrl . 'pix/update_status/' . $instancia,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_HTTPHEADER => array(
				'Content-Type: application/json'
			),
			)
		);

		return json_decode(curl_exec($curl));
	}

	/**
	 * Se o método retorna false quer dizer que o usuário ainda está no tempo mensal do ultimo pagamento
	 */
	public function gerar_pagamento($instancia, $usuario)
	{
		$curl = curl_init();
		
		$data_inicial = $usuario['ultimo_pagamento'];
		$data_final = date('Y-m-d');
		$diferenca = strtotime($data_final) - strtotime($data_inicial);
		$dias = floor($diferenca / (60 * 60 * 24));

		if ($dias >= 30) {
			curl_setopt_array($curl, array(
				CURLOPT_URL => $this->paymentUrl . 'pix/qr-code',
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_ENCODING => '',
				CURLOPT_MAXREDIRS => 10,
				CURLOPT_TIMEOUT => 0,
				CURLOPT_FOLLOWLOCATION => true,
				CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				CURLOPT_CUSTOMREQUEST => 'POST',
				CURLOPT_POSTFIELDS => json_encode([
					'cpf' => $usuario['documento'],
					'nome' => $usuario['nome'],
					'valor' => $usuario['valor'],
					'celular' => $usuario['telefone'],
					'email' => $usuario['email'],
					'winners_id' => $instancia
				]),
				CURLOPT_HTTPHEADER => array(
					'Content-Type: application/json'
				)
			));

			$dados = array('Usuario.ativo' => '0');
			$parametros = array('Usuario.id' => $instancia);
	
			$this->Usuario->updateAll($dados, $parametros);

			return json_decode(curl_exec($curl));
		}

		return false;
	}

	public function verificar_modulos_subusuario($hieraquia_id)
	{
		$this->loadModel('ModuloRelacionaUsuario');
		$this->loadModel('Hieraquia');
		$this->loadModel('HieraquiaModulo');

		$modulos_hieraquia = $this->HieraquiaModulo->find('all', array('conditions' => 
				array(
					'Hieraquia.id' => $hieraquia_id
				)
			)
		);

		foreach ($modulos_hieraquia as $i => $modulo) {
			$this->modulos[$modulo['Modulo']['modulo']]['id'] = $modulo['Modulo']['id'];
			$this->modulos[$modulo['Modulo']['modulo']]['modulo'] = $modulo['Modulo']['modulo'];
			$this->modulos[$modulo['Modulo']['modulo']]['funcao'] = $modulo['Modulo']['funcao'];
			$this->modulos[$modulo['Modulo']['modulo']]['nome']   = $modulo['Modulo']['nome_modulo'];
			$this->modulos[$modulo['Modulo']['modulo']]['icone']  = $modulo['Modulo']['icone'];
			$this->modulos[$modulo['Modulo']['modulo']]['permissao'][$modulo['HieraquiaModulo']['tipo_de_permissao']]  = $modulo['HieraquiaModulo']['tipo_de_permissao'];
		}

		return $this->modulos;
	}

	/*
	*	Metodo que verifica as configurações e modulos do usuario logado
	*/
	function verificar_modulos() {
		$this->loadModel('ModuloRelacionaUsuario');

		$registros = $this->ModuloRelacionaUsuario->find('all',
			array('conditions' => 
				array(
					'ModuloRelacionaUsuario.id_usuario' => $this->instancia, 
					'ModuloRelacionaUsuario.ativo' => 1,
				  	'Modulo.ativo' => 1
				)
			)
		);
		
		foreach ($registros as $indice => $modulo) {
			$this->modulos[$modulo['Modulo']['modulo']]['id'] = $modulo['Modulo']['id'];
			$this->modulos[$modulo['Modulo']['modulo']]['modulo'] = $modulo['Modulo']['modulo'];
			$this->modulos[$modulo['Modulo']['modulo']]['funcao'] = $modulo['Modulo']['funcao'];
			$this->modulos[$modulo['Modulo']['modulo']]['nome']   = $modulo['Modulo']['nome_modulo'];
			$this->modulos[$modulo['Modulo']['modulo']]['icone']  = $modulo['Modulo']['icone'];
			$this->modulos[$modulo['Modulo']['modulo']]['permissao']['read'] = 'read';
			$this->modulos[$modulo['Modulo']['modulo']]['permissao']['write'] = 'write';
		}

		return $this->modulos;
	}

	/*
	* Metodo que verifica se determinado modulo está ativo
	* @param array modulo
	*/
	function verificar_modulo_ativo($modulo) {
		$retorno = array_key_exists($modulo, $this->modulos);
		return $retorno;
	}

	public function verificar_acesso_admin() {
		$verificar = $this->Session->read('Admin.logado');
		
		if (!$verificar) {
			$this->Session->setFlash('Você não possui acesso a está área do sistema');
			$this->redirect('/admin/login');
		}

		return true;
	}
}