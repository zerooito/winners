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

}
