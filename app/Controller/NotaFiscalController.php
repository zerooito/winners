<?php

class NotaFiscalController extends AppController {

	protected $apiEndpoint = 'https://platform.notaas.com.br/api/v1';

	public function configuracoes() {
		if (!$this->PermissoesHelper->usuario_possui_permissao_para('nota_fiscal', 'write')) {
			$this->Session->setFlash('Voce nao possui acesso a esta area do sistema');
			return $this->redirect('/dashboard/home');
		}

		$this->loadModel('NotaFiscalConfiguracao');

		$config = $this->NotaFiscalConfiguracao->find('first', array(
			'conditions' => array(
				'NotaFiscalConfiguracao.usuario_id' => $this->instancia,
				'NotaFiscalConfiguracao.ativo' => 1
			)
		));

		$this->set('configuracao', $config);
		$this->layout = 'wadmin';
	}

	public function salvar_configuracoes() {
		if (!$this->PermissoesHelper->usuario_possui_permissao_para('nota_fiscal', 'write')) {
			$this->Session->setFlash('Voce nao possui acesso a esta area do sistema');
			return $this->redirect('/dashboard/home');
		}

		$this->loadModel('NotaFiscalConfiguracao');

		$api_key = $this->request->data('api_key');

		$exist = $this->NotaFiscalConfiguracao->find('first', array(
			'conditions' => array(
				'NotaFiscalConfiguracao.usuario_id' => $this->instancia
			)
		));

		$data = array(
			'api_key' => $api_key,
			'usuario_id' => $this->instancia,
			'ativo' => 1
		);

		if (!empty($exist)) {
			$this->NotaFiscalConfiguracao->id = $exist['NotaFiscalConfiguracao']['id'];
		}

		if (!$this->NotaFiscalConfiguracao->save($data)) {
			$this->Session->setFlash('Erro ao salvar configuracoes!');
			return $this->redirect('/nota_fiscal/configuracoes');
		}

		$this->Session->setFlash('Configuracoes salvas com sucesso!');
		return $this->redirect('/nota_fiscal/configuracoes');
	}

	public function listar_cadastros() {
		if (!$this->PermissoesHelper->usuario_possui_permissao_para('nota_fiscal', 'read')) {
			$this->Session->setFlash('Voce nao possui acesso a esta area do sistema');
			return $this->redirect('/dashboard/home');
		}

		$this->layout = 'wadmin';
	}

