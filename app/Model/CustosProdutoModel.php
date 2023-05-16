<?php

class CustosProduto extends Model {

    public $belongsTo  =  array( 
        'Produto'  =>  array( 
            'className'  =>  'Produto', 
            'foreignKey'  =>  'produto_id' 
        )
    ); 

}