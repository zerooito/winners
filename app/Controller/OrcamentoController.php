<?php

require_once(ROOT . DS . 'vendor' . DS . 'autoload.php');

use Dompdf\Dompdf;

class OrcamentoController extends AppController 
{

	public function listar_cadastros()
	{
		$this->layout = 'wadmin';

		$this->loadModel('Venda');

		$this->set('vendas', $this->Venda->find('all',
				array('conditions' =>
					array(
						'ativo' => 1,
						'id_usuario' => $this->instancia,
						'orcamento' => 1
					)
				)
			)
		);
	}

	public function salvar_orcamento()
	{
		$this->layout = 'wadmin';
	}

	public function pdf($vendaId)
	{
		// instantiate and use the dompdf class
		$dompdf = new Dompdf();

		$html = $this->pegar_venda_como_html();

		$dompdf->loadHtml($html);

		$dompdf->setPaper('A4');

		$dompdf->render();

		$dompdf->stream();

		exit;
	}

	public function pegar_venda_como_html()
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
		$html .= '				<h2>Orçamento Pedido #1</h2>';
		$html .= '			</td>';
		$html .= '		</tr> ';
		$html .= '	</table>';
		$html .= '	<br>';
		$html .= '	<table width="100%" valign="center" align="center">';
		$html .= '		<tr  style="background-color: #ccc;">';
		$html .= '			<td>Total: </td>';
		$html .= '			<td>R$ 24,55</td>';
		$html .= '		</tr>';
		$html .= '		<tr  style="background-color: #fff;">';
		$html .= '			<td>Desconto: </td>';
		$html .= '			<td>R$ 4,55</td>';
		$html .= '		</tr>';
		$html .= '		<tr  style="background-color: #ccc;">';
		$html .= '			<td>Valor a Pagar: </td>';
		$html .= '			<td>R$ 4,55</td>';
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
		$html .= '					<tr>';
		$html .= '						<td>Alicate 14"</td>';
		$html .= '						<td>1</td>';
		$html .= '						<td>R$ 23,00</td>';
		$html .= '					</tr>';
		$html .= '				</table>';
		$html .= '			</td>';
		$html .= '		</tr>';
		$html .= '	</table>';
		$html .= '';
		$html .= '</body>';
		$html .= '</html>';

		return $html;
	}

}