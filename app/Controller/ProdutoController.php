<?php

ini_set('max_execution_time', 300);

class ProdutoController extends AppController{		

	public function listar_cadastros() {
		$this->layout = 'wadmin';

		$this->set('produtos', $this->Produto->find('all', 
				array('conditions' => 
					array('ativo' => 1,
						  'id_usuario' => $this->instancia
					)
				)
			)
		);
	}

	public function adicionar_cadastro() {
		$this->loadModel('Categoria');

		$this->set('categorias', $this->Categoria->find('all', 
				array('conditions' => 
					array('ativo' => 1,
						  'usuario_id' => $this->instancia
					)
				)
			)
		);	

		$this->layout = 'wadmin';
	}

	public function s_adicionar_cadastro() {
		$dados  = $this->request->data('dados');

		$variacoes = $this->request->data('variacao');

		$image  = $_FILES['imagem'];

		$retorno = $this->uploadImage($image);

		if (!$retorno['status']) 
			$this->Session->setFlash('Não foi possivel salvar a imagem tente novamente');

		$dados['imagem'] = $retorno['nome'];
		$dados['id_usuario'] = $this->instancia;
		$dados['ativo'] = 1;
		$dados['id_alias'] = $this->id_alias();

		if($this->Produto->save($dados)) {
			$produto_id = $this->Produto->getLastInsertId();
			
			require 'VariacaoController.php';

			$objVariacaoController = new VariacaoController();

			$objVariacaoController->s_adicionar_variacao($variacoes, $produto_id, $this->instancia);			

			$this->Session->setFlash('Produto salvo com sucesso!');
            
            return $this->redirect('/produto/listar_cadastros');
		} else {
			$this->Session->setFlash('Ocorreu um erro ao salva o produto!');
            
            return $this->redirect('/produto/listar_cadastros');
		}
	}

	public function editar_cadastro($id) {
		$this->layout = 'wadmin';

		$this->loadModel('Variacao');

		$query = array (
			'joins' => array(
				    array(
				        'table' => 'produtos',
				        'alias' => 'Produto',
				        'type' => 'LEFT',
				        'conditions' => array(
				            'Variacao.produto_id = Produto.id',
				        ),
				    )
				),
	        'conditions' => array('Variacao.produto_id' => $id, 'Variacao.ativo' => 1),
	        'fields' => array('Produto.id, Variacao.*'),
		);

		$variacoes = $this->set('variacoes', $this->Variacao->find('all', $query));

		$this->set('produto', $this->Produto->find('all', 
				array('conditions' => 
					array('ativo' => 1,
						  'id' => $id
					)
				)
			)[0]
		);

		$this->loadModel('Categoria');

		$this->set('categorias', $this->Categoria->find('all', 
				array('conditions' => 
					array('ativo' => 1,
						  'usuario_id' => $this->instancia
					)
				)
			)
		);	
	}

	public function s_editar_cadastro($id) {
		$dados = $this->request->data('dados');

		$variacoes = $this->request->data('variacao');

		$image  = $_FILES['imagem'];
		
		if (!empty($image['name'])) {
			$retorno = $this->uploadImage($image);
			
			if (!$retorno['status']) 
				$this->Session->setFlash('Não foi possivel salvar a imagem tente novamente');
			
			$dados['imagem'] = $retorno['nome'];
		}


		$dados['id_usuario'] = $this->instancia;
		$dados['ativo'] = 1;
		$dados['id_alias'] = $this->id_alias();

		$this->Produto->id = $id;
		
		if ($this->Produto->save($dados)) {

			require 'VariacaoController.php';
			$objVariacaoController = new VariacaoController();
			$objVariacaoController->desativar_variacoes($id);
			$objVariacaoController->s_adicionar_variacao($variacoes, $id, $this->instancia);	

			$this->Session->setFlash('Produto editado com sucesso!','default','good');
            return $this->redirect('/produto/listar_cadastros');
		} else {
			$this->Session->setFlash('Ocorreu um erro ao editar o produto!','default','good');
            return $this->redirect('/produto/listar_cadastros');
		}
	}

	public function excluir_cadastro() {
		$this->layout = 'ajax';

		$id = $this->request->data('id');

		$dados = array('ativo' => '0');
		$parametros = array('id' => $id);

		if ($this->Produto->updateAll($dados, $parametros)) {
			echo json_encode(true);
		} else {
			echo json_encode(false);
		}
	}

	public function id_alias() {
		$id_alias = $this->Produto->find('first', array(
				'conditions' => array('Produto.ativo' => 1),
				'order' => array('Produto.id' => 'desc')
			)
		);

		return $id_alias['Produto']['id_alias'] + 1;
	}

