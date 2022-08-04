<?php

App::uses('AppController', 'Controller');

require 'PagamentoController.php';
require 'CupomController.php';
require 'NewsletterController.php';
require 'VendaController.php';

require_once(ROOT . DS . 'vendor' . DS . 'autoload.php');

use FastShipping\Lib\Tracking;
use FastShipping\Lib\Shipping;

class LojaController extends AppController {
	public $layout = 'lojaexemplo';	

   protected $usuario;

   const CATEGORIA_BANNER_HOME = "Principal";

	public function beforeFilter(){
    $lojaSession = $this->Session->read('Usuario.loja');

    if (isset($lojaSession))
    {
      if (isset($this->params['loja']))
      {
        if ($this->params['loja'] != $lojaSession)
        {
          $loja = $this->params['loja'];
        }
        else 
        {
          $loja = $lojaSession;
        }
      }
      else 
      {
        $loja = $lojaSession;
      }
    }
    else
    {
      $loja = $this->params['loja'];
      if (empty($loja)) { 
	      $loja = $GLOBALS['information']['loja'];
      }
    }

    if (!isset($loja)) 
    {
      echo 'Loja não existe';    
      exit;
    }
    else
    {
      $this->loadModel('Usuario');

      $this->usuario = $this->Usuario->find('first', array(
          'conditions' => array(
            'Usuario.loja' => $loja
          )
        )
      );

      if (empty($this->usuario))
      {
        echo 'Loja não existe';
        exit;
      }

      $this->Session->write('Usuario.id', $this->usuario['Usuario']['id']); //gambi temporaria
      $this->Session->write('Usuario.loja', $this->usuario['Usuario']['loja']); //gambi temporaria

      $this->set('usuario', $this->usuario);

      $this->layout = $this->usuario['Usuario']['layout_loja'];
    }
    
	  return true;
	}