	public function listar_cadastros_ajax() {
		$this->layout = 'ajax';

		$aColumns = array('id', 'modelo', 'numero_nf', 'destinatario', 'valor_total', 'status', 'data_emissao', 'actions');

		$this->loadModel('NotaFiscal');

		$conditions = array(
			'fields' => array(
				'NotaFiscal.id', 'NotaFiscal.modelo', 'NotaFiscal.numero_nf',
				'NotaFiscal.nome_destinatario', 'NotaFiscal.valor_total',
				'NotaFiscal.status', 'NotaFiscal.data_emissao', 'NotaFiscal.invoice_id'
			),
			'conditions' => array(
				'NotaFiscal.ativo' => 1,
				'NotaFiscal.id_usuario' => $this->instancia
			),
			'order' => array('NotaFiscal.id DESC')
		);

		$total = $this->NotaFiscal->find('count', $conditions);

		if (isset($_GET['iDisplayStart']) && $_GET['iDisplayLength'] != '-1') {
			$conditions['offset'] = $_GET['iDisplayStart'];
			$conditions['limit'] = $_GET['iDisplayLength'];
		}

		if (isset($_GET['iSortCol_0'])) {
			for ($i = 0; $i < intval($_GET['iSortingCols']); $i++) {
				if ($_GET['bSortable_' . intval($_GET['iSortCol_' . $i])] == "true") {
					$conditions['order'] = array('NotaFiscal.' . $aColumns[intval($_GET['iSortCol_' . $i])] => $_GET['sSortDir_' . $i]);
				}
			}
		}

		if (isset($_GET['sSearch']) && !empty($_GET['sSearch'])) {
			$search = $_GET['sSearch'];
			$conditions['conditions']['OR'] = array(
				'NotaFiscal.numero_nf LIKE' => '%' . $search . '%',
				'NotaFiscal.nome_destinatario LIKE' => '%' . $search . '%',
				'NotaFiscal.chave_acesso LIKE' => '%' . $search . '%'
			);
		}

		$notas = $this->NotaFiscal->find('all', $conditions);

		$output = array(
			"sEcho" => intval($_GET['sEcho']),
			"iTotalDisplayRecords" => $total,
			"iTotalRecords" => count($notas),
			"aaData" => array()
		);

		foreach ($notas as $nota) {
			$row = array();

			$row[] = $nota['NotaFiscal']['id'];
			$row[] = ($nota['NotaFiscal']['modelo'] == 55) ? 'NF-e' : 'NFC-e';
			$row[] = $nota['NotaFiscal']['numero_nf'] ?? '-';
			$row[] = $nota['NotaFiscal']['nome_destinatario'];
			$row[] = 'R$ ' . number_format($nota['NotaFiscal']['valor_total'], 2, ',', '.');

			$statusLabel = $this->statusLabel($nota['NotaFiscal']['status']);
			$row[] = $statusLabel;

			$dataFmt = '-';
			if (!empty($nota['NotaFiscal']['data_emissao'])) {
				$dataFmt = date('d/m/Y H:i', strtotime($nota['NotaFiscal']['data_emissao']));
			}
			$row[] = $dataFmt;

			$actions = '<a href="/nota_fiscal/visualizar_cadastro/' . $nota['NotaFiscal']['id'] . '" class="btn btn-info btn-sm" title="Visualizar"><i class="fas fa-eye"></i></a> ';

			if ($nota['NotaFiscal']['status'] == 'issued') {
				$actions .= '<a href="/nota_fiscal/download_danfe/' . $nota['NotaFiscal']['id'] . '" class="btn btn-success btn-sm" title="Download DANFE" target="_blank"><i class="fas fa-file-pdf"></i></a> ';
				$actions .= '<a href="/nota_fiscal/download_xml/' . $nota['NotaFiscal']['id'] . '" class="btn btn-secondary btn-sm" title="Download XML" target="_blank"><i class="fas fa-file-code"></i></a> ';
			}

			if ($nota['NotaFiscal']['status'] == 'issued' && $this->PermissoesHelper->usuario_possui_permissao_para('nota_fiscal', 'write')) {
				$actions .= '<button onclick="cancelar_nota(' . $nota['NotaFiscal']['id'] . ');" class="btn btn-danger btn-sm" title="Cancelar Nota"><i class="fas fa-times"></i></button> ';
			}

			$row[] = $actions;
			$output['aaData'][] = $row;
		}

		echo json_encode($output);
		exit;
	}

	private function statusLabel($status) {
		$labels = array(
			'queued' => '<span class="badge badge-secondary">Na Fila</span>',
			'processing' => '<span class="badge badge-info">Processando</span>',
			'issued' => '<span class="badge badge-success">Emitida</span>',
			'error' => '<span class="badge badge-danger">Erro</span>',
			'cancelled' => '<span class="badge badge-dark">Cancelada</span>',
			'inutilized' => '<span class="badge badge-warning">Inutilizada</span>'
		);
		return isset($labels[$status]) ? $labels[$status] : '<span class="badge badge-light">' . $status . '</span>';
	}

