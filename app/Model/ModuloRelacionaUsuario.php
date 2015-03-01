<?php

class ModuloRelacionaUsuario extends AppModel {
	public  $belongsTo  =  array ( 
        'Usuario'  =>  array ( 
            'className'  =>  'Usuario' , 
            'foreignKey'  =>  'id_usuario' 
        ),
        'Modulo' => array(
        	'className' => 'Modulo',
        	'foreignKey' => 'id_modulo' 
        )
    ); 
}