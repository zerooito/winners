<?php

require 'GatewayInterface.php';
include(APP . 'Vendor/PagSeguro/source/PagSeguroLibrary/PagSeguroLibrary.php');

class PagseguroController extends AppController implements GatewayInterface
{

    private $paymentRequest;
    private $email;
    private $token;
    private $produtos = array();
    private $client = array();    
    private $reference;
    private $valor_frete;

    public function __construct()
    {
        $this->paymentRequest = new PagSeguroPaymentRequest();
        // Set the currency
        $this->paymentRequest->setCurrency("BRL");
    }
    
    // $products, $andress, $client, $total, $valor_frete, $id_venda
    public function finalizarPedido()
    {
        $this->paymentRequest->setReference($this->reference);
        $this->paymentRequest->setShippingCost($this->valor_frete);


        // Set the url used by PagSeguro to redirect user after checkout process ends
        $this->paymentRequest->setRedirectUrl("http://www.lojamodelo.com.br");

        try {

            /*
             * #### Credentials #####
             * Replace the parameters below with your credentials
             * You can also get your credentials from a config file. See an example:
             * $credentials = PagSeguroConfig::getAccountCredentials();
            //  */

            // seller authentication
            $credentials = new PagSeguroAccountCredentials($this->email, $this->token);

            // application authentication
            //$credentials = PagSeguroConfig::getApplicationCredentials();

            //$credentials->setAuthorizationCode("E231B2C9BCC8474DA2E260B6C8CF60D3");

            // Register this payment request in PagSeguro to obtain the payment URL to redirect your customer.
            $url = $this->paymentRequest->register($credentials);
            
            return $url;

        } catch (PagSeguroServiceException $e) {

            die($e->getMessage());

        }
    }

    /**
    * @return void
    * @param String $token
    **/
    public function setToken($token)
    {
        $this->token = $token;
    }

    /**
    * @return String $token
    **/
    public function getToken()
    {
        return $this->token;
    }

    /**
    * @return void
    * @param String $email
    **/
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
    * @return String $email
    **/
    public function getEmail()
    {
        return $this->email;
    }

    /**
    * @return void
    * @param Array $produtos
    **/
    public function setProdutos($produtos)
    {
        $this->produtos = $produtos;
    }

    /**
    * @return Array $produtos
    **/
    public function getProdutos()
    {
        return $this->produtos;
    }

    /**
    * @param Array Produtos
    * @return Array Produtos
    **/
    public function adicionarProdutosGateway()
    {
        if (empty($this->getProdutos()))
        {
            throw new Exception("Você precisa usar a função setar os dados do produto!", 1);            
        }

        foreach ($this->getProdutos() as $i => $item) {
            $nome = $item['Produto']['nome'];
            if (isset($item['Produto']['variacao']) && !empty($item['Produto']['variacao'])) {
                $nome .= '    Tamanho: '. $item['Produto']['variacao'];
            }
            $this->paymentRequest->addItem(
                '000' . $item['Produto']['id'], 
                $nome,
                $item['Produto']['quantidade'], 
                number_format($item['Produto']['preco'], 2, '.', '')
            );
        }

        return $this->getProdutos();
    }

    public function setEndereco($endereco)
    {
        $this->endereco = $endereco;
    }

    public function getEndereco()
    {
        return $this->endereco;
    }

    public function setEnderecoClienteGateway()
    {
        if (empty($this->endereco))
        {
            throw new Exception("Você precisa usar a função setar os dados do cliente!", 1);            
        }

        $sedexCode = PagSeguroShippingType::getCodeByType('PAC');
        $paymentRequest->setShippingType($sedexCode);

        $paymentRequest->setShippingAddress(
            $this->endereco['cep'],
            $this->endereco['endereco'],
            $this->endereco['numero'],
            $this->endereco['complemento'],
            $this->endereco['bairro'],
            $this->endereco['cidade'],
            $this->endereco['estado'],
            'BRA'
        );

        return $this->getEndereco();
    }

    public function setReference($reference)
    {
        $this->reference = $reference;
    }

    public function getReference()
    {
        return $this->reference;
    }

    public function setValorFrete($valor_frete)
    {
        $this->valor_frete = $valor_frete;
    }

    public function getValorFrete()
    {
        return $this->valor_frete;
    }

    public function setClienteGateway()
    {
        if (empty($this->cliente))
        {
            throw new Exception("Você precisa usar a função setar os dados do cliente!", 1);            
        }

        // Set your customer information.
        $this->paymentRequest->setSender(
            $this->cliente['nome'],
            $this->cliente['email'],
            $this->cliente['ddd'],
            $this->cliente['telefone'],
            'CPF',
            $this->cliente['cpf']
        );

        return $this->getCliente();
    }

    public function setCliente($cliente)
    {
        $this->cliente = $cliente;
    }

    public function getCliente()
    {
        return $this->cliente;
    }

}