<?php

class LancamentoVenda extends AppModel {

    public $hasOne = array(
	    'LancamentoCategoria' => array(
	        'className' => 'LancamentoCategoriaModel',
	        'foreignKey' => 'lancamento_categoria_id'
	    )
    );

}