<?php

class SubUsuario extends AppModel
{
	public $belongsTo = array(
        'Hieraquia' => array(
            'className' => 'Hieraquia',
            'foreignKey'  =>  'hieraquia_id' 
        ),
        'Usuario' => array(
            'className' => 'Usuario',
            'foreignKey'  =>  'usuario_id' 
        )
    );
}