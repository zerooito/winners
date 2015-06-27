<?php

class ProdutoEstoqueController extends AppController {

	public function validar_estoque($produto, $quantidade) {
		if (empty($produto)) {
			return false;
		}

		if ($produto[0]['Produto']['estoque'] <= 0) {
			// $this->Session->setFlash('O Produto selecionado não possui estoque disponivel');
			return false;
		}


		if ($produto[0]['Produto']['estoque'] < $quantidade) {
			// $this->Session->setFlash('A quantidade escolhida é maior do que a disponivel');
			return false;
		}

		return true;
	}

	public function diminuir_estoque_produto($produto_id, $quantidade) {
		if (!isset($produto_id) || !isset($quantidade) || !is_numeric($quantidade)) {
			return false;
		}

		try {
			$this->loadModel('Produto');

			$produto = $this->Produto->find('first', array(
				'conditions' => array('Produto.id' => $produto_id),
				'order' => array('Produto.id' => 'desc')
			));

			$novo_estoque['estoque'] = $produto['Produto']['estoque'] - $quantidade;

			$this->Produto->id = $produto_id;
			if (!$this->Produto->save($novo_estoque)) {
				return false;
			}

			return true;
		} catch (Exception $e) {
			print_r($e);
			exit();
		}
 	}

}