<?php

class NewsletterController extends AppController {


	public function listar_cadastros() 
	{
		$newsletters = $this->Newsletter->find('all', 
			array('conditions' => 
				array('ativo' => 1,
					  'usuario_id' => $this->instancia
				)
			)
		);
		
		$this->set('newsletters', $newsletters);

		$this->layout = 'wadmin';
	}

	public function excluir_newsletter($id)
	{
		$dados['ativo'] = 0;

		$this->Newsletter->id = $id;

		if ($this->Newsletter->save($dados)) {
			$this->Session->setFlash('Cadastro de newsletter excluido com sucesso!');
            return $this->redirect('/newsletter/listar_cadastros');
		} else {
			$this->Session->setFlash('Ocorreu algum erro ao excluir o cadastro de newsletter!');
            return $this->redirect('/newsletter/listar_cadastros');
		}
	}


	public function newsletter_cadastro($nome, $email, $usuario_id)
	{
		$dados['ativo'] 	 = 1;
		$dados['email'] 	 = $email;
		$dados['nome']  	 = $nome;
		$dados['usuario_id'] = $usuario_id;

		if ($this->Newsletter->save($dados))
		{
			return true;
		}

		return false;
	}

}