<?php

$dominio = array(
	'id_usuario' => '9',
	'controller' => 'Odontoclinicpimentas',
	'funcao'	 => 'home'
);

$_SESSION['information'] = $dominio;

Router::connect('/cadastros', 	   array('controller' => $dominio['controller'], 'action' => 'cadastros'));

Router::connect('/pagina_inicial', array('controller' => $dominio['controller'], 'action' => 'home'));

Router::connect('/meus_pedidos',   array('controller' => $dominio['controller'], 'action' => 'meus_pedidos'));

Router::connect('/produto/:id',    array('controller' => $dominio['controller'], 'action' => 'produto'));

require CAKE . 'Config' . DS . 'routes.php';

CakePlugin::routes();