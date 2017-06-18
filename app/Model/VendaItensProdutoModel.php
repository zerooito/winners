<?php

class VendaItensProduto extends AppModel {
	
	public $belongsTo  =  array( 
        'Produto'  =>  array( 
            'className'  =>  'Produto', 
            'foreignKey'  =>  'produto_id' 
        ),
        'Venda' => array(
        	'className' => 'Venda',
        	'foreignKey' => 'venda_id' 
        )
    ); 

}