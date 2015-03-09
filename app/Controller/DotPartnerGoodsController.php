<?php

class DotPartnerGoodsController extends AppController {
	
	public $uses = array('DotPartnerGood', 'DotGood');
	
	public function getPartnerGoods() {
		$this->autoRender = false;
		$conditions = array();
		$order = array();
		$value = array();
		$joins = array();
		
		if(isset($this->request->query['id'])) {
			$id = $this->request->query['id'];
		} else {
			return;
		}

		if (isset($_GET['filter']['filters'])) {
			
			foreach ($_GET['filter']['filters'] as $filter) {
				
				
				if($filter['field'] == 'name' || $filter['field'] == 'alias') {
					if($_GET['filter']['logic'] == 'or') {
						$value[] = $filter['value'];	
					} else {
						$value = $filter['value'];
					}

					if($filter['operator'] == 'eq') {
					
						$conditions['DG.'. $filter['field']] = $value;
						$joins = array(
							array(
								"table" => "dot_goods",
								"alias" => "DG",
								"type" => "LEFT",
								"conditions" => array(
									"dot_good_id = DG.id"
								)
							),
						);
					
					} elseif($filter['operator'] == 'neq') {
					
						$conditions['DG.'. $filter['field'] . ' !='] = $value;
						$joins = array(
							array(
								"table" => "dot_goods",
								"alias" => "DG",
								"type" => "LEFT",
								"conditions" => array(
									"dot_good_id = DG.id"
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
					
						$conditions['DotGood.' . $filter['field']] = $value;
					
					} elseif($filter['operator'] == 'neq') {
					
						$conditions['DotGood.' . $filter['field'] . ' !='] = $value;
					}
				}	
			}
		}
		if (isset($_GET['sort'])) {

			foreach ($_GET['sort'] as $sort) {
				if($sort['field'] == 'alias' || $sort['field'] == 'name' || $sort['field'] == 'id' ) {
					$joins = array(
						array(
							"table" => "dot_goods",
							"alias" => "DG",
							"type" => "LEFT",
							"conditions" => array(
								"dot_good_id = DG.id"
							)
						),
					);
					$order[] = 'DG.'. $sort['field'] . ' '. $sort['dir'];

				} else {
					$order[] = $sort['field'] . ' '. $sort['dir'];
				}
			}
		}
		
		$conditions['dot_partner_id'] = $id;
		$pG = $this->DotPartnerGood->find('all', array(
			'order' => $order,
			'limit' => isset($_GET['take']) ? $_GET['take'] : null,
			'offset' => isset($_GET['skip']) ? $_GET['skip'] : null,
			"joins" => $joins,
			'conditions' => $conditions
		));
		
		$arrayForGrid = array();
		foreach ($pG as $good) {
			$good['DotGood']['price_define'] = null;
			
				$good['DotGood']['price_define'] = $good['DotPartnerGood']['price_define'];
				$good['DotGood']['dot_partner_good_id'] = $good['DotPartnerGood']['id'];
				$good['DotGood']['price_lead_define'] = $good['DotPartnerGood']['price_lead_define'];

			
			$arrayForGrid[] = $good['DotGood'];
		}
		
		$total = array($this->DotPartnerGood->find('count', array(
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

	public function getNotDefinePartnerGoods() {
		$this->autoRender = false;
		$conditions = array();
		$order = array();
		$value = array();
		$joins = array();
		$ids = array();
		
		if(isset($this->request->query['id'])) {
			$id = $this->request->query['id'];
		} else {
			return;
		}

		$pG = $this->DotPartnerGood->find('all', array(
			'conditions' => array(
				'dot_partner_id' => $id
			)
		));
		
		if(!empty($pG)) {
			foreach ($pG as $good) {
				$ids[] = $good['DotPartnerGood']['dot_good_id'];
			}
		}

		if (isset($_GET['filter']['filters'])) {
			
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
								"table" => "dot_partner_goods",
								"alias" => "PG",
								"type" => "LEFT",
								"conditions" => array(
									"DotGood.id = PG.dot_good_id"
								)
							),
						);
					
					} elseif($filter['operator'] == 'neq') {
					
						$conditions['PG.'. $filter['field'] . ' !='] = $value;
						$joins = array(
							array(
								"table" => "dot_partner_goods",
								"alias" => "PG",
								"type" => "LEFT",
								"conditions" => array(
									"DotGood.id = PG.dot_good_id"
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
					
						$conditions['DotGood.' . $filter['field']] = $value;
					
					} elseif($filter['operator'] == 'neq') {
					
						$conditions['DotGood.' . $filter['field'] . ' !='] = $value;
					}
				}	
			}
		}
		if (isset($_GET['sort'])) {

			foreach ($_GET['sort'] as $sort) {
				if($sort['field'] == 'price_define' || $sort['field'] == 'price_lead_define') {
					$joins = array(
						array(
							"table" => "dot_partner_goods",
							"alias" => "PG",
							"type" => "LEFT",
							"conditions" => array(
								"DotGood.id = PG.dot_good_id"
							)
						),
					);
					$order[] = 'PG.'. $sort['field'] . ' '. $sort['dir'];

				} else {
					$order[] = $sort['field'] . ' '. $sort['dir'];
				}
			}
		}
		if(!empty($ids)) {
			$conditions[] = array(
				'NOT' => array(
					'DotGood.id' => $ids
				)
			);
		}
		// print_r($conditions);die;

		$goods = $this->DotGood->find('all', array(
			'order' => $order,
			'limit' => isset($_GET['take']) ? $_GET['take'] : null,
			'offset' => isset($_GET['skip']) ? $_GET['skip'] : null,
			"joins" => $joins,
			'conditions' => $conditions,
		));
		
		$arrayForGrid = array();
		foreach ($goods as $good) {
			$good['DotGood']['price_define'] = null;
			
			if(isset($good['DotPartnerGood']) && !empty($good['DotPartnerGood'])) {
				
				foreach ($good['DotPartnerGood'] as $value) {
				
					if(isset($value['price_define']) && ($value['dot_partner_id'] == $id)) {
						$good['DotGood']['price_define'] = $value['price_define'];
						$good['DotGood']['price_lead_define'] = $value['price_lead_define'];
					}
				}


			}
			
			$arrayForGrid[] = $good['DotGood'];
		}
		$total = array($this->DotGood->find('count', array(
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
		
		if(isset($this->request->query['id'])) {
			$id = $this->request->query['id'];
		} else {
			return;
		}

		$insAttrPG = array();
		
		// update
		if(isset($this->request->data['dot_partner_good_id'])) {
			$insAttrPG = array(
				'id' => $this->request->data['dot_partner_good_id'],
				'price_define' => isset($this->request->data['price_define']) ? $this->request->data['price_define'] : null,
				'dot_good_id' => $this->request->data['id'],
				'dot_partner_id' => $id,
				'price_lead_define' => isset($this->request->data['price_lead_define']) ? $this->request->data['price_lead_define'] : null,
			);
		}
		
		if ($this->DotPartnerGood->save($insAttrPG)) {
		}
	}

	public function create() {

		$this->autoRender = false;
		
		if(isset($this->request->query['partner_id']) && isset($this->request->query['good_id'])) {
			$partnerId = $this->request->query['partner_id'];
			$goodId = $this->request->query['good_id'];
		} else {
			return;
		}

		$insAttrPG = array();
		
		// create
		$insAttrPG = array(
			// 'price_define' => isset($this->request->data['price_define']) ? $this->request->data['price_define'] : null,
			'dot_good_id' => $goodId,
			'dot_partner_id' => $partnerId,
			// 'price_lead_define' => isset($this->request->data['price_lead_define']) ? $this->request->data['price_lead_define'] : null,
		);
	
		if ($this->DotPartnerGood->save($insAttrPG)) {
			echo 'ok';
		}
	}

	function index() {
		$this->layout = false;
		if(isset($this->request->query['id'])) {
			$id = $this->request->query['id'];
		} else {
			return;
		}
		$this->set(array('id' => $id));
	}

	function addPrice() {
		$this->layout = false;
		if(isset($this->request->query['id'])) {
			$id = $this->request->query['id'];
		} else {
			return;
		}
		$this->set(array('id' => $id));
	}

	function delete() {
		$this->autoRender = false;

		if(isset($this->request->data['dot_partner_good_id'])) {
			$id = $this->request->data['dot_partner_good_id'];
		} else {
			return;
		}
		
		$this->DotPartnerGood->delete($id);
	}

}
