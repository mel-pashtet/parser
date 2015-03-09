<?php

class DotStatus extends Model {
	public $name = 'DotStatus';
	// public $hasMany = 'DotPartnerGood';
	
	// public $validate = array(
	// 	'is_return' => array(
	// 		'rule' => array('boolean')
	// 	),
	// 	'price_zakup' => array(
	// 		'rule' => 'numeric',
	// 		'allowEmpty' => true,
	// 	),
	// 	'price_prod' => array(
	// 		'rule' => 'numeric',
	// 		'allowEmpty' => true,
	// 	),
	// 	'price_vozv' => array(
	// 		'rule' => 'numeric',
	// 		'allowEmpty' => true,
	// 	),
	// 	'alias' => array(
	// 		'rule' => array('minLength', '1'),
	// 		'allowEmpty' => false,
	// 	),
	// 	'name' => array(
	// 		'rule' => array('minLength', '1'),
	// 		'allowEmpty' => false,
	// 	),
	
	// );

	// public function beforeValidate($options = array()) {
	// 	parent::beforeValidate();
	// 	if(!isset($this->data['DotGood']['is_return'])) {
	// 		$this->data['DotGood']['is_return'] = 0;

	// 	} elseif($this->data['DotGood']['is_return'] == 'false') {
	// 		$this->data['DotGood']['is_return'] = 0;
	// 	} else {
	// 		$this->data['DotGood']['is_return'] = 1;

	// 	}

	// 	if(isset($this->data['DotGood']['price_zakup']) && $this->data['DotGood']['price_zakup'] <= 0) {
	// 		$this->data['DotGood']['price_zakup'] = null;
	// 	}
	// 	if(isset($this->data['DotGood']['price_prod']) && $this->data['DotGood']['price_prod'] <= 0) {
	// 		$this->data['DotGood']['price_prod'] = null;
	// 	}
	// 	if(isset($this->data['DotGood']['price_vozv']) && $this->data['DotGood']['price_vozv'] <= 0) {
	// 		$this->data['DotGood']['price_vozv'] = null;
	// 	}

	// 	return true;
	// }
}
