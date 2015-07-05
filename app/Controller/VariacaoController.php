<?php

class VariacaoController extends AppController {

	public function s_adicionar_variacao($variacoes, $produto_id, $usuario_id) {
		if (empty($variacoes) || empty($produto_id)) {
			return false;
		}

		foreach ($variacoes as $i => $variacao) {
			$this->Variacao->create();

			$dados['produto_id']    = $produto_id;
			$dados['usuario_id']    = $usuario_id;
			$dados['nome_variacao'] = $variacao['variacao'];
			$dados['estoque']		= $variacao['estoque'];
			$dados['ativo']			= 1;

			$this->Variacao->save($dados);
		} 

		return true;
	}

	public function desativar_variacoes($id) {
		if (empty($id)) {
			return false;
		}

		$dados = array ('ativo' => '0');
		$parametros = array ('produto_id' => $id);

		if (!$this->Variacao->updateAll($dados, $parametros)) {
			return false;
		}

		return true;
	}

}