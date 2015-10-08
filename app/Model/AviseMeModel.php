<?php

/**
* @model 
* @table avise_mes
*/
class AviseMe extends AppModel
{
	public  $belongsTo  =  array ( 
        'Produto'  =>  array ( 
            'className'  =>  'Produto' , 
            'foreignKey'  =>  'produto_id' 
        ),
    ); 
}