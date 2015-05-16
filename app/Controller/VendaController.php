<?php

class VendaController extends AppController {

	function pdv() {
		$this->layout = 'wadmin';

		$this->loadModel('Produto');

		$this->set('produtos', $this->Produto->find('all',
				array('conditions' =>
					array('ativo' => 1,
						  'id_usuario' => $this->instancia
					)
				)
			)
		);
	}

	function recuperar_dados_venda_ajax() {
		$this->layout = 'ajax';

		$dados = $this->request->data('dados');

		$this->loadModel('Produto');

		$produto = $this->Produto->find('all',
			array('conditions' =>
				array('ativo' => 1,
					  'id_alias' => $dados['codigo_produto']
				)
			)
		);

		if (empty($produto)) {
			echo json_encode(false);
			return false;
		}

		echo json_encode($produto);
	}

	public function listar_cadastros() {
		$this->layout = 'wadmin';

		$this->set('vendas', $this->Venda->find('all',
				array('conditions' =>
					array(
						'ativo' => 1,
						'id_usuario' => $this->instancia
					)
				)
			)
		);
	}
}
