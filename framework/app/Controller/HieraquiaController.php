<?php

class HieraquiaController extends AppController {
	public function listar_cadastros() {
		$this->layout = 'wadmin';
	}

	public function adicionar_hieraquia() {
		$this->layout = 'wadmin';
		$this->set('modulos', $this->modulos);
	}

}