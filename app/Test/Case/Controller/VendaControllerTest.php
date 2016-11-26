<?php

require(APP . 'Controller/AppController.php');
require(APP . 'Controller/VendaController.php');

/**
* VendaControllerTest
*/
class VendaControllerTest extends PHPUnit_Framework_TestCase
{

	protected $VendaController;

	public function setUp()
	{
		$this->VendaController = new VendaController;
		parent::setUp();
	}

    public function testRecoverDataDuringOneWeekToDashboard()
    {
        $data = $this->VendaController->recoverDataToDashboardOneWeek();
        $this->assertNotEmpty($data);
    }

}
    