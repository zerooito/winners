<?php

require 'LojaController.php';

/**
* 
*/
class XStoreController extends LojaController
{
	public function beforeFilter() {
		$this->Session->write('Usuario.id', $_SESSION['information']['id_usuario']);//gambi temporaria

		$this->layout = 'xstore';
		return true;
   	}

}