	public function loadProducts($id_categoria = null, $id_produto = null) {
		$this->loadModel('Produto');

      $params = array('conditions' => 
         array(
            'Produto.ativo' => 1,
            'Produto.id_usuario' => $this->Session->read('Usuario.id'),
            'Produto.destaque' => 1
         ),
         'limit' => 100
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

   public function loadBanners($nome_categoria_banner = null) {
      $this->loadModel('Banner');
      $this->loadModel('CategoriaBanner');

      $params = array(
         'fields' => array(
            'CategoriaBanner.nome', 'CategoriaBanner.width', 'CategoriaBanner.height', 
            'Banner.nome_banner', 'Banner.src'
         ),
         'joins' => array(
             array(
                 'table' => 'categoria_banners',
                 'alias' => 'CategoriaBanner',
                 'type' => 'LEFT',
                 'conditions' => array(
                     'Banner.categoria_banner_id = CategoriaBanner.id',
                 ),
             )
         ),
         'conditions' => array(
            'Banner.ativo' => 1,
            'Banner.usuario_id' => $this->Session->read('Usuario.id'),
            'CategoriaBanner.nome' => $nome_categoria_banner
         )
      );

      $banners = $this->Banner->find('all', $params);

      return $banners;
   } 

	public function addCart() {
		$produto = $this->request->data('produto');
		
		if (empty($produto)) {
			$this->redirect('/');
		}

      if (!$this->validateProduct($produto)) {
         $this->Session->setFlash('Quantidade de produtos escolhidas é maior do que a disponivel!');
         $this->redirect('/');
      }

		$cont = count($this->Session->read('Produto'));

		$this->Session->write('Produto.' . $produto['id'] . '.id' , $produto['id']);
      $this->Session->write('Produto.' . $produto['id'] . '.quantidade' , round($produto['quantidade']));

      if (isset($produto['variacao']) && !empty($produto['variacao'])) {
         $this->Session->write('Produto.' . $produto['id'] . '.variacao', $produto['variacao']);
      }

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
      $this->loadModel('Variacao');

      $productsSession = $this->Session->read('Produto');
      
      if (empty($productsSession) || !isset($productsSession)) {
         return array('products_cart' => [], 'total' => 0.0);
      }

      (float) $total = 0.00;
      $produtos      = array();
      foreach ($productsSession as $indice => $item) {
         $produto =  $this->Produto->find('all', 
            array('conditions' => 
               array(
                  'Produto.ativo' => 1,
                  'Produto.id' => $item['id']
               )
            )
         );

        if (
          isset($produto[0]['Produto']['preco_promocional']) &&
          $produto[0]['Produto']['preco_promocional'] != $produto[0]['Produto']['preco']
        ) {
          $total += $produto[0]['Produto']['preco_promocional'] * $item['quantidade'];
        } else {
          $total += $produto[0]['Produto']['preco'] * $item['quantidade'];
        }

         $produto[0]['Produto']['quantidade'] = $item['quantidade'];

         if (isset($item['variacao']) && !empty($item['variacao'])) {
            $variacao = $this->Variacao->find('all', 
               array('conditions' =>
                  array('Variacao.id' => $item['variacao'])
               ),
               array('fields' => 
                  array('Variacao.nome_variacao')
               )
            );

            if (isset($variacao) && !empty($variacao)) {
               $produto[0]['Produto']['variacao'] = $variacao[0]['Variacao']['nome_variacao'];
            }
         }

         $produtos[] = $produto[0];
      }
      
      return array('products_cart' => $produtos, 'total' => $total);
   }

   public function loadCategoriesProducts($id_categoria = null) {
      $this->loadModel('Categoria');

      $params = array('conditions' => 
         array(
            'ativo' => 1,
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

      $valor_frete = number_format((float) $this->Session->read('Frete.valor'), 2, '.', ',');

      $objVenda = new VendaController();
     
      $productsSale = $this->prepareProductsSale($products['products_cart']);
     
      $usuario_id = $this->Session->read('Usuario.id');

      $dados_lancamento = array(
         'forma_pagamento_multiplo' => [],
         'forma_pagamento' => 'pagseguro',
         'loja' => true
      );

      $loja = true;
      if (!empty($this->Session->read('Cupom.valor_com_desconto'))) {
         $total = $this->Session->read('Cupom.valor_com_desconto');
         $desconto = $products['total'] - $total;
      } else {
         $total = 0;
         $desconto = 0;
      }
      $valorFinal = $valor_frete + $total; // remover valor de frente colocando numa label especifica

      $retorno_venda = $objVenda->salvar_venda($productsSale, $dados_lancamento, array('valor' => $valorFinal, 'desconto' => $desconto, 'orcamento' => 0), $usuario_id, $loja);

      $this->paymentPagSeguro($products['products_cart'], $andress, $client, $total, $valor_frete, $retorno_venda['id'], $desconto);
   }

   public function paymentPagSeguro($products, $andress, $client, $total, $shipping, $id, $desconto) {
      $pagamento = new PagamentoController('PagseguroController');   

      $pagamento->setToken($this->usuario['Usuario']['token_pagseguro']);
      
      $pagamento->setEmail($this->usuario['Usuario']['email_pagseguro']);

      $pagamento->setProdutos($products);
      
      $pagamento->adicionarProdutosGateway();

      $pagamento->setEndereco($andress);

      $pagamento->setReference('#' . $id);
      
      $pagamento->setValorFrete($shipping);

      $pagamento->setExtraAmount($desconto);

      return $this->redirect($pagamento->finalizarPedido());
   }

   public function prepareProductsSale($products) {
      $retorno = array();
     
      foreach ($products as $i => $product) {
         $retorno[$i]['id_produto'] = $product['Produto']['id'];
         $retorno[$i]['quantidade'] = $product['Produto']['quantidade'];
         if (!empty($product['Produto']['variacao']) && isset($product['Produto']['variacao'])) {
            $retorno[$i]['variacao']   = $product['Produto']['variacao'];
         }
      }

      return $retorno;
   }

   public function searchAndressByCep($cep) {
      $this->layout = 'ajax';

      $curl = curl_init('http://cep.correiocontrol.com.br/' . $cep . '.js');

      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
      
      $resultado = curl_exec($curl);

      echo $resultado;

      exit();
   }

   public function calcTransportAjax() {
      $this->layout = 'ajax';
   
      $cep_destino = $this->request->data('cep_destino');
      $cep_origem  = $this->request->data('cep_origem');
   
      $dataProducts = $this->loadProductsAndValuesCart();

      (float) $peso = 0;
      foreach ($dataProducts['products_cart'] as $i => $product) {
         $peso += $product['Produto']['peso_bruto'] * $product['Produto']['quantidade'];
      }
   
      $fretes = $this->transport($cep_destino, $this->usuario['Usuario']['cep_origem'], $peso);
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
   
      $this->Session->write('Frete.valor', $disponiveis[$cont - 1]['valor']);
      
      if (!empty($this->Session->read('Cupom.valor_com_desconto'))) {
         $valor_com_desconto = $this->Session->read('Cupom.valor_com_desconto');
      } else {
         $valor_com_desconto = 0;
      }

      if ($valor_com_desconto > 0) {
         (float) $total = ($disponiveis[$cont - 1]['valor'] + $valor_com_desconto);
      } else {
         (float) $total = ($disponiveis[$cont - 1]['valor'] + $dataProducts['total']);
      }
   
      $total = number_format($total, 2, ',', '.');
   
      $retorno = array('frete' => $disponiveis[$cont - 1]['valor'], 'total' => $total);
   
      echo json_encode($retorno);   
      exit();
   }
   
   public function transport($cep_destino, $cep_origem, $peso) {
      $altura = '2';
      $largura = '11';
      $comprimento = '16';

      $dados['sCepDestino'] = $cep_destino;
      $dados['sCepOrigem'] = $cep_origem;
      $dados['nVlPeso'] = $peso;
      $dados['nVlComprimento'] = $comprimento;
      $dados['nVlAltura'] = $altura;
      $dados['nVlLargura'] = $largura;
      $dados['nCdServico'] = '41106';
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

   public function saveEmailNewsletter() {
      $nome  = $this->request->data('nome');
      $email = $this->request->data('email');

      $objNewsletter = new NewsletterController();

      if ($objNewsletter->newsletter_cadastro($nome, $email, $this->Session->read('Usuario.id')))
      {
         echo json_encode(true);
         exit();
      } 

      echo json_encode(false);
      exit();
   }

   public function useCoupon() {
      $this->layout = 'ajax';

      $cupom = $this->request->data('cupom');
      $valor  = $this->request->data('valor');
         
      $objCupom = new CupomController();
      $produtos = $this->loadProductsAndValuesCart();
      $valor_com_desconto = $objCupom->utilizar_cupom($cupom, $produtos['total'], $this->Session->read('Usuario.id'));

      $this->Session->write('Cupom.valor_com_desconto', number_format($valor_com_desconto, 2, '.', ','));

      if (!empty($this->Session->read('Frete.valor'))) {
         $freteValor = $this->Session->read('Frete.valor');
      } else {
         $freteValor = 0;
      }
      
      if (!$valor_com_desconto)
      {
         echo json_encode(false);
         exit();
      }

      echo json_encode([
         'desconto' => number_format($produtos['total'] - $valor_com_desconto, 2, '.', ','), 
         'total' => number_format($valor_com_desconto + $freteValor, 2, '.', ',')
      ]);
      exit();
   }

   public function validateProduct($data) {
      $this->loadModel('Variacao');

      if (isset($data['variacao']) && !empty($data['variacao'])) {
         $params = array('conditions' => 
            array(
               'Variacao.id' => $data['variacao']
            )
         );

         $variacao = $this->Variacao->find('all', $params);

         if ($variacao[0]['Variacao']['estoque'] <= 0 || $data['quantidade'] > $variacao[0]['Variacao']['estoque'])
         {
            return false;
         }
      }

      return true;   
   }

   public function saveClientFromEcommerce($data) {
      $this->loadModel('Cliente');

      $data['senha'] = sha1($data['senha']);

      $this->Cliente->set($data);

      if (!$this->Cliente->validates())
      {
         return false;
      }

      if (!$this->Cliente->save())
      {
         return false;
      }

      return $this->Cliente->getLastInsertId();
   }

   public function saveAndressClientFromEcommerce($data) {
      $this->loadModel('EnderecoClienteCadastro');

      $this->EnderecoClienteCadastro->set($data);

      if (!$this->EnderecoClienteCadastro->validates())
      {
         return false;
      }

      return $this->EnderecoClienteCadastro->save();
   }

	/**
	* Views
	*/
	public function about() {
      $this->set('usuario', $this->usuario);
      $this->set('categorias', $this->loadCategoriesProducts());

      $this->render('/' . $this->usuario['Usuario']['folder_view'] . '/about');
	}

	public function termsOfUse() {
      $this->set('usuario', $this->usuario);
      $this->set('categorias', $this->loadCategoriesProducts());

      $this->render('/' . $this->usuario['Usuario']['folder_view'] . '/termsOfUse');
	}

   public function policyDelivery() {
      $this->set('usuario', $this->usuario);
      $this->set('categorias', $this->loadCategoriesProducts());

      $this->render('/' . $this->usuario['Usuario']['folder_view'] . '/policyDelivery');
	}

   public function policyDevolution() {
      $this->set('usuario', $this->usuario);
      $this->set('categorias', $this->loadCategoriesProducts());

      $this->render('/' . $this->usuario['Usuario']['folder_view'] . '/policyDevolution');
	}

	public function index() {
      $this->set('usuario', $this->usuario);
      $this->set('banners', $this->loadBanners(self::CATEGORIA_BANNER_HOME));
      $this->set('categorias', $this->loadCategoriesProducts());
      $this->set('produtos', $this->loadProducts());
      
      $this->render('/' . $this->usuario['Usuario']['folder_view'] . '/index');
	}

   public function cart() {
      $this->set('usuario', $this->usuario);
      $this->set('categorias', $this->loadCategoriesProducts());
      $products = $this->loadProductsAndValuesCart();

      $this->set('products', $products['products_cart']);
      $this->set('total', $products['total']);

      $this->render('/' . $this->usuario['Usuario']['folder_view'] . '/cart');
   }

   public function checkout() {
      $this->set('usuario', $this->usuario);
      $this->set('categorias', $this->loadCategoriesProducts());  
      $products = $this->loadProductsAndValuesCart();

      $this->set('products', $products['products_cart']);
      $this->set('total', $products['total']);
      $this->set('desconto', 0.00);

      $this->Session->write('Cupom.desconto', 0.00);

      $this->render('/' . $this->usuario['Usuario']['folder_view'] . '/checkout');
   }

   public function category() {
      $this->set('usuario', $this->usuario);
      $id   = $this->params['id'];
      $nome = $this->params['nome'];

      $products = $this->loadProducts($id);

      $this->set('categorias', $this->loadCategoriesProducts());
      $this->set('banners', $this->loadBanners($nome));
      $this->set('produtos', $products);
      $this->set('nameCategory', $nome);

      $this->render('/' . $this->usuario['Usuario']['folder_view'] . '/category');
   }

   public function product() {
      $this->set('usuario', $this->usuario);
      $this->loadModel('Produto');

      $id = $this->params['id'];

      $this->set('categorias', $this->loadCategoriesProducts());
      
      $produto = $this->loadProducts(null, $id)[0];

      $this->loadModel('Variacao');

      $query = array (
         'joins' => array(
                array(
                    'table' => 'produtos',
                    'alias' => 'Produto',
                    'type' => 'LEFT',
                    'conditions' => array(
                        'Variacao.produto_id = Produto.id',
                    ),
                )
            ),
           'conditions' => array('Variacao.produto_id' => $id, 'Variacao.ativo' => 1),
           'fields' => array('Produto.id, Variacao.*'),
      );

      $variacoes = $this->Variacao->find('all', $query);
      $this->set('variacoes', $variacoes);

      $this->set('produto', $produto);

      $this->render('/' . $this->usuario['Usuario']['folder_view'] . '/product');
   }

   public function retornopagseguro() {
      $code = $_GET['code'];

      pr($code, 1);
   }

}
