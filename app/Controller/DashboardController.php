<?php

require 'VendaController.php';

class DashboardController extends AppController
{
	public function home() 
	{	
		$vendaController = new VendaController;
		
		$totalVendas = 0;
		$totalVendasAnual = 0;
		if ($this->PermissoesHelper->usuario_possui_permissao_para('venda', 'read')) {
			$totalVendas = $vendaController->obter_total_vendas_periodo_atual(
				$this->instancia, date('Y-m-01'), date('Y-m-31')
			);
			$totalVendasAnual = $vendaController->obter_total_vendas_periodo_atual(
				$this->instancia, date('Y-01-01'), date('Y-12-31')
			);
		}

		$this->set('total_vendas', $totalVendas);
		$this->set('total_vendas_anual', $totalVendasAnual);

		$this->layout = 'wadmin';

	}
}