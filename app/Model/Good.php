<?php

class Good extends Model {
	public $name = 'Good';
	public $hasMany = 'PartnerGood';
}
