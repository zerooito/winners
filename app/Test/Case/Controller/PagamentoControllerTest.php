<?php


require(APP . 'Controller/AppController.php');
require(APP . 'Controller/PagamentoController.php');

/**
* PagamentoControllerTest
*/
class PagamentoControllerTest extends PHPUnit_Framework_TestCase
{
    protected $pagamento;

    public function testInstanciaClassePagamentoComPagSeguro()
    {
    	$this->pagamento = new PagamentoController('PagseguroController');
    }

    public function testSetAndGetTokenPagSeguro()
    {
    	$this->pagamento = new PagamentoController('PagseguroController');

        $this->pagamento->setToken('25AB84E7DE7647848D0819210140F79D');

        $this->assertEquals('25AB84E7DE7647848D0819210140F79D', $this->pagamento->getToken());
    }

    public function testSetAndGetEmailPagSeguro()
    {
        $this->pagamento = new PagamentoController('PagseguroController');

        $this->pagamento->setEmail('winnersdevelopers@gmail.com');

        $this->assertEquals('winnersdevelopers@gmail.com', $this->pagamento->getEmail());
    }

    public function testSetOneNewProductInListPagSeguro()
    {
        $this->pagamento = new PagamentoController('PagseguroController');

        $produto = array(
            0 => array(
                'Produto' => array(
                    'id' => 23,
                    'nome' => 'Produto Teste',
                    'variacao' => 'M',
                    'quantidade' => 2,
                    'preco' => 2.44
                )
            )
        );

        $this->pagamento->setProdutos($produto);
        $this->assertEquals($produto, $this->pagamento->adicionarProdutosGateway());
    }

    public function testSetAndressFromClientPagseguro()
    {
        $this->pagamento = new PagamentoController('PagseguroController');

        $endereco = array(
            'cep' => '07252-000',
            'endereco' => 'Avenida do Contorno',
            'numero' => 19,
            'complemento' => 'Viela',
            'bairro' => 'Nova cidade',
            'cidade' => 'Guarulhos',
            'estado' => 'SP'
        );

        $this->pagamento->setEndereco($endereco);
        $this->assertEquals($endereco, $this->pagamento->getEndereco());
    }

    public function testSetCliente()
    {
        $this->pagamento = new PagamentoController('PagseguroController');

        $cliente = array(
            'nome' => 'Reginaldo Junior',
            'email' => 'jr.design_2010@hotmail.com',
            'ddd' => '11',
            'telefone' => '946640932',
            'cpf' => '43944409843'
        );

        $this->pagamento->setCliente($cliente);
        $this->assertEquals($cliente, $this->pagamento->setClienteGateway());
    }

    public function testPedido()
    {
        $this->pagamento = new PagamentoController('PagseguroController');   

        $this->pagamento->setToken('25AB84E7DE7647848D0819210140F79D');
        $this->pagamento->setEmail('winnersdevelopers@gmail.com');
        
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
        $this->pagamento->setProdutos($produto);
        $this->pagamento->adicionarProdutosGateway();

        $endereco = array(
            'cep' => '07252-000',
            'endereco' => 'Avenida do Contorno',
            'numero' => 19,
            'complemento' => 'Viela',
            'bairro' => 'Nova cidade',
            'cidade' => 'Guarulhos',
            'estado' => 'SP'
        );
        $this->pagamento->setEndereco($endereco);


        $cliente = array(
            'nome' => 'Reginaldo Junior',
            'email' => 'jr.design_2010@hotmail.com',
            'ddd' => '11',
            'telefone' => '946640932',
            'cpf' => '43944409843'
        );
        $this->pagamento->setCliente($cliente);

        $this->pagamento->setReference('#2324');
        $this->pagamento->setValorFrete(23.44);

        // $this->pagamento->finalizarPedido();
    }
}