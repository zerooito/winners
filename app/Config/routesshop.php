<?php

// Rotas Loja
Router::connect('/:loja', array('controller' => 'loja', 'action' => 'index'));

Router::connect('/:loja/produto/:id', array('controller' => 'loja', 'action' => 'product'));

Router::connect('/:loja/sobre', array('controller' => 'loja', 'action' => 'about'));

Router::connect('/:loja/termos-de-uso', array('controller' => 'loja', 'action' => 'termsOfUse'));

Router::connect('/:loja/politica-de-envio', array('controller' => 'loja', 'action' => 'policyDelivery'));

Router::connect('/:loja/politica-de-devolucao', array('controller' => 'loja', 'action' => 'policyDevolution'));

Router::connect('/:loja/addCart',   array('controller' => 'loja', 'action' => 'addCart'));

Router::connect('/:loja/clearCart',   array('controller' => 'loja', 'action' => 'clearCart'));

Router::connect('/:loja/cart',   array('controller' => 'loja', 'action' => 'cart'));

Router::connect('/:loja/checkout',   array('controller' => 'loja', 'action' => 'checkout'));

Router::connect('/:loja/payment',   array('controller' => 'loja', 'action' => 'payment'));

Router::connect('/:loja/category/:id/:nome', array('controller' => 'loja', 'action' => 'category'));

Router::connect('/:loja/calcTransportAjax', array('controller' => 'loja', 'action' => 'calcTransportAjax'));

Router::connect('/:loja/removeProductCart/:id',   array('controller' => 'loja', 'action' => 'removeProductCart'));

Router::connect('/:loja/product/:id', array('controller' => 'loja', 'action' => 'product'));

Router::connect('/:loja/retornopagseguro', array('controller' => 'loja', 'action' => 'retornopagseguro'));

require CAKE . 'Config' . DS . 'routes.php';

CakePlugin::routes();