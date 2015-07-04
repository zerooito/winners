<?php

require 'IntegracaoPagseguroController.php';

class LojaController extends IntegracaoPagseguroController {
	public $layout = 'lojaexemplo';	

	public function beforeFilter(){
	   return true;
	}

	public function loadProducts($id_categoria = null, $id_produto = null) {
		$this->loadModel('Produto');

      $params = array('conditions' => 
         array(
            'Produto.ativo' => 1,
            'Produto.id_usuario' => $this->Session->read('Usuario.id')
         )
      );

      if ($id_categoria != null) {
         $params['conditions']['Produto.categoria_id'] = $id_categoria;
      }

      if ($id_produto != null) {
         $params['conditions']['Produto.id'] = $id_produto;
      }

		$produtos = $this->Produto->find('all', $params);

	   return $produtos;
	}

	public function addCart() {
		$produto = $this->request->data('produto');
		
		if (empty($produto)) {
			$this->redirect('/');
		}

		$cont = count($this->Session->read('Produto'));

		$this->Session->write('Produto.'.$produto['id'].'.id' , $produto['id']);
      $this->Session->write('Produto.'.$produto['id'].'.quantidade' , 1);

		$this->redirect('/cart');
	}

   public function removeProductCart() {
      if ( ($this->Session->read('Produto.' . $this->params['id'])) !== null ) {
         $this->Session->delete( 'Produto.' . $this->params['id'] );
      }

      $this->redirect('/cart');
   }

	public function clearCart() {
		$this->Session->delete('Produto');
	}

   public function loadProductsAndValuesCart() {
      $this->loadModel('Produto');

      $productsSession = $this->Session->read('Produto');

      (float) $total = 0.00;
      $produtos      = array();
      foreach ($productsSession as $indice => $item) {
         $produto =  $this->Produto->find('all', 
            array('conditions' => 
               array('Produto.ativo' => 1,
                    'Produto.id' => $item['id']
               )
            )
         );

         $total     += $produto[0]['Produto']['preco'];

         $produtos[] = $produto[0];
      }

      return array('products_cart' => $produtos, 'total' => $total);
   }

   public function loadCategoriesProducts($id_categoria = null) {
      $this->loadModel('Categoria');

      $params = array('conditions' => 
         array('ativo' => 1,
              'usuario_id' => $this->Session->read('Usuario.id')
         )
      );

      $categorias = $this->Categoria->find('all', $params);

      return $categorias;
   }

   public function payment() {
      $andress = $this->request->data('endereco');
      $client  = $this->request->data('cliente');

      $products = $this->loadProductsAndValuesCart();

      (float) $valor_frete = number_format($this->Session->read('Frete.valor'), 2, '.', ',');

      require 'VendaController.php';
      $objVenda = new VendaController();
      $productsSale = $this->prepareProductsSale($products['products_cart']);
      $usuario_id = $this->Session->read('Usuario.id');

      $retorno_venda = $objVenda->salvar_venda($productsSale, array(), array('valor' => $valor_frete + $products['total']), $usuario_id);

      $this->paymentPagSeguro($products['products_cart'], $andress, $client, $products['total'], $valor_frete, $retorno_venda['id']);
   }

   public function prepareProductsSale($products) {
      $retorno = array();
      foreach ($products as $i => $product) {
         $retorno[$i]['id_produto'] = $product['Produto']['id'];
         $retorno[$i]['quantidade'] = 1;
      }

      return $retorno;
   }

   public function searchAndressByCep($cep) {
      $this->layout = 'ajax';

      $curl = curl_init('http://cep.correiocontrol.com.br/'.$cep.'.js');

      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
      $resultado = curl_exec($curl);

      echo $resultado;
      exit();
   }

   public function calcTransportAjax() {
      $this->layout = 'ajax';
      $cep_destino = $this->request->data('cep_destino');
      $cep_origem  = $this->request->data('cep_origem');

      $dataProducts = $this->loadProducts();

      (float) $peso = 0;
      foreach ($dataProducts as $i => $product) {
         $peso += $product['Produto']['peso_bruto'];
      }

      $fretes = $this->transport($cep_destino, $cep_origem, $peso);

      $disponiveis = array();
      $cont = 0;
      foreach ($fretes as $i => $frete) {
         $disponiveis[$cont]['valor']  = (array) $frete->Valor;
         $disponiveis[$cont]['prazo']  = (array) $frete->PrazoEntrega;
         $disponiveis[$cont]['codigo'] = (array) $frete->Codigo;

         $disponiveis[$cont]['valor']  = array_shift($disponiveis[$cont]['valor']);
         $disponiveis[$cont]['prazo']  = array_shift($disponiveis[$cont]['prazo']);
         $disponiveis[$cont]['codigo'] = array_shift($disponiveis[$cont]['codigo']);
         $cont++;
      }

      $cartReturn = $this->loadProductsAndValuesCart();

      $this->Session->write('Frete.valor', $disponiveis[$cont - 1]['valor']);

      $total = $disponiveis[$cont - 1]['valor'] + $cartReturn['total'];
      $total = number_format($total, 2, ',', '.');

      $retorno = array('frete' => $disponiveis[$cont - 1]['valor'], 'total' => $total);

      echo json_encode($retorno);   
      exit();
   }
   
   public function transport($cep_destino, $cep_origem, $peso) {
      $altura = '2';
      $largura = '11';
      $comprimento = '16';

      $dados['sCepDestino'] = '07252-000';
      $dados['sCepOrigem'] = '09181-000';
      $dados['nVlPeso'] = $peso;
      $dados['nVlComprimento'] = $comprimento;
      $dados['nVlAltura'] = $altura;
      $dados['nVlLargura'] = $largura;
      $dados['nCdServico'] = 41106;//pac varejo
      $dados['nVlDiametro'] = '2';
      $dados['nCdFormato'] = '1';
      $dados['sCdMaoPropria'] = 'n';
      $dados['nVlValorDeclarado'] = '0';
      $dados['StrRetorno'] = 'xml';

      $dados = http_build_query($dados);

      $curl = curl_init('http://ws.correios.com.br/calculador/CalcPrecoPrazo.aspx' . '?' . $dados);

      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
      $resultado = curl_exec($curl);

      $resultado = simplexml_load_string($resultado);

      return $resultado;
   }

	/**
	* Views
	*/
	public function index() {
      // echo 'oi';exit();
      $this->set('categorias', $this->loadCategoriesProducts());
		$this->set('produtos', $this->loadProducts());
	}

   public function cart() {
      $this->set('categorias', $this->loadCategoriesProducts());
      $products = $this->loadProductsAndValuesCart();

      $this->set('products', $products['products_cart']);
      $this->set('total', $products['total']);
   }

   public function checkout() {
      $this->set('categorias', $this->loadCategoriesProducts());  
      $products = $this->loadProductsAndValuesCart();

      $this->set('products', $products['products_cart']);
      $this->set('total', $products['total']);
   }

   public function category() {
      $id   = $this->params['id'];
      $nome = $this->params['nome'];

      $products = $this->loadProducts($id);

      $this->set('categorias', $this->loadCategoriesProducts());
      $this->set('produtos', $products);
      $this->set('nameCategory', $nome);
   }

   public function product() {
      $this->loadModel('Produto');

      $id = $this->params['id'];

      $this->set('categorias', $this->loadCategoriesProducts());
      
      $produto = $this->loadProducts(null, $id)[0];

      $this->set('produto', $produto);
   }

}