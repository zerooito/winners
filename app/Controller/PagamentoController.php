<?php

class PagamentoController extends Controller {
	public $data;
	public $status;
	
	function forma_de_pagamento() {
		return true;
	}

	function status_de_pagamento() {
		return true;
	}

	function efetuar_pagamento() {
		return true;
	}

}