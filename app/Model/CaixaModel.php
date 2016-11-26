<?php

class Caixa extends Model {

	public $belongsTo =  array ( 
        'Usuario'  =>  array ( 
            'className'  =>  'Usuario' , 
            'foreignKey'  =>  'usuario_id' 
        ),
    ); 
    
}