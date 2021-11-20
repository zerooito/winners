<?php

include 'CaixaController.php';

class LancamentoVendasController extends AppController {

	public function salvar_lancamento($id_venda, $dados, $valor_total, $id_usuario, $orcamento=true) {
		$lancamento['venda_id'] = $id_venda;
		$lancamento['valor'] = $valor_total;
		
		if ($orcamento) {
			$lancamento['valor_pago'] = 0;
		} else {
			$lancamento['valor_pago'] = $valor_total;
		}
		
		$lancamento['data_pgt']   = date('Y-m-d');
		$lancamento['ativo']	  = 1;
		$lancamento['usuario_id'] = $id_usuario;
		$lancamento['tipo'] = 'receita';

		if ($orcamento == false) {
			$objCaixaController = new CaixaController();
			$caixa_atual = $objCaixaController->carregar_caixa_atual($id_usuario);

			$lancamento['caixa_id'] = $caixa_atual['Caixa']['id'];
		}

		if (count($dados['forma_pagamento_multiplo']) > 1) {
			foreach ($dados['forma_pagamento_multiplo'] as $i => $forma_pagamento) {
				$this->LancamentoVenda->create();

				$lancamento['forma_pagamento'] = $forma_pagamento;
				$lancamento['valor_pago'] = $dados['valor_pago_multiplo'][$i];
				$lancamento['valor'] = $dados['valor_pago_multiplo'][$i];

				$this->LancamentoVenda->save($lancamento);
			}
		} else {
			$lancamento['forma_pagamento'] = $dados['forma_pagamento'];

			$this->LancamentoVenda->save($lancamento);
		}

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