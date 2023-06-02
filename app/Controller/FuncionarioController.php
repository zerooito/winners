<?php

require_once(ROOT . DS . 'vendor' . DS . 'autoload.php');

use Dompdf\Dompdf;

require 'HieraquiaController.php';
require 'FinanceiroController.php';

class FuncionarioController extends AppController{
	function home() {
		if (!$this->PermissoesHelper->usuario_possui_permissao_para('funcionario', 'read')) {
			$this->Session->setFlash('Você não possui acesso a esta área do sistema');
			return $this->redirect('/dashboard/home');
		}

		$this->layout = 'wadmin';
	}

	function adicionar_funcionario() {
		if (!$this->PermissoesHelper->usuario_possui_permissao_para('funcionario', 'write')) {
			$this->Session->setFlash('Você não possui acesso a esta área do sistema');
			return $this->redirect('/funcionario/listar_cadastros');
		}

		$this->loadModel('Hieraquia');
		$hieraquias = $this->Hieraquia->find('all',
			array('conditions' => 
				array(
					'id_usuario' => $this->instancia
				)
			)
		);

		$this->set('hieraquias', $hieraquias);

		$this->layout = 'wadmin';
	}

	function s_adicionar_funcionario() {
		if (!$this->PermissoesHelper->usuario_possui_permissao_para('funcionario', 'write')) {
			$this->Session->setFlash('Você não possui acesso a esta área do sistema');
			return $this->redirect('/funcionario/listar_cadastros');
		}

		$subusuario = $this->request->data('subusuario');

		if ($this->verificar_email($subusuario['email'])) {
			$this->Session->setFlash('E-mail já está sendo utilizado no sistema, utilize outro acesso.');
			return $this->redirect('/funcionario/adicionar_funcionario');
		}

		$hieraquiaController = new HieraquiaController;
		$subusuario_resposta = $hieraquiaController->salvar_subusuario($subusuario, $this->instancia);

		$dados = $this->request->data('dados');
		$dados['ativo'] = 1;
		$dados['usuario_id'] = $this->instancia;
		$dados['salario'] = str_replace(',', '', $dados['salario']);
		$dados['subusuario_id'] = $subusuario_resposta['Usuario']['subusuario_id'];
		$dados['data_nascimento'] = date('y-m-d', strtotime($dados['data_nascimento']));

		if ($this->Funcionario->save($dados)) {
			$this->Session->setFlash('Funcionário salvo com sucesso!');
            return $this->redirect('/funcionario/listar_cadastros');
		} else {
			$this->Session->setFlash('Ocorreu um erro ao salva o funcionario!');
            return $this->redirect('/funcionario/listar_cadastros');
		}
	}

	function excluir_funcionario() {
		if (!$this->PermissoesHelper->usuario_possui_permissao_para('funcionario', 'write')) {
			$this->Session->setFlash('Você não possui acesso a esta área do sistema');
			echo json_encode(false);
			return;
		}

		$this->layout = 'ajax';

		$id = $this->request->data('id');

		$dados = array ('ativo' => '0');
		$parametros = array ('id' => $id);

		if ($this->Funcionario->updateAll($dados,$parametros)) {
			echo json_encode(true);
		} else {
			echo json_encode(false);
		}
	}

	function listar_cadastros() {
		if (!$this->PermissoesHelper->usuario_possui_permissao_para('funcionario', 'read')) {
			$this->Session->setFlash('Você não possui acesso a esta área do sistema');
			return $this->redirect('/dashboard/home');
		}

		$this->layout = 'wadmin';

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
	        'conditions' => array('Funcionario.usuario_id' => $this->instancia, 'Funcionario.ativo' => 1),
	        'fields' => array('Usuario.*, Funcionario.*, SubUsuario.*'),
		);

		$funcionarios = $this->Funcionario->find('all', $query);

