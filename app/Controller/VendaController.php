<?php

require_once(ROOT . DS . 'vendor' . DS . 'autoload.php');

use Dompdf\Dompdf;

include 'ProdutoEstoqueController.php';
include 'VendaItensProdutoController.php';
include 'LancamentoVendasController.php';
include 'ImpressaoFiscalController.php';

class VendaController extends AppController {

	public function pdv() {
		if (!$this->PermissoesHelper->usuario_possui_permissao_para('venda', 'write')) {
			$this->Session->setFlash('Você não possui acesso a esta área do sistema');
			return $this->redirect('/dashboard/home');
		}

		$this->layout = 'wadmin';

		$this->loadModel('Produto');

		$this->set('produtos', $this->Produto->find('all',
				array('conditions' =>
					array('ativo' => 1,
						  'id_usuario' => $this->instancia
					)
				)
			)
		);

		$this->loadModel('Cliente');

		$this->set('clientes', $this->Cliente->find('all',
				array('conditions' =>
					array('ativo' => 1,
						  'id_usuario' => $this->instancia
					)
				)
			)
		);
	}

	public function recuperar_dados_venda_ajax() {
		$this->layout = 'ajax';

		$dados = $this->request->data('dados');

		$this->loadModel('Produto');

		$produto = $this->Produto->find('all',
			array('conditions' =>
				array('ativo' => 1,
					'id_alias' => $dados['codigo_produto']
				)
			)
		);

		if (empty($produto)) {
			echo json_encode(false);
			return false;
		}

		echo json_encode($produto);
	}

	public function listar_cadastros() {
		$this->layout = 'wadmin';

		$this->loadModel('StatusVenda');
		$status = $this->StatusVenda->find('all', array(
			array('fields' => array(
				'StatusVenda.id', 'StatusVenda.text',
				'StatusVenda.color', 'StatusVenda.id_usuario'
			)),
			'conditions' => array(
					'StatusVenda.ativo' => 1,
					'StatusVenda.id_usuario' => $this->instancia
				)
			)
		);

		$this->set('status', $status);
	}

	public function mudar_status() {
		if (!$this->PermissoesHelper->usuario_possui_permissao_para('venda', 'write')) {
			$this->Session->setFlash('Você não possui acesso a esta área do sistema');
			return $this->redirect('/venda/listar_cadastros');
		}

		$dados = $this->request->data('venda');

		$this->loadModel('Venda');

		$this->Venda->id = $dados['id'];
		unset($dados['id']);

		if ($this->Venda->save($dados)) {
			$this->Session->setFlash('Status da venda editada com Sucesso!','default','good');
            return $this->redirect('/venda/listar_cadastros');
		} else {
			$this->Session->setFlash('Erro ao atualizar o status da venda!','default','good');
            return $this->redirect('/venda/listar_cadastros');
		}
	}

