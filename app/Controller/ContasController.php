<?php 

class ContasController extends AppController {

	public function adicionar_conta() {
		$this->loadModel('Contas');

		if (!$this->PermissoesHelper->usuario_possui_permissao_para('financeiro', 'write')) {
			$this->Session->setFlash('Você não possui acesso a esta área do sistema');
			return $this->redirect('/dashboard/home');
		}

		$dados = $this->request->data('dados');

		$dados['ativo']      = 1;
		$dados['saldo'] = str_replace(',', '', $dados['saldo']);
		$dados['usuario_id'] = $this->instancia;

		if ($this->Contas->save($dados)) {
			$this->Session->setFlash('Conta criada com Sucesso!','default','good');
            return $this->redirect('/usuario/contas');
		} else {
			$this->Session->setFlash('Erro ao criar a conta!','default','good');
            return $this->redirect('/usuario/contas');
		}
	}

	public function depositar() 
	{
		$this->loadModel('Contas');
		$this->loadModel('ExtratoContas');

		if (!$this->PermissoesHelper->usuario_possui_permissao_para('financeiro', 'write')) {
			$this->Session->setFlash('Você não possui acesso a esta área do sistema');
			return $this->redirect('/dashboard/home');
		}
		
		$dados = $this->request->data('dados');
		if ($dados['acao'] == 'depositar') {
			$valor = str_replace(',', '', $dados['valor']);
		} else {
			$valor = -str_replace(',', '', $dados['valor']);
		}

		$extrato_conta = [
			'usuario_id' => $this->instancia,
			'valor' => $valor,
			'descricao' => $dados['descricao'],
			'conta_id' => $dados['conta_id'],
			'ativo' => 1,
		];

		$this->ExtratoContas->save($extrato_conta);

		$conta = $this->Contas->find('first', array(
			'conditions' => array(
				'id' => $dados['conta_id']
			)
		));
		
		$this->Contas->id = $conta['Contas']['id'];

		if ($this->Contas->save(['saldo' => $conta['Contas']['saldo'] + $valor])) {
			$this->Session->setFlash('Deposito/Retirada feito com Sucesso!','default','good');
            return $this->redirect('/usuario/contas');
		} else {
			$this->Session->setFlash('Erro ao depositar/retirar na conta!','default','good');
            return $this->redirect('/usuario/contas');
		}
	}

	public function extrato($id)
	{
		$this->layout = 'wadmin';

		$this->loadModel('ExtratoContas');
		$this->loadModel('Contas');
		$this->loadModel('LancamentoVenda');

		$conditions = array(
			'conditions' => array(
				'ExtratoContas.ativo' => 1,
				'ExtratoContas.usuario_id' => $this->instancia,
				'Contas.id' => $id
			),
			'joins' => array(
			    array(
			        'table' => 'contas',
			        'alias' => 'Contas',
			        'type' => 'LEFT',
			        'conditions' => array(
			            'ExtratoContas.conta_id = Contas.id',
			        ),
			    ),
			    array(
			        'table' => 'lancamento_vendas',
			        'alias' => 'LancamentoVenda',
			        'type' => 'LEFT',
			        'conditions' => array(
			            'ExtratoContas.financeiro_id = LancamentoVenda.id',
			        ),
			    ),
			),
			'fields' => array(
				'LancamentoVenda.*', 'Contas.*', 'ExtratoContas.*'
			),
			'limit' => 100,
			'order' => array('ExtratoContas.id' => 'desc')
		);

		$extrato_contas = $this->ExtratoContas->find('all', $conditions);

		$this->set('extrato_contas', $extrato_contas);
	}

}