	public function adicionar_cadastro() {
		if (!$this->PermissoesHelper->usuario_possui_permissao_para('nota_fiscal', 'write')) {
			$this->Session->setFlash('Voce nao possui acesso a esta area do sistema');
			return $this->redirect('/nota_fiscal/listar_cadastros');
		}

		$this->layout = 'wadmin';

		$this->loadModel('Cliente');
		$this->loadModel('Produto');
		$this->loadModel('Venda');

		$this->set('clientes', $this->Cliente->find('all', array(
			'conditions' => array('ativo' => 1, 'id_usuario' => $this->instancia)
		)));

		$this->set('produtos', $this->Produto->find('all', array(
			'conditions' => array('ativo' => 1, 'id_usuario' => $this->instancia)
		)));

		$this->set('vendas', $this->Venda->find('list', array(
			'conditions' => array('ativo' => 1, 'id_usuario' => $this->instancia, 'orcamento' => 0),
			'fields' => array('Venda.id', 'Venda.id')
		)));
	}

	public function buscar_produto_ajax() {
		$this->layout = 'ajax';

		$this->loadModel('Produto');

		$dados = $this->request->data('dados');

		if (empty($dados)) {
			$dados = array('codigo' => $_GET['codigo']);
		}

		$produto = $this->Produto->find('first', array(
			'conditions' => array(
				'Produto.ativo' => 1,
				'Produto.id_usuario' => $this->instancia,
				'OR' => array(
					'Produto.id' => $dados['codigo'],
					'Produto.id_alias' => $dados['codigo'],
					'Produto.sku' => $dados['codigo']
				)
			)
		));

		if (empty($produto)) {
			echo json_encode(array('found' => false));
			return;
		}

		echo json_encode(array('found' => true, 'produto' => $produto));
	}

	public function carregar_cliente_ajax() {
		$this->layout = 'ajax';

		$this->loadModel('Cliente');

		$id = $this->request->data('id');
		if (empty($id)) {
			$id = $_GET['id'];
		}

		$cliente = $this->Cliente->find('first', array(
			'conditions' => array(
				'Cliente.id' => $id,
				'Cliente.ativo' => 1,
				'Cliente.id_usuario' => $this->instancia
			)
		));

		if (empty($cliente)) {
			echo json_encode(array('found' => false));
			return;
		}

		$doc = $cliente['Cliente']['documento1'];
		$doc = preg_replace('/[^0-9]/', '', $doc);

		echo json_encode(array(
			'found' => true,
			'nome' => $cliente['Cliente']['nome1'] . ' ' . $cliente['Cliente']['nome2'],
			'documento' => $doc,
			'email' => $cliente['Cliente']['email']
		));
	}

