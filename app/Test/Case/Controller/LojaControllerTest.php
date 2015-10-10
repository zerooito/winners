<?php

require(APP . 'Controller/LojaController.php');

/**
* 
*/
class LojaControllerTest extends ControllerTestCase
{

    public $controllers = array('app.loja');

	protected $Loja;

	public function setUp()
	{
		$this->Loja = new LojaController;
	}

	/**
	* @test create cliente
	**/
	public function testCreateClienteByLojaController()
	{
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