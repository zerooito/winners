<?php

/**
* 
*/
class AsaasController extends AppController
{

	protected $endpoint = 'https://www.asaas.com/api/v3';

	public function configuracoes()
	{
		$this->loadModel('Asaas');
		
		$asaas = $this->Asaas->find('first', array(
				'Asaas.usuario_id' => $this->instancia
			)
		);

		$this->set('asaas', $asaas);

		$this->layout = 'wadmin';
	}

	public function save()
	{
		$key_api = $this->request->data('key_api');

		$data = [
			'api_key' => $key_api,
			'usuario_id' => $this->instancia
		];

		$this->loadModel('Asaas');
		
		$exist = $this->Asaas->find('first', array(
				'Asaas.key_api' => $key_api,
				'Asaas.usuario_id' => $this->instancia
			)
		);

		if (!empty($exist)) {
			$this->Asaas->id = $exist['Asaas']['id'];
		}

		if (!$this->Asaas->save($data)) {
			$this->Session->setFlash('Erro ao atualizar dados!');
            return $this->redirect('/asaas/configuracoes');
		}

		$this->Session->setFlash('Dados atualizados com sucesso!');
        return $this->redirect('/asaas/configuracoes');
	}

	// \"customer\": \"{CUSTOMER_ID}\",
	// \"billingType\": \"BOLETO\",
	// \"dueDate\": \"2017-06-10\",
	// \"value\": 100,
	// \"description\": \"Pedido 056984\",
	// \"externalReference\": \"056984\"
	public function criar_cobranca($data)
	{
		return $this->request($data, '/payments', 'POST');
	}

	// {
	// 	  \"name\": \"Marcelo Almeida\",
	// 	  \"email\": \"marcelo.almeida@gmail.com\",
	// 	  \"phone\": \"4738010919\",
	// 	  \"mobilePhone\": \"4799376637\",
	// 	  \"cpfCnpj\": \"24971563792\",
	// 	  \"postalCode\": \"01310-000\",
	// 	  \"address\": \"Av. Paulista\",
	// 	  \"addressNumber\": \"150\",
	// 	  \"complement\": \"Sala 201\",
	// 	  \"province\": \"Centro\",
	// 	  \"externalReference\": \"12987382\",
	// 	  \"notificationDisabled\": false,
	// 	  \"additionalEmails\": \"marcelo.almeida2@gmail.com,marcelo.almeida3@gmail.com\"
	// 	}
	public function criar_cliente($data)
	{
		return $this->request($data, '/customers', 'POST');
	}

	public function request($data, $method, $type='GET')
	{
		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, $this->endpoint . $method);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_HEADER, FALSE);

		if (strtoupper($type) == "POST") {
			curl_setopt($ch, CURLOPT_POST, TRUE);
			curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
		}

		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		  "Content-Type: application/json",
		  "access_token: " . $this->loadToken()
		));

		$response = curl_exec($ch);
		curl_close($ch);

		return json_decode($response);
	}

	public function loadToken()
	{
		$this->loadModel('Asaas');

		$response = $this->Asaas->find('first', array(
				array('conditions' => array(
						'Asaas.usuario_id' => $this->instancia
					)
				)
			)
		);

		if (!empty($response)) {
			return $response['Asaas']['api_key'];
		}
	}
	
}