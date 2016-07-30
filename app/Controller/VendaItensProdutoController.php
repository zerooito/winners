<?php 

class VendaItensProdutoController extends ProdutoEstoqueController {

	public function adicionar_itens_venda($id_venda, $produtos, $orcamento) {

		if ($id_venda == null || empty($produtos)) {
			return false;
		}

		$erros = 0;
		foreach ($produtos as $indice => $item) {
			$dados['produto_id'] 		 = $item['id_produto'];
			$dados['quantidade_produto'] = $item['quantidade'];
			$dados['venda_id']			 = $id_venda;
			$dados['ativo']				 = 1;

			if (!$this->VendaItensProduto->save($dados)) {
				$erros++;
			}

			if (!$orcamento) {
				if (isset($item['variacao'])) {
					if (!$this->diminuir_estoque_produto_variacao($item['id_produto'], $item['quantidade'], $item['variacao'])) {
						return false;
					}
				}

				if (!$this->diminuir_estoque_produto($item['id_produto'], $item['quantidade'])) {
					return false;
				}
			}
		}

		return $erros;
	}

}