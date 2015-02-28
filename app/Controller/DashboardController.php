<?php

class DashboardController extends AppController{

	function home() {
		$modulos = $this->verificar_acesso();
		$this->verificar_modulo_ativo('produto');
		$this->layout = 'wadmin';
	}

}