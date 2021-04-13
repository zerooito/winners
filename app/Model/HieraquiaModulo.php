<?php

class HieraquiaModulo extends AppModel 
{
	public $belongsTo = array(
        'Hieraquia' => array(
            'className' => 'Hieraquia',
            'foreignKey'  =>  'hieraquia_id' 
        ),
        'Modulo' => array(
            'className' => 'Modulo',
            'foreignKey'  =>  'modulo_id' 
        )
    );
}