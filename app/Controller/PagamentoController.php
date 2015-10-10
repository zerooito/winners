<?php

require 'PagseguroController.php';

class PagamentoController extends AppController
{
	private $gateway = '';	

	function __construct($gateway)
	{
		$this->gateway = new $gateway();
	}

}