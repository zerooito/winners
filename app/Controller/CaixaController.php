<?php

class CaixaController extends AppController {

	public function iniciar_caixa() {
		$data = $this->request->data['caixa'];

		$data['usuario_id'] = $this->instancia;
		$data['ativo']		= 1;
		$data['valor_inicial'] = $this->remove_first_point(str_replace(',', '', $data['valor_inicial']));

		if (!$this->Caixa->save($data)) {
			$this->Session->setFlash('Ocorreu um erro ao abrir o caixa, tente novamente, caso persista contate o suporte');
			$this->redirect('/venda/adicionar_cadastro');
		}

		$this->Session->setFlash('Caixa aberto com sucesso!');
		$this->redirect('/venda/adicionar_cadastro');
	}

	public function finalizar_caixa() {
		$data = $this->request->data['caixa'];
		$data['valor_final_cartao'] = $data['valor_final_cartao_debito'] + $data['valor_final_cartao_credito'];
		$data['valor_final_total'] = $this->remove_first_point(str_replace(',', '.', $data['valor_final_total']));
		$data['valor_final_dinheiro'] = $this->remove_first_point(str_replace(',', '.', $data['valor_final_dinheiro']));
		$data['valor_final_cartao_debito'] = $this->remove_first_point(str_replace(',', '.', $data['valor_final_cartao_debito']));
		$data['valor_final_cartao_credito'] = $this->remove_first_point(str_replace(',', '.', $data['valor_final_cartao_credito']));
		$data['valor_final_outros'] = $this->remove_first_point(str_replace(',', '.', $data['valor_final_outros']));
		$data['valor_inicial'] = $this->remove_first_point(str_replace(',', '.', $data['valor_inicial']));
		
		if (!$this->Caixa->save($data)) {
			$this->Session->setFlash('Ocorreu um erro ao fechar o caixa, tente novamente, caso persista contate o suporte');
			$this->redirect('/venda/adicionar_cadastro');
		}

		$this->Session->setFlash('Caixa fechado com sucesso!');
		$this->redirect('/venda/adicionar_cadastro');
	}

	public function caixa_foi_aberto() 
	{
		$this->layout = 'ajax';

		$caixaAtual = $this->carregar_caixa_atual();

		if (empty($caixaAtual)) {
			echo json_encode(['status' => 'nao_aberto', 'data_abertura' => null]);
			exit;
		}
		
		echo json_encode(['status' => 'aberto', 'data_abertura' => date_format(new DateTime($caixaAtual['Caixa']['data_abertura']), 'd/m/Y H:i:s')]);
		exit;
	}

	public function carregar_fechamento_caixa_dia_ajax() 
	{
		$this->layout = 'ajax';

		$caixaAtual = $this->carregar_caixa_atual();

		$totalVendas = $this->carregar_total_vendas($caixaAtual['Caixa']['id']) + $caixaAtual['Caixa']['valor_inicial'];

		$vendido = $totalVendas - $caixaAtual['Caixa']['valor_inicial'];

		$response = [
			'total_vendas' => (float) $totalVendas,
			'total_cartao_debito' => (float) $this->carregar_total_por_tipo('cartao_debito', $caixaAtual['Caixa']['id']),
			'total_cartao_credito' => (float) $this->carregar_total_por_tipo('cartao_credito', $caixaAtual['Caixa']['id']),
			'total_dinheiro' => (float) $this->carregar_total_por_tipo('dinheiro', $caixaAtual['Caixa']['id']),
			'total_outros' => (float) $this->carregar_total_por_tipo('pix', $caixaAtual['Caixa']['id']),
			'caixa_atual' => $caixaAtual,
			'vendido' => $vendido
		];

		echo json_encode($response);
		exit;
	}

