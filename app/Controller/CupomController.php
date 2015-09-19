<?php

class CupomController extends AppController {


	public function listar_cadastros() 
	{
		$cupons = $this->Cupom->find('all', 
			array('conditions' => 
				array('ativo' => 1,
					  'usuario_id' => $this->instancia
				)
			)
		);
		
		$this->set('cupons', $cupons);

		$this->layout = 'wadmin';
	}

	public function adicionar_cupom()
	{
		$this->layout = 'wadmin';
	}

	public function s_adicionar_cupom()
	{
		$dados = $this->request->data('dados');
		$dados['ativo'] = 1;
		$dados['usuario_id'] = $this->instancia;

		if ($this->Cupom->save($dados)) {
			$this->Session->setFlash('Cupom criado com sucesso!');
            return $this->redirect('/cupom/listar_cadastros');
		} else {
			$this->Session->setFlash('Ocorreu algum erro ao criar o cupom!');
            return $this->redirect('/cupom/listar_cadastros');
		}
	}

	public function editar_cupom($id)
	{
		$this->set('cupom', $this->Cupom->find('all', 
				array('conditions' => 
					array(
						'ativo' => 1,
						'usuario_id' => $this->instancia,
						'id' => $id
					)
				)
			)
		);

		$this->layout = 'wadmin';
	}

	public function s_editar_cupom($id)
	{
		$dados = $this->request->data('dados');

		$this->Cupom->id = $id;

		if ($this->Cupom->save($dados)) {
			$this->Session->setFlash('Cupom editado com sucesso!');
            return $this->redirect('/cupom/listar_cadastros');
		} else {
			$this->Session->setFlash('Ocorreu algum erro ao editar o cupom!');
            return $this->redirect('/cupom/listar_cadastros');
		}
	}

	public function excluir_cupom($id)
	{
		$dados['ativo'] = 0;

		$this->Cupom->id = $id;

		if ($this->Cupom->save($dados)) {
			$this->Session->setFlash('Cupom excluido com sucesso!');
            return $this->redirect('/cupom/listar_cadastros');
		} else {
			$this->Session->setFlash('Ocorreu algum erro ao excluir o cupom!');
            return $this->redirect('/cupom/listar_cadastros');
		}
	}

}