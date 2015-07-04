<?php

require 'IntegracaoPagseguroController.php';

class LojaController extends IntegracaoPagseguroController {
	public $layout = 'lojaexemplo';	

	public function beforeFilter(){
	   return true;
	}

	public function loadProducts($id_categoria = null) {
		$this->loadModel('Produto');

      $params = array('conditions' => 
         array('Produto.ativo' => 1,
              'Produto.id_usuario' => $_SESSION['information']['id_usuario'],
         )
      );

      if ($id_categoria != null) {
         $params['conditions']['categoria_id'] = $id_categoria;
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
              'usuario_id' => $_SESSION['information']['id_usuario']
         )
      );

      $categorias = $this->Categoria->find('all', $params);

      return $categorias;
   }

   public function payment() {
      $andress = $this->request->data('endereco');
      $client  = $this->request->data('cliente');
      $products = $this->loadProductsAndValuesCart();

      $this->paymentPagSeguro($products['products_cart'], $andress, $client, $products['total']);
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
      $products = $this->loadProductsAndValuesCart();

      $this->set('products', $products['products_cart']);
      $this->set('total', $products['total']);
   }

   public function checkout() {
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
}