<?php

include 'ProdutoEstoqueController.php';
include 'VendaItensProdutoController.php';
include 'LancamentoVendasController.php';

class VendaController extends AppController {

	public function pdv() {
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

		$this->set('vendas', $this->Venda->find('all',
				array('conditions' =>
					array(
						'ativo' => 1,
						'id_usuario' => $this->instancia,
						'orcamento' => 0
					)
				)
			)
		);
	}

	public function adicionar_cadastro() {
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

		$this->loadModel('Produto');

		$this->set('produtos', $this->Produto->find('all',
				array('conditions' =>
					array('ativo' => 1,
						  'id_usuario' => $this->instancia
					)
				)
			)
		);
	}

	public function conveter_venda($vendaId) {
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

		$this->loadModel('Produto');

		$this->set('produtos', $this->Produto->find('all',
				array('conditions' =>
					array('ativo' => 1,
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
						'id_usuario' => $this->instancia
					)
				)
			)
		);

		$this->loadModel('VendaItensProduto');

		$venda_produtos = $this->VendaItensProduto->find('all', 
			array('conditions' => 
				array(
					'VendaItensProduto.ativo' => 1,
					'VendaItensProduto.id' => $vendaId
				)
			)
		);

		$this->loadModel('Produto');

		$produtos = [];
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

			if ($produto[0]['Produto']['estoque'] <= 0)
			{
				$this->Session->setFlash('O produto (' . $produto[0]['Produto']['nome'] .') não tem mais estoque disponivel!');
				continue;
			}
			
			$produtos[$i] = $produto[0]['Produto'];
			$produtos[$i]['quantidade'] = $venda_produto['VendaItensProduto']['quantidade_produto'];

			$total = $produtos[$i]['preco'] * $venda_produto['VendaItensProduto']['quantidade_produto'];

			$produtos[$i]['preco'] = number_format($produtos[$i]['preco'], 2, ',', '.');
			$produtos[$i]['total'] = number_format($total, 2, ',', '.');
		}

		$this->set('venda_produtos', $produtos);
	}

	public function s_adicionar_cadastro() {
		$dados_venda 	  = $this->request->data('venda');
		$dados_lancamento = $this->request->data('lancamento');
		$produtos 	      = $this->request->data('produto');

		if (!$this->validar_itens_venda($produtos) && !$dados_venda['orcamento']) {
			$this->Session->setFlash('Algum produto adicionado não possui estoque disponivel');
			$this->redirect('/venda/adicionar_cadastro');
		}

		$dados_venda['valor'] = $this->calcular_valor_venda($produtos);
		$dados_venda['custo'] = $this->calcular_custo_venda($produtos);
		
		$salvar_venda = $this->salvar_venda($produtos, $dados_lancamento, $dados_venda);
		
		if (!$salvar_venda) {
			$this->Session->setFlash('Ocorreu um erro ao salvar a venda tente novamento');
			$this->redirect('/venda/adicionar_cadastro');
		}
		
		$this->Session->setFlash('Venda salva com sucesso');
		$this->redirect('/venda/adicionar_cadastro');
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

			$preco += $produto[0]['Produto']['preco'] * $item['quantidade'];
		}

		return $preco;
	}

	public function calcular_custo_venda($produtos) {
		$this->loadModel('Produto');

		(float) $custo = 0.00;
		foreach ($produtos as $indice => $item) {
			$produto = $this->Produto->find('all',
				array('conditions' =>
					array('Produto.id' => $item['id_produto'])
				)
			);

			$custo += $produto[0]['Produto']['custo'] * $item['quantidade'];
		}

		return $custo;
	}

	public function validar_itens_venda($produtos) {
		$this->loadModel('Produto');

		foreach ($produtos as $indice => $item) {
			$produto = $this->Produto->find('all',
				array('conditions' =>
					array('Produto.id' => $item['id_produto'])
				)
			);

			$objProdutoEstoqueController = new ProdutoEstoqueController();

			if (!$objProdutoEstoqueController->validar_estoque($produto, $item['quantidade'])) {
				return false;
			}			
		}

		return true;
	}

	public function salvar_venda($produtos, $lancamento, $informacoes, $usuario_id) {
		unset($informacoes['id_cliente']);

		$informacoes['data_venda'] = date('Y-m-d');
		$informacoes['id_usuario'] = $this->instancia != 'winners' ? $this->instancia : $usuario_id;
		$informacoes['ativo']	   = 1;
		$informacoes['desconto']   = (float) $informacoes['desconto'];
		$informacoes['valor']	   = $informacoes['valor'] - $informacoes['desconto'];
		$informacoes['orcamento']  = $informacoes['orcamento'];

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
		if ($objLancamentoVendasController->salvar_lancamento($id_venda, $lancamento, $informacoes['valor']) === false) {
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

	public function recoverDataToDashboardOneWeek(){
		$vendas = $this->Venda->find('all',
			array('conditions' =>
				array(
					'ativo' => 1,
					'id_usuario' => $this->instancia,
				),
				'limit' => 6
			)
		);

		$resposta = [];
		foreach ($vendas as $i => $venda) {
			$resposta[] = (float) number_format($venda['Venda']['valor'], 2, '.', ',');
		}

		$resposta = [
			'name' => 'Valor',
			'data' => $resposta
		];

		return json_encode($resposta);
	}

}
