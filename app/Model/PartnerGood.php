<?php

class PartnerGood extends Model {
	public $name = 'PartnerGood';
	public $belongsTo = array(
        'Good', 'Partner'
    );
}