	public function s_adicionar_cadastro() {
		if (!$this->PermissoesHelper->usuario_possui_permissao_para('nota_fiscal', 'write')) {
			$this->Session->setFlash('Voce nao possui acesso a esta area do sistema');
			return $this->redirect('/nota_fiscal/listar_cadastros');
		}

		$this->loadModel('NotaFiscal');
		$this->loadModel('NotaFiscalItem');
		$this->loadModel('NotaFiscalPagamento');

		$dados = $this->request->data('nota_fiscal');

		$notaData = array(
			'modelo' => intval($dados['modelo']),
			'natureza_operacao' => $dados['natureza_operacao'],
			'destino_operacao' => intval($dados['destino_operacao']),
			'nome_destinatario' => $dados['dest_nome'],
			'logradouro_destinatario' => $dados['dest_logradouro'],
			'numero_destinatario' => !empty($dados['dest_numero']) ? $dados['dest_numero'] : 'SN',
			'bairro_destinatario' => $dados['dest_bairro'],
			'codigo_municipio_destinatario' => intval($dados['dest_codigo_municipio']),
			'cidade_destinatario' => $dados['dest_cidade'],
			'uf_destinatario' => $dados['dest_uf'],
			'cep_destinatario' => preg_replace('/[^0-9]/', '', $dados['dest_cep']),
			'presenca_comprador' => intval($dados['presenca_comprador']),
			'id_usuario' => $this->instancia,
			'ativo' => 1,
			'status' => 'queued',
			'created' => date('Y-m-d H:i:s')
		);

		if (!empty($dados['dest_cpf_cnpj'])) {
			$doc = preg_replace('/[^0-9]/', '', $dados['dest_cpf_cnpj']);
			$notaData['cpf_cnpj_destinatario'] = $doc;
			$notaData['indicador_ie'] = strlen($doc) == 14 ? 1 : 9;
		}

		if (!empty($dados['dest_ie'])) {
			$notaData['ie_destinatario'] = $dados['dest_ie'];
			$notaData['indicador_ie'] = 1;
		}

		if (!empty($dados['dest_email'])) {
			$notaData['email_destinatario'] = $dados['dest_email'];
		}

		if (!empty($dados['cliente_id'])) {
			$notaData['cliente_id'] = intval($dados['cliente_id']);
		}

		if (!empty($dados['venda_id'])) {
			$notaData['venda_id'] = intval($dados['venda_id']);
		}

		if (!empty($dados['informacoes_complementares'])) {
			$notaData['informacoes_complementares'] = $dados['informacoes_complementares'];
		}

		$this->NotaFiscal->create();
		if (!$this->NotaFiscal->save($notaData)) {
			$this->Session->setFlash('Erro ao criar nota fiscal!');
			return $this->redirect('/nota_fiscal/adicionar_cadastro');
		}

		$notaFiscalId = $this->NotaFiscal->id;

		$valorTotalNota = 0;

		$itens = $dados['itens'];
		if (!empty($itens) && is_array($itens)) {
			for ($i = 0; $i < count($itens['descricao']); $i++) {
				if (empty($itens['descricao'][$i])) continue;

				$valorUnit = floatval($itens['valor_unitario'][$i]);
				$qtd = intval($itens['quantidade'][$i]);
				$valorTotal = floatval($itens['valor_total'][$i]);

				if ($valorTotal <= 0) {
					$valorTotal = $valorUnit * $qtd;
				}

				$itemData = array(
					'nota_fiscal_id' => $notaFiscalId,
					'descricao' => $itens['descricao'][$i],
					'ncm' => $itens['ncm'][$i],
					'cfop' => $itens['cfop'][$i],
					'valor_total' => $valorTotal,
					'quantidade' => $qtd,
					'valor_unitario' => $valorUnit > 0 ? $valorUnit : $valorTotal,
					'unidade' => !empty($itens['unidade'][$i]) ? $itens['unidade'][$i] : 'UN',
					'ativo' => 1
				);

				if (!empty($itens['produto_id'][$i])) {
					$itemData['produto_id'] = intval($itens['produto_id'][$i]);
				}

				if (!empty($itens['codigo'][$i])) {
					$itemData['codigo'] = $itens['codigo'][$i];
				}

				if (!empty($itens['cst'][$i])) {
					$itemData['cst'] = $itens['cst'][$i];
				}

				if (!empty($itens['csosn'][$i])) {
					$itemData['csosn'] = $itens['csosn'][$i];
				}

				if (isset($itens['aliquota_icms'][$i]) && $itens['aliquota_icms'][$i] !== '') {
					$itemData['aliquota_icms'] = floatval($itens['aliquota_icms'][$i]);
				}

				$this->NotaFiscalItem->create();
				$this->NotaFiscalItem->save($itemData);

				$valorTotalNota += $valorTotal;
			}
		}

		$pagamentos = $dados['pagamentos'];
		if (!empty($pagamentos) && is_array($pagamentos)) {
			for ($i = 0; $i < count($pagamentos['tipo']); $i++) {
				if (empty($pagamentos['tipo'][$i])) continue;

				$pagData = array(
					'nota_fiscal_id' => $notaFiscalId,
					'tipo_pagamento' => $pagamentos['tipo'][$i],
					'valor' => floatval($pagamentos['valor'][$i]),
					'ativo' => 1
				);

				if (!empty($pagamentos['bandeira'][$i])) {
					$pagData['bandeira'] = $pagamentos['bandeira'][$i];
				}

				$this->NotaFiscalPagamento->create();
				$this->NotaFiscalPagamento->save($pagData);
			}
		}

		$this->NotaFiscal->id = $notaFiscalId;
		$this->NotaFiscal->save(array('valor_total' => $valorTotalNota));

		$result = $this->emitirNotaAs($notaFiscalId);

		if (isset($result->invoiceId)) {
			$this->NotaFiscal->id = $notaFiscalId;
			$this->NotaFiscal->save(array(
				'invoice_id' => $result->invoiceId,
				'data_emissao' => date('Y-m-d H:i:s'),
				'modified' => date('Y-m-d H:i:s')
			));

			$this->Session->setFlash('Nota fiscal enfileirada para emissao! ID: ' . $result->invoiceId);
			return $this->redirect('/nota_fiscal/visualizar_cadastro/' . $notaFiscalId);
		}

		$errMsg = isset($result->error) ? $result->error : 'Erro desconhecido ao enviar nota.';
		$this->NotaFiscal->id = $notaFiscalId;
		$this->NotaFiscal->save(array('status' => 'error', 'x_motivo' => $errMsg));

		$this->Session->setFlash('Nota criada, mas houve erro ao emitir: ' . $errMsg);
		return $this->redirect('/nota_fiscal/visualizar_cadastro/' . $notaFiscalId);
	}

