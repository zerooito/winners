<?php

class NfeController extends AppController {

	public function beforeFilter(){
		return true;
   	}

	public function teste() {
		/*
		 * Exemplo de envio de Nfe já assinada e validada
		 */
		require_once('nfephp/libs/NFe/ToolsNFePHP.class.php');
		$nfe = new ToolsNFePHP;
		$modSOAP = '2'; //usando cURL

		//use isso, este é o modo manual voce tem mais controle sobre o que acontece
		$filename = 'nfephp/exemplos/xml/11101284613439000180550010000004881093997017-nfe.xml';
		//obter um numero de lote
		$lote = substr(str_replace(',', '', number_format(microtime(true)*1000000, 0)), 0, 15);
		// montar o array com a NFe
		$sNFe = file_get_contents($filename);
		//array vazio passado como referencia
		$aResp = array();
		debug($nfe->autoriza($sNFe, $lote, $aResp));
		//enviar o lote
		if ($resp = $nfe->autoriza($sNFe, $lote, $aResp)) {
		    if ($aResp['bStat']) {
		        echo "Numero do Recibo : " . $aResp['nRec'] .", use este numero para obter o protocolo ou informações de erro no xml com testaRecibo.php.";
		    } else {
		        echo "Houve erro !! $nfe->errMsg";
		    }
		} else {
		    echo "houve erro !!  $nfe->errMsg";
		}
		debug($nfe);
		echo '<BR><BR><h1>DEBUG DA COMUNICAÇÕO SOAP</h1><BR><BR>';
		echo '<PRE>';
		echo htmlspecialchars($nfe->soapDebug);
		echo '</PRE><BR>';
		exit();
	}

}