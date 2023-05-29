<?php

class Produto extends AppModel
{
	
    public $hasMany  =  array( 
        'CustosProduto'  =>  array( 
            'className'  =>  'CustosProduto', 
            'foreignKey'  =>  'produto_id' 
        )
    ); 

}