	public function visualizar_cadastro($id = null) {
		if (!$this->PermissoesHelper->usuario_possui_permissao_para('nota_fiscal', 'read')) {
			$this->Session->setFlash('Voce nao possui acesso a esta area do sistema');
			return $this->redirect('/dashboard/home');
		}

		$this->layout = 'wadmin';

		$this->loadModel('NotaFiscal');

		$nota = $this->NotaFiscal->find('first', array(
			'conditions' => array(
				'NotaFiscal.id' => $id,
				'NotaFiscal.id_usuario' => $this->instancia
			),
			'contain' => array('NotaFiscalItem', 'NotaFiscalPagamento', 'Cliente', 'Venda')
		));

		if (empty($nota)) {
			$this->Session->setFlash('Nota fiscal nao encontrada!');
			return $this->redirect('/nota_fiscal/listar_cadastros');
		}

		$this->set('nota', $nota);
	}

	public function verificar_status($id = null) {
		$this->layout = 'ajax';

		$this->loadModel('NotaFiscal');

		$nota = $this->NotaFiscal->find('first', array(
			'conditions' => array(
				'NotaFiscal.id' => $id,
				'NotaFiscal.id_usuario' => $this->instancia
			)
		));

		if (empty($nota) || empty($nota['NotaFiscal']['invoice_id'])) {
			echo json_encode(array('error' => 'Nota nao encontrada ou sem invoice_id'));
			return;
		}

		$result = $this->consultarStatusNotaAs($nota['NotaFiscal']['invoice_id']);

		if (isset($result->status)) {
			$updateData = array('status' => $result->status);

			if (isset($result->nNf)) $updateData['numero_nf'] = $result->nNf;
			if (isset($result->serie)) $updateData['serie'] = $result->serie;
			if (isset($result->chaveAcesso)) $updateData['chave_acesso'] = $result->chaveAcesso;
			if (isset($result->nProt)) $updateData['protocolo'] = $result->nProt;
			if (isset($result->cStat)) $updateData['c_stat'] = $result->cStat;
			if (isset($result->xMotivo)) $updateData['x_motivo'] = $result->xMotivo;
			if (isset($result->vNf)) $updateData['valor_total'] = $result->vNf;

			$this->NotaFiscal->id = $id;
			$this->NotaFiscal->save($updateData);
		}

		echo json_encode($result);
	}

