<?php

require(APP . 'Controller/AppController.php');
require(APP . 'Controller/ApiController.php');

/**
* ApiControllerTest
*/
class ApiControllerTest extends PHPUnit_Framework_TestCase
{
    protected $api;

    public function setUp() 
    {
        $this->api = new ApiController;
    }

	public function testWishlist()
	{
		$dados = array(
			'nome1' => 'Reginaldo',
			'nome2' => 'Luna',
			'email' => 'reginaldo.junior@ciawn.com.br',
			'documento1' => '433.322.038-32',
			'documento2' => '35.879.080-2',
			'senha' => 'asdf123456',
			'data_de_nascimento' => '2014-10-03'
		);

		$result = $this->assertEquals(true, $this->api->wishlist($dados), 'Sim');

		debug($result);
	}

	public function testSetIdUser()
	{
		$user_id = 30;

		$this->api->setIdUser($user_id);
		$result = $this->assertEquals($user_id, $this->api->getIdUser());

		debug($result);
	}

}