<?php
class HomeController extends AppController{
	function index(){
		$this->layout = 'winners';

	}

	function teste(){
		echo 'teste';
	}

	function tema(){
		$this->layout = 'winners';
	}
}