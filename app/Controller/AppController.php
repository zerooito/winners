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
	public $modulos = array();
	public $instancia = 'winners';

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

		$this->verificar_acesso();

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
			
			$this->instancia = $dados_subusuario[]
		} else {
			$this->instancia = $dados['id'];
			$this->verificar_modulos();
		}
		
		return true;
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

	/*
	* Metodo que verifica o pagamento
	*/
	function verificar_pagamento() {
		$this->loadModel('Usuario');

		$pagamento = $this->Usuario->find('all', 
			array('conditions' => 
				array('Usuario.id' => $this->instancia)
			)
		);

		return $pagamento[0]['Usuario']['ativo'];
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