<?php

class DashboardController extends AppController{

	function home() {
		$pagamento = $this->verificar_pagamento();

		$this->set('pagamento', $pagamento);
		$this->layout = 'wadmin';
	}

}