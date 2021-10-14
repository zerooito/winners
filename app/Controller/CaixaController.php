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

	public function listar_cadastros()
	{

		$this->layout = 'wadmin';
	}

	public function listar_cadastros_ajax()
	{
		$this->layout = 'ajax';

		$aColumns = [
			'id', 'valor_inicial', 'valor_final_total', 
			'valor_final_cartao', 'valor_final_dinheiro',
			'data_abertura', 'data_fechamento'
		];
		
		$conditions = array('conditions' =>
			array(
				'ativo' => 1,
				'usuario_id' => $this->instancia
			)
		);

		$allCaixa = $this->Caixa->find('all', $conditions); // mudar para count
		
		if ( isset( $_GET['iDisplayStart'] ) && $_GET['iDisplayLength'] != '-1' )
		{
			$conditions['offset'] = $_GET['iDisplayStart'];
			$conditions['limit'] = $_GET['iDisplayLength'];
		}

		if ( isset( $_GET['iSortCol_0'] ) )
		{
			for ( $i=0 ; $i < intval( $_GET['iSortingCols'] ) ; $i++ )
			{
				if ( $_GET[ 'bSortable_' . intval($_GET['iSortCol_' . $i]) ] == "true" )
				{
					$conditions['order'] = array('Caixa.' . $aColumns[intval($_GET['iSortCol_' . $i])] => $_GET['sSortDir_'.$i]);
				}
			}
		}

		if ( isset( $_GET['sSearch'] ) && !empty( $_GET['sSearch'] ) )
		{
			$conditions['conditions']['Caixa.data_abertura LIKE '] = '%' . $_GET['sSearch'] . '%';
		}
		
		$caixas = $this->Caixa->find('all', $conditions);

		$output = array(
			"sEcho" => intval($_GET['sEcho']),
			"iTotalDisplayRecords" => count($allCaixa),
			"iTotalRecords" => count($caixas),
			"aaData" => array()
		);

		if ($this->PermissoesHelper->usuario_possui_permissao_para('venda', 'read')) {
			foreach ( $caixas as $i => $caixa )
			{
				$row = array();

				for ( $i=0 ; $i < count($aColumns) ; $i++ )
				{
					$value = $caixa['Caixa'][$aColumns[$i]];

					if ($aColumns[$i] == 'data_abertura') {
						if (empty($caixa['Caixa'][$aColumns[$i]])) {
							$value = ' -- ';
						} else {
							$value = date_format(new DateTime($caixa['Caixa'][$aColumns[$i]]), 'd/m/Y H:i:s');
						}
					}

					if ($aColumns[$i] == 'data_fechamento') {
						if (empty($caixa['Caixa'][$aColumns[$i]])) {
							$value = ' -- ';
						} else {
							$value = date_format(new DateTime($caixa['Caixa'][$aColumns[$i]]), 'd/m/Y H:i:s');
						}
					}

					if ($aColumns[$i] == 'valor_final_cartao') {
						if (empty($caixa['Caixa'][$aColumns[$i]])) {
							$value = ' -- ';
						} else {
							$value = 'R$ ' . number_format($caixa['Caixa'][$aColumns[$i]], 2, '.', ',');
						}
					}

					if ($aColumns[$i] == 'valor_final_dinheiro') {
						if (empty($caixa['Caixa'][$aColumns[$i]])) {
							$value = ' -- ';
						} else {
							$value = 'R$ ' . number_format($caixa['Caixa'][$aColumns[$i]], 2, '.', ',');
						}
					}

					if ($aColumns[$i] == 'valor_final_total') {
						if (empty($caixa['Caixa'][$aColumns[$i]])) {
							$value = ' -- ';
						} else {
							$value = 'R$ ' . number_format($caixa['Caixa'][$aColumns[$i]], 2, '.', ',');
						}
					}

					$row[] = $value;
				}
				
				if (empty($caixa['Caixa']['data_fechamento'])) {
					$row[] = '<a href="#" class="btn btn-success" title="Fechar Caixa"><i class="fa fa-envelope" aria-hidden="true"></i></a>';
				} else {
					$row[] = '<a href="#" class="btn btn-primary" title="Visualizar Dados Caixa"><i class="fa fa-eye" aria-hidden="true"></i></a>';
				}

				$output['aaData'][] = $row;
			}
		}

		echo json_encode($output);
		exit;
	}

}