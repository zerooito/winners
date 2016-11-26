<?php

class LancamentoVendasController extends AppController {

	public function salvar_lancamento($id_venda, $dados, $valor_total, $id_usuario) {
		$lancamento['venda_id']   = $id_venda;
		$lancamento['valor'] = $valor_total;
		$lancamento['valor_pago'] = $valor_total;
		$lancamento['data_pgt']   = date('Y-m-d');
		$lancamento['ativo']	  = 1;
		$lancamento['usuario_id'] = $id_usuario;
		$lancamento['forma_pagamento'] = $dados['forma_pagamento'];

		$this->LancamentoVenda->save($lancamento);

		return true;
 	}

}