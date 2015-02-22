<?php

class DashboardController extends AppController{

	function home() {
		$this->verificar_acesso();
		$this->layout = 'wadmin';
	}

}