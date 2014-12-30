<?php

class ClienteController extends AppController{	
	public $helpers = array('Excel');

	function home() {
		$this->layout = 'wadmin';
	}

	function adicionar_cliente() {
		$this->layout = 'wadmin';
	}

	function s_adicionar_cliente() {
		$dados = $this->request->data('dados');
		$dados['ativo'] = 1;
		$dados['id_instancia'] = '';
		debug($dados);
		if ($this->Cliente->save($dados)) {
			$this->Session->setFlash('Cliente salvo com sucesso!');
            return $this->redirect('/cliente/listar_cadastros');
		} else {
			$this->Session->setFlash('Ocorreu um erro ao salva o cliente!');
            return $this->redirect('/cliente/listar_cadastros');
		}
	}

	function excluir_cliente() {
		$this->layout = 'ajax';

		$id = $this->request->data('id');

		$dados = array ('ativo' => '0');
		$parametros = array ('id' => $id);

		if ($this->Cliente->updateAll($dados,$parametros)) {
			echo json_encode(true);
		} else {
			echo json_encode(false);
		}
	}

	function listar_cadastros() {
		$this->layout = 'wadmin';

		$this->set('clientes', $this->Cliente->find('all', 
				array('conditions' => 
					array('ativo' => 1)
				)
			)
		);
	}

	function editar_cliente() {
		$this->layout = 'wadmin';
		$id = $this->params->pass[0];

		$this->set('cliente', $this->Cliente->find('all', 
				array('conditions' => 
					array('ativo' => 1,
						  'id' => $id
					)
				)
			)
		);
	}

	function s_editar_cliente() {
		$dados = $this->request->data('dados');
		$this->Cliente->id = $this->request->data('id');

		if ($this->Cliente->save($dados)) {
			$this->Session->setFlash('Cliente editado com sucesso!');
            return $this->redirect('/cliente/listar_cadastros');
		} else {
			$this->Session->setFlash('Ocorreu um erro ao editar o cliente!');
            return $this->redirect('/cliente/listar_cadastros');
		}
	}		

	function exportar_clientes() {
        $this->layout = 'ajax'; 
        $this->set('event', $this->Cliente->findById(4)); 
	}

}