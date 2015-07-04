<?php

$dominio = array(
	'id_usuario' => '23',
	'controller' => 'XStore',
	'funcao'	 => 'index'
);

$_SESSION['information'] = $dominio;

Router::connect('/addCart',   array('controller' => $dominio['controller'], 'action' => 'addCart'));

Router::connect('/clearCart',   array('controller' => $dominio['controller'], 'action' => 'clearCart'));

Router::connect('/cart',   array('controller' => $dominio['controller'], 'action' => 'cart'));

Router::connect('/checkout',   array('controller' => $dominio['controller'], 'action' => 'checkout'));

Router::connect('/payment',   array('controller' => $dominio['controller'], 'action' => 'payment'));

Router::connect('/category/:id/:nome',   array('controller' => $dominio['controller'], 'action' => 'category'));

Router::connect('/removeProductCart/:id',   array('controller' => $dominio['controller'], 'action' => 'removeProductCart'));

Router::connect('/product/:id',    array('controller' => $dominio['controller'], 'action' => 'product'));

require CAKE . 'Config' . DS . 'routes.php';

CakePlugin::routes();