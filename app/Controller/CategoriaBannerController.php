<?php

/**
* CategoriaBannerController
*/
class CategoriaBannerController extends AppController {

	public function listar_cadastros() {
		$categorias = $this->CategoriaBanner->find('all', 
			array('conditions' => 
				array('ativo' => 1,
					  'usuario_id' => $this->instancia
				)
			)
		);

		$this->set('categorias', $categorias);

		$this->layout = 'wadmin';
	}

	public function adicionar_cadastro() {
		$this->layout = 'wadmin';
	}

	public function s_adicionar_cadastro() {
		$dados = $this->request->data('dados');
		$dados['ativo']      = 1;
		$dados['usuario_id'] = $this->instancia;

		if ($this->CategoriaBanner->save($dados)) {
			$this->Session->setFlash('Categoria criada com Sucesso!','default','good');
            return $this->redirect('/categoria_banner/listar_cadastros');
		} else {
			$this->Session->setFlash('Erro ao criar a categoria!','default','good');
            return $this->redirect('/categoria_banner/listar_cadastros');
		}
	}

	public function editar_cadastro($id) {
		$categoria = $this->CategoriaBanner->find('first', 
			array('conditions' => 
				array( 'id' => $id )
			)
		);

		$this->set('dados', $categoria);

		$this->layout = 'wadmin';
	}

	public function s_editar_cadastro($id) {
		$dados = $this->request->data('dados');

		$this->CategoriaBanner->id = $id;

		if ($this->CategoriaBanner->save($dados)) {
			$this->Session->setFlash('Categoria editada com Sucesso!','default','good');
            return $this->redirect('/categoria_banner/listar_cadastros');
		} else {
			$this->Session->setFlash('Erro ao editar a categoria!','default','good');
            return $this->redirect('/categoria_banner/listar_cadastros');
		}
	}

	public function excluir_cadastro() {
		$this->layout = 'ajax';

		$id = $this->request->data('id');

		$dados = array ('ativo' => '0');
		$parametros = array ('id' => $id);

		if ($this->CategoriaBanner->updateAll($dados, $parametros)) {
			$this->Session->setFlash('Categoria excluida com Sucesso!','default','good');
			echo json_encode(true);
		} else {
			$this->Session->setFlash('Erro ao excluir categoria!','default','good');
			echo json_encode(false);
		}
	}

}