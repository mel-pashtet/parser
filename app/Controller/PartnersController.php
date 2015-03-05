<?php

class PartnersController extends AppController {
	// var $helpers = array('CakeGrid.Grid');
	// public $uses = array('PartnerGood', 'Partner', 'Good');

	// public $components = array('Paginator');

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
				}
			}
		}
		if (isset($_GET['sort'])) {

			foreach ($_GET['sort'] as $sort) {
				$order[] = $sort['field'] . ' '. $sort['dir'];
			}
		}
		$partners = $this->Partner->find('all', array(
			'limit' => isset($_GET['take']) ? $_GET['take'] : null,
			'offset' => isset($_GET['skip']) ? $_GET['skip'] : null,
			'order' => $order,
			'conditions' => $conditions,
		));

		$total = array($this->Partner->find('count', array(
			'conditions' => $conditions,
		)));
		
		$arrayForGrid = array();
		
		foreach ($partners as $partner) {
			$arrayForGrid[] = $partner['Partner'];
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
		if ($this->request->data) {
			if($this->request->data['price_lead'] <= 0) {
				$this->request->data['price_lead'] = null;
			}
			if ($this->Partner->save($this->request->data)) {
			}
		}

	}

	public function delete($id = null) {
		$this->autoRender = false;

		if ($this->request->data) {
			$id = $this->request->data['id'];
		}
		$this->Partner->delete($id);
	}

	function create() {
		$this->autoRender = false;
		if ($this->request->data) {
			if($this->request->data['price_lead'] <= 0) {
				$this->request->data['price_lead'] = null;
			}
			if ($this->Partner->save($this->request->data)) {
			}
		}
	}

}
