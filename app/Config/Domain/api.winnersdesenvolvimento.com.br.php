<?php

Router::connect('/client',   array('controller' => 'Api'));

require CAKE . 'Config' . DS . 'routes.php';

CakePlugin::routes();