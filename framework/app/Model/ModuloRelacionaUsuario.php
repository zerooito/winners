<?php

class ModuloRelacionaUsuario extends AppModel {
	public  $belongsTo  =  array ( 
        'Usuario'  =>  array ( 
            'className'  =>  'Usuario' , 
            'foreignKey'  =>  'id' 
        ),
        'Modulo' => array(
        	'className' => 'Modulo',
        	'foreignKey' => 'id' 
        )
    ); 
}