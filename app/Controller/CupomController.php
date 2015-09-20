<?php

class CupomController extends AppController {


	public function listar_cadastros() 
	{
		$cupons = $this->Cupom->find('all', 
			array('conditions' => 
				array('ativo' => 1,
					  'usuario_id' => $this->instancia
				)
			)
		);
		
		$this->set('cupons', $cupons);

		$this->layout = 'wadmin';
	}

	public function adicionar_cupom()
	{
		$this->layout = 'wadmin';
	}

	public function s_adicionar_cupom()
	{
		$dados = $this->request->data('dados');
		$dados['ativo'] = 1;
		$dados['usuario_id'] = $this->instancia;

		if ($this->Cupom->save($dados)) {
			$this->Session->setFlash('Cupom criado com sucesso!');
            return $this->redirect('/cupom/listar_cadastros');
		} else {
			$this->Session->setFlash('Ocorreu algum erro ao criar o cupom!');
            return $this->redirect('/cupom/listar_cadastros');
		}
	}

	public function editar_cupom($id)
	{
		$this->set('cupom', $this->Cupom->find('all', 
				array('conditions' => 
					array(
						'ativo' => 1,
						'usuario_id' => $this->instancia,
						'id' => $id
					)
				)
			)
		);

		$this->layout = 'wadmin';
	}

	public function s_editar_cupom($id)
	{
		$dados = $this->request->data('dados');

		$this->Cupom->id = $id;

		if ($this->Cupom->save($dados)) {
			$this->Session->setFlash('Cupom editado com sucesso!');
            return $this->redirect('/cupom/listar_cadastros');
		} else {
			$this->Session->setFlash('Ocorreu algum erro ao editar o cupom!');
            return $this->redirect('/cupom/listar_cadastros');
		}
	}

	public function excluir_cupom($id)
	{
		$dados['ativo'] = 0;

		$this->Cupom->id = $id;

		if ($this->Cupom->save($dados)) {
			$this->Session->setFlash('Cupom excluido com sucesso!');
            return $this->redirect('/cupom/listar_cadastros');
		} else {
			$this->Session->setFlash('Ocorreu algum erro ao excluir o cupom!');
            return $this->redirect('/cupom/listar_cadastros');
		}
	}


	/**
	* @param nome cupom
	* @param usuario id
	* @return false ou o array com os dados do cupom
	**/
	public function procurar_cupom($nome_cupom, $usuario_id)
	{
		if (empty($nome_cupom) && !isset($nome_cupom))
		{
			return false;
		}

		$cupom = $this->Cupom->find('all',
			array('conditions' => 
				array(
					'ativo'      => 1,
					'usuario_id' => $usuario_id,
					'nome'       => $nome_cupom
				)
			)
		);		
		
		if (empty($cupom))
		{
			return false;
		}

		return $cupom[0];
	}

	/**
	* @param valor original float
	* @return float com o valor final ja considerando o valor do cupom
	**/
	public function calcular_desconto_cupom($valor_original, $valor_desconto_cupom, $tipo_cupom)
	{
		if (empty($valor_original) && !isset($valor_original))
		{
			return false;
		}

		if ($tipo_cupom == 'porcento')
		{
			return $valor_original - (($valor_original * $valor_desconto_cupom) / 100);
		}

		if ($tipo_cupom == 'fixo')
		{
			return $valor_original - $valor_desconto_cupom;
		}

		return (float) $valor_original;
	}

	/**
	* @param $cupom String nome do cupom a ser utilizado
	* @param $valor float com o valor original da venda
	* @return $novo_valor float com o novo valor da venda
	**/
	public function utilizar_cupom($cupom, $valor_original, $usuario_id)
	{
		if (empty($cupom) && !isset($cupom))
		{
			return false;
		}

		$cupom = $this->procurar_cupom($cupom, $usuario_id);
		
		if (!$cupom)
		{
			return false;
		}

		$novo_valor = $this->calcular_desconto_cupom($valor_original, $cupom['Cupom']['valor'], $cupom['Cupom']['tipo']);

		return $novo_valor;
	}
}