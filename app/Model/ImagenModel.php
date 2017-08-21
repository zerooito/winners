<?php

class Imagen extends Model {

	public $belongsTo = array( 
        'Usuario' => array( 
            'className' => 'Usuario' , 
            'foreignKey' => 'usuario_id' 
        ),
        'Produto' => array( 
            'className' => 'Produto' , 
            'foreignKey' => 'produto_id' 
        )
    ); 
    
}