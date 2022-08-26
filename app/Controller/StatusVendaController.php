<?php

class StatusVendaController extends AppController 
{
    public function listar_cadastros()
    {
		if (!$this->PermissoesHelper->usuario_possui_permissao_para('venda', 'read')) {
			$this->Session->setFlash('Você não possui acesso a esta área do sistema');
			return $this->redirect('/dashboard/home');
		}

		$this->layout = 'wadmin';
    }

	public function listar_cadastros_ajax() {
		if (!$this->PermissoesHelper->usuario_possui_permissao_para('venda', 'read')) {
			$this->Session->setFlash('Você não possui acesso a esta área do sistema');
			return $this->redirect('/dashboard/home');
		}

		$this->layout = 'ajax';

		$aColumns = array( 'id', 'text', 'color', 'actions' );

		$this->loadModel('StatusVenda');

		$conditions = array(
			'conditions' => array(
				'StatusVenda.ativo' => 1,
				'StatusVenda.id_usuario' => $this->instancia
			)
		);

		$todosStatus = $this->StatusVenda->find('count', $conditions);

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
					$conditions['order'] = array('StatusVenda.' . $aColumns[intval($_GET['iSortCol_' . $i])] => $_GET['sSortDir_'.$i]);
				}
			}
		}

		if ( isset( $_GET['sSearch'] ) && !empty( $_GET['sSearch'] ) )
		{
			$conditions['conditions']['StatusVenda.id'] = '%' . $_GET['sSearch'] . '%';
		}

		$status = $this->StatusVenda->find('all', $conditions);

		$output = array(
			"sEcho" => intval($_GET['sEcho']),
			"iTotalDisplayRecords" => $todosStatus,
			"iTotalRecords" => count($status),
			"aaData" => array()
		);

		if ($this->PermissoesHelper->usuario_possui_permissao_para('venda', 'read')) {		
			foreach ($status as $state) {
				$row = array();

				for ( $i=0 ; $i < count($aColumns) ; $i++ )
				{
                    if ($aColumns[$i] == 'color') {
                        $row[] = '<span class="badge badge-primary" style="background-color: ' . $state['StatusVenda'][$aColumns[$i]] . '">' . $state['StatusVenda'][$aColumns[$i]] . '</span>';
                    } else if ($aColumns[$i] == 'actions') {
                        $btEdit = '<a class="btn btn-danger" href="/status_venda/excluir_cadastro/' . $state['StatusVenda']['id'] . '"><i class="fas fa-trash"></i></a>';
				        $row[] = $btEdit;
                    } else {
					    $row[] = $state['StatusVenda'][$aColumns[$i]];
                    }
				}

				$output['aaData'][] = $row;
			}
		}

		echo json_encode($output);
		exit;
    }

    public function adicionar_cadastro()
    {
		if (!$this->PermissoesHelper->usuario_possui_permissao_para('venda', 'write')) {
			$this->Session->setFlash('Você não possui acesso a esta área do sistema');
			return $this->redirect('/dashboard/home');
		}

		$this->loadModel('StatusVenda');

		$dados = $this->request->data('status');
		$dados['ativo'] = 1;
		$dados['id_usuario'] = $this->instancia;

		if ($this->StatusVenda->save($dados)) {
			$this->Session->setFlash('Status criada com Sucesso!','default','good');
            return $this->redirect('/status_venda/listar_cadastros');
		} else {
			$this->Session->setFlash('Erro ao criar a status!','default','good');
            return $this->redirect('/status_venda/listar_cadastros');
		}
    }

	public function excluir_cadastro()
	{
		if (!$this->PermissoesHelper->usuario_possui_permissao_para('venda', 'write')) {
			$this->Session->setFlash('Você não possui acesso a esta área do sistema');
			return $this->redirect('/dashboard/home');
		}

		$this->loadModel('StatusVenda');

		$id = $this->request->data('id');

		$dados = array('ativo' => '0');
		$parametros = array('id' => $id);

		if ($this->StatusVenda->updateAll($dados, $parametros)) {
			$this->Session->setFlash('Status venda excluida com Sucesso!','default','good');
		} else {
			$this->Session->setFlash('Erro ao excluir categoria!','default','good');
		}

		return $this->redirect('/status_venda/listar_cadastros');
	}

}