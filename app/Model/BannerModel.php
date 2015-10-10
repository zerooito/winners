<?php

class Banner extends AppModel {
	 public  $belongsTo  =  array ( 
        'Usuario'  =>  array ( 
            'className'  =>  'Usuario' , 
            'foreignKey'  =>  'usuario_id' 
        ),
        'CategoriaBanner'  =>  array ( 
            'className'  =>  'CategoriaBanner' , 
            'foreignKey'  =>  'categoria_banner_id' 
        ),
    ); 
}