<?php

use PluggTo\Lib\Product\PluggProduct;
use PluggTo\Lib\PluggRequest;

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

	public function enviar_produto($dados, $variacao) 
	{
		$this->loadModel('PluggtoConfiguracoes');

		$PluggProduct = new PluggProduct;
		$PluggRequest = new PluggRequest;

		$keysPluggTo  = $this->PluggtoConfiguracoes->find('first', array(
				'conditions' => array(
					'PluggtoConfiguracoes.usuario_id' => $dados['id_usuario']
				)
			)
		);

		$PluggRequest->CLIENT_ID     = $keysPluggTo['PluggtoConfiguracoes']['client_id'];
		$PluggRequest->CLIENT_SECRET = $keysPluggTo['PluggtoConfiguracoes']['client_secret'];
		$PluggRequest->API_USER      = $keysPluggTo['PluggtoConfiguracoes']['api_user'];
		$PluggRequest->PASSWORD      = $keysPluggTo['PluggtoConfiguracoes']['api_secret'];
		$PluggRequest->TYPE          = 'PLUGIN';

		$token = $PluggRequest->getAccessToken();

		$PluggProduct->access_token = $token;
		$PluggProduct->name = $dados['nome'];
		$PluggProduct->photos = [['url' => 'http://www.ciawn.com.br/uploads/produto/imagens/' . $dados['imagem']]];
		$PluggProduct->sku = $dados['sku'];
		$PluggProduct->quantity = $dados['estoque'];
		$PluggProduct->price = $dados['preco'];
		$PluggProduct->dimension = [
			'weight' => $dados['peso_bruto']
		];

		$retorno = $PluggProduct->sendProductToPlugg();

		return $retorno;
	}

}