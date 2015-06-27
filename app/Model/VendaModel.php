<?php

/**
* Model de venda
*/
class Venda extends AppModel {
	public  $belongsTo  =  array ( 
        'VendaItensProduto'  =>  array ( 
            'className'  =>  'VendaItensProduto', 
            'foreignKey'  =>  'venda_id' 
        )
    ); 
}