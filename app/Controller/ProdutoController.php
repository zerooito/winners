<?php

class ProdutoController extends AppController{	
	public function listar_cadastros() {
		$this->layout = 'wadmin';

		$this->set('produtos', $this->Produto->find('all', 
				array('conditions' => 
					array('ativo' => 1,
						  'id_usuario' => $this->instancia
					)
				)
			)
		);
	}

	public function adicionar_cadastro() {
		$this->layout = 'wadmin';
	}

	public function s_adicionar_cadastro() {
		$dados = $this->request->data('dados');
		$dados['id_usuario'] = $this->instancia;
		$dados['ativo'] = 1;
		$dados['id_alias'] = $this->id_alias();
		if($this->Produto->save($dados)) {
			$this->Session->setFlash('Produto salvo com sucesso!');
            return $this->redirect('/produto/listar_cadastros');
		} else {
			$this->Session->setFlash('Ocorreu um erro ao salva o produto!');
            return $this->redirect('/produto/listar_cadastros');
		}
	}

	public function editar_cadastro() {
		$this->layout = 'wadmin';

		$id = $this->params->pass[0];

		$this->set('produto', $this->Produto->find('all', 
				array('conditions' => 
					array('ativo' => 1,
						  'id' => $id
					)
				)
			)
		);
	}

	public function s_editar_cadastro() {
		$dados = $this->request->data('dados');
		$this->Produto->id = $this->request->data('id');
		
		if ($this->Produto->save($dados)) {
			$this->Session->setFlash('Produto editado com sucesso!','default','good');
            return $this->redirect('/produto/listar_cadastros');
		} else {
			$this->Session->setFlash('Ocorreu um erro ao editar o produto!','default','good');
            return $this->redirect('/produto/listar_cadastros');
		}
	}

	public function excluir_cadastro() {
		$this->layout = 'ajax';

		$id = $this->request->data('id');

		$dados = array ('ativo' => '0');
		$parametros = array ('id' => $id);

		if ($this->Produto->updateAll($dados,$parametros)) {
			echo json_encode(true);
		} else {
			echo json_encode(false);
		}
	}

	public function id_alias() {
		$id_alias = $this->Produto->find('first', array(
				'conditions' => array('Produto.ativo' => 1),
				'order' => array('Produto.id' => 'desc')
			)
		);

		return $id_alias['Produto']['id_alias'] + 1;
	}

}