<?php

class DotPartnersController extends AppController {
	
	public function index() {
	}

	public function getPartners() {
		$this->autoRender = false;
		$conditions = array();
		$order = array();
		$value = array();

		
		if (isset($_GET['filter']['filters'])) {
	
			foreach ($_GET['filter']['filters'] as $filter) {
				if($filter['operator'] == 'eq') {
					
					if($_GET['filter']['logic'] == 'or' || $_GET['filter']['logic'] == 'and') {
						$value = array();
						$value[] = $filter['value'];	
					} else {
						$value = $filter['value'];
					}

					$conditions[$filter['field']] = $value;
				} elseif($filter['operator'] == 'neq') {

					if($_GET['filter']['logic'] == 'or') {
						$value[] = $filter['value'];	
					} else {
						$value = $filter['value'];
					}
					$conditions[$filter['field'] . ' !='] = $value;
				} elseif($filter['operator'] == 'startswith') {
					if($_GET['filter']['logic'] == 'or') {
						$value[] = $filter['value'];	
					} else {
						$value = $filter['value'];
					}
					$conditions[$filter['field'] . ' LIKE'] = '%' . $value . '%';
				}
			}
		}
		if (isset($_GET['sort'])) {

			foreach ($_GET['sort'] as $sort) {
				$order[] = $sort['field'] . ' '. $sort['dir'];
			}
		}
		// print_r($conditions);
		$partners = $this->DotPartner->find('all', array(
			'limit' => isset($_GET['take']) ? $_GET['take'] : null,
			'offset' => isset($_GET['skip']) ? $_GET['skip'] : null,
			'order' => $order,
			'conditions' => $conditions,
		));

		$total = array($this->DotPartner->find('count', array(
			'conditions' => $conditions,
		)));
		
		$arrayForGrid = array();
		
		foreach ($partners as $partner) {
			$arrayForGrid[] = $partner['DotPartner'];
		}
		
		$resp = array(
			'data' => $arrayForGrid,
			'total' => $total
		);
		
		$resp = json_encode($resp);
		return $resp;
	}

	public function update( $id = null ) {
		$this->autoRender = false;
		// print_r($this->request);die;
		if ($this->request->data) {
			
			if ($this->DotPartner->save($this->request->data)) {
			} else {
				print_r($this->DotPartner->validationErrors);
			}
		}

	}

	public function delete($id = null) {
		$this->autoRender = false;

		if ($this->request->data) {
			$id = $this->request->data['id'];
		}
		$this->DotPartner->delete($id);
	}

	public function create() {
		$this->autoRender = false;
		if ($this->request->data) {
			if ($this->DotPartner->save($this->request->data)) {
			}
		}
	}
	// public function addPartnersToDB() {
	// 	$this->autoRender = false;
	// 	$data = array(
	// 		array('id' => 1, 'key' => 'qhmKw1RKf2RfdbfGaU3ZMbUQ7jsiNcL0', 'name' => 'КЦ Cartli'),
	// 		array('id' => 2, 'key' => 'VWNKrw0qzOkk6qQQ0tjqHfbJboDQIOKS', 'name' => 'КЦ Atlanta'),
	// 		array('id' => 3, 'key' => 'j20iNg0oAn56dMJOcWj8PwWyjU0rFFs9', 'name' => 'Партнерка  ADWAD'),
	// 		array('id' => 4, 'key' => 'Q5PTGp6nKZOBfVLWRaartps0YWu4ybA1', 'name' => 'Свои сайты'),
	// 		array('id' => 5, 'key' => 'QxfkzrVkkD3VOJaATHc1spieFH8SfXqn', 'name' => 'Oxcpa'),
	// 		array('id' => 6, 'key' => 'RL5HbGfiUECCza08ttXT06NfekGj1DgF', 'name' => 'KMA'),
	// 		array('id' => 7, 'key' => 'GDHFRYeJg6D1vI6E4QugzVHgC1odwvEi', 'name' => 'MonsterLeads'),
	// 		array('id' => 8, 'key' => 'ThbuEzZPbdwfCGs7N9vP6gRpPtTd8OTa', 'name' => 'LeadsPartner'),
	// 		array('id' => 9, 'key' => '6xYkqPNaNG2Ia4lu0nJ5jL0VBBz8lbul', 'name' => 'Cpagetti'),
	// 		array('id' => 10, 'key' => 'tCxujKUrSYgupUsZ0gDWCp4bBQIYNEU2', 'name' => 'CTR.ru'),
	// 		array('id' => 11, 'key' => 'eBCDQcTPAyrqTPrEDjhl3czspH7ItEw4', 'name' => 'ActionAds tech'),
	// 		array('id' => 12, 'key' => 'CNAr03QCgjhp6lbwPwStkjzVg29E2sCJ', 'name' => 'Clobucks'),
	// 		array('id' => 13, 'key' => 'OWdGBFg9zv4kXnAB1AmDK44zCXsFoL8h', 'name' => 'ADSLeader'),
	// 		array('id' => 14, 'key' => 'tUc0waB5PaaO35FV4as5Cefx965w0ZUJ', 'name' => 'Lead-r'),
	// 		array('id' => 15, 'key' => 'hhie9u65v1tWemOwXLn1bhQkmyVI5B9J', 'name' => 'LeadPays'),
	// 		array('id' => 16, 'key' => 'JFORqD8r0cNCa7dRabLHljFelnsIPF7o', 'name' => 'Hotpartner Ukraine'),
	// 		array('id' => 17, 'key' => 'Zy3GaQwae5T2J0ORRR6727p3DJxq5FOr', 'name' => 'OfferTop'),
	// 		array('id' => 18, 'key' => 'XcmQTjHAWEVCcbc9XZytBseM5M5Mkvky', 'name' => 'Everad'),
	// 	);
	// 	$insAttr = array();
	// 	$allSave = array();

	// 	foreach ($data as $onePart) {
	// 		$insAttr = array(
	// 			'DotPartner' => array(
	// 				'id' => $onePart['id'],
	// 				'name' => $onePart['name'],
	// 				'secret_key' => $onePart['key'],
	// 				'price_lead' => null,
	// 			)
	// 		);
	// 		$allSave[] = $insAttr;
	// 	}

	// 	if ($this->DotPartner->saveMany($allSave)) {
	// 	} else {
	// 		print_r($this->DotGood->validationErrors);
	// 	}
	// }

}
