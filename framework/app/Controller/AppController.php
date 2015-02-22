<?php
/**
* Controller principal da aplicação
**/

App::uses('Controller', 'Controller');

class AppController extends Controller {
	public $modulos = array();

	/*
	* Metodo que funciona como construct para setar os modulos da instancia logada
	*/
	public function beforeFilter(){
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
			return false;
		}

		$this->verificar_modulos($dados['id']);

		return true;
	}

	/*
	*	Metodo que verifica as configurações e modulos do usuario logado
	*/
	function verificar_modulos($id_usuario) {
		$this->loadModel('ModuloRelacionaUsuario');

		$registros = $this->ModuloRelacionaUsuario->find('all',
			array('conditions' => 
				array('ModuloRelacionaUsuario.id_usuario' => $id_usuario, 
					  'ModuloRelacionaUsuario.ativo' => 1,
					  'Modulo.ativo' => 1
					)
				)
			);

		foreach ($registros as $indice => $modulo) {
			$this->modulos[$indice] = $modulo['Modulo']['modulo'];
		}
		
		return $this->modulos;
	}

	/*
	* Metodo que verifica se determinado modulo está ativo
	* @param modulo
	*/
	function verificar_modulo_ativo($modulo) {
		$retorno = in_array($modulo, $this->modulos);
		return $retorno;
	}

}