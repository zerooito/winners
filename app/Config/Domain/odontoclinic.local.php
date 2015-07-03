<?php

$dominio = array(
	'id_usuario' => '9',
	'controller' => 'XStore',
	'funcao'	 => 'index'
);

$_SESSION['information'] = $dominio;

Router::connect('/cadastros', 	   array('controller' => $dominio['controller'], 'action' => 'cadastros'));

Router::connect('/pagina_inicial', array('controller' => $dominio['controller'], 'action' => 'home'));

Router::connect('/meus_pedidos',   array('controller' => $dominio['controller'], 'action' => 'meus_pedidos'));

Router::connect('/addCart',   array('controller' => $dominio['controller'], 'action' => 'addCart'));

Router::connect('/clearCart',   array('controller' => $dominio['controller'], 'action' => 'clearCart'));

Router::connect('/cart',   array('controller' => $dominio['controller'], 'action' => 'cart'));

Router::connect('/checkout',   array('controller' => $dominio['controller'], 'action' => 'checkout'));

Router::connect('/removeProductCart/:id',   array('controller' => $dominio['controller'], 'action' => 'removeProductCart'));

Router::connect('/produto/:id',    array('controller' => $dominio['controller'], 'action' => 'produto'));

require CAKE . 'Config' . DS . 'routes.php';

CakePlugin::routes();