<?php

class OdontoclinicpimentasController extends AppController {
	public function beforeFilter(){
		return true;
   	}

	function home() {
		$this->layout = 'odontoclinicpimentas';
	}

	function index() {
		$this->layout = 'odontoclinicpimentas';
	}
}