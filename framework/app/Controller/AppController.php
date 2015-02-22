<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
	public $modulos = array();

	public function beforeFilter(){
		$this->verificar_acesso();
    	$this->set('modulos', $this->modulos);
   	}

	function verificar_acesso() {
		$dados = $this->Session->Read('Usuario');

		if (count($dados) < 1) {
			return false;
		}

		$this->verificar_modulos($dados['id']);

		return true;
	}

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

	function verificar_modulo_ativo($modulo) {
		$retorno = in_array($modulo, $this->modulos);
		return $retorno;
	}

}