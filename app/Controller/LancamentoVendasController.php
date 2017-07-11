<?php

class LancamentoVendasController extends AppController {

	public function salvar_lancamento($id_venda, $dados, $valor_total, $id_usuario, $orcamento=true) {
		$lancamento['venda_id']   = $id_venda;
		$lancamento['valor'] = $valor_total;
		
		if ($orcamento) {
			$lancamento['valor_pago'] = 0;
		} else {
			$lancamento['valor_pago'] = $valor_total;
		}
		
		$lancamento['data_pgt']   = date('Y-m-d');
		$lancamento['ativo']	  = 1;
		$lancamento['usuario_id'] = $id_usuario;
		$lancamento['forma_pagamento'] = $dados['forma_pagamento'];

		$this->LancamentoVenda->save($lancamento);

		return true;
 	}

 	public function cancelar($id_venda, $id_cliente) {
 		$response = $this->LancamentoVenda->find('first', array(
    			'conditions' => array(
    				'LancamentoVenda.venda_id' => $id_venda
    			)
    		)
    	);

 		$this->LancamentoVenda->id = $response['LancamentoVenda']['id'];

 		$this->LancamentoVenda->save(
 			['valor_pago' => 0]
 		);

 		echo json_encode(
 			[
 				'valor' => $response['LancamentoVenda']['valor']
 			]
 		);
 		exit;

 	}

 	public function aprovar($id_venda, $id_cliente) {
 		$response = $this->LancamentoVenda->find('first', array(
    			'conditions' => array(
    				'LancamentoVenda.venda_id' => $id_venda
    			)
    		)
    	);

 		$this->LancamentoVenda->id = $response['LancamentoVenda']['id'];

 		$this->LancamentoVenda->save(
 			['valor_pago' => $response['LancamentoVenda']['valor']]
 		);
 		
 		echo json_encode(
 			[
 				'valor' => $response['LancamentoVenda']['valor']
 			]
 		);
 		exit;
 	}

}