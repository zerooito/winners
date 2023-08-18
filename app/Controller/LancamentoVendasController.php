<?php

include 'CaixaController.php';
include 'FinanceiroController.php';

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

		if ($orcamento == false && !isset($lancamento['loja'])) {
			$objCaixaController = new CaixaController();
			$caixa_atual = $objCaixaController->carregar_caixa_atual($id_usuario);

			if (isset($caixa_atual) && !empty($caixa_atual)) {
				$lancamento['caixa_id'] = $caixa_atual['Caixa']['id'];
			}
		}

		unset($lancamento['loja']);

		if (count($dados['forma_pagamento_multiplo']) > 1) {
			foreach ($dados['forma_pagamento_multiplo'] as $i => $forma_pagamento) {
				$this->LancamentoVenda->create();

				$lancamento['forma_pagamento'] = $forma_pagamento;
				$lancamento['valor_pago'] = $dados['valor_pago_multiplo'][$i];

				$lancamento_record = $this->LancamentoVenda->save($lancamento);

				if ($forma_pagamento != 'dinheiro') {
					$objFinanceiroController = new FinanceiroController();
					$objFinanceiroController->atualizarContaEAdicionarExtrato(null, $lancamento_record);
				}
			}
		} else {
			$lancamento['forma_pagamento'] = $dados['forma_pagamento'];
			$lancamento_venda = $this->LancamentoVenda->save($lancamento);

			if ($dados['forma_pagamento'] != 'dinheiro') {
				$objFinanceiroController = new FinanceiroController();
				$objFinanceiroController->atualizarContaEAdicionarExtrato(null, $lancamento_venda);
			}
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