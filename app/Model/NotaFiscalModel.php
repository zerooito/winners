<?php

class NotaFiscal extends AppModel {
	public $belongsTo = array(
		'Cliente' => array(
			'className' => 'Cliente',
			'foreignKey' => 'cliente_id'
		),
		'Venda' => array(
			'className' => 'Venda',
			'foreignKey' => 'venda_id'
		)
	);

	public $hasMany = array(
		'NotaFiscalItem' => array(
			'className' => 'NotaFiscalItem',
			'foreignKey' => 'nota_fiscal_id'
		),
		'NotaFiscalPagamento' => array(
			'className' => 'NotaFiscalPagamento',
			'foreignKey' => 'nota_fiscal_id'
		)
	);
}
