<?php

class PluggtoController extends AppController {

	public function beforeFilter() {
		parent::beforeFilter();

		$this->loadModel('PluggtoConfiguracoes');
	}

	public function configuracoes() {
		$dados = $this->PluggtoConfiguracoes->find('first', array(
				'conditions' => array(
					'PluggtoConfiguracoes.usuario_id' => $this->instancia
				)
			)
		);

		$this->set('dados', $dados['PluggtoConfiguracoes']);

		$this->layout = 'wadmin';
	}

	public function salvar() {
		$dados = $this->request->data['dados'];

		$dados['usuario_id'] = $this->instancia;

		if (isset($dados['id']))
			$this->PluggtoConfiguracoes->id = $dados['id'];

		if (!$this->PluggtoConfiguracoes->save($dados))
		{
			$this->Session->setFlash("Ocorreu um erro ao salvar as configurações.");

			return $this->redirect("/pluggto/configuracoes"); 
		}

		$this->Session->setFlash("Configurações salvas com sucesso.");

		return $this->redirect("/pluggto/configuracoes");  
	}

}