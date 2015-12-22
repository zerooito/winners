<?php

require(APP . 'Controller/IntegracaoPagseguroController.php');

/**
* IntegracaoPagseguroControllerTest
*/
class IntegracaoPagseguroControllerTest extends PHPUnit_Framework_TestCase
{

    public function testSum() 
    {
        $result = $this->testAction('/IntegracaoPagseguroController/sum/1/2 ');
        debug($result);
    }

}
    