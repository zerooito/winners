<?php

class NotaFiscalPagamento extends AppModel {
	public $belongsTo = array(
		'NotaFiscal' => array(
			'className' => 'NotaFiscal',
			'foreignKey' => 'nota_fiscal_id'
		)
	);
}
