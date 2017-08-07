<?php

App::uses('AppModel', 'Model');

class LancamentoVenda extends AppModel {
	
	public $belongsTo = array(
		'LancamentoCategoria' => array(
			'className' => 'LancamentoCategoria',
			'foreignKey' => 'lancamento_categoria_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);


}