<?php


require(APP . 'Controller/AppController.php');
require(APP . 'Controller/PagamentoController.php');

/**
* PagamentoControllerTest
*/
class PagamentoControllerTest extends PHPUnit_Framework_TestCase
{
    protected $pagamento;

    public function testInstanciaClassePagamentoComPagseguro()
    {
    	$this->pagamento = new PagamentoController('PagseguroController');
    }

    public function testSetAndGetTokenPagseguro()
    {
    	$this->pagamento = new PagamentoController('PagseguroController');

        $this->pagamento->setToken('açlksdjflçajsdflkajsdf');

        $this->assertEquals('açlksdjflçajsdflkajsdf', $this->pagamento->getToken());
    }

    public function testSetAndGetEmailPagseeguro()
    {
        $this->pagamento = new PagamentoController('PagseguroController');

        $this->pagamento->setEmail('winnersdevelopers@gmail.com');

        $this->assertEquals('winnersdevelopers@gmail.com', $this->pagamento->getEmail());
    }
}