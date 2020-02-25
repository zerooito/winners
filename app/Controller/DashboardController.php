<?php

require 'VendaController.php';

class DashboardController extends AppController
{
	public function home() 
	{		
		$pagamento = $this->verificar_pagamento();
		$this->set('pagamento', $pagamento);
		
		$vendaController = new VendaController;

		$this->set('vendas', $vendaController->recoverDataToDashboardOneWeek($this->instancia));
		$this->set('total_vendas', $vendaController->obter_total_vendas_periodo_atual(
			$this->instancia, date('Y-m-01'), date('Y-m-31')
		));
		$this->set('total_vendas_anual', $vendaController->obter_total_vendas_periodo_atual(
			$this->instancia, date('Y-01-01'), date('Y-12-31')
		));

		$this->layout = 'wadmin';

	}
}