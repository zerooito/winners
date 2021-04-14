<?php

class SubUsuario extends AppModel
{
	public $belongsTo = array(
        'Hieraquia' => array(
            'className' => 'Hieraquia',
            'foreignKey'  =>  'id_hieraquia' 
        ),
        'Usuario' => array(
            'className' => 'Usuario',
            'foreignKey'  =>  'id_usuario' 
        )
    );
}