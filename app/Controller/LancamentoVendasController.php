<?php

class LancamentoVendasController extends AppController {

	public function salvar_lancamento($id_venda, $lancamento, $valor_total) {
		$lancamento['venda_id']   = $id_venda;
		$lancamento['valor_pago'] = $valor_total;
		$lancamento['data_pgt']   = date('Y-m-d');
		$lancamento['ativo']	  = 1;
		$lancamento['usuario_id'] = $this->instancia;

		$this->LancamentoVenda->save($lancamento);

		return true;
 	}

}