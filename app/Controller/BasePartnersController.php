<?php

class BasePartnersController extends AppController {
	public $uses = array('DotPartnerGood', 'BasePartner', 'DotGood');
	public function index() {
		$insAttr = array();
		$saveAll = array();
		ini_set('memory_limit', '-1');
		$this->autoRender = false;
		$partners = $this->BasePartner->find('all', array(
			'limit' => 1,
			// 'group' => 'offer',
		));
		print_r($partners);die;

		$goods = $this->DotGood->find('all', array(
		));
		// foreach ($partners as $partner) {
		// 	foreach ($goods as $good) {
		// 		if(isset($partner['DotPartner'])) {
		// 			if($good['DotGood']['alias'] == $partner['BasePartner']['offer']) {

		// 				$insAttr = array(
		// 					'dot_partner_id' => $partner['DotPartner']['id'],
		// 					'dot_good_id' => $good['DotGood']['id'],
		// 				);
		// 				$saveAll[] = $insAttr;
		// 			}
		// 			//  else {
		// 			// 	var_dump($partner['BasePartner']['offer']);
		// 			// 	print_r("\n");
		// 			// 	var_dump($good['DotGood']['alias']);die;
		// 			// }
		// 		}
			
		// 	}
			
		// }

		// // print_r($saveAll);die;
		// if ($this->DotPartnerGood->saveMany($saveAll)) {
		// } else {
		// 	print_r($this->DotPartnerGood->validationErrors);
		// }
	}


}
