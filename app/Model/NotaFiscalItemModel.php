<?php

class NotaFiscalItem extends AppModel {
	public $belongsTo = array(
		'NotaFiscal' => array(
			'className' => 'NotaFiscal',
			'foreignKey' => 'nota_fiscal_id'
		),
		'Produto' => array(
			'className' => 'Produto',
			'foreignKey' => 'produto_id'
		)
	);
}
