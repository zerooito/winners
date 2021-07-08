<?php

require_once(ROOT . DS . 'vendor' . DS . 'autoload.php');

use Dompdf\Dompdf;

class ProdutoController extends AppController{		

	public function listar_cadastros() {
		if (!$this->PermissoesHelper->usuario_possui_permissao_para('produto', 'read')) {
			$this->Session->setFlash('Você não possui acesso a esta área do sistema');
			return $this->redirect('/dashboard/home');
		}

		$this->layout = 'wadmin';
	}

	public function listar_cadastros_ajax() {
		$this->layout = 'ajax';

		$aColumns = array( 'sku', 'imagem', 'nome', 'preco', 'estoque' );
		
		$conditions = array('conditions' =>
			array(
				'ativo' => 1,
				'id_usuario' => $this->instancia
			)
		);

		$allProdutos = $this->Produto->find('all', $conditions);
		
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
					$conditions['order'] = array('Produto.' . $aColumns[intval($_GET['iSortCol_' . $i])] => $_GET['sSortDir_'.$i]);
				}
			}
		}

		if ( isset( $_GET['sSearch'] ) && !empty( $_GET['sSearch'] ) )
		{
			$conditions['conditions']['Produto.nome LIKE '] = '%' . $_GET['sSearch'] . '%';
		}
		
		$produtos = $this->Produto->find('all', $conditions);

		$output = array(
			"sEcho" => intval($_GET['sEcho']),
			"iTotalDisplayRecords" => count($allProdutos),
			"iTotalRecords" => count($produtos),
			"aaData" => array()
		);

		if ($this->PermissoesHelper->usuario_possui_permissao_para('produto', 'read')) {
			foreach ( $produtos as $i => $produto )
			{
				$row = array();

				for ( $i=0 ; $i < count($aColumns) ; $i++ )
				{
					$value = $produto['Produto'][$aColumns[$i]];

					if ($aColumns[$i] == "imagem")
					{
						$value = '<img src="/uploads/produto/imagens/' . $produto['Produto'][$aColumns[$i]] . '" width="120" height="120">';

						if (!isset($produto['Produto'][$aColumns[$i]]) || empty($produto['Produto'][$aColumns[$i]]))
						{
							$value = '<img src="/images/no_image.png" width="120" height="120">';
						}
					}

					if ($aColumns[$i] == "preco") 
					{
						$value = 'R$ ' . number_format($value, 2, ',', '.');
					}
					
					$row[] = $value;
				}

				$btEdit = '<a class="btn btn-info" href="/produto/editar_cadastro/' . $produto['Produto']['id'] . '"><i class="text-white fas fa-pencil-alt"></i></a>';
				$btMove = '<a class="btn btn-primary" href="/produto/movimentacoes_estoque/' . $produto['Produto']['id'] . '"><i class="fa fa-bars"></i></a>';
				$btImage = '<a class="btn btn-primary" href="/produto/imagens/' . $produto['Produto']['id'] . '"><i class="fas fa-images"></i></a>';
				$btDelete = '<a class="btn btn-danger" href="javascript:remover_produto(' . $produto['Produto']['id'] . ');"><i class="fas fa-trash"></i></a>';

				$row[] = $btEdit . ' ' . $btMove . ' ' . $btImage . ' ' . $btDelete;

				$output['aaData'][] = $row;
			}
		}

		echo json_encode($output);
		exit;
	}

	public function imagens($id) {
		if (!$this->PermissoesHelper->usuario_possui_permissao_para('produto', 'read')) {
			$this->Session->setFlash('Você não possui acesso a esta área do sistema');
			return $this->redirect('/produto/listar_cadastros');
		}

		$this->layout = 'wadmin';

		$produto = $this->Produto->find('first', array(
				'conditions' => array(
					'Produto.id' => $id
				)
			)
		);

		$this->loadModel('Imagen');
		$imagens = $this->Imagen->find('all', array(
				'conditions' => array(
					'Imagen.produto_id' => $id,
					'Imagen.usuario_id' => $this->instancia,
					'Imagen.ativo' => 1
				)
			)
		);

		$this->set('imagens', $imagens);
		$this->set('produto', $produto);
	}

	public function listar_cadastros_estoque_minimo(){
		if (!$this->PermissoesHelper->usuario_possui_permissao_para('produto', 'read')) {
			$this->Session->setFlash('Você não possui acesso a esta área do sistema');
			return $this->redirect('/produto/listar_cadastros');
		}

		$this->layout = 'wadmin';
	}

	public function listar_cadastros_estoque_minimo_ajax(){

		$this->layout = 'ajax';

		$aColumns = array( 'sku', 'imagem', 'nome', 'preco', 'estoque' );

		$this->loadModel('Usuario');

		$usuario = $this->Usuario->find('all', array('conditions' =>
				array(
					'Usuario.id' => $this->instancia
				)
			)
		)[0]['Usuario'];
		
		$conditions = array('conditions' =>
			array(
				'ativo' => 1,
				'id_usuario' => $this->instancia,
				'Produto.estoque < ' => 'Produto.quantidade_minima',
				//'OR' => array(
				//	'Produto.estoque <= ' => $usuario['estoque_minimo']
				//)
			)
		);

		$allProdutos = $this->Produto->query("select * from produtos where estoque < quantidade_minima and id_usuario = " . $this->instancia . " and ativo = 1");

		
		$sql = "select * from produtos as Produto where estoque < quantidade_minima and id_usuario = " . $this->instancia . " and ativo = 1";

		if ( isset( $_GET['iDisplayStart'] ) && $_GET['iDisplayLength'] != '-1' )
		{
			$sql .= ' LIMIT ' . $_GET['iDisplayLength'] . ' OFFSET ' . $_GET['iDisplayStart'];
		}

		if ( isset( $_GET['iSortCol_0'] ) )
		{
			for ( $i=0 ; $i < intval( $_GET['iSortingCols'] ) ; $i++ )
			{
				if ( $_GET[ 'bSortable_' . intval($_GET['iSortCol_' . $i]) ] == "true" )
				{
					$conditions['order'] = array('Produto.' . $aColumns[intval($_GET['iSortCol_' . $i])] => $_GET['sSortDir_'.$i]);
				}
			}
		}
		
		if ( isset( $_GET['sSearch'] ) && !empty( $_GET['sSearch'] ) )
		{
			$conditions['conditions']['Produto.nome LIKE '] = '%' . $_GET['sSearch'] . '%';
		}

		$produtos = $this->Produto->query($sql);

		$output = array(
			"sEcho" => intval($_GET['sEcho']),
			"iTotalDisplayRecords" => count($allProdutos),
			"iTotalRecords" => count($produtos),
			"aaData" => array()
		);

		$output = [];
		if ($this->PermissoesHelper->usuario_possui_permissao_para('produto', 'read')) {
			foreach ( $produtos as $i => $produto )
			{
				$row = array();

				for ( $i=0 ; $i < count($aColumns) ; $i++ )
				{
					$value = $produto['Produto'][$aColumns[$i]];

					if ($aColumns[$i] == "imagem")
					{
						$value = '<img src="/uploads/produto/imagens/' . $produto['Produto'][$aColumns[$i]] . '" width="120" height="120">';

						if (!isset($produto['Produto'][$aColumns[$i]]) || empty($produto['Produto'][$aColumns[$i]]))
						{
							$value = '<img src="/images/no_image.png" width="120" height="120">';
						}
					}
					
					$row[] = $value;
				}

				$output['aaData'][] = $row;
			}
		}
		
		echo json_encode($output);
		exit;
	}

	public function baixar_estoque_minimo_pdf() {
		if (!$this->PermissoesHelper->usuario_possui_permissao_para('produto', 'read')) {
			$this->Session->setFlash('Você não possui acesso a esta área do sistema');
			return $this->redirect('/produto/listar_cadastros');
		}

		$this->loadModel('Produto');
		$this->loadModel('Usuario');

		$dompdf = new Dompdf();

		$usuario = $this->Usuario->find('all', array('conditions' =>
				array(
					'Usuario.id' => $this->instancia
				)
			)
		)[0]['Usuario'];

		$conditions = array('conditions' =>
			array(
				'ativo' => 1,
				'id_usuario' => $this->instancia,
				'Produto.estoque < ' => 'Produto.quantidade_minima',
				//'OR' => array(
				//	'Produto.estoque <= ' => $usuario['estoque_minimo']
				//)
			)
		);

		$produtos = $this->Produto->query("select * from produtos as Produto where estoque < quantidade_minima and id_usuario = " . $this->instancia . " and ativo = 1");
		
		$html = $this->getProdutosEstoqueMinimoComoHtml($produtos);

		$dompdf->loadHtml($html);

		$dompdf->set_paper(array(0, 0, 595.28, count($produtos) * 25));

		$dompdf->render();

		$dompdf->stream();

		exit;
	}

	public function getProdutosEstoqueMinimoComoHtml($produtos) {
    	ob_start();

		$html = '';
		$html .= '<html>';
		$html .= '<head>';
		$html .= '	<title></title>';
		$html .= '</head>';
		$html .= '<body>';
		$html .= '';
		$html .= '	<table style="background-color: #cacaca;"  width="100%" valign="center" align="center">';
		$html .= '		<tr align="center">';
		$html .= '			<td>';
		$html .= '				<h2>Produtos com quantidade de estoque minimo</h2>';
		$html .= '			</td>';
		$html .= '		</tr> ';
		$html .= '	</table>';
		$html .= '	<br>';
		$html .= '	<br>';
		$html .= '	<table  width="100%" valign="center" align="center">';
		$html .= '		<tr style="background-color: #cacaca;" align="center">';
		$html .= '			<td>';
		$html .= '				<h2>Produtos</h2>';
		$html .= '			</td>';
		$html .= '		</tr> ';
		$html .= '	</table>';
		$html .= '	<br>';
		$html .= '	<table  width="100%" valign="center" align="center">';
		$html .= '		<tr>';
		$html .= '			<td>';
		$html .= '				<table width="100%" valign="center" align="center">';
		$html .= '					<tr style="background-color: #cacaca;">';
		$html .= '						<td>Nome Produto</td>';
		$html .= '						<td>Quantidade</td>';
		$html .= '						<td>Custo</td>';
		$html .= '					</tr>';
		$html .= '';

		foreach ($produtos as $i => $produto) {
			$html .= '					<tr>';
			$html .= '						<td>' . $produto['Produto']['nome'] . '</td>';
			$html .= '						<td>' . $produto['Produto']['estoque'] . '</td>';
			$html .= '						<td>R$ ' . number_format($produto['Produto']['custo'], 2, ',', '.') . '</td>';
			$html .= '					</tr>';
		}

		$html .= '				</table>';
		$html .= '			</td>';
		$html .= '		</tr>';
		$html .= '	</table>';
		$html .= '	<br>';
		$html .= '';
		$html .= '</body>';
		$html .= '</html>';
		echo $html;exit;
		return $html;
	}

	public function adicionar_cadastro() {
		if (!$this->PermissoesHelper->usuario_possui_permissao_para('produto', 'write')) {
			$this->Session->setFlash('Você não possui acesso a esta área do sistema');
			return $this->redirect('/produto/listar_cadastros');
		}

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
		if (!$this->PermissoesHelper->usuario_possui_permissao_para('produto', 'write')) {
			$this->Session->setFlash('Você não possui acesso a esta área do sistema');
			return $this->redirect('/produto/listar_cadastros');
		}

		$dados  = $this->request->data('dados');

		$variacoes = $this->request->data('variacao');

		$image  = $_FILES['imagem'];

		$retorno = $this->uploadImage($image);

		if (!$retorno['status']) 
			$this->Session->setFlash('Não foi possivel salvar a imagem tente novamente');

		$dados['imagem'] = $retorno['nome'];
		$dados['id_usuario'] = $this->instancia;
		$dados['ativo'] = 1;
		$dados['destaque'] = 0;
		$dados['id_alias'] = $this->id_alias();
		$dados['preco'] = str_replace(',', '', $dados['preco']);

		if($this->Produto->save($dados)) {
			$produto_id = $this->Produto->getLastInsertId();
			
			require 'VariacaoController.php';

			$objVariacaoController = new VariacaoController();

			$objVariacaoController->s_adicionar_variacao($variacoes, $produto_id, $this->instancia);			

			if ($this->verificar_modulo_ativo('pluggto'))
			{
				require 'PluggtoController.php';
				$objPluggTo = new PluggtoController();
				$produto_pluggto = $objPluggTo->enviar_produto($dados, $variacoes);

				if (!isset($produto_pluggto->Product->id)) 
				{
					$this->Session->setFlash('Produto não foi enviado para o Plugg.to!');
				}
			}

			$this->Session->setFlash('Produto salvo com sucesso!');
            
            return $this->redirect('/produto/listar_cadastros');
		} else {
			$this->Session->setFlash('Ocorreu um erro ao salva o produto!');
            
            return $this->redirect('/produto/listar_cadastros');
		}
	}

	public function editar_cadastro($id) {
		if (!$this->PermissoesHelper->usuario_possui_permissao_para('produto', 'write')) {
			$this->Session->setFlash('Você não possui acesso a esta área do sistema');
			return $this->redirect('/produto/listar_cadastros');
		}

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
		if (!$this->PermissoesHelper->usuario_possui_permissao_para('produto', 'write')) {
			$this->Session->setFlash('Você não possui acesso a esta área do sistema');
			return $this->redirect('/produto/listar_cadastros');
		}

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
		$dados['preco'] = str_replace(',', '', $dados['preco']);

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
		if (!$this->PermissoesHelper->usuario_possui_permissao_para('produto', 'write')) {
			echo json_encode(false);
			return;
		}

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

		$preco = $retorno['Produto']['preco'];
		if ($retorno['Produto']['preco_promocional'] < $preco) {
			$preco = $retorno['Produto']['preco_promocional'];
		}

		$retorno['Produto']['total'] = $this->calcular_preco_produto_venda($preco, $this->request->data('qnt'));

		$retorno['Produto']['preco'] = (float) $preco;
		
		echo json_encode($retorno);
	}

	public function getUserActive($id) {
		$this->loadModel('Usuario');

		$user = $this->Usuario->find('all', 
			array('conditions' => 
				array('Usuario.id' => $id)
			)
		);
		
		return $user;
	}

	public function validar_estoque($produto) {

		$user_active = $this->getUserActive($produto['Produto']['id_usuario']);

		if ($user_active[0]['Usuario']['sale_without_stock'])
			return true;

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

		return (float) $retorno;
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
					case 0: // Nome
						$dados[$row]['nome'] = $cell->getValue();						
					break;
					case 1: // preço
						$dados[$row]['preco'] = $cell->getValue();						
					break;
					case 2: // peso bruto
						$dados[$row]['peso_bruto'] = $cell->getValue();						
					break;
					case 3: // peso liquido
						$dados[$row]['peso_liquido'] = $cell->getValue();						
					break;
					case 4: // estoque
						$dados[$row]['estoque'] = $cell->getValue();
					break;
					case 5: // estoque
						$dados[$row]['descricao'] = $cell->getValue();
					break;
				}
			}

			$dados[$row]['destaque'] = 0;
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
    					'Produto.sku' => $dado['nome'],
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
    }

    public function movimentacoes_estoque($produtoId) {
		if (!$this->PermissoesHelper->usuario_possui_permissao_para('produto', 'read')) {
			$this->Session->setFlash('Você não possui acesso a esta área do sistema');
			return $this->redirect('/produto/listar_cadastros');
		}

    	$this->layout = 'wadmin';

    	$this->set('id', $produtoId);
    }

	public function listar_cadastros_estoque_ajax($produtoId) {
		$this->loadModel('VendaItensProduto');

		$this->layout = 'ajax';

		$aColumns = array( 'id', 'produto_id', 'venda_id', 'quantidade_produto' );
		
		$conditions = array(
			'conditions' => array(
				'VendaItensProduto.ativo' => 1,
				'VendaItensProduto.produto_id' => $produtoId
			),
			'joins' => array(
			    array(
			        'table' => 'produtos',
			        'alias' => 'Produto',
			        'type' => 'LEFT',
			        'conditions' => array(
			            'VendaItensProduto.produto_id = Produto.id',
			        ),
			    )
			),
	        'fields' => array('VendaItensProduto.*, Produto.*'),
		);

		$allProdutos = $this->VendaItensProduto->find('all', $conditions);
		
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
					$conditions['order'] = array('VendaItensProduto.' . $aColumns[intval($_GET['iSortCol_' . $i])] => $_GET['sSortDir_'.$i]);
				}
			}
		}

		if ( isset( $_GET['sSearch'] ) && !empty( $_GET['sSearch'] ) )
		{
			$conditions['conditions']['VendaItensProduto.id LIKE '] = '%' . $_GET['sSearch'] . '%';
		}
		
		$produtos = $this->VendaItensProduto->find('all', $conditions);

		$output = array(
			"sEcho" => intval($_GET['sEcho']),
			"iTotalDisplayRecords" => count($allProdutos),
			"iTotalRecords" => count($produtos),
			"aaData" => array()
		);

		if (!$this->PermissoesHelper->usuario_possui_permissao_para('produto', 'read')) {
			foreach ( $produtos as $i => $produto )
			{
				$row = array();

				for ( $i=0 ; $i < count($aColumns) ; $i++ )
				{
					if ($aColumns[$i] == "produto_id") {
						$value = $produto['Produto']['nome'];
					} else if ($aColumns[$i] == "quantidade_produto") {
						$value = -$produto['VendaItensProduto'][$aColumns[$i]];
					} else {
						$value = $produto['VendaItensProduto'][$aColumns[$i]];
					}
					
					$row[] = $value;
				}

				$output['aaData'][] = $row;
			}
		}
		
		echo json_encode($output);
		exit;
	}

    public function salvar_imagem($id) {
		$image  = $_FILES['arquivo'];
		
		$retorno = $this->uploadImage($image);

		if (!$retorno['status']) {
			$this->Session->setFlash('A imagem não foi salva tente novamente ou contate o suporte!');
            return $this->redirect('/produto/imagens/' . $id);
		}

		$photo = $this->request->data('photo');

		$data = array(
			'arquivo' => $retorno['nome'],
			'order' => $photo['order'],
			'alt' => $photo['alt'],
			'title' => $photo['title'],
			'ativo' => 1,
			'usuario_id' => $this->instancia,
			'produto_id' => $id
		);

		$this->loadModel('Imagen');

		$retorno = $this->Imagen->save($data);

		if (!$retorno) {
			$this->Session->setFlash('A imagem não foi salva tente novamente ou contate o suporte!');
            return $this->redirect('/produto/imagens/' . $id);
		}

		$this->Session->setFlash('A salva com sucesso!');
        return $this->redirect('/produto/imagens/' . $id);
    }

    public function imagem_excluir_cadastro($id) {
    	$this->loadModel('Imagen');

    	$this->Imagen->id = $id;

    	$this->Imagen->save(['ativo' => 0]);

    	echo json_encode(array('success' => true));
    	exit;
    }

    public function produto_item()
    {
		$search = strip_tags(trim($_GET['q'])); 

		$conditions['conditions']['Produto.id_usuario'] = $this->instancia;
		$conditions['conditions']['Produto.ativo'] = 1;
		$conditions['conditions']['Produto.nome LIKE '] = '%' . $search . '%';

		$conditions['limit'] = 25;
		
		$produtos = $this->Produto->find('all', $conditions);

		$data = [];
		foreach ($produtos as $produto) {
			$data[] = [
				'id' => $produto['Produto']['id'],
				'text' => $produto['Produto']['nome']
			];
		}

		echo json_encode($data);
		exit;
    }

}
