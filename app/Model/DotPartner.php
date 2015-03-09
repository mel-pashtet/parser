<?php

class DotPartner extends Model {
	public $name = 'DotPartner';
	public $hasMany = 'DotPartnerGood';

	public $validate = array(
		'price_lead' => array(
			'rule' => 'numeric',
			'allowEmpty' => true,
		),
		'alias' => array(
			'rule' => array('minLength', '1'),
			'allowEmpty' => false,
		),
		'name' => array(
			'rule' => array('minLength', '1'),
			'allowEmpty' => false,
		),
		'secret_key' => array(
			'rule' => array('minLength', '1'),
			'allowEmpty' => false,
		),
	);

	public function beforeValidate($options = array()) {
		parent::beforeValidate();
		
		if(!$this->data['DotPartner']['price_lead']) {
			$this->data['DotPartner']['price_lead'] = null;
		} elseif($this->data['DotPartner']['price_lead'] <= 0) {
			$this->data['DotPartner']['price_lead'] = null;
		}

		return true;
	}
	
	

}
