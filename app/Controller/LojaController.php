<?php

class LojaController extends AppController {

	public function beforeFilter(){
		return true;
   	}

   	public function index() {
		$this->layout = 'lojaexemplo';
   	}

}