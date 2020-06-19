<?php

require_once(ROOT . DS . 'vendor' . DS . 'autoload.php');

use Dompdf\Dompdf;

class OrcamentoController extends AppController 
{

	public function listar_cadastros()
	{
		$this->layout = 'wadmin';

		$this->loadModel('Venda');
		$vendas = $this->Venda->find('all',
			 array(
				'conditions' => array(
					array(
						'Venda.ativo' => 1,
						'Venda.id_usuario' => $this->instancia,
						'Venda.orcamento' => 1
					)
				),
				'order' => array('Venda.id DESC'),
				'joins' => array(
					array(
						'table' => 'clientes',
						'alias' => 'Cliente',
						'type' => 'LEFT',
						'conditions' => array(
							'Cliente.id = Venda.cliente_id'
						)
					)
				),
				'fields' => array('Venda.*, Cliente.*'),
			)
		);

		$this->set('vendas',  $vendas);
	}

	public function excluir_cadastro($vendaId)
	{
		$this->layout = 'ajax';

		$this->loadModel('Venda');

		$dados['ativo'] = 0;
		$dados['id_usuario'] = $this->instancia;
		$dados['id'] = $vendaId;

		echo json_encode($this->Venda->save($dados));

		exit;
	}

	public function salvar_orcamento()
	{
		$this->layout = 'wadmin';
	}

	public function pdf($vendaId)
	{
		$this->loadModel('Venda');
		$this->loadModel('VendaItensProduto');

		$dompdf = new Dompdf();

		$dadosVenda = $this->Venda->find('all', 
			array('conditions' =>
				array(
					'Venda.id' => $vendaId
				)
			)
		);

		$produtosVenda = $this->VendaItensProduto->find('all',
			array('conditions' => 
				array(
					'VendaItensProduto.venda_id' => $vendaId
				)
			)
		);

		$html = $this->pegar_venda_como_html($dadosVenda, $produtosVenda);

		$dompdf->loadHtml($html);

		$dompdf->set_paper('a4');

		$dompdf->render();

		$dompdf->stream('orcamento-venda-' . $vendaId);

		exit;
	}

	public function pegar_venda_como_html($dadosVenda, $produtosVenda)
	{
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
		$html .= '				<h2>Orçamento Pedido #' . $dadosVenda[0]['Venda']['id'] . '</h2>';
		$html .= '			</td>';
		$html .= '		</tr> ';
		$html .= '	</table>';
		$html .= '	<br>';
		$html .= '	<table width="100%" valign="center" align="center">';
		$html .= '		<tr  style="background-color: #ccc;">';
		$html .= '			<td>Total: </td>';
		$html .= '			<td>R$ ' . number_format($dadosVenda[0]['Venda']['valor'], 2, ',', '.') . '</td>';
		$html .= '		</tr>';
		$html .= '		<tr  style="background-color: #ccc;">';
		$html .= '			<td>Valor a Pagar: </td>';
		$html .= '			<td>R$ ' . number_format($dadosVenda[0]['Venda']['valor'], 2, ',', '.') . '</td>';
		$html .= '		</tr>';
		$html .= '	</table>';
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
		$html .= '						<td>Valor</td>';
		$html .= '					</tr>';
		$html .= '';
		$desconto = 0;
		foreach ($produtosVenda as $i => $produto) {
			$produtoInfos = $this->getInfoProdutos($produto['VendaItensProduto']['produto_id']);
			
			$total = $produtoInfos['Produto']['preco'] * $produto['VendaItensProduto']['quantidade_produto'];
			$total = number_format($total, 2, ',', '.');

			$html .= '					<tr>';
			$html .= '						<td>' . $produtoInfos['Produto']['nome'] . '</td>';
			$html .= '						<td>' . $produto['VendaItensProduto']['quantidade_produto'] . '</td>';
			$html .= '						<td>R$ ' . $total . '</td>';
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

		return $html;
	}

	public function getInfoProdutos($produtoId)
	{
		$this->loadModel('Produto');

		$response = $this->Produto->find('first', 
			array('conditions' => array(
					'Produto.id' => $produtoId
				)
			)
		);

		return $response;
	}

}