	public function carregar_fechamento_do_caixa($id) 
	{
		$this->layout = 'ajax';

		$caixaAtual = $this->carregar_caixa_por_id($id);

		$totalVendas = $this->carregar_total_vendas($id) + $caixaAtual['Caixa']['valor_inicial'];

		$vendido = $totalVendas - $caixaAtual['Caixa']['valor_inicial'];

		$response = [
			'total_vendas' => (float) $totalVendas,
			'total_cartao_debito' => (float) $this->carregar_total_por_tipo('cartao_debito', $id),
			'total_cartao_credito' => (float) $this->carregar_total_por_tipo('cartao_credito', $id),
			'total_dinheiro' => (float) $this->carregar_total_por_tipo('dinheiro', $id),
			'total_outros' => (float) $this->carregar_total_por_tipo('pix', $id),
			'caixa_atual' => $caixaAtual,
			'vendido' => $vendido
		];

		echo json_encode($response);
		exit;
	}

	public function carregar_caixa_por_id($id)
	{
		$caixa = $this->Caixa->find('first', array(
				'conditions' => array(
					'Caixa.usuario_id' => $this->instancia,
					'Caixa.id' => $id
				)
			)
		);

		return $caixa;
	}

	public function carregar_caixa_atual($id_usuario = null)
	{
		if (empty($id_usuario) || !isset($id_usuario)) {
			$id_usuario = $this->instancia;
		}

		$caixa = $this->Caixa->find('first', array(
				'conditions' => array(
					'Caixa.usuario_id' => $id_usuario,
					'Caixa.data_fechamento' => null
				),
				'order' => array('Caixa.data_abertura' => 'desc')
			)
		);

		return $caixa;
	}

	public function carregar_total_por_tipo($tipo, $caixa_id)
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
				'LancamentoVenda.caixa_id' => $caixa_id,
				'Venda.orcamento <> ' => 1
			)
		);

		if ($tipo == 'cartao_debito') {
			$conditions['conditions']['LancamentoVenda.forma_pagamento'] = 'cartao_debito';
		} else if ($tipo == 'cartao_credito') {
			$conditions['conditions']['LancamentoVenda.forma_pagamento'] = 'cartao_credito';
		} else if ($tipo == 'pix') {
			$conditions['conditions']['LancamentoVenda.forma_pagamento'] = 'pix';
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

	public function carregar_total_vendas($caixa_id)
	{
		$this->loadModel('Venda');
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
				'LancamentoVenda.caixa_id' => $caixa_id,
				'Venda.orcamento <> ' => 1
			)
		);

		$total = 0;

		$LancamentoVendas = $this->LancamentoVenda->find('all', $conditions);	
		foreach ($LancamentoVendas as $i => $LancamentoVenda) {
			$total += $LancamentoVenda['LancamentoVenda']['valor_pago'];
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
			'valor_final_cartao', 'valor_final_dinheiro', 'valor_final_outros',
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

					if ($aColumns[$i] == 'valor_inicial') {
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

					if ($aColumns[$i] == 'valor_final_outros') {
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
					$row[] = '<a href="javascript:;" class="fechar-caixa btn btn-success"  data-id="' . $caixa['Caixa']['id'] . '" title="Fechar Caixa"><i class="fa fa-envelope" aria-hidden="true"></i></a>';
				} else {
					$row[] = '<a href="javascript:alert(\'Caixa já fechado\');" class="btn btn-primary" data-id="' . $caixa['Caixa']['id'] . '" title="Caixa fechado"><i class="fa fa-check" aria-hidden="true"></i></a>';
				}

				$output['aaData'][] = $row;
			}
		}

		echo json_encode($output);
		exit;
	}

	private function remove_first_point($originalString)
	{

		$occurrencesCount = substr_count($originalString, ".");

		if ($occurrencesCount <= 1) {
			return $originalString;
		}

		$position = strpos($originalString, ".");

		if ($position !== false) {
			$modifiedString = substr($originalString, 0, $position) . substr($originalString, $position + 1);
		} else {
			$modifiedString = $originalString;
		}

		return $modifiedString;
	}

}