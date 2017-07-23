<?php

class FinanceiroController extends AppController 
{

	public function listar_cadastros()
	{
		$this->loadModel('LancamentoVenda');

		$this->layout = 'wadmin';

		$this->set('lancamentos', $this->carregar_lancamentos_periodo(
				'2017-04-02',
				date('Y-m-d')
			)
		);
	}

	public function carregar_lancamentos_periodo($start, $end)
	{
		$this->loadModel('LancamentoVenda');
		$this->loadModel('LancamentoCategoria');

		$conditions = array('conditions' =>
			array(
				'LancamentoVenda.ativo' => 1,
				'LancamentoVenda.usuario_id' => $this->instancia,
				'LancamentoVenda.data_pgt > ' => $start,
				'LancamentoVenda.data_pgt < ' => $end
			)
		);

		$lancamentos = $this->LancamentoVenda->find('all', $conditions);
		
		$a_receber = 0;
		$a_pagar = 0;
		$pago = 0;
		$total = 0;
		$total_entradas = 0;
		$total_saidas = 0;
		foreach ($lancamentos as $i => $lancamento)
		{
			$categoria = $this->LancamentoCategoria->find('first', array('conditions' =>
					array(
						'LancamentoCategoria.ativo' => 1,
						'LancamentoCategoria.usuario_id' => $this->instancia,
						'LancamentoCategoria.id' => $lancamento['LancamentoVenda']['lancamento_categoria_id']
					)
				)
			);

			$lancamentos[$i]['Categoria'] = isset($categoria['LancamentoCategoria']) ? $categoria['LancamentoCategoria'] : array();

			if (empty($categoria) || $categoria['LancamentoCategoria']['tipo'] == "receita") {
				if ($lancamento['LancamentoVenda']['valor'] > $lancamento['LancamentoVenda']['valor_pago']) {
					$a_receber += $lancamento['LancamentoVenda']['valor'] - $lancamento['LancamentoVenda']['valor_pago'];
				}

				if ($lancamento['LancamentoVenda']['valor'] >= $lancamento['LancamentoVenda']['valor_pago']) {
					$total_entradas += $lancamento['LancamentoVenda']['valor'];
				}
			}

			if (empty($categoria))
				continue;

			if ($categoria['LancamentoCategoria']['tipo'] == "despesa") {
				if ($lancamento['LancamentoVenda']['valor'] > $lancamento['LancamentoVenda']['valor_pago']) {
					$a_pagar += $lancamento['LancamentoVenda']['valor'] - $lancamento['LancamentoVenda']['valor_pago'];
				} else {
					$pago += $lancamento['LancamentoVenda']['valor'];
					$total_saidas += $lancamento['LancamentoVenda']['valor'];
				}
			}

		}
		
		$data = [
			'lancamentos' => $lancamentos,
			'a_receber' => $a_receber,
			'a_pagar' => $a_pagar,
			'pago' => $pago,
			'total' => $total_entradas,
			'total_saidas' => $total_saidas
		];

		return $data;
	}

	public function listar_cadastros_ajax()
	{
		$this->layout = 'ajax';

		$this->loadModel('LancamentoVenda');
		$this->loadModel('LancamentoCategoria');

		$aColumns = array( 'id', 'venda_id', 'data_pgt', 'valor', 'lancamento_categoria_id' );

		$conditions = array('conditions' =>
			array(
				'LancamentoVenda.ativo' => 1,
				'LancamentoVenda.usuario_id' => $this->instancia
			)
		);

		$allLancamentos = $this->LancamentoVenda->find('count', $conditions);

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
					$conditions['order'] = array('LancamentoVenda.' . $aColumns[intval($_GET['iSortCol_' . $i])] => $_GET['sSortDir_'.$i]);
				}
			}
		}

		if ( isset( $_GET['sSearch'] ) && !empty( $_GET['sSearch'] ) )
		{
			$conditions['conditions']['LancamentoCategoria.nome LIKE '] = '%' . $_GET['sSearch'] . '%';
		}
		
		$lancamentos = $this->LancamentoVenda->find('all', $conditions);

		$output = array(
			"sEcho" => intval($_GET['sEcho']),
			"iTotalDisplayRecords" => $allLancamentos,
			"iTotalRecords" => count($lancamentos),
			"aaData" => array()
		);

		foreach ( $lancamentos as $i => $lancamento )
		{
			$row = array();

			for ( $i=0 ; $i < count($aColumns) ; $i++ )
			{
				if ($aColumns[$i] == "lancamento_categoria_id") {
					$conditions = array('conditions' =>
						array(
							'LancamentoCategoria.id' => $lancamento['LancamentoVenda'][$aColumns[$i]],
							'LancamentoCategoria.usuario_id' => $this->instancia,
							'LancamentoCategoria.ativo' => 1
						)
					);

					$categoria_lancamento = $this->LancamentoCategoria->find('first', $conditions);

					if (!empty($categoria_lancamento)) {
						if ($categoria_lancamento['LancamentoCategoria']['tipo'] == "receita") {
							$value = '<span class="label label-success">' . $categoria_lancamento['LancamentoCategoria']['nome'] . '</span>';
						} else {
							$value = '<span class="label label-danger">' . $categoria_lancamento['LancamentoCategoria']['nome'] . '</span>';
						}
					} else {
						$value = '<span class="label label-default">Sem Categoria</span>';
					}
				} else {
					$value = $lancamento['LancamentoVenda'][$aColumns[$i]];
				}

				if ($aColumns[$i] == "valor") {
					$value = 'R$ ' . number_format($lancamento['LancamentoVenda'][$aColumns[$i]], 2, ',', '.');
				}

				if ($aColumns[$i] == "data_pgt") {
					$date = new \DateTime($lancamento['LancamentoVenda'][$aColumns[$i]]);
					$value = $date->format('d/m/Y');
				}
				
				$row[] = $value;
			}

			$btImage = '<a class="btn btn-primary" href="/produto/imagens/' . $lancamento['LancamentoVenda']['id'] . '"><i class="fa fa-picture-o"></i></a>';

			$row[] = $btImage;

			$output['aaData'][] = $row;
		}

		echo json_encode($output);
		exit;
	}

	public function adicionar_categoria()
	{
		$data = $this->request->data('categoria');

		$data['usuario_id'] = $this->instancia;
		$data['ativo'] = 1;

		$this->loadModel('LancamentoCategoria');

		$retorno = $this->LancamentoCategoria->save($data);
		
		if (!$retorno) {
			$this->Session->setFlash('Ocorreu um erro ao salvar a categoria tente novamente');
			return $this->redirect('/financeiro/listar_cadastros');
		}

		$this->Session->setFlash('Categoria salva com sucesso');
		return $this->redirect('/financeiro/listar_cadastros');
	}

}