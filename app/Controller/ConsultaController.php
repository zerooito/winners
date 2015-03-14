<?php

class ConsultaController extends AppController {

	public function listar_cadastros(){
		$this->loadModel('Consulta');
		$consultas = $this->Consulta->find('all', 
			array('conditions' => 
				array('ativo' => 1,
					  'id' => $this->instancia
				)
			)
		);
		
		$this->set('consultas', $consultas);
		$this->layout = 'wadmin';
	}

}