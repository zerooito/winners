<?php

require 'VendaController.php';

class DashboardController extends AppController{

	function home() {
		
		$pagamento = $this->verificar_pagamento();

		$this->set('pagamento', $pagamento);
		
		$vendaController = new VendaController;
		$this->set('vendas', $vendaController->recoverDataToDashboardOneWeek());

		$this->layout = 'wadmin';

	}

}