<?php

class CaixaController extends AppController {

	public function iniciar_caixa() {
		$data = $this->request->data['caixa'];

		$data['usuario_id'] = $this->instancia;
		$data['ativo']		= 1;

		if (!$this->Caixa->save($data)) {
			$this->Session->setFlash('Ocorreu um erro ao abrir o caixa, tente novamente, caso persista contate o suporte');
			$this->redirect('/venda/adicionar_cadastro');
		}

		$this->Session->setFlash('Caixa aberto com sucesso!');
		$this->redirect('/venda/adicionar_cadastro');
	}

	public function finalizar_caixa() {
		$data = $this->request->data['caixa'];

		if (!$this->Caixa->save($data)) {
			$this->Session->setFlash('Ocorreu um erro ao fechar o caixa, tente novamente, caso persista contate o suporte');
			$this->redirect('/venda/adicionar_cadastro');
		}

		$this->Session->setFlash('Caixa fechado com sucesso!');
		$this->redirect('/venda/adicionar_cadastro');
	}

	public function carregar_fechamento_caixa_dia_ajax() 
	{
		$this->layout = 'ajax';

		$caixaAtual = $this->carregar_caixa_atual();

		$totalVendas = $this->carregar_total_vendas() + $caixaAtual['Caixa']['valor_inicial'];

		$vendido = $totalVendas - $caixaAtual['Caixa']['valor_inicial'];

		$response = [
			'total_vendas' => (float) $totalVendas,
			'total_cartao' => (float) $this->carregar_total_por_tipo('cartao'),
			'total_dinheiro' => (float) $this->carregar_total_por_tipo('dinheiro'),
			'caixa_atual' => $caixaAtual,
			'vendido' => $vendido
		];

		echo json_encode($response);
		exit;
	}

	public function carregar_caixa_atual()
	{
		$caixa = $this->Caixa->find('first', array(
				'conditions' => array(
					'Caixa.usuario_id' => $this->instancia,
					'Caixa.data_abertura >= ' => date('Y-m-d')
				)
			)
		);

		return $caixa;
	}

	public function carregar_total_por_tipo($tipo)
	{
		$this->loadModel('LancamentoVenda');

		$conditions = array(
			'joins' => array(
			    array(
			        'table' => 'vendas',
			        'alias' => 'Venda',
			        'type' => 'LEFT',
			        'conditions' => array(
			            'LancamentoVenda.venda_id = Venda.id',
			        ),
			    )
			),
			'conditions' => array(
				'LancamentoVenda.usuario_id' => $this->instancia,
				'LancamentoVenda.data_pgt' => date('Y-m-d'),
				'Venda.orcamento <> ' => 1
			)
		);

		if ($tipo == 'cartao') {
			$conditions['conditions']['LancamentoVenda.forma_pagamento <> '] = 'dinheiro';
		} else {
			$conditions['conditions']['LancamentoVenda.forma_pagamento'] = 'dinheiro';
		}

		$LancamentoVendas = $this->LancamentoVenda->find('all', $conditions);	
		
		$total = 0;

		foreach ($LancamentoVendas as $i => $LancamentoVenda) {
			$total += $LancamentoVenda['LancamentoVenda']['valor_pago'];
		}

		return (float) $total;
	}

	public function carregar_total_vendas()
	{
		$this->loadModel('Venda');

		$dateInit = date('Y-m-d');
		$dateEnd  = date('Y-m-d');

		$vendas = $this->Venda->find('all', array(
				'conditions' => array(
					'Venda.data_venda' => $dateInit,
					'Venda.id_usuario' => $this->instancia,
					'Venda.ativo' => 1,
					'Venda.orcamento <> ' => 1
				)
			)
		);

		$total = 0;
		foreach ($vendas as $i => $venda) {
			$total += $venda['Venda']['valor'];
		}

		return (float) $total;
	}

}