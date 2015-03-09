<?php

class DotPartnerGood extends Model {
	public $name = 'DotPartnerGood';
	public $belongsTo = array(
		'DotGood', 'DotPartner'
	);

	public $validate = array(
		'price_define' => array(
			'rule' => 'numeric',
			'allowEmpty' => true,
		),
		'price_lead_define' => array(
			'rule' => 'numeric',
			'allowEmpty' => true,
		),

		'dot_good_id' => array(
			'rule' => 'numeric',
			'required' => true,
		),
		'dot_partner_id' => array(
			'rule' => 'numeric',
			'required' => true,
		),
	);

	public function beforeValidate($options = array()) {
		parent::beforeValidate();
		
		if(!isset($this->data['DotPartnerGood']['price_define'])) {
			$this->data['DotPartnerGood']['price_define'] = null;
		} elseif($this->data['DotPartnerGood']['price_define'] <= 0) {
			$this->data['DotPartnerGood']['price_define'] = null;
		}
		if(!isset($this->data['DotPartnerGood']['price_lead_define'])) {
			$this->data['DotPartnerGood']['price_lead_define'] = null;
		} elseif($this->data['DotPartnerGood']['price_lead_define'] <= 0) {
			$this->data['DotPartnerGood']['price_lead_define'] = null;
		}
		
		return true;
	}
}
