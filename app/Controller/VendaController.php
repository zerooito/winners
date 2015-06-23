<?php

include 'ProdutoEstoqueController.php';

class VendaController extends ProdutoEstoqueController {

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

		$this->loadModel('Cliente');

		$this->set('clientes', $this->Cliente->find('all',
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

	public function adicionar_cadastro() {
		$this->layout = 'wadmin';

		$this->loadModel('Cliente');

		$this->set('clientes', $this->Cliente->find('all',
				array('conditions' =>
					array('ativo' => 1,
						  'id_usuario' => $this->instancia
					)
				)
			)
		);

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

	public function s_adicionar_cadastro() {
		$dados_venda 	  = $this->request->data('venda');
		$dados_lancamento = $this->request->data('lancamento');
		$produtos 	  = $this->request->data('produto');

		$this->adicionar_itens_venda($produtos);
		pr($dados_lancamento);
		pr($dados_venda);
		pr($produtos);
		exit();
	}

	public function adicionar_itens_venda($produtos) {
		$this->loadModel('Produto');

		foreach ($produtos as $indice => $produto) {
			$produto = $this->Produto->find('all',
				array('conditions' =>
					array('Produto.id' => $produto['id_produto'])
				)
			);

			$this->validar_estoque($produto);
			debug($produto,1);
		}
	}

}
