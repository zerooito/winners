<?php

require(APP . 'Controller/AppController.php');
require(APP . 'Controller/LojaController.php');

/**
* 
*/
class LojaControllerTest extends PHPUnit_Framework_TestCase
{
	protected $Loja;

	public function testCreateClienteByLojaController()
	{
		$this->Loja = new LojaController;
		
		$data = array(
				'nome1' => 'reginaldo',
				'nome2' => 'luis',
				'email' => 'regin@naldo.com',
				'documento1' => '123.345.566-89',
				'data_de_nascimento' => '1995-03-10',
				'ativo' => 1,
				'id_usuario' => 23,
				'senha' => 'senha123'
			);


		$result = $this->Loja->saveClientFromEcommerce($data);
		$this->assertEquals(is_numeric($result), true);
	}

	public function testCreateClientByLojaControllerNextCreateAndress()
	{
		$this->Loja = new LojaController;

		$data = array(
			'nome1' => 'reginaldo',
			'nome2' => 'luis',
			'email' => 'regin@naldo.com',
			'documento1' => '123.345.566-89',
			'data_de_nascimento' => '1995-03-10',
			'ativo' => 1,
			'id_usuario' => 23,
			'senha' => 'senha123'
		);

		$result = $this->Loja->saveClientFromEcommerce($data);
		
		$data = array(
			'id_usuario' => 23,
			'id_cliente' => $result,
			'ativo'		 => 1,
			'cep'		 => '07252-000',
			'endereco'   => 'Avenida do Contorno',
			'numero'     => '19b',
			'bairro'	 => 'Nova Cidade',
			'cidade'	 => 'Guarulhos',
			'uf' 		 => 'SP'
		);

		$result = $this->Loja->saveAndressClientFromEcommerce($data);

		$this->assertEquals(is_array($result), true);
	}
}