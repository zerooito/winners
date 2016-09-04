<?php

class QueueProduct extends AppModel {
	
	public function loadPlanilhasNotProcesseds() {
		$planilhas = $this->find('all', array(
				array('conditions' => array(
						array('OR' => array(
								'QueueProduct.processado' => 0,
								'QueueProduct.processado' => 2
							)
						)
					)
				)
			)
		);

		$response = [];
		foreach ($planilhas as $planilha) {
			$response[] = [
				'caminho' => $planilha['QueueProduct']['caminho'],
				'usuario_id' => $planilha['QueueProduct']['usuario_id'],
				'id' => $planilha['QueueProduct']['id']
			];
		}

		return $response;
	}

	public function planilhaProcessedIncomplete($planilhaId) {
		$dados = array ('QueueProduct.processado' => '2');
		$parametros = array ('QueueProduct.id' => $planilhaId);

		return $this->updateAll($dados, $parametros);
	}

	public function planilhaProcessedComplete($planilhaId) {
		$dados = array ('QueueProduct.processado' => '1');
		$parametros = array ('QueueProduct.id' => $planilhaId);

		return $this->updateAll($dados, $parametros);
	}

}