	public function cancelar_nota($id = null) {
		$this->layout = 'ajax';

		if (!$this->PermissoesHelper->usuario_possui_permissao_para('nota_fiscal', 'write')) {
			echo json_encode(array('error' => 'Sem permissao'));
			return;
		}

		$this->loadModel('NotaFiscal');

		$nota = $this->NotaFiscal->find('first', array(
			'conditions' => array(
				'NotaFiscal.id' => $id,
				'NotaFiscal.id_usuario' => $this->instancia
			)
		));

		if (empty($nota) || empty($nota['NotaFiscal']['invoice_id'])) {
			echo json_encode(array('error' => 'Nota nao encontrada'));
			return;
		}

		$motivo = $this->request->data('motivo');
		if (empty($motivo)) {
			$motivo = 'Cancelamento solicitado pelo emitente through API';
		}

		if (strlen($motivo) < 15) {
			$motivo = str_pad($motivo, 15, ' ');
		}

		$result = $this->cancelarNotaAs($nota['NotaFiscal']['invoice_id'], $motivo);

		echo json_encode($result);
	}

	public function download_danfe($id = null) {
		$this->loadModel('NotaFiscal');

		$nota = $this->NotaFiscal->find('first', array(
			'conditions' => array(
				'NotaFiscal.id' => $id,
				'NotaFiscal.id_usuario' => $this->instancia
			)
		));

		if (empty($nota) || empty($nota['NotaFiscal']['invoice_id'])) {
			$this->Session->setFlash('Nota fiscal nao encontrada!');
			return $this->redirect('/nota_fiscal/listar_cadastros');
		}

		$apiKey = $this->loadApiKey();
		if (empty($apiKey)) {
			$this->Session->setFlash('Configure a API key da NotaAs primeiro!');
			return $this->redirect('/nota_fiscal/configuracoes');
		}

		$url = $this->apiEndpoint . '/nfe/invoices/' . $nota['NotaFiscal']['invoice_id'] . '/danfe';

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('x-api-key: ' . $apiKey));
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		$pdf = curl_exec($ch);
		$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);

		if ($httpCode == 200) {
			$this->response->type('pdf');
			$this->response->header('Content-Disposition', 'inline; filename="danfe-' . $id . '.pdf"');
			$this->response->body($pdf);
			return $this->response;
		}

		$this->Session->setFlash('Erro ao baixar DANFE!');
		return $this->redirect('/nota_fiscal/visualizar_cadastro/' . $id);
	}

	public function download_xml($id = null) {
		$this->loadModel('NotaFiscal');

		$nota = $this->NotaFiscal->find('first', array(
			'conditions' => array(
				'NotaFiscal.id' => $id,
				'NotaFiscal.id_usuario' => $this->instancia
			)
		));

		if (empty($nota) || empty($nota['NotaFiscal']['invoice_id'])) {
			$this->Session->setFlash('Nota fiscal nao encontrada!');
			return $this->redirect('/nota_fiscal/listar_cadastros');
		}

		$apiKey = $this->loadApiKey();
		if (empty($apiKey)) {
			$this->Session->setFlash('Configure a API key da NotaAs primeiro!');
			return $this->redirect('/nota_fiscal/configuracoes');
		}

		$url = $this->apiEndpoint . '/nfe/invoices/' . $nota['NotaFiscal']['invoice_id'] . '/xml';

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('x-api-key: ' . $apiKey));
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		$xml = curl_exec($ch);
		$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);

		if ($httpCode == 200) {
			$this->response->type('xml');
			$this->response->header('Content-Disposition', 'attachment; filename="nfe-' . $id . '.xml"');
			$this->response->body($xml);
			return $this->response;
		}

		$this->Session->setFlash('Erro ao baixar XML!');
		return $this->redirect('/nota_fiscal/visualizar_cadastro/' . $id);
	}

	public function excluir_cadastro() {
		if (!$this->PermissoesHelper->usuario_possui_permissao_para('nota_fiscal', 'write')) {
			echo json_encode(array('error' => 'Sem permissao'));
			return;
		}

		$this->loadModel('NotaFiscal');

		$id = $this->request->data('id');

		$this->NotaFiscal->id = $id;
		if ($this->NotaFiscal->save(array('ativo' => 0))) {
			echo json_encode(array('success' => true));
		} else {
			echo json_encode(array('error' => 'Erro ao excluir'));
		}
	}

	private function emitirNotaAs($notaFiscalId) {
		$apiKey = $this->loadApiKey();
		if (empty($apiKey)) {
			return (object) array('error' => 'API key nao configurada. Acesse Configuracoes > Nota Fiscal.');
		}

		$this->loadModel('NotaFiscal');
		$this->loadModel('NotaFiscalItem');
		$this->loadModel('NotaFiscalPagamento');

		$nota = $this->NotaFiscal->findById($notaFiscalId);

		$itens = $this->NotaFiscalItem->find('all', array(
			'conditions' => array('NotaFiscalItem.nota_fiscal_id' => $notaFiscalId, 'NotaFiscalItem.ativo' => 1)
		));

		$pagamentos = $this->NotaFiscalPagamento->find('all', array(
			'conditions' => array('NotaFiscalPagamento.nota_fiscal_id' => $notaFiscalId, 'NotaFiscalPagamento.ativo' => 1)
		));

		$body = array(
			'modelo' => intval($nota['NotaFiscal']['modelo']),
			'naturezaOperacao' => $nota['NotaFiscal']['natureza_operacao'],
			'destinoOperacao' => intval($nota['NotaFiscal']['destino_operacao']),
			'dest' => array(
				'nome' => $nota['NotaFiscal']['nome_destinatario'],
				'endereco' => array(
					'logradouro' => $nota['NotaFiscal']['logradouro_destinatario'],
					'numero' => $nota['NotaFiscal']['numero_destinatario'],
					'bairro' => $nota['NotaFiscal']['bairro_destinatario'],
					'codigoMunicipio' => intval($nota['NotaFiscal']['codigo_municipio_destinatario']),
					'cidade' => $nota['NotaFiscal']['cidade_destinatario'],
					'uf' => $nota['NotaFiscal']['uf_destinatario'],
					'cep' => $nota['NotaFiscal']['cep_destinatario']
				)
			),
			'presencaComprador' => intval($nota['NotaFiscal']['presenca_comprador']),
			'items' => array(),
			'pagamentos' => array()
		);

		if (!empty($nota['NotaFiscal']['cpf_cnpj_destinatario'])) {
			$doc = $nota['NotaFiscal']['cpf_cnpj_destinatario'];
			if (strlen($doc) == 14) {
				$body['dest']['cnpj'] = $doc;
			} else {
				$body['dest']['cpf'] = $doc;
			}
		}

		if (!empty($nota['NotaFiscal']['ie_destinatario'])) {
			$body['dest']['ie'] = $nota['NotaFiscal']['ie_destinatario'];
		} else {
			$body['dest']['indicadorIE'] = intval($nota['NotaFiscal']['indicador_ie']);
		}

		if (!empty($nota['NotaFiscal']['email_destinatario'])) {
			$body['dest']['email'] = $nota['NotaFiscal']['email_destinatario'];
		}

		if (!empty($nota['NotaFiscal']['informacoes_complementares'])) {
			$body['infCpl'] = $nota['NotaFiscal']['informacoes_complementares'];
		}

		foreach ($itens as $item) {
			$BODYitem = array(
				'descricao' => $item['NotaFiscalItem']['descricao'],
				'ncm' => $item['NotaFiscalItem']['ncm'],
				'cfop' => $item['NotaFiscalItem']['cfop'],
				'valorTotal' => floatval($item['NotaFiscalItem']['valor_total']),
				'quantidade' => intval($item['NotaFiscalItem']['quantidade']),
				'valorUnitario' => floatval($item['NotaFiscalItem']['valor_unitario']),
				'unidade' => $item['NotaFiscalItem']['unidade']
			);

			if (!empty($item['NotaFiscalItem']['codigo'])) {
				$BODYitem['codigo'] = $item['NotaFiscalItem']['codigo'];
			}

			if (!empty($item['NotaFiscalItem']['cst'])) {
				$BODYitem['cst'] = $item['NotaFiscalItem']['cst'];
			}

			if (!empty($item['NotaFiscalItem']['csosn'])) {
				$BODYitem['csosn'] = $item['NotaFiscalItem']['csosn'];
			}

			if (isset($item['NotaFiscalItem']['aliquota_icms']) && $item['NotaFiscalItem']['aliquota_icms'] !== null) {
				$BODYitem['aliquotaIcms'] = floatval($item['NotaFiscalItem']['aliquota_icms']);
			}

			if (!empty($item['NotaFiscalItem']['ean'])) {
				$BODYitem['ean'] = $item['NotaFiscalItem']['ean'];
			}

			$body['items'][] = $BODYitem;
		}

		foreach ($pagamentos as $pag) {
			$body['pagamentos'][] = array(
				'tipoPagamento' => $pag['NotaFiscalPagamento']['tipo_pagamento'],
				'valor' => floatval($pag['NotaFiscalPagamento']['valor'])
			);
		}

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $this->apiEndpoint . '/nfe/emitir');
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($body));
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'Content-Type: application/json',
			'x-api-key: ' . $apiKey
		));

		$response = curl_exec($ch);
		$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);

		$result = json_decode($response);

		if ($httpCode == 202 && isset($result->invoiceId)) {
			return $result;
		}

		$errMsg = isset($result->error) ? $result->error : 'HTTP ' . $httpCode;
		if (isset($result->message)) $errMsg .= ' - ' . $result->message;

		return (object) array('error' => $errMsg);
	}

	private function consultarStatusNotaAs($invoiceId) {
		$apiKey = $this->loadApiKey();
		if (empty($apiKey)) {
			return (object) array('error' => 'API key nao configurada');
		}

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $this->apiEndpoint . '/nfe/invoices/' . $invoiceId . '/status');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('x-api-key: ' . $apiKey));

		$response = curl_exec($ch);
		curl_close($ch);

		return json_decode($response);
	}

	private function cancelarNotaAs($invoiceId, $motivo) {
		$apiKey = $this->loadApiKey();
		if (empty($apiKey)) {
			return (object) array('error' => 'API key nao configurada');
		}

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $this->apiEndpoint . '/nfe/cancelar');
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(array(
			'invoiceId' => $invoiceId,
			'motivo' => $motivo
		)));
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'Content-Type: application/json',
			'x-api-key: ' . $apiKey
		));

		$response = curl_exec($ch);
		curl_close($ch);

		$result = json_decode($response);

		if (isset($result->invoiceId)) {
			$this->loadModel('NotaFiscal');
			$nota = $this->NotaFiscal->find('first', array(
				'conditions' => array('NotaFiscal.invoice_id' => $invoiceId)
			));
			if (!empty($nota)) {
				$this->NotaFiscal->id = $nota['NotaFiscal']['id'];
				$this->NotaFiscal->save(array('status' => 'cancelled'));
			}
		}

		return $result;
	}

	private function loadApiKey() {
		$this->loadModel('NotaFiscalConfiguracao');

		$config = $this->NotaFiscalConfiguracao->find('first', array(
			'conditions' => array(
				'NotaFiscalConfiguracao.usuario_id' => $this->instancia,
				'NotaFiscalConfiguracao.ativo' => 1
			)
		));

		if (!empty($config)) {
			return $config['NotaFiscalConfiguracao']['api_key'];
		}

		return null;
	}
}
