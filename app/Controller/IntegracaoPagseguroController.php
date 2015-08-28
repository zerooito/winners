<?php

include(APP . 'Vendor/PagSeguro/source/PagSeguroLibrary/PagSeguroLibrary.php');

class IntegracaoPagseguroController extends AppController {

    public function paymentPagSeguro($products, $andress, $client, $total, $valor_frete, $id_venda)
    {
        // Instantiate a new payment request
        $paymentRequest = new PagSeguroPaymentRequest();

        // Set the currency
        $paymentRequest->setCurrency("BRL");

        // Add an item for this payment request
        foreach ($products as $i => $item) {
        	$paymentRequest->addItem('000'.$item['Produto']['id'], $item['Produto']['nome'] . '    Tamanho: '. $item['Produto']['variacao'], $item['Produto']['quantidade'], number_format($item['Produto']['preco'], 2, '.', ''));
        }


        // Add an item for this payment request
        // $paymentRequest->addItem('0001', 'Notebook prata', 2, 430.00);

        // Add another item for this payment request
        // $paymentRequest->addItem('0002', 'Notebook rosa', 2, 560.00);

        // Set a reference code for this payment request. It is useful to identify this payment
        // in future notifications.
        $paymentRequest->setReference($id_venda);

        // Set shipping information for this payment request
        $sedexCode = PagSeguroShippingType::getCodeByType('PAC');
        
        $paymentRequest->setShippingCost($valor_frete);  

        $paymentRequest->setShippingType($sedexCode);
        $paymentRequest->setShippingAddress(
            $andress['cep'],
            $andress['endereco'],
            $andress['numero'],
            'apto. 114',
            $andress['bairro'],
            $andress['cidade'],
            $andress['estado'],
            'BRA'
        );

        // Set your customer information.
        $paymentRequest->setSender(
            $client['nome'],
            $client['email'],
            $client['ddd'],
            $client['telefone'],
            'CPF',
            $client['cpf']
        );

        // Set the url used by PagSeguro to redirect user after checkout process ends
        $paymentRequest->setRedirectUrl("http://www.lojamodelo.com.br");

        // Add checkout metadata information
        // $paymentRequest->addMetadata('PASSENGER_CPF', '15600944276', 1);
        // $paymentRequest->addMetadata('GAME_NAME', 'DOTA');
        // $paymentRequest->addMetadata('PASSENGER_PASSPORT', '23456', 1);

        // Another way to set checkout parameters
        // $paymentRequest->addParameter('notificationURL', 'http://www.lojamodelo.com.br/nas');
        // $paymentRequest->addParameter('senderBornDate', '07/05/1981');
        // $paymentRequest->addIndexedParameter('itemId', '0003', 3);
        // $paymentRequest->addIndexedParameter('itemDescription', 'Notebook Preto', 3);
        // $paymentRequest->addIndexedParameter('itemQuantity', '1', 3);
        // $paymentRequest->addIndexedParameter('itemAmount', '200.00', 3);

        // Add discount per payment method
        $paymentRequest->addPaymentMethodConfig('CREDIT_CARD', 1.00, 'DISCOUNT_PERCENT');
        $paymentRequest->addPaymentMethodConfig('EFT', 2.90, 'DISCOUNT_PERCENT');
        $paymentRequest->addPaymentMethodConfig('BOLETO', 10.00, 'DISCOUNT_PERCENT');
        $paymentRequest->addPaymentMethodConfig('DEPOSIT', 3.45, 'DISCOUNT_PERCENT');
        $paymentRequest->addPaymentMethodConfig('BALANCE', 0.01, 'DISCOUNT_PERCENT');

        try {

            /*
             * #### Credentials #####
             * Replace the parameters below with your credentials
             * You can also get your credentials from a config file. See an example:
             * $credentials = PagSeguroConfig::getAccountCredentials();
            //  */

            // seller authentication
            $credentials = new PagSeguroAccountCredentials("email", "token");

            // application authentication
            //$credentials = PagSeguroConfig::getApplicationCredentials();

            //$credentials->setAuthorizationCode("E231B2C9BCC8474DA2E260B6C8CF60D3");

            // Register this payment request in PagSeguro to obtain the payment URL to redirect your customer.
            $url = $paymentRequest->register($credentials);

            $this->redirect($url);

        } catch (PagSeguroServiceException $e) {

            die($e->getMessage());

        }
    }


}