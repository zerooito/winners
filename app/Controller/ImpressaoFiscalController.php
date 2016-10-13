<?php

class ImpressaoFiscalController extends AppController {

	protected $txt;
	protected $userName;

	public function gerar_arquivo() {
		$this->cabecalho();
		
		$this->corpo();

		$this->rodape();

		$name = date('Y-m-d') . uniqid() . ".txt";
		
		$dir = APP . 'webroot/uploads/venda/fiscal/';
		
		$nameFull = $dir . $name;

		$file = fopen($nameFull, "w") or die("Não foi possivel imprimir arquivo!");
				
		fwrite($file, $this->txt);
		
		fclose($file);

		return $name;
	}

	public function cabecalho() {
		$this->txt .= "     Winners OpenSource    \n";
		$this->txt .= "---------------------------\n";
		$this->txt .= "  " . $this->userName .   "\n";
		$this->txt .= "---------------------------\n";
		
		$this->txt .= "Data: " . date('d')  . '/' . date('m') . '/' . date('Y')
				   . "\nHora: " . date('H:i:s') . "\n";

		$this->txt .= "---------------------------\n\n";
	}

	public function rodape() {
		return;
	}

	public function corpo() {
		if (!isset($this->corpoTxt) || empty($this->corpoTxt))
			return false;

		$this->txt .= $this->corpoTxt;

		return $this->corpoTxt;
	}

	public function exibir() {
		$arquivo = $_GET['arquivo'];
		
		echo file_get_contents(APP . 'webroot/uploads/venda/fiscal/' . $arquivo);
		
		exit;
	}

}