<?php

require 'LojaController.php';

/**
* 
*/
class XStoreController extends LojaController
{
	public function beforeFilter() {
		$this->layout = 'xstore';
		return true;
   	}

}