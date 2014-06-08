<?php
class WAdminController extends AppController{
	function index(){
		$this->layout = 'wadmin';

		print_r($this->Session->read());
		echo 'index';
	}

	function paginas(){
		$this->layout = 'wadmin';

		echo 'paginas';
	}
}