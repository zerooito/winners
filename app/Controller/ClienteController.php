<?php

require 'AsaasController.php';

class ClienteController extends AppController{	
	// public $helpers = array('Excel');

	function home() {
		$this->layout = 'wadmin';
	}

	function adicionar_cliente() {
		$this->layout = 'wadmin';
	}

	function s_adicionar_cliente() {
		$dados = $this->request->data('dados');
		$dados['ativo'] = 1;
		$dados['id_usuario'] = $this->instancia;
		$dados['data_de_nascimento'] = date('y-m-d', strtotime($dados['data_de_nascimento']));
		$dados['senha'] = md5(uniqid());

		$endereco = $this->request->data('endereco');
		$endereco['uf'] = $endereco['estado'];

		unset($endereco['estado']);
		
		//falta fazer o cadastro e relacionamento dos dados de endereco

		if ($this->Cliente->save($dados)) {
			$endereco['id_usuario'] = $this->instancia;
			$endereco['id_cliente'] = $this->Cliente->id;
			$endereco['ativo']		= 1;

			$this->loadModel('EnderecoClienteCadastro');
			$this->EnderecoClienteCadastro->save($endereco);

			$this->Session->setFlash('Cliente salvo com sucesso!');
            return $this->redirect('/cliente/listar_cadastros');
		} else {
			$this->Session->setFlash('Ocorreu um erro ao salva o cliente!');
            return $this->redirect('/cliente/listar_cadastros');
		}
	}

	function excluir_cliente() {
		$this->layout = 'ajax';

		$id = $this->request->data('id');

		$dados = array ('ativo' => '0');
		$parametros = array ('id' => $id);

		if ($this->Cliente->updateAll($dados,$parametros)) {
			echo json_encode(true);
		} else {
			echo json_encode(false);
		}
	}

	function listar_cadastros() {
		$this->layout = 'wadmin';

		$this->set('clientes', $this->Cliente->find('all', 
				array('conditions' => 
					array('ativo' => 1,
						  'id_usuario' => $this->instancia
					)
				)
			)
		);
	}

	function editar_cliente() {
		$this->layout = 'wadmin';
		$id = $this->params->pass[0];

		$this->set('cliente', $this->Cliente->find('all', 
				array('conditions' => 
					array('ativo' => 1,
						  'id' => $id
					)
				)
			)
		);
	}

	function s_editar_cliente() {
		$dados = $this->request->data('dados');
		$this->Cliente->id = $this->request->data('id');

		if ($this->Cliente->save($dados)) {
			$this->Session->setFlash('Cliente editado com sucesso!');
            return $this->redirect('/cliente/listar_cadastros');
		} else {
			$this->Session->setFlash('Ocorreu um erro ao editar o cliente!');
            return $this->redirect('/cliente/listar_cadastros');
		}
	}		

	function exportar_clientes() {
        $this->layout = 'ajax'; 
        $this->set('event', $this->Cliente->find('all')); 
	}

	function listar_pedidos($id) {
		$this->layout = 'wadmin';

		$this->loadModel('Venda');
		$this->loadModel('LancamentoVenda');

		$vendas = $this->Venda->find('all', array(
				'conditions' => array(
					'Venda.cliente_id' => $id
				)
			)
		);

		$total = 0;
		$devendo = 0;
		foreach ($vendas as $i => $venda) {
			$lancamento = $this->LancamentoVenda->find('first', array(
					'conditions' => array(
						'LancamentoVenda.venda_id' => $venda['Venda']['id']
					)
				)
			);

			if (!isset($lancamento['LancamentoVenda'])) {
				unset($vendas[$i]);
				continue;
			}

			$vendas[$i]['LancamentoVenda'] = $lancamento['LancamentoVenda'];

			if ($lancamento['LancamentoVenda']['valor'] == $lancamento['LancamentoVenda']['valor_pago']) {
				$total += $lancamento['LancamentoVenda']['valor_pago'];
			} else {
				$devendo += $lancamento['LancamentoVenda']['valor'];
			}
		}
		
		$cliente = $this->Cliente->find('first', array(
				'conditions' => array(
					'Cliente.id' => $id
				)
			)
		);

		$this->set('cliente', $cliente);
		$this->set('vendas', $vendas);
		$this->set('total', $total);
		$this->set('devendo', $devendo);
	}

	function emitir_boleto($venda_id) {
		$AsaasController = new AsaasController;

		$this->loadModel('Venda');

		$venda = $this->Venda->find('first', array(
				'conditions' => array(
					'Venda.id' => $venda_id
				)
			)
		);

		$this->loadModel('Cliente');

		$cliente = $this->Cliente->find('first', array(
				'conditions' => array(
					'Cliente.id' => $venda['Venda']['cliente_id']
				)
			)
		);

		if (empty($cliente['Cliente']['asaas_id'])) {
			$cliente_data = array(
				"name" => $cliente['Cliente']['nome1'] . ' ' . $cliente['Cliente']['nome2'],
				"email" => $cliente['Cliente']['email'],
				"cpfCnpj" => $cliente['Cliente']['documento1'],
				"externalReference" => $cliente['Cliente']['id']
			);
			
			$response = $AsaasController->criar_cliente($cliente_data);

			$asaas_id = $response->id;

			$this->Cliente->id = $cliente['Cliente']['id'];
			$this->Cliente->save(['asaas_id' => $asaas_id]);
		} else {
			$asaas_id = $cliente['Cliente']['asaas_id'];
		}

		$venda = array(
			"customer" => $asaas_id,
			"billingType" => "BOLETO",
			"dueDate" => date('Y-m-d'),
			"value" => $venda['Venda']['valor'],
			"description" => "Boleto referente a venda no sistema winners REFº " . $venda['Venda']['id'],
			"externalReference" => $venda['Venda']['id']
		);

		$response = $AsaasController->criar_cobranca($venda);
		
		if (isset($response->errors)) {
			foreach ($response->errors as $i => $error) {
				$this->Session->setFlash($error->description);
			}

			return $this->redirect('/cliente/listar_pedidos/' . $cliente['Cliente']['id']);
		}

		$this->Venda->id = $venda_id;
		
		$data = [
			'asaas_boleto' => $response->bankSlipUrl,
			'asaas_status' => $response->status,
			'asaas_transaction_id' => $response->id
		];

		if (!$this->Venda->save($data)) {
			$this->Session->setFlash('Erro ao emitir cobrança!');
            return $this->redirect('/cliente/listar_pedidos/' . $cliente['Cliente']['id']);
		}

		$this->Session->setFlash('Cobrança emitida com sucesso!');
        return $this->redirect('/cliente/listar_pedidos/' . $cliente['Cliente']['id']);
	}

}