	public function carregar_dados_venda_ajax() {
		$this->layout = 'ajax';

		$retorno = $this->Produto->find('first', 
			array('conditions' => 
				array('Produto.ativo' => 1,
					  'Produto.id_usuario' => $this->instancia,
					  'Produto.id' => $this->request->data('id')
				)
			)
		);

		if (!$this->validar_estoque($retorno)) {
			return false;
		}

		$retorno['Produto']['total'] = $this->calcular_preco_produto_venda($retorno['Produto']['preco'], $this->request->data('qnt'));

		$retorno['Produto']['preco'] = number_format($retorno['Produto']['preco'], 2, ',', '.');
		
		echo json_encode($retorno);
	}

	public function validar_estoque($produto) {
		if (empty($produto) && !isset($produto)) {
			return false;
		}
		
		if ($produto['Produto']['estoque'] <= 0) {
			return false;
		}

		return true;
	}

	public function calcular_preco_produto_venda($preco, $qnt) {
		if (empty($preco) || !isset($preco)) {
			return false;
		}

		if (!is_numeric($qnt)) {
			return false;
		}

		$retorno = $preco * $qnt;

		return number_format($retorno, 2, ',', '.');
	}

	public function uploadImage(&$image) {
		$type = substr($image['name'], -4);
		$nameImage = uniqid() . md5($image['name']) . $type;
		$dir = APP . 'webroot/uploads/produto/imagens/';
		
		$returnUpload = move_uploaded_file($image['tmp_name'], $dir . $nameImage);

		if (!$returnUpload)
			return array('nome' => null, 'status' => false);

		return array('nome' => $nameImage, 'status' => true);
	}

	public function visualizar_cadastro($id) {
		$this->layout = 'wadmin';

		$produto = $this->Produto->find('all', 
			array('conditions' => 
				array('ativo' => 1,
					  'id' => $id
				)
			)
		);

		if (empty($produto)) {
			$this->Session->setFlash("Produto não encotrado, tente novamente");
			$this->redirect("/produto/listar_cadastros");
		}

		$this->set('produto', $produto[0]);
	}

	public function exportar_excel_exemplo() {
		include(APP . 'Vendor/PHPExcel/PHPExcel.php');
		include(APP . 'Vendor/PHPExcel/PHPExcel/IOFactory.php');

        $objPHPExcel = new PHPExcel();
        // Definimos o estilo da fonte
        $objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);

        $objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(40);

        // Criamos as colunas
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A1', "Nome do Produto")
                    ->setCellValue('B1', "Preço ")
                    ->setCellValue("C1", "Peso Bruto")
                    ->setCellValue("D1", "Peso Liquido")
                    ->setCellValue("E1", "Estoque")
                    ->setCellValue("F1", "Descrição");

        // Podemos renomear o nome das planilha atual, lembrando que um único arquivo pode ter várias planilhas
        $objPHPExcel->getActiveSheet()->setTitle('Listagem de produtos');

        // Cabeçalho do arquivo para ele baixar
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="planilha_importacao_exemplo.xls"');
        header('Cache-Control: max-age=0');
        // Se for o IE9, isso talvez seja necessário
        header('Cache-Control: max-age=1');

        // Acessamos o 'Writer' para poder salvar o arquivo
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');

        // Salva diretamente no output, poderíamos mudar arqui para um nome de arquivo em um diretório ,caso não quisessemos jogar na tela
        $objWriter->save('php://output'); 

