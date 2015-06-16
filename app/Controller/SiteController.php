<?php

class SiteController extends AppController {

	public function beforeFilter(){
		$this->Session->write('Usuario', $_SESSION['information']);

		return true;
   	}

	public function home() {
		$this->layout = $this->getLayout();
	}

	public function contato() {
		$this->layout = $this->getLayout();
	}
	
	public function paginas() {
		$this->layout = $this->getLayout();
	}

	public function galeria() {
		$this->layout = $this->getLayout();
	}

	public function setLayout($playout) {
		$this->layout = $playout;
	}

	public function getLayout() {
		return $this->layout;
	}

}