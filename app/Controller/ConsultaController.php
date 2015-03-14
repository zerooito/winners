<?php

class ConsultaController extends AppController {

	public function listar_cadastros(){
		$this->loadModel('Consulta');
		$consultas = $this->Consulta->find('all', 
			array('conditions' => 
				array('ativo' => 1,
					  'id_usuario' => $this->instancia
				)
			)
		);
		$this->set('consultas', $consultas);
		$this->layout = 'wadmin';
	}

	function excluir_consulta() {
		$this->layout = 'ajax';

		$id = $this->request->data('id');
		$this->loadModel('Consulta');

		$dados = array ('ativo' => '0');
		$parametros = array ('id' => $id);

		if ($this->Consulta->updateAll($dados,$parametros)) {
			echo json_encode(true);
		} else {
			echo json_encode(false);
		}
	}

}