        exit;
    }

    public function importar_produtos_planilha() {
        if (!isset($_FILES['arquivo']['tmp_name']) && empty($_FILES['arquivo']['tmp_name']))
        {
			$this->Session->setFlash("Erro ao subir a planilha, tente novamente.");
			$this->redirect("/produto/listar_cadastros");        	
        }

        $typesPermissions = ['application/vnd.ms-excel'];

        if (!in_array($_FILES['arquivo']['type'], $typesPermissions))
        {
			$this->Session->setFlash("O arquivo deve ser no formato .xls.");
			$this->redirect("/produto/listar_cadastros");                	
        }

        $caminho = APP . 'webroot/uploads/produto/planilhas/' . uniqid() . '.xls';

        $inputFileName = $_FILES['arquivo']['tmp_name'];

        move_uploaded_file($inputFileName, $caminho);

        $data = [
        	'caminho' => $caminho,
        	'usuario_id' => $this->instancia,
        	'processado' => 0,
        	'ativo' => 1
        ];

        $this->loadModel('QueueProduct');

        if ($this->QueueProduct->save($data))
        {
			$this->Session->setFlash("O arquivo está na fila para ser importado, iremos enviar um e-mail quando terminar.");
			$this->redirect("/produto/listar_cadastros");  
        }
        else 
        {
			$this->Session->setFlash("Ocorreu um erro, tente novamente.");
			$this->redirect("/produto/listar_cadastros");          	
        }
    }

    public function importar_produtos_planilha() {
		include(APP . 'Vendor/PHPExcel/PHPExcel.php');
		include(APP . 'Vendor/PHPExcel/PHPExcel/IOFactory.php');
    	
        $objPHPExcel = new PHPExcel();

        if (!isset($_FILES['arquivo']['tmp_name']) && empty($_FILES['arquivo']['tmp_name']))
        {
			$this->Session->setFlash("Erro ao subir a planilha, tente novamente.");
			$this->redirect("/produto/listar_cadastros");        	
        }

        $typesPermissions = ['application/vnd.ms-excel'];

        if (!in_array($_FILES['arquivo']['type'], $typesPermissions))
        {
			$this->Session->setFlash("O arquivo deve ser no formato .xls.");
			$this->redirect("/produto/listar_cadastros");                	
        }

        $caminho = APP . 'webroot/uploads/produto/planilhas/' . uniqid() . '.xls';

        $inputFileName = $_FILES['arquivo']['tmp_name'];

        move_uploaded_file($inputFileName, $caminho);

        $data = [
        	'caminho' => $caminho,
        	'usuario_id' => $this->instancia,
        	'processado' => 0,
        	'ativo' => 1
        ];

        if ($this->QueueProducts->save($data))
        {
			$this->Session->setFlash("O arquivo está na fila para ser importado, iremos enviar um e-mail quando terminar.");
			$this->redirect("/produto/listar_cadastros");  
        }
        else 
        {
			$this->Session->setFlash("Ocorreu um erro, tente novamente.");
			$this->redirect("/produto/listar_cadastros");          	
        }
    }

    public function processar_planilhas_na_fila() {
    	$this->loadModel('QueueProduct');

    	$planilhas = $this->QueueProduct->loadPlanilhasNotProcesseds();

    	$response = [];
    	foreach ($planilhas as $planilha) {
    		$response[] = $this->processar_planilhas($planilha['caminho'], $planilha['usuario_id'], $planilha['id']);
    	}

    	return $response;
    }

    public function processar_planilhas($inputFileName, $usuarioId, $planilhaId) {
		include(APP . 'Vendor/PHPExcel/PHPExcel.php');
		include(APP . 'Vendor/PHPExcel/PHPExcel/IOFactory.php');
    	
        $objPHPExcel = new PHPExcel();

		try {
		    $inputFileType 	= PHPExcel_IOFactory::identify($inputFileName);
		    $objReader 		= PHPExcel_IOFactory::createReader($inputFileType);
		    $objPHPExcel 	= $objReader->load($inputFileName);
		} catch(Exception $e) {
		    die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME) . '": ' . $e->getMessage());
		}

		$dados = [];

		$rows = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();

		for ($row = 2; $row <= $rows; $row++) {
			
			$rowInterator = $objPHPExcel->getActiveSheet()->getRowIterator($row)->current();

			$cellIterator = $rowInterator->getCellIterator();
			$cellIterator->setIterateOnlyExistingCells(false);

			foreach ($cellIterator as $i => $cell) {
				switch ($i) {
					case 0: //Codigo/SKU
						$dados[$row]['sku'] = $cell->getValue();
					break; 
					case 1: // Nome/Descrição 
						$dados[$row]['nome'] = $cell->getValue();						
					break;
					case 2: // QtdAtual
						//$dados[$row]['sku'] = $cell->getValue();						
					break;
					case 3: // QtdMinima  
						$dados[$row]['quantidade_minima'] = $cell->getValue();						
					break;
					case 4: // QtdTotal
						$dados[$row]['estoque'] = $cell->getValue();						
					break;
					case 5: // ValCusto
						$dados[$row]['custo'] = $cell->getValue();						
					break;
					case 6:  // ValVenda
						$dados[$row]['preco'] = $cell->getValue();						
					break;
				}
			}

			$dados[$row]['id_usuario'] = $usuarioId;	
			$dados[$row]['ativo'] = 1;

		}

		$errors = $this->processar_lista_produtos($dados);

		if (isset($errors) && !empty($errors))
		{
			$this->QueueProduct->planilhaProcessedIncomplete($planilhaId);
		}

		$this->QueueProduct->planilhaProcessedComplete($planilhaId);

		echo json_encode(array('sucess' => true));
		exit;
    }

    public function processar_lista_produtos($dados) {
    	$errors = [];

    	foreach ($dados as $dado) {
    		$this->loadModel('Produto');
    		
    		$existProduto = $this->Produto->find('all',
    			array(
    				'conditions' => array(
    					'Produto.sku' => $dado['sku'],
    					'Produto.ativo' => 1
    				)
    			)
    		);

    		if (isset($existProduto) && !empty($existProduto))
    		{
    			$this->Produto->id = $existProduto[0]['Produto']['id'];
    			$this->Produto->save($dado);
    			continue;
    		}

			$this->Produto->create();

    		if (!$this->Produto->save($dado))
    		{
    			$errors[] = $dado;
    		}
    	}

    	return $errors;
>>>>>>> 36dc74c7f7a4a9679dceb6b9594a56aa51a0ed1a
    }

}
