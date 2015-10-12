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

        $this->pagamento->setToken('açlksdjflçajsdflkajsdf');

        $this->assertEquals('açlksdjflçajsdflkajsdf', $this->pagamento->getToken());
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

}