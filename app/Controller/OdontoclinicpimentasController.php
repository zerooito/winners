<?php
require 'SiteController.php';

class OdontoclinicpimentasController extends SiteController {

	public function beforeFilter() {
		$this->setLayout('odontoclinicpimentas');
	}

}