	public function listar_cadastros_ajax() {
		$this->layout = 'ajax';

		$aColumns = array( 'id', 'valor', 'forma_pagamento', 'status_venda', 'data_venda', 'actions' );

		$this->loadModel('Venda');
		$this->loadModel('LancamentoVenda');
		$this->loadModel('StatusVenda');

		$conditions = array(
			'fields' => array(
				'Venda.id', 'Venda.valor', 'Venda.data_venda', 'Venda.status_venda_id' 
			),
			'conditions' => array(
				'Venda.ativo' => 1,
				'Venda.id_usuario' => $this->instancia,
				'Venda.orcamento' => 0
			),
			'order' => array(
				'Venda.id DESC'
			)
		);

		$todasVendas = $this->Venda->find('count', $conditions);

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
					$conditions['order'] = array('Venda.' . $aColumns[intval($_GET['iSortCol_' . $i])] => $_GET['sSortDir_'.$i]);
				}
			}
		}

		if ( isset( $_GET['sSearch'] ) && !empty( $_GET['sSearch'] ) )
		{
			$conditions['conditions']['Venda.id'] = '%' . $_GET['sSearch'] . '%';
		}

		$vendas = $this->Venda->find('all', $conditions);

		$output = array(
			"sEcho" => intval($_GET['sEcho']),
			"iTotalDisplayRecords" => $todasVendas,
			"iTotalRecords" => count($vendas),
			"aaData" => array()
		);

		if ($this->PermissoesHelper->usuario_possui_permissao_para('venda', 'read')) {		
			foreach ($vendas as $venda) {
				$row = array();

				for ( $i=0 ; $i < count($aColumns) ; $i++ )
				{
					if ($aColumns[$i] == "forma_pagamento") {
						$lancamentos = $this->LancamentoVenda->find('all', array(
							array('fields' => array(
								'LancamentoVenda.venda_id', 'LancamentoVenda.forma_pagamento',
								'Lancamento.id'
							)),
							'conditions' => array(
									'LancamentoVenda.venda_id' => $venda['Venda']['id']
								)
							)
						);

						$value = '';
						foreach ($lancamentos as $lancamento) {
							$pagamento = (isset($lancamento['LancamentoVenda']['forma_pagamento'])) ? $lancamento['LancamentoVenda']['forma_pagamento'] : array();
							
							if (isset($pagamento) && !empty($pagamento))
								$pagamento = str_replace('_', ' ', $pagamento);
							
							if (isset($pagamento) && !empty($pagamento))
								$pagamento = ucwords($pagamento);
							
							$value .= '<span class="badge badge-success">' . $pagamento . '</span> ';
						}
					} else if ($aColumns[$i] == "status_venda") {
						$status = $this->StatusVenda->find('all', array(
							array('fields' => array(
								'StatusVenda.id', 'StatusVenda.text',
								'StatusVenda.color'
							)),
							'conditions' => array(
									'StatusVenda.id' => $venda['Venda']['status_venda_id']
								)
							)
						);

						if (!empty($status)) {
							$value = '<span class="badge badge-success" style="background-color: ' . $status[0]['StatusVenda']['color'] . '; ">' . $status[0]['StatusVenda']['text'] . '</span>';
						} else {
							$value = '<span class="badge badge-success">[PDV] Concluido</span>';
						}
					} else if ($aColumns[$i] == "actions") {
						$value = '<a href="javascript:showModalPrintNota(' . $venda['Venda']['id'] . ');" id="' . $venda['Venda']['id'] . '" class="btn btn-info show-modal-cupom">';
						$value .= '<i class="far fa-sticky-note"></i>';
						$value .= '</a> ';

						if ($this->PermissoesHelper->usuario_possui_permissao_para('venda', 'write')) {
							$value .= ' <a onclick="mudar_status_venda(' . $venda['Venda']['id'] . ');" id="' . $venda['Venda']['id'] . '" type="button" class="btn btn-warning"><i class="text-white fas fa-edit"></i></a>';
							$value .= ' <a onclick="remover_venda(' . $venda['Venda']['id'] . ');" id="' . $venda['Venda']['id'] . '" type="button" class="btn btn-danger"><i class="text-white fas fa-trash"></i></a>';	
						}				
					} else if ($aColumns[$i] == "valor") { 
						$value = 'R$ ' . number_format($venda['Venda'][$aColumns[$i]], 2, ',', '.');
					} else {
						$value = $venda['Venda'][$aColumns[$i]];
					}
					
					$row[] = $value;
				}

				$btEdit = '<a class="btn btn-info" href="/produto/editar_cadastro/' . $venda['Venda']['id'] . '"><i class="fa fa-pencil"></i></a>';

				$row[] = $btEdit;

				$output['aaData'][] = $row;
			}
		}

		echo json_encode($output);
		exit;
	}

	public function adicionar_cadastro() {
		if (!$this->PermissoesHelper->usuario_possui_permissao_para('venda', 'write')) {
			$this->Session->setFlash('Você não possui acesso a esta área do sistema');
			return $this->redirect('/venda/listar_cadastros');
		}

		$this->layout = 'wadmin';

		$this->loadModel('Cliente');

		$this->set('clientes', $this->Cliente->find('all',
				array('conditions' =>
					array('ativo' => 1,
						  'id_usuario' => $this->instancia
					)
				)
			)
		);

		$this->set('funcionarios', $this->carregar_funcionarios($this->instancia));

		$this->loadModel('Produto');

		$this->set('produtos', $this->Produto->find('all',
				array('conditions' =>
					array('ativo' => 1,
						  'id_usuario' => $this->instancia
					)
				)
			)
		);

		$this->set('vendaId', $this->Session->read('UltimoIdVendaSalvo'));
	}

	public function carregar_funcionarios($usuario_id)
	{
		$this->loadModel('Funcionario');

		$query = array (
			'joins' => array(
			    array(
			        'table' => 'sub_usuarios',
			        'alias' => 'SubUsuario',
			        'type' => 'LEFT',
			        'conditions' => array(
			            'SubUsuario.id = Funcionario.subusuario_id',
			        ),
			    ),
			    array(
			        'table' => 'usuarios',
			        'alias' => 'Usuario',
			        'type' => 'LEFT',
			        'conditions' => array(
			            'Funcionario.subusuario_id = Usuario.subusuario_id',
			        ),
			    )
			),
	        'conditions' => array('Funcionario.usuario_id' => $usuario_id, 'Funcionario.ativo' => 1),
	        'fields' => array('Usuario.*, Funcionario.*, SubUsuario.*'),
		);

		$funcionarios = $this->Funcionario->find('all', $query);

		return $funcionarios;
	}

	public function conveter_venda($vendaId) {
		if (!$this->PermissoesHelper->usuario_possui_permissao_para('venda', 'write')) {
			$this->Session->setFlash('Você não possui acesso a esta área do sistema');
			return $this->redirect('/venda/listar_cadastros');
		}

		$this->layout = 'wadmin';

		$this->loadModel('Cliente');
		
		$this->set('clientes', $this->Cliente->find('all',
				array('conditions' =>
					array(
						'ativo' => 1,
						'id_usuario' => $this->instancia
					)
				)
			)
		);

		$this->loadModel('Produto');

		$this->set('produtos', $this->Produto->find('all',
				array('conditions' =>
					array(
						'ativo' => 1,
						'id_usuario' => $this->instancia
					)
				)
			)
		);

		$this->set('venda', $this->Venda->find('all', 
				array('conditions' =>
					array(
						'Venda.ativo' => 1,
						'Venda.id' => $vendaId,
						'Venda.id_usuario' => $this->instancia
					)
				)
			)
		);

		$this->loadModel('VendaItensProduto');

		$venda_produtos = $this->VendaItensProduto->find('all', 
			array('conditions' => 
				array(
					'VendaItensProduto.ativo' => 1,
					'VendaItensProduto.venda_id' => $vendaId
				)
			)
		);

		$this->loadModel('Produto');

		$produtos = [];
		$total_venda = 0;
		foreach ($venda_produtos as $i => $venda_produto) 
		{
			$produto = $this->Produto->find('all',
				array('conditions' =>	
					array(
						'Produto.ativo' => 1,
						'Produto.id' => $venda_produto['VendaItensProduto']['produto_id']
					)
				)
			);
			
			if (empty($produto)) {
				$this->Session->setFlash('Ocorreu algum erro no produto (' . $venda_produto['VendaItensProduto']['produto_id'] .')');
				continue;
			}

			if (isset($produto) && !empty($produto)) {
				if ($produto[0]['Produto']['estoque'] <= 0) {
					$this->Session->setFlash('O produto (' . $produto[0]['Produto']['nome'] .') não tem mais estoque disponivel!');
					continue;
				}
			}
			
			$produtos[$i] = $produto[0]['Produto'];
			$produtos[$i]['quantidade'] = $venda_produto['VendaItensProduto']['quantidade_produto'];

			$total = $produtos[$i]['preco'] * $venda_produto['VendaItensProduto']['quantidade_produto'];

			$produtos[$i]['preco'] = number_format($produtos[$i]['preco'], 2, ',', '.');
			$produtos[$i]['total'] = number_format($total, 2, ',', '.');
			$total_venda += $total;
		}

		$this->set('venda_produtos', $produtos);
		$this->set('total_venda', $total_venda);
	}

	public function s_adicionar_cadastro() {
		if (!$this->PermissoesHelper->usuario_possui_permissao_para('venda', 'write')) {
			$this->Session->setFlash('Você não possui acesso a esta área do sistema');
			return $this->redirect('/venda/listar_cadastros');
		}

		$dados_venda 	  = $this->request->data('venda');
		$dados_lancamento = $this->request->data('lancamento');
		$produtos 	      = $this->request->data('produto');

		$retorno_produtos_validacao = $this->validar_itens_venda($produtos);
		if ($retorno_produtos_validacao > 0 && !$dados_venda['orcamento']) {
			if ($retorno_produtos_validacao == 1) {
				$this->Session->setFlash('Algum produto adicionado não possui estoque disponivel');
			} else if ($retorno_produtos_validacao == 2) {
				$this->Session->setFlash('Você não adicionou produtos na venda');
			} else {
				$this->Session->setFlash('Ocorreu algum erro ao tentar criar venda');
			}

			$this->redirect('/venda/adicionar_cadastro');
		}

		$dados_venda['valor'] = $this->calcular_valor_venda($produtos);
		$dados_venda['custo'] = $this->calcular_custo_venda($produtos);

		$salvar_venda = $this->salvar_venda($produtos, $dados_lancamento, $dados_venda, $this->instancia);
		
		if (!$salvar_venda) {
			$this->Session->setFlash('Ocorreu um erro ao salvar a venda tente novamento');
			return $this->redirect('/venda/adicionar_cadastro');
		}

		$this->Session->write('UltimoIdVendaSalvo', $salvar_venda['id']);
		
		$this->Session->setFlash('Venda salva com sucesso');
		return $this->redirect('/venda/adicionar_cadastro');
	}

	public function calcular_valor_venda($produtos) {
		$this->loadModel('Produto');

		(float) $preco = 0.00;

		foreach ($produtos as $indice => $item) {
			$produto = $this->Produto->find('all',
				array('conditions' =>
					array('Produto.id' => $item['id_produto'])
				)
			);
			
			$preco_unitario = $produto[0]['Produto']['preco'];
			if ($produto[0]['Produto']['preco_promocional'] > 0 && $produto[0]['Produto']['preco_promocional'] < $produto[0]['Produto']['preco']) {
				$preco_unitario = $produto[0]['Produto']['preco_promocional'];
			}

			$preco += $preco_unitario * $item['quantidade'];
		}

		return $preco;
	}

	public function calcular_custo_venda($produtos) {
		$this->loadModel('Produto');
		$this->loadModel('CustosProduto');

		(float) $custo = 0.00;
		foreach ($produtos as $indice => $item) {
			$produto = $this->Produto->find('all',
				array('conditions' =>
					array('Produto.id' => $item['id_produto'])
				)
			);

			$custos_adicionais = $this->CustosProduto->find('all', array('conditions' =>
					array(
						'CustosProduto.produto_id' => $item['id_produto'],
						'CustosProduto.ativo' => 1
					)
				)
			);

			$custo += $produto[0]['Produto']['custo'] * $item['quantidade'];

			if (isset($custos_adicionais) && !empty($custos_adicionais)) {
				foreach ($custos_adicionais as $custo_adicional) {
					$custo += $custo_adicional['CustosProduto']['valor']; // custos adicionais não são multiplicados pela quantidade de itens
				}
			}
		}

		return $custo;
	}

	public function validar_itens_venda($produtos) {
		$this->loadModel('Produto');

		if (empty($produtos)) {
			$this->Session->setFlash('Ocorreu algum erro ao salvar a venda');
			return 2;
		}

		foreach ($produtos as $indice => $item) {
			$produto = $this->Produto->find('all',
				array('conditions' =>
					array('Produto.id' => $item['id_produto'])
				)
			);

			$objProdutoEstoqueController = new ProdutoEstoqueController();

			if (!$objProdutoEstoqueController->validar_estoque($produto, $item['quantidade'])) {
				return 1;
			}			
		}

		return 0;
	}

	public function salvar_venda($produtos, $lancamento, $informacoes, $usuario_id, $loja = false) {
		if (!$loja) {
			if (!$this->PermissoesHelper->usuario_possui_permissao_para('venda', 'write')) {
				$this->Session->setFlash('Você não possui acesso a esta área do sistema');
				return $this->redirect('/venda/listar_cadastros');
			}
		}

		unset($informacoes['id_cliente']);

		$informacoes['data_venda'] 		= date('Y-m-d');
		$informacoes['id_usuario'] 		= $this->instancia != 'winners' ? $this->instancia : $usuario_id;
		$informacoes['ativo']	   		= 1;
		$informacoes['desconto']   		= (float) @$informacoes['desconto'];
		$informacoes['valor']	   		= $informacoes['valor'] - $informacoes['desconto'];
		$informacoes['orcamento']  		= @$informacoes['orcamento'];

		if ($loja) {
			$this->loadModel('StatusVenda');

			$conditions = array(
				'conditions' => array(
					'StatusVenda.ativo' => 1,
					'StatusVenda.text' => 'Pendente',
					'StatusVenda.id_usuario' => $this->instancia
				)
			);
	
			$status = $this->StatusVenda->find('all', $conditions);
	
			$informacoes['status_venda_id'] = $status[0]['StatusVenda']['id'];
		}

		if (!$this->Venda->save($informacoes)) {
			$this->Session->setFlash('Ocorreu algum erro ao salvar a venda');
			return false;
		}
		
		$id_venda = $this->Venda->getLastInsertId();

		$objVendaItensProdutoController = new VendaItensProdutoController();
		
		if ($objVendaItensProdutoController->adicionar_itens_venda($id_venda, $produtos, $informacoes['orcamento']) === false) {
			return false;
		}

		$objLancamentoVendasController = new LancamentoVendasController();

		if ($objLancamentoVendasController->salvar_lancamento($id_venda, $lancamento, $informacoes['valor'], $informacoes['id_usuario'], $informacoes['orcamento']) === false) {
			return false;
		}

		return array('status' => true, 'id' => $id_venda);
	}

	public function relatorio_diario() {
		include(APP . 'Vendor/PHPExcel/PHPExcel.php');
		include(APP . 'Vendor/PHPExcel/PHPExcel/IOFactory.php');

        $objPHPExcel = new PHPExcel();
        // Definimos o estilo da fonte
        $objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);

        $objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(40);

        // Criamos as colunas
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A1', "Valor Venda")
                    ->setCellValue('B1', "Custo Médio ")
                    ->setCellValue("C1", "Valor Lucro")
                    ->setCellValue('D1', "ID Venda" );


        $vendas = $this->Venda->find('all',
        	array('conditions' => array(
        			'AND' => array(
        				'Venda.ativo' => 1,
        				'Venda.id_usuario' => $this->instancia,
        				'Venda.data_venda' => date('Y-m-d')
        			)
        		)
        	)
        );

        $i = 2;
        foreach ($vendas as $key => $venda) {
        	$objPHPExcel->setActiveSheetIndex(0)
        				->setCellValue('A'.$i, 'R$ ' . $venda['Venda']['valor'])
        				->setCellValue('B'.$i, 'R$ ' . $venda['Venda']['custo'])
        				->setCellValue('C'.$i, 'R$ ' . $venda['Venda']['valor'] - $venda['Venda']['custo'])
        				->setCellValue('D'.$i, $venda['Venda']['id']);
        	$i++;
        }

        // Podemos renomear o nome das planilha atual, lembrando que um único arquivo pode ter várias planilhas
        $objPHPExcel->getActiveSheet()->setTitle('Listagem de vendas');

        // Cabeçalho do arquivo para ele baixar
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="relatorio_vendas_'.date('d-m-Y').'.xls"');
        header('Cache-Control: max-age=0');
        // Se for o IE9, isso talvez seja necessário
        header('Cache-Control: max-age=1');

        // Acessamos o 'Writer' para poder salvar o arquivo
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');

        // Salva diretamente no output, poderíamos mudar arqui para um nome de arquivo em um diretório ,caso não quisessemos jogar na tela
        $objWriter->save('php://output'); 

        exit;
	}

	public function recoverDataToDashboardOneMonth($id_usuario = null) {
		if (is_null($id_usuario)) {
			$id_usuario = $this->instancia;
		}

		$this->layout = 'ajax';

		$datas = [];
		$data_inicio = mktime(0, 0, 0, date('m') , 1 , date('Y'));
		$data_fim = mktime(23, 59, 59, date('m'), date('t'), date('Y'));
		$numeros_dias_mes = date('d', $data_fim);

		for ($i = 1; $i <= $numeros_dias_mes; $i++) {
			$datas[] = 'Dia ' . $i;
		}

		$vendas = $this->Venda->find('all',
			array('conditions' =>
				array('and' => array(
						'Venda.ativo' => 1,
						'Venda.id_usuario' => $id_usuario,
						'Venda.data_venda >= ' => date('Y/m/d', $data_inicio),
						'Venda.data_venda <= ' => date('Y/m/d', $data_fim)
					)
				)
			)
		);
		
		$soma = [];
		foreach ($vendas as $i => $venda) {
			$indice = substr($venda['Venda']['data_venda'], -2);
			if (isset($soma[$indice]) && !empty($soma[$indice])) {
				$soma[$indice] += $venda['Venda']['valor'];
				continue;
			}

			$soma[$indice] = $venda['Venda']['valor'];
		}

		$resposta = [];
		foreach ($soma as $i => $sum) {
			$resposta[] = $sum;
		}

		$resposta = [
			'labels' => $datas,
			'data' => $resposta
		];

		echo json_encode($resposta);
	}


	public function recoverCategoryProductsByMonth($id_usuario = null) {
		if (is_null($id_usuario)) {
			$id_usuario = $this->instancia;
		}

		$this->layout = 'ajax';

		$labels = [];
		$conditions = array(
			'conditions' => array(
				'Venda.id_usuario' => $this->instancia,
				'Venda.orcamento <>' => 1
			),
			'joins' => array(
			    array(
			        'table' => 'venda_itens_produtos',
			        'alias' => 'VendaItensProduto',
			        'type' => 'LEFT',
			        'conditions' => array(
			            'Venda.id = VendaItensProduto.venda_id',
			        ),
			    ),
			    array(
			        'table' => 'produtos',
			        'alias' => 'Produto',
			        'type' => 'LEFT',
			        'conditions' => array(
			            'Produto.id = VendaItensProduto.produto_id',
			        ),
			    ),
			    array(
			        'table' => 'categorias',
			        'alias' => 'Categoria',
			        'type' => 'LEFT',
			        'conditions' => array(
			            'Categoria.id = Produto.categoria_id',
			        ),
			    )
			),
			'fields' => array(
				'VendaItensProduto.*', 'Venda.*', 'Produto.nome', 'Categoria.*',
				'Produto.estoque', 'Produto.preco', 'Produto.preco_promocional'
			),
			'order' => array('Venda.id' => 'desc'),
			'limit' => 100
		);

		$vendasComProdutos = $this->Venda->find('all', $conditions);
		
		foreach ($vendasComProdutos as $venda) {
			if (!in_array($venda['Categoria']['nome'], $labels)) {
				$labels[] = $venda['Categoria']['nome'];
			}
		}

		foreach ($labels as $i => $label) {
			$resposta[$i] = 0;
			foreach ($vendasComProdutos as $venda) {
				if ($venda['Categoria']['nome'] == $label) {
					$resposta[$i] += $venda['Venda']['valor'];
				}
			}
		}

		$resposta = [
			'labels' => $labels,
			'data' => $resposta
		];

		echo json_encode($resposta);
	}

	public function excluir_cadastro() {
		if (!$this->PermissoesHelper->usuario_possui_permissao_para('venda', 'read')) {
			echo json_encode(false);
			exit;
		}

		$this->layout = 'ajax';

		$id = $this->request->data('id');

		$dados = array('ativo' => '0');
		$parametros = array('id' => $id);

		if ($this->Venda->updateAll($dados, $parametros)) {
			echo json_encode(true);
		} else {
			echo json_encode(false);
		}
	}

	public function imprimir_nota_nao_fiscal($id) {
		$this->loadModel('LancamentoVenda');
		$this->loadModel('VendaItensProduto');
		$this->loadModel('Produto');
		$this->loadModel('Usuario');

		$ImpressaoFiscalController = new ImpressaoFiscalController;

		$dados_venda = $this->Venda->find('first',
			array('conditions' =>
				array(
					'Venda.ativo' => 1,
					'Venda.id' => $id
				)
			)
		);

		$usuario = $this->Usuario->find('first',
			array('conditions' =>
				array(
					'Usuario.id' => $dados_venda['Venda']['id_usuario']
				)
			)
		);
		
		$ImpressaoFiscalController->userName = $usuario['Usuario']['nome'];

		$dados_lancamentos = $this->LancamentoVenda->find('all',
			array('conditions' => 
				array(
					'LancamentoVenda.ativo' => 1,
					'LancamentoVenda.venda_id' => $id
				)
			)
		);

		$produtos = $this->VendaItensProduto->find('all', 
			array('conditions' =>
				array(
					'VendaItensProduto.venda_id' => $id
				)
			)
		);

		$itens = array();
		$totalGeral = 0.00;
		foreach ($produtos as $i => $item) {
			$produto = $this->Produto->find('first',
				array('conditions' =>
					array('Produto.id' => $item['VendaItensProduto']['produto_id'])
				)
			);	

			$total = $produto['Produto']['preco'] * $item['VendaItensProduto']['quantidade_produto'];

			$totalGeral += $total;

			$ImpressaoFiscalController->corpoTxt .= ""
						   . "Produto: " . $produto['Produto']['nome']
						   . "\nQuantidade: " . $item['VendaItensProduto']['quantidade_produto'] 
						   . "\nPreço: R$ " . number_format($produto['Produto']['preco'], 2, ',', '.')
						   . "\nTotal: R$ " . number_format($total, 2, ',', '.')
						   . "\n--------------------------\n";
		}

		$desconto = $totalGeral - $dados_venda['Venda']['valor'];

		$ImpressaoFiscalController->corpoTxt .= "Valor Total: " . number_format($totalGeral, 2, ',', '.') . "\n\n";
		$ImpressaoFiscalController->corpoTxt .= "Valor Pago: R$ " . number_format($dados_venda['Venda']['valor'], 2, ',', '.') . "\n";
		$ImpressaoFiscalController->corpoTxt .= "Desconto: R$ " . number_format($desconto, 2, ',', '.') . "\n\n";

		$formas_pagamentos = '';
		foreach ($dados_lancamentos as $dados_lancamento) {
			$formas_pagamentos .= $dados_lancamento['LancamentoVenda']['forma_pagamento'] . ' ';
		}

		$ImpressaoFiscalController->corpoTxt .= "Forma de Pagamento: " . $formas_pagamentos . "\n\n";

		$file = $ImpressaoFiscalController->gerar_arquivo();
		
		echo json_encode(array('file' => $file));

		exit;
	}

	public function clear_session_venda($id)
	{
		$this->Session->write('UltimoIdVendaSalvo', null);
		exit;
	}

	public function obter_total_vendas_periodo_atual($id_usuario, $from, $to)
	{
		$conditions = array(
			'conditions' => array(
				'Venda.id_usuario' => $id_usuario,
				'Venda.ativo' => 1,
				'Venda.data_venda >=' => $from,
				'Venda.data_venda <=' => $to,
				'Venda.orcamento <>' => 1
			),
			'fields' => array(
				'Venda.valor'
			)
		);

		$vendas = $this->Venda->find('all', $conditions);

		$valorTotalVendasPeriodo = $this->calcularValorTotalVendas($vendas);

		return $valorTotalVendasPeriodo;
	}

	public function imprimir_relatorio()
	{
		$ImpressaoFiscalController = new ImpressaoFiscalController;

		$from = $_GET['from'];
		$to   = $_GET['to'];

		$relatorio = $this->obter_relatorio_por_data($from, $to);

		$itens = array();
		$totalGeral = 0.00;

		$ImpressaoFiscalController->corpoTxt .= "Dinheiro: " . number_format($relatorio['dinheiro'], 2, ',', '.') . "\n\n";
		$ImpressaoFiscalController->corpoTxt .= "Cartão de Crédito: " . number_format($relatorio['cartao_credito'], 2, ',', '.') . "\n\n";
		$ImpressaoFiscalController->corpoTxt .= "Cartão de Débito: " . number_format($relatorio['cartao_debito'], 2, ',', '.') . "\n\n";
		$ImpressaoFiscalController->corpoTxt .= "Total de vendas: " . number_format($relatorio['valorTotalVendasPeriodo'], 2, ',', '.') . "\n\n";
		$ImpressaoFiscalController->corpoTxt .= "Total Custo: " . number_format($relatorio['totalCustoPeriodo'], 2, ',', '.') . "\n\n";
		$ImpressaoFiscalController->corpoTxt .= "Total Lucro - Custo: " . number_format($relatorio['totalLucro'], 2, ',', '.') . "\n\n";

		$file = $ImpressaoFiscalController->gerar_arquivo();
		
		echo json_encode(array('file' => $file));

		exit;
	}

	public function relatorio() {
		if (!$this->PermissoesHelper->usuario_possui_permissao_para('venda', 'read')) {
			$this->Session->setFlash('Você não possui acesso a esta área do sistema');
			return $this->redirect('/venda/listar_cadastros');
		}

		$this->layout = 'wadmin';

		$from = $_GET['from'];
		$to   = $_GET['to'];

		$relatorio = $this->obter_relatorio_por_data($from, $to);
		
		$this->set('pix', $relatorio['pix']);
		$this->set('dinheiro', $relatorio['dinheiro']);
		$this->set('cartao_credito', $relatorio['cartao_credito']);
		$this->set('cartao_debito', $relatorio['cartao_debito']);
		$this->set('valorTotalVendasPeriodo', $relatorio['valorTotalVendasPeriodo']);
		$this->set('totalCustoPeriodo', $relatorio['totalCustoPeriodo']);
		$this->set('totalLucro', $relatorio['totalLucro']);
		$this->set('produtos_vendidos', $relatorio['produtos_vendidos']);
	}

	public function obter_relatorio_por_data($from, $to)
	{
		$this->loadModel('Venda');
		$this->loadModel('LancamentoVenda');

		$conditions = array(
			'conditions' => array(
				'Venda.id_usuario' => $this->instancia,
				'Venda.data_venda >=' => $from,
				'Venda.data_venda <=' => $to,
				'Venda.orcamento <>' => 1,
				'Venda.ativo' => 1
			)
		);

		$vendas = $this->Venda->find('all', $conditions);
		
		$valorTotalVendasPeriodo = $this->calcularValorTotalVendas($vendas);

		$totalCustoPeriodo = $this->calcularTotalCustoProdutosPeriodo($vendas);

		$lancamentos = array();

		$produtosVendidos = array();

		foreach ($vendas as $i => $venda) {
			$lancamentos_all =  $this->LancamentoVenda->find('all', array(
					'conditions' => array(
						'LancamentoVenda.venda_id' => $venda['Venda']['id']
					)
				)
			);

			foreach ($lancamentos_all as $lancamento) {
				if (!empty($lancamento))
					$lancamentos[] = $lancamento;
			}
		}

		$conditions = array(
			'conditions' => array(
				'Venda.id_usuario' => $this->instancia,
				'Venda.data_venda >=' => $from,
				'Venda.data_venda <=' => $to,
				'Venda.orcamento <>' => 1,
				'Venda.ativo' => 1
			),
			'joins' => array(
			    array(
			        'table' => 'venda_itens_produtos',
			        'alias' => 'VendaItensProduto',
			        'type' => 'LEFT',
			        'conditions' => array(
			            'Venda.id = VendaItensProduto.venda_id',
			        ),
			    ),
			    array(
			        'table' => 'produtos',
			        'alias' => 'Produto',
			        'type' => 'LEFT',
			        'conditions' => array(
			            'Produto.id = VendaItensProduto.produto_id',
			        ),
			    )
			),
			'fields' => array(
				'VendaItensProduto.*', 'Venda.*', 'Produto.nome',
				'Produto.estoque', 'Produto.preco', 'Produto.preco_promocional'
			),
			'order' => array('Venda.id' => 'desc')
		);

		$vendasComProdutos = $this->Venda->find('all', $conditions);

		foreach ($vendasComProdutos as $i => $venda) {
			$produtosVendidos[$venda['Venda']['id']]['produto'][] = [
				'nome' => $venda['Produto']['nome'],
				'quantidade_vendida' => $venda['VendaItensProduto']['quantidade_produto'],
				'estoque_atual' => $venda['Produto']['estoque'],
				'produto_id' => $venda['VendaItensProduto']['produto_id'],
				'preco' => ($venda['Produto']['preco'] > $venda['Produto']['preco_promocional']) ? $venda['Produto']['preco_promocional'] : $venda['Produto']['preco']
			];

			$produtosVendidos[$venda['Venda']['id']]['valor_venda'] = $venda['Venda']['valor'];
		}

		$valorTotalPgt = $this->calcularTotalVendas($lancamentos);

		return [
			'pix' => @$valorTotalPgt['pix'],
			'dinheiro' => @$valorTotalPgt['dinheiro'],
			'cartao_credito' => @$valorTotalPgt['cartao_credito'],
			'cartao_debito' => @$valorTotalPgt['cartao_debito'],
			'valorTotalVendasPeriodo' => $valorTotalVendasPeriodo,
			'totalCustoPeriodo' => $totalCustoPeriodo,
			'totalLucro' => $valorTotalVendasPeriodo - $totalCustoPeriodo,
			'produtos_vendidos' => $produtosVendidos
		];
	}

	public function calcularTotalVendas($lancamentos)
	{
		$response = array();
		foreach ($lancamentos as $i => $lancamento) {
			@$response[$lancamento['LancamentoVenda']['forma_pagamento']] += $lancamento['LancamentoVenda']['valor_pago'];
		}

		return $response;
	}

	public function calcularTotalCustoProdutosPeriodo($vendas)
	{
		$valor = 0.00;

		foreach ($vendas as $i => $venda) {
			$valor += $venda['Venda']['custo'];
		}

		return $valor;
	}

	public function calcularValorTotalVendas($vendas)
	{
		$valor = 0.00;

		foreach ($vendas as $i => $venda) {
			$valor += $venda['Venda']['valor'];
		}

		return $valor;
	}

}
