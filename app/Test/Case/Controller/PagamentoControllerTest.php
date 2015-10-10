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
    	$this->pagamento = new PagamentoController('PagamentoController');
    	
    }
}