		$this->set('funcionarios', $funcionarios);
	}

	function editar_funcionario() {
		if (!$this->PermissoesHelper->usuario_possui_permissao_para('funcionario', 'write')) {
			$this->Session->setFlash('Você não possui acesso a esta área do sistema');
			return $this->redirect('/funcionario/listar_cadastros');
		}

		$this->layout = 'wadmin';
		$id = $this->params->pass[0];

		$this->set('funcionario', $this->Funcionario->find('all', 
				array('conditions' => 
					array('ativo' => 1,
						  'id' => $id
					)
				)
			)
		);
	}

	function s_editar_funcionario() {
		if (!$this->PermissoesHelper->usuario_possui_permissao_para('funcionario', 'write')) {
			$this->Session->setFlash('Você não possui acesso a esta área do sistema');
			return $this->redirect('/funcionario/listar_cadastros');
		}

		$dados = $this->request->data('dados');
		$this->Funcionario->id = $this->request->data('id');

		if ($this->Funcionario->save($dados)) {
			$this->Session->setFlash('Cliente editado com sucesso!');
            return $this->redirect('/funcionario/listar_cadastros');
		} else {
			$this->Session->setFlash('Ocorreu um erro ao editar o cliente!');
            return $this->redirect('/funcionario/listar_cadastros');
		}
	}		

	function exportar_funcionarios() {
		if (!$this->PermissoesHelper->usuario_possui_permissao_para('funcionario', 'read')) {
			$this->Session->setFlash('Você não possui acesso a esta área do sistema');
			return $this->redirect('/funcionario/listar_cadastros');
		}

        $this->layout = 'ajax'; 
        $this->set('event', $this->Funcionario->find('all')); 
	}

	function listar_pedidos($id) {
		if (!$this->PermissoesHelper->usuario_possui_permissao_para('venda', 'read')) {
			$this->Session->setFlash('Você não possui acesso a esta área do sistema');
			return $this->redirect('/funcionario/listar_cadastros');
		}

		$this->layout = 'wadmin';

		$this->loadModel('Venda');
		$this->loadModel('PagamentoFuncionario');
		$vendas = $this->Venda->find('all', array(
				'conditions' => array(
					'Venda.funcionario_id' => $id
				)
			)
		);

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
	        'conditions' => array(
				'Funcionario.usuario_id' => $this->instancia,
				'Funcionario.id' => $id,
				'Funcionario.ativo' => 1
			),
	        'fields' => array('Usuario.*, Funcionario.*, SubUsuario.*'),
		);

		$funcionario = $this->Funcionario->find('first', $query);

		$pagamento_funcionario = $this->PagamentoFuncionario->find('all', array(
			'conditions' => array(
				'PagamentoFuncionario.funcionario_id' => $id,
				'PagamentoFuncionario.ativo' => 1
			)
		));

		$this->set('funcionario', $funcionario);
		$this->set('vendas', $vendas);
		$this->set('ultimo_pagamento', array_reverse($pagamento_funcionario));
	}

	public function pdf($pagamentoFuncionarioId)
	{
		if (!$this->PermissoesHelper->usuario_possui_permissao_para('orcamento', 'read')) {
			$this->Session->setFlash('Você não possui acesso a esta área do sistema');
			return $this->redirect('/orcamento/listar_cadastros');
		}

		$this->loadModel('Venda');
		$this->loadModel('PagamentoFuncionario');

		$nome = $this->request->query('nome');

		$dompdf = new Dompdf();

		$pagamentoFuncionario = $this->PagamentoFuncionario->find('first', 
			array('conditions' => array(
					'PagamentoFuncionario.id' => $pagamentoFuncionarioId
				)
			)
		);

		$html = $this->preparar_dados_como_html($pagamentoFuncionario, $nome);

		$dompdf->loadHtml($html);

		$dompdf->set_paper('a4');

		$dompdf->render();

		$dompdf->stream('pagamento-funcionario-' . $pagamentoFuncionario['PagamentoFuncionario']['funcionario_id']);

		exit;
	}

	public function preparar_dados_como_html($pagamentoFuncionario, $nome)
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
		$html .= '				<h2>Pagamento Funcionario #' . $nome . '</h2>';
		$html .= '			</td>';
		$html .= '		</tr> ';
		$html .= '	</table>';
		$html .= '	<br>';
		$html .= '	<table width="100%" valign="center" align="center">';
		$html .= '		<tr  style="background-color: #ccc;">';
		$html .= '			<td>Total Vendas: </td>';
		$html .= '			<td>R$ ' . number_format($pagamentoFuncionario['PagamentoFuncionario']['total_vendas'], 2, ',', '.') . '</td>';
		$html .= '		</tr>';
		$html .= '		<tr  style="background-color: #ccc;">';
		$html .= '			<td>Comissão: </td>';
		$html .= '			<td>R$ ' . number_format($pagamentoFuncionario['PagamentoFuncionario']['comissao'], 2, ',', '.') . '</td>';
		$html .= '		</tr>';
		$html .= '		<tr  style="background-color: #ccc;">';
		$html .= '			<td>Salario: </td>';
		$html .= '			<td>R$ ' . number_format($pagamentoFuncionario['PagamentoFuncionario']['salario'], 2, ',', '.') . '</td>';
		$html .= '		</tr>';
		$html .= '		<tr  style="background-color: #ccc;">';
		$html .= '			<td>Total Pago: </td>';
		$html .= '			<td>R$ ' . number_format($pagamentoFuncionario['PagamentoFuncionario']['total_pago'], 2, ',', '.') . '</td>';
		$html .= '		</tr>';
		$html .= '	</table>';
		$html .= '	<br>';
		$html .= '	<table  width="100%" valign="center" align="center">';
		$html .= '		<tr style="background-color: #cacaca;" align="center">';
		$html .= '			<td>';
		$html .= '				<h2>Vendas</h2>';
		$html .= '			</td>';
		$html .= '		</tr> ';
		$html .= '	</table>';
		$html .= '	<br>';
		$html .= '	<table  width="100%" valign="center" align="center">';
		$html .= '		<tr>';
		$html .= '			<td>';
		$html .= '				<table width="100%" valign="center" align="center">';
		$html .= '					<tr style="background-color: #cacaca;">';
		$html .= '						<td>Venda Id</td>';
		$html .= '						<td>Data</td>';
		$html .= '						<td>Valor</td>';
		$html .= '					</tr>';
		$html .= '';
		$vendas = json_decode($pagamentoFuncionario['PagamentoFuncionario']['vendas']);
		foreach ($vendas as $i => $venda) {
			$html .= '					<tr>';
			$html .= '						<td>#' . $venda->Venda->id . '</td>';
			$html .= '						<td>' . date('d/m/Y', strtotime($venda->Venda->data_venda)) . '</td>';
			$html .= '						<td>R$ ' . number_format($venda->Venda->valor, 2, ',', '.') . '</td>';
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

	public function gerar_pagamento_funcionario()
	{
		$this->layout = 'ajax';

		if (!$this->PermissoesHelper->usuario_possui_permissao_para('funcionario', 'read')) {
			echo json_encode([]);
			return;
		}

		$this->loadModel('PagamentoFuncionario');

		$dados = $this->request->data('dados');
		$dados['vendas'] = json_encode(@$dados['vendas']);
		$dados['ativo'] = 1;
		$dados['data'] = date('Y-m-d');

		if ($this->PagamentoFuncionario->save($dados)) {
			$this->cadastrar_lancamento_financeiro($dados);

			echo json_encode(['status' => true]);
			exit;
		}

		echo json_encode(['status' => false]);
		exit;
	}

	public function cadastrar_lancamento_financeiro($dados)
	{
		$financeiroController = new FinanceiroController;
		
		$categoria = $financeiroController->buscarOuCriarCategoriaDespesaFinanceiro($this->instancia);
		
		$dados = [
			'valor' => $dados['total_pago'],
			'data_pgt' => $dados['data'],
			'valor_pago' => $dados['total_pago'],
			'ativo' => 1,
			'usuario_id' => $this->instancia,
			'lancamento_categoria_id' => $categoria['LancamentoCategoria']['id']
		];
		
		$this->loadModel('LancamentoVenda');

		if ($this->LancamentoVenda->save($dados)) {
			return true;
		}

		return false;
	}

	public function calcular_pagamento()
	{
		$this->layout = 'ajax';

		if (!$this->PermissoesHelper->usuario_possui_permissao_para('funcionario', 'read')) {
			echo json_encode([]);
			return;
		}

		$this->loadModel('Venda');

		$dados = $this->request->data('dados');

		$vendas = $this->Venda->find('all', array(
				'conditions' => array(
					'Venda.funcionario_id' => $dados['funcionario_id'],
					'Venda.data_venda >=' => $dados['from'],
					'Venda.data_venda <=' => $dados['to']
				)
			)
		);

		$funcionario = $this->Funcionario->find('first', array(
				'conditions' => array(
					'Funcionario.id' => $dados['funcionario_id']
				)
			)
		);

		$comissao = $this->calcular_comissao($vendas, $funcionario['Funcionario']['comissao']);
		
		$resposta = [
			'total_vendas' => $comissao['total_vendas'],
			'comissao' => $comissao['comissao'],
			'funcionario_id' => $dados['funcionario_id'],
			'salario' => $funcionario['Funcionario']['salario'],
			'total_pago' => $funcionario['Funcionario']['salario'] + $comissao['comissao'],
			'vendas' => $vendas
		];

		echo json_encode($resposta);
		exit;
	}

	public function calcular_comissao($vendas, $taxaComissao)
	{
		$comissao = 0.00;
		$total = 0.00;

		foreach ($vendas as $venda) {
			$total += $venda['Venda']['valor'];
		}

		$comissao = $total * ($taxaComissao / 100);

		return ['total_vendas' => $total, 'comissao' => $comissao];
	}

	public function carregar_funcionarios($id = null)
	{
		if (!$this->PermissoesHelper->usuario_possui_permissao_para('funcionario', 'read')) {
			echo json_encode([]);
			return;
		}

		$filter = $this->request->query('term');

		$conditions = array('conditions' => array(
				'Cliente.usuario_id' => $this->instancia,
				'Cliente.ativo' => 1
			)
		);

		if (!empty($filter['term'])) {
			$conditions['conditions']['Cliente.nome1 LIKE '] = '%' . $filter['term'] . '%';
		}

		$conditions['limit'] = $this->request->query('page_limit');

		$clientes = $this->Funcionario->find('all', $conditions);

		$response = [];

		$response['results'][0]['id'] = -1;
		$response['results'][0]['text'] = 'Todos';

		$i = 0;
		foreach ($clientes as $cliente) {
			$i++; 
			
			$response['results'][$i]['id'] = $cliente['Cliente']['id'];
			$response['results'][$i]['text'] = $cliente['Cliente']['nome1'] . ' ' . $cliente['Cliente']['nome2'];
		}

		echo json_encode($response);
		exit;
	}

	private function verificar_email($email)
	{
		$this->loadModel('Usuario');

		$resposta = $this->Usuario->find('count',
			array(
				'conditions' => array('Usuario.email' => $email)
			)
		);

		return $resposta > 0 ? true : false;
	}

}