<?php

class HieraquiaController extends AppController {

	public function listar_cadastros() {
		$this->loadModel('Hieraquia');
		$dados = $this->Hieraquia->find('all',
			array('conditions' => 
				array(
					'ativo' => 1,
					'id_usuario' => $this->instancia
				)
			)
		);

		$this->set('hieraquias', $dados);
		$this->layout = 'wadmin';
	}

	public function adicionar_hieraquia() {
		$this->layout = 'wadmin';
		$this->set('modulos', $this->modulos);
	}

	public function s_adicionar_hieraquia() {
		$this->loadModel('Hieraquia');
		$this->loadModel('HieraquiaModulo');

		$dados = $this->request->data('dados');

		$hieraquia['nome'] = $dados['nome'];
		$hieraquia['id_usuario'] = $this->instancia;
		$hieraquia['ativo'] = 1;

		$hieraquia_salva = $this->Hieraquia->save($hieraquia);

		if (!$hieraquia_salva) {
			$this->Session->setFlash('Ocorreu um erro ao salva o hieraquia!');
            return $this->redirect('/hieraquia/listar_cadastros');
		}

		$relaciona_modulo_hieraquia = [];
		foreach ($dados['modulos'] as $tipo_de_permissao => $modulos) {
			foreach ($modulos as $modulo) {
				$relaciona_modulo_hieraquia[] = [
					'hieraquia_id' => $hieraquia_salva['Hieraquia']['id'],
					'modulo_id' => $modulo,
					'tipo_de_permissao' => $tipo_de_permissao
				];
			}
		}

		$this->HieraquiaModulo->saveMany($relaciona_modulo_hieraquia);

		$this->Session->setFlash('Tudo certo, sua hieraquia foi criada com sucesso!');
		return $this->redirect('/hieraquia/listar_cadastros');
	}
	
	public function listar_subusuarios() {
		$this->loadModel('SubUsuarios');

		$usuarios = $this->SubUsuarios->find('all', 
			array('conditions' => 
				array(
					'id_usuario' => $this->instancia
				)
			)
		);

		$this->layout = 'wadmin';
		$this->set('usuarios', $usuarios);
	}

	public function visualizar($id)
	{
		$this->loadModel('Hieraquia');
		$this->loadModel('HieraquiaModulo');

		$hieraquia = $this->HieraquiaModulo->find('all',
						array('conditions' => 
							array(
								'hieraquia_id' => $id
							)
						)
					);

		$this->layout = 'wadmin';
		$this->set('hieraquia', $hieraquia);
	}

	public function adicionar_subusuario()
	{
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

}