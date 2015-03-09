<?php

class BasePartner extends Model {
	public $belongsTo = array(
		'DotPartner' => array(
			'className' => 'DotPartner',
			'foreignKey' => 'source_id'
		),
		'DotGood' => array(
			'className' => 'DotGood',
			'foreignKey' => false,
			'conditions' => 'BasePartner.offer = DotGood.alias',
		),
		'DotStatus' => array(
			'className' => 'DotStatus',
			'foreignKey' => false,
			'conditions' => 'BasePartner.status = DotStatus.ext_id',
		)

	);

}
