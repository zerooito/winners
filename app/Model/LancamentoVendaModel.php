<?php

class LancamentoVenda extends AppModel {

    public $hasOne = 'Venda';
    public $hasMany = array(
        'Venda' => array(
            'className' => 'Venda'
        )
    );

}