<?php

class GoodsController extends AppController {
	
	// public $paginate = array(
	// 	'limit' => 5,
	// );

	public function index() {
	}

	public function getGoods() {
		$this->autoRender = false;
		$conditions = array();
		$order = array();
		$value = array();
		
		if (isset($_GET['filter']['filters'])) {

			foreach ($_GET['filter']['filters'] as $filter) {
				if($filter['value'] == 'false') {
					$filter['value'] = 0;
				}
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
		$goods = $this->Good->find('all', array(
			'limit' => isset($_GET['take']) ? $_GET['take'] : null,
			'offset' => isset($_GET['skip']) ? $_GET['skip'] : null,
			'order' => $order,
			'conditions' => $conditions,
		));

		$total = array($this->Good->find('count', array(
			'conditions' => $conditions,
		)));
		
		$arrayForGrid = array();
		
		foreach ($goods as $good) {
			$arrayForGrid[] = $good['Good'];
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
			if($this->request->data['is_return'] == 'false') {
				$this->request->data['is_return'] = 0;
			}
			if($this->request->data['price_zakup'] <= 0) {
				$this->request->data['price_zakup'] = null;
			}
			if($this->request->data['price_prod'] <= 0) {
				$this->request->data['price_prod'] = null;
			}
			if($this->request->data['price_vozv'] <= 0) {
				$this->request->data['price_vozv'] = null;
			}
			if ($this->Good->save($this->request->data)) {
			}
		}

	}

	public function delete($id = null) {
		$this->autoRender = false;

		if ($this->request->data) {
			$id = $this->request->data['id'];
		}
		
		if($this->Good->delete($id)){

		}
	}

	function create() {
		$this->autoRender = false;
		if ($this->request->data) {
			if($this->request->data['is_return'] == 'false') {
				$this->request->data['is_return'] = 0;
			}
			if($this->request->data['price_zakup'] <= 0) {
				$this->request->data['price_zakup'] = null;
			}
			if($this->request->data['price_prod'] <= 0) {
				$this->request->data['price_prod'] = null;
			}
			if($this->request->data['price_vozv'] <= 0) {
				$this->request->data['price_vozv'] = null;
			}
			if ($this->Good->save($this->request->data)) {
			}
		}
	}

}
