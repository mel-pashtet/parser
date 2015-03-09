<?php

class DotStatusesController extends AppController {
	
	public function index() {
		$statuses = $this->DotStatus->find('all');
		print_r($statuses);die;
	}

	// public function insertStatus() {
	// 	$this->autoRender = false;
	// 	$allSave = array();

	// 	$data = array(
	// 		1 => array('default' => 'wait', 'monsterleads' => 1, 'offertop' => 0, 'hotpartner' => 'new'),
	// 		21 => array('default' => 'wait', 'monsterleads' => 1, 'offertop' => 0, 'hotpartner' => 'waiting'),
	// 		23 => array('default' => 'wait', 'monsterleads' => 1, 'offertop' => 0, 'hotpartner' => 'waiting'),
	// 		48 => array('default' => 'wait', 'monsterleads' => 1, 'offertop' => 0, 'hotpartner' => 'waiting'),
	// 		20 => array('default' => 'approve', 'monsterleads' => 2, 'offertop' => 1, 'hotpartner' => 'toconfirmed'),
	// 		27 => array('default' => 'approve', 'monsterleads' => 2, 'offertop' => 1, 'hotpartner' => 'toconfirmed'),
	// 		29 => array('default' => 'approve', 'monsterleads' => 2, 'offertop' => 1, 'hotpartner' => 'toconfirmed'),
	// 		40 => array('default' => 'approve', 'monsterleads' => 2, 'offertop' => 1, 'hotpartner' => 'toconfirmed'),
	// 		41 => array('default' => 'approve', 'monsterleads' => 2, 'offertop' => 1, 'hotpartner' => 'toconfirmed'),
	// 		42 => array('default' => 'approve', 'monsterleads' => 2, 'offertop' => 1, 'hotpartner' => 'toconfirmed'),
	// 		43 => array('default' => 'approve', 'monsterleads' => 2, 'offertop' => 1, 'hotpartner' => 'toconfirmed'),
	// 		44 => array('default' => 'approve', 'monsterleads' => 2, 'offertop' => 1, 'hotpartner' => 'toconfirmed'),
	// 		45 => array('default' => 'approve', 'monsterleads' => 2, 'offertop' => 1, 'hotpartner' => 'toconfirmed'),
	// 		46 => array('default' => 'approve', 'monsterleads' => 2, 'offertop' => 1, 'hotpartner' => 'toconfirmed'),
	// 		47 => array('default' => 'approve', 'monsterleads' => 2, 'offertop' => 1, 'hotpartner' => 'toconfirmed'),
	// 		49 => array('default' => 'approve', 'monsterleads' => 2, 'offertop' => 1, 'hotpartner' => 'toconfirmed'),
	// 		22 => array('default' => 'declined', 'monsterleads' => 3, 'offertop' => 2, 'hotpartner' => 'cancel'),
	// 		24 => array('default' => 'declined', 'monsterleads' => 3, 'offertop' => 2, 'hotpartner' => 'cancel'),
	// 		25 => array('default' => 'declined', 'monsterleads' => 3, 'offertop' => 2, 'hotpartner' => 'cancel'),
	// 		26 => array('default' => 'declined', 'monsterleads' => 3, 'offertop' => 2, 'hotpartner' => 'cancel'),
	// 		28 => array('default' => 'declined', 'monsterleads' => 3, 'offertop' => 2, 'hotpartner' => 'cancel'),
	// 	);

	// 	foreach ($data as $key => $value) {
	// 		$insAttr = array(
	// 			'DotStatus' => array(
	// 				'name' => $value['default'],
	// 				'ext_id' => $key,
	// 			)
	// 		);

	// 		$allSave[] = $insAttr;

	// 	}

	// 	if ($this->DotStatus->saveMany($allSave)) {
	// 	} else {
	// 		print_r($this->DotStatus->validationErrors);
	// 	}
	// }
}
