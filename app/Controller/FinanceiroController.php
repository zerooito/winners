<?php

class FinanceiroController extends AppController 
{

	public function listar_cadastros()
	{
		$this->loadModel('LancamentoVenda');

		$this->layout = 'wadmin';

		$this->set('lancamentos', $this->carregar_lancamentos_periodo());
	}

	public function carregar_lancamentos_periodo()
	{
		$this->loadModel('LancamentoVenda');
		$this->loadModel('LancamentoCategoria');

		$conditions = array('conditions' =>
			array(
				'LancamentoVenda.ativo' => 1,
				'LancamentoVenda.usuario_id' => $this->instancia
			),
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

	public function carregar_categorias($id = null)
	{
		$this->loadModel('LancamentoCategoria');

		$filter = $this->request->query('term');

		$conditions = array('conditions' => array(
				'LancamentoCategoria.usuario_id' => $this->instancia,
				'LancamentoCategoria.ativo' => 1
			)
		);

		if (!empty($filter['term'])) {
			$conditions['conditions']['LancamentoCategoria.nome LIKE '] = '%' . $filter['term'] . '%';
		}

		$conditions['limit'] = $this->request->query('page_limit');

		$categorias = $this->LancamentoCategoria->find('all', $conditions);

		$response = [];

		$response['results'][0]['id'] = -1;
		$response['results'][0]['text'] = 'Todos';

		$response['results'][1]['id'] = 0;
		$response['results'][1]['text'] = 'Sem categoria';

		$i = 1;
		foreach ($categorias as $categoria) {
			$i++; 

			$response['results'][$i]['id'] = $categoria['LancamentoCategoria']['id'];
			$response['results'][$i]['text'] = $categoria['LancamentoCategoria']['nome'];
		}

		echo json_encode($response);
		exit;
	}

	public function carregar_fornecedores($id = null)
	{
		$this->loadModel('Fornecedore');

		$filter = $this->request->query('term');

		$conditions = array('conditions' => array(
				'Fornecedore.usuario_id' => $this->instancia,
				'Fornecedore.ativo' => 1
			)
		);

		if (!empty($filter['term'])) {
			$conditions['conditions']['Fornecedore.nome LIKE '] = '%' . $filter['term'] . '%';
		}

		$conditions['limit'] = $this->request->query('page_limit');

		$fornecedores = $this->Fornecedore->find('all', $conditions);

		$response = [];

		$response['results'][0]['id'] = -1;
		$response['results'][0]['text'] = 'Todos';

		$response['results'][1]['id'] = 0;
		$response['results'][1]['text'] = 'Sem Fornecedor';

		$i = 1;
		foreach ($fornecedores as $fornecedor) {
			$i++; 

			$response['results'][$i]['id'] = $fornecedor['Fornecedore']['id'];
			$response['results'][$i]['text'] = $fornecedor['Fornecedore']['nome'];
		}

		echo json_encode($response);
		exit;
	}

	public function listar_cadastros_ajax()
	{
		$this->layout = 'ajax';

		$this->loadModel('LancamentoVenda');
		$this->loadModel('LancamentoCategoria');

		$aColumns = array( 'id', 'venda_id', 'data_vencimento', 'valor', 'lancamento_categoria_id' );

		$conditions = array(
			'conditions' => array(
				'LancamentoVenda.ativo' => 1,
				'LancamentoVenda.usuario_id' => $this->instancia
			),
			'joins' => array(
			    array(
			        'table' => 'lancamento_categorias',
			        'alias' => 'LancamentoCategoria',
			        'type' => 'LEFT',
			        'conditions' => array(
			            'LancamentoVenda.lancamento_categoria_id = LancamentoCategoria.id',
			        ),
			    ),
			    array(
			        'table' => 'fornecedores',
			        'alias' => 'Fornecedore',
			        'type' => 'LEFT',
			        'conditions' => array(
			            'LancamentoVenda.fornecedore_id = Fornecedore.id',
			        ),
			    )
			),
			'fields' => array(
				'LancamentoCategoria.*', 'LancamentoVenda.*', 'Fornecedore.*'
			)
		);

		if ( isset( $_GET['iSortCol_0'] ) )
		{
			for ( $i=0 ; $i < intval( $_GET['iSortingCols'] ) ; $i++ )
			{
				if ( $_GET[ 'bSortable_' . intval($_GET['iSortCol_' . $i]) ] == "true" )
				{
					$conditions['order'] = array(
						'LancamentoVenda.' . $aColumns[intval($_GET['iSortCol_' . $i])] => $_GET['sSortDir_' . $i]);
				}
			}
		}
		
		if ( isset( $_GET['sSearch'] ) && !empty( $_GET['sSearch'] ) )
		{
			$search = explode(':', $_GET['sSearch']);

			if ($search[0] == "lancamento_categoria_id" && $search[1] != -1) {
				$conditions['conditions']['LancamentoCategoria.id'] = empty($search[1]) ? "" : $search[1];
			}

			if ($search[0] == "tipo" && $search[1] != -1) {
				$conditions['conditions']['LancamentoCategoria.tipo'] = $search[1];
			}

			if ($search[0] == "pagamento" && $search[1] != -1) {
				$conditions['conditions']['LancamentoVenda.data_pgt'] = $search[1];
			}

			if ($search[0] == "fornecedor" && $search[1] != -1) {
				$conditions['conditions']['Fornecedore.id'] = $search[1];
			}
		}
		// pr($conditions);
		$allLancamentos = $this->LancamentoVenda->find('count', $conditions);

		if ( isset( $_GET['iDisplayStart'] ) && $_GET['iDisplayLength'] != '-1' )
		{
			$conditions['offset'] = $_GET['iDisplayStart'];
			$conditions['limit'] = $_GET['iDisplayLength'];
		}

		$lancamentos = $this->LancamentoVenda->find('all', $conditions);
		// pr($lancamentos,1);
		$output = array(
			"sEcho" => intval($_GET['sEcho']),
			"iTotalDisplayRecords" => $allLancamentos,
			"iTotalRecords" => count($lancamentos),
			"aaData" => array()
		);

		foreach ( $lancamentos as $i => $lancamento )
		{
			$row = array();

			$btPaid = '';
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

							$btPaid = '<a class="btn btn-primary" href="javascript:alert(\'Não é uma despesa.\');"><i class="fa fa-child"></i></a>';
						} else {
							$value = '<span class="label label-danger">' . $categoria_lancamento['LancamentoCategoria']['nome'] . '</span>';

							if ($lancamento['LancamentoVenda']['valor_pago'] < $lancamento['LancamentoVenda']['valor']) {
								$btPaid = '<a class="btn btn-success" href="/produto/imagens/' . $lancamento['LancamentoVenda']['id'] . '"><i class="fa fa-check"></i></a>';
							} else {
								$btPaid = '<a class="btn btn-default" href="javascript:alert(\'Lançamento já foi pago\');"><i class="fa fa-money"></i></a>';
							}
						}
					} else {
						$value = '<span class="label label-default">Sem Categoria</span>';
					}

				} else {
					$value = $lancamento['LancamentoVenda'][$aColumns[$i]];
				}

				if ($aColumns[$i] == "venda_id" && empty($lancamento['LancamentoVenda'][$aColumns[$i]])) {
					$value = '<b>Não é uma venda</b>';
				} elseif ($aColumns[$i] == "venda_id" && !empty($lancamento['LancamentoVenda'][$aColumns[$i]])) {
					$value = '<a href="http://www.ciawn.com.br/venda/listar_cadastros?venda_id=' . $lancamento['LancamentoVenda'][$aColumns[$i]] . '">Ver Pedido</a>';
				}

				if ($aColumns[$i] == "valor") {
					$value = 'R$ ' . number_format($lancamento['LancamentoVenda'][$aColumns[$i]], 2, ',', '.');
				}

				if ($aColumns[$i] == "data_vencimento" && $lancamento['LancamentoVenda'][$aColumns[$i]] != "") {
					$date = new \DateTime($lancamento['LancamentoVenda'][$aColumns[$i]]);
					$value = $date->format('d/m/Y');
				} else if ($aColumns[$i] == "data_vencimento" && empty($lancamento['LancamentoVenda'][$aColumns[$i]])) {
					$value = "Não informado";
				}
				
				$row[] = $value;
			}

			$row[] = isset($btPaid) ? $btPaid : '';

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

	public function adicionar_fornecedor()
	{
		$data = $this->request->data('fornecedor');

		$this->loadModel('Fornecedore');

		$data['usuario_id'] = $this->instancia;
		$data['ativo'] = 1;
		
		if (!$this->Fornecedore->save($data)) {
			$this->Session->setFlash('Ocorreu um erro ao inserir o fornecedor');
			return $this->redirect('/financeiro/listar_cadastros');
		}

		$this->Session->setFlash('Fornecedor inserido com sucesso!');
		return $this->redirect('/financeiro/listar_cadastros');		
	}

	public function adicionar_transacao()
	{
		$transacao = $this->request->data('transacao');

		$transacao['valor_pago'] = 0;
		$transacao['ativo'] = 1;
		$transacao['usuario_id'] = $this->instancia;

		$this->loadModel('LancamentoVenda');

		if (!$this->LancamentoVenda->save($transacao)) {
			$this->Session->setFlash('Ocorreu um erro ao cadastrar o lançamento');
			return $this->redirect('/financeiro/listar_cadastros');
		}

		$this->Session->setFlash('Lançamento inserido com sucesso!');
		return $this->redirect('/financeiro/listar_cadastros');
	}

}