<?php

class PartnerGoodsController extends AppController {
	
	public $uses = array('PartnerGood', 'Good');
	
	public function getPartnerGoods() {
		$this->autoRender = false;
		$conditions = array();
		$order = array();
		$value = array();
		$joins = array();
		
		if(isset($_GET['id'])) {
			$id = $_GET['id'];
		} else {
			return;
		}

		if (isset($_GET['filter']['filters'])) {
			// print_r($_GET['filter']['filters']);die;

			foreach ($_GET['filter']['filters'] as $filter) {
				
				
				if($filter['field'] == 'price_lead_define' || $filter['field'] == 'price_define') {
					if($_GET['filter']['logic'] == 'or') {
						$value[] = $filter['value'];	
					} else {
						$value = $filter['value'];
					}

					if($filter['operator'] == 'eq') {
					
						$conditions['PG.'. $filter['field']] = $value;
						$joins = array(
							array(
								"table" => "partner_goods",
								"alias" => "PG",
								"type" => "LEFT",
								"conditions" => array(
									"Good.id = PG.good_id"
								)
							),
						);
					
					} elseif($filter['operator'] == 'neq') {
					
						$conditions['PG.'. $filter['field'] . ' !='] = $value;
						$joins = array(
							array(
								"table" => "partner_goods",
								"alias" => "PG",
								"type" => "LEFT",
								"conditions" => array(
									"Good.id = PG.good_id"
								)
							),
						);
					}

					
				} else {
					if($_GET['filter']['logic'] == 'or' || $_GET['filter']['logic'] == 'and') {
						$value = array();
						$value[] = $filter['value'];
					} else {
						$value = $filter['value'];
					}

					if($filter['operator'] == 'eq') {
					
						$conditions[$filter['field']] = $value;
					
					} elseif($filter['operator'] == 'neq') {
					
						$conditions[$filter['field'] . ' !='] = $value;
					}
				}	
			}
		}
		if (isset($_GET['sort'])) {

			foreach ($_GET['sort'] as $sort) {
				if($sort['field'] == 'price_define' || $sort['field'] == 'price_lead_define') {
					$joins = array(
						array(
							"table" => "partner_goods",
							"alias" => "PG",
							"type" => "LEFT",
							"conditions" => array(
								"Good.id = PG.good_id"
							)
						),
					);
					$order[] = 'PG.'. $sort['field'] . ' '. $sort['dir'];

				} else {
					$order[] = $sort['field'] . ' '. $sort['dir'];
				}
			}
		}
		$goods = $this->Good->find('all', array(
			'order' => $order,
			'limit' => isset($_GET['take']) ? $_GET['take'] : null,
			'offset' => isset($_GET['skip']) ? $_GET['skip'] : null,
			"joins" => $joins,
			'conditions' => $conditions,
		));
		
		$arrayForGrid = array();
		foreach ($goods as $good) {
			$good['Good']['price_define'] = null;
			
			if(isset($good['PartnerGood']) && !empty($good['PartnerGood'])) {
				
				foreach ($good['PartnerGood'] as $value) {
				
					if(isset($value['price_define']) && ($value['partner_id'] == $id)) {
						$good['Good']['price_define'] = $value['price_define'];
						$good['Good']['partner_good_id'] = $value['id'];
						$good['Good']['price_lead_define'] = $value['price_lead_define'];
					}
				}


			}
			
			$arrayForGrid[] = $good['Good'];
		}
		$total = array($this->Good->find('count', array(
			"joins" => $joins,
			'conditions' => $conditions,
		)));
		$resp = array(
			'data' => $arrayForGrid,
			'total' => $total
		);

		$q = json_encode($resp);

		return $q;
	}

	public function update( $id = null ) {

		$this->autoRender = false;
		
		if(isset($_GET['id'])) {
			$id = $_GET['id'];
		} else {
			return;
		}

		$insAttrPG = array();
		
		// update
		// print_r($this->request->data);die;
		if(isset($this->request->data['partner_good_id'])) {
			$insAttrPG = array(
				'id' => $this->request->data['partner_good_id'],
				'price_define' => isset($this->request->data['price_define']) && $this->request->data['price_define'] > 0 ? $this->request->data['price_define'] : null,
				'good_id' => $this->request->data['id'],
				'partner_id' => $id,
				'price_lead_define' => isset($this->request->data['price_lead_define']) && $this->request->data['price_lead_define'] > 0 ? $this->request->data['price_lead_define'] : null,
			);

		// create
		} else {
			$insAttrPG = array(
				'price_define' => isset($this->request->data['price_define']) && $this->request->data['price_define'] > 0 ? $this->request->data['price_define'] : null,
				'good_id' => $this->request->data['id'],
				'partner_id' => $id,
				'price_lead_define' => isset($this->request->data['price_lead_define']) && $this->request->data['price_lead_define'] > 0 ? $this->request->data['price_lead_define'] : null,
			);
		}
		
		if ($this->PartnerGood->save($insAttrPG)) {
		}
	}

	function index() {
		$this->layout = false;
		if(isset($_GET['id'])) {
			$id = $_GET['id'];
		} else {
			return;
		}
		$this->set(array('id' => $id));
	}

}
