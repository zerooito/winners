<?php

class ProdutoController extends AppController{
	public $codigo;
	public $nome;
	public $preco;
	public $estoque;
	
	public function listar_cadastros() {
		$this->layout = 'wadmin';

		$this->set('produtos', $this->Produto->find('all', 
				array('conditions' => 
					array('ativo' => 1)
				)
			)
		);
	}

	public function adicionar_cadastro() {
		$this->layout = 'wadmin';
	}

	public function s_adicionar_cadastro() {
		$dados = $this->request->data('dados');
		$dados['id_instancia'] = $this->Session->read('Usuario.id');
		$dados['ativo'] = 1;
		$dados['id_alias'] = $this->id_alias();

		if($this->Produto->save($dados)) {
			$this->Session->setFlash('Cliente salvo com sucesso!');
            return $this->redirect('/produto/listar_cadastros');
		} else {
			$this->Session->setFlash('Ocorreu um erro ao salva o cliente!');
            return $this->redirect('/produto/listar_cadastros');
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