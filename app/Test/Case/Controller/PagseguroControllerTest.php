<?php

require(APP . 'Controller/AppController.php');
require(APP . 'Controller/PagseguroController.php');

/**
* PagseguroControllerTest
*/
class PagseguroControllerTest extends PHPUnit_Framework_TestCase
{

	protected $pagSeguroController;

	public function setUp()
	{
		$this->pagSeguroController = new PagseguroController;
		parent::setUp();
	}

	public function testFinalizarPedido()
	{
		$this->pagSeguroController->setToken('25AB84E7DE7647848D0819210140F79D');
        
        $this->pagSeguroController->setEmail('winnersdevelopers@gmail.com');
        
        $produto = array(
            0 => array(
                'Produto' => array(
                    'id' => 23,
                    'nome' => 'Produto Teste',
                    'variacao' => 'M',
                    'quantidade' => 1.00,
                    'preco' => 2.44
                )
            )
        );

        $this->pagSeguroController->setProdutos($produto);

        $this->pagSeguroController->adicionarProdutosGateway();

        $endereco = array(
            'cep' => '07252-000',
            'endereco' => 'Avenida do Contorno',
            'numero' => 19,
            'complemento' => 'Viela',
            'bairro' => 'Nova cidade',
            'cidade' => 'Guarulhos',
            'estado' => 'SP'
        );

        $this->pagSeguroController->setEndereco($endereco);

        $cliente = array(
            'nome' => 'Reginaldo Junior',
            'email' => 'jr.design_2010@hotmail.com',
            'ddd' => '11',
            'telefone' => '946640932',
            'cpf' => '43944409843'
        );

        $this->pagSeguroController->setCliente($cliente);

        $this->pagSeguroController->setReference('#2324');

        $this->pagSeguroController->setValorFrete(23.44);

        $url = $this->pagSeguroController->finalizarPedido();

        $this->assertContains('http', $url);
	}

}
    