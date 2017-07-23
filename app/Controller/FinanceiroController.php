<?php

class FinanceiroController extends AppController 
{

	public function listar_cadastros()
	{
		$this->layout = 'wadmin';

		$this->set('total', $this->carregar_total_periodo(
				date('Y-m-d'),
				date('Y-m-d')
			)
		);
	}

	public function carregar_total_periodo($start, $end)
	{
		$this->loadModel('LancamentoVenda');
		$this->loadModel('LancamentoCategoria');

		$conditions = array('conditions' =>
			array(
				'LancamentoVenda.ativo' => 1,
				'LancamentoVenda.usuario_id' => $this->instancia
			)
		);

		$lancamentos = $this->LancamentoVenda->find('all', $conditions);

		$categorias = $this->LancamentoCategoria->find('all', array('conditions' =>
				array(
					'LancamentoCategoria.ativo' => 1,
					'LancamentoCategoria.usuario_id' => $this->instancia
				)
			)
		);

		// pr($categorias);
		// pr($end, 1);
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