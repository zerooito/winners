<?php

class ProdutoEstoqueController extends AppController {

	public function validar_estoque($produto, $quantidade) {
		if (empty($produto)) {
			return false;
		}

		$user_active = $this->getUserActive($produto[0]['Produto']['id_usuario']);

		if ($user_active[0]['Usuario']['sale_without_stock'])
			return true;

		if ($produto[0]['Produto']['estoque'] <= 0) {
			$this->Session->setFlash('O Produto ' . $produto[0]['Produto']['name'] . ' selecionado não possui estoque disponivel');
			return false;
		}


		if ($produto[0]['Produto']['estoque'] < $quantidade) {
			$this->Session->setFlash('A quantidade para o produto ' . $produto[0]['Produto']['name'] . ' escolhida é maior do que a disponivel');
			return false;
		}

		return true;
	}

	public function getUserActive($id) {
		$this->loadModel('Usuario');

		$user = $this->Usuario->find('all', 
			array('conditions' => 
				array('Usuario.id' => $id)
			)
		);
		
		return $user;
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
				)
			);

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

 	public function diminuir_estoque_produto_variacao($produto_id, $quantidade, $variacao) {
 		if (!isset($produto_id) || !isset($quantidade) || !isset($variacao)) {
 			return false;
 		}

 		try {
 			$this->loadModel('Variacao');

 			$variacao = $this->Variacao->find('first', array(
 					'conditions' => array(
 						'Variacao.produto_id' => $produto_id,
 						'Variacao.ativo' => 1,
 						'Variacao.nome_variacao' => $variacao
 					)
 				)
 			);

			$novo_estoque['estoque'] = $variacao['Variacao']['estoque'] - $quantidade;

			$this->Variacao->id = $variacao['Variacao']['id'];
			if (!$this->Variacao->save($novo_estoque)) {
				return false;
			}

			return true;
 		} catch (Exception $e) {
 			print_r($e);
 			exit();
 		}
 	}

}