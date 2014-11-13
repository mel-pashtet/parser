<?php

class ItemsController extends AppController {
	public $uses = array('ItemPhotos', 'Item');

	// public $components = array('Paginator');

	// public $paginate = array(
	// 	'limit' => 1,
	// );

	function create() {
		$success = false;
		foreach ($this->data['results'] as $key => $oneItem) {
		
			foreach ($oneItem as $key => $value) {
				if($key == 'itemPhotos'){
					$photos = $value;

				}
				$result[$key] = $value;
			}
			
			$attr = array(
				'Item' => $result
			);
			
			if (!empty($attr)) {
				$newItem = new $this->Item();
				
				if ($newItem->save($attr)) {
					$success = true;
					
					foreach ($photos as $key => $value) {
						$attrItemPhotos = array(
							'ItemPhotos' => array(
								'item_id' => $newItem->id,
								'photo' => $value
							),
						);
						$newFoto = new $this->ItemPhotos();
						if($newFoto->save($attrItemPhotos)) {
							$success = true;
						} else {
							$success = false;
						}

					}
					$this->autoRender = false;
				} else {
					$success = false;
				}
			}
		}

		echo json_encode(array(
			'success' => $success,
			'count' => count($this->data['results']),
		));

	}

	public function listItems() {
		
		$searchValues = array();
		$similarItems = array();

		$arraySelect = array(
			'phone' => 'телефон',
			'author' => 'автор',
			'email' => 'email',
			'title' => 'название',
		);
		$searchField = array_flip($arraySelect);
		$searchField = reset($searchField);
		
		if (!empty($this->data)) {
			$searchField = $this->data['Item']['select'];
		}
		
		$items = $this->Item->find('all', array(
			'fields' => array(
				"$searchField", "COUNT($searchField) as Total"
			),
			'group' => array(
				"$searchField HAVING Total > 1"
			),
			'order' => array(
				'Total desc'
			), 
		));

		$originalRecords = $this->Item->find('all', array(
			'fields' => array(
				'*', "COUNT($searchField) as Total"
			),
			'group' => array(
				"$searchField HAVING Total = 1"
			),
			'order' => array(
				'Total desc'
			), 
		));
		
		foreach ($items as $key => $value) {
			$searchValues[] = $value['Item'][$searchField]; 
			
		}
		$similarItems = $this->Item->find('all', array(
				'conditions' => array(
					"$searchField" => $searchValues,
				),
				'order' => array("$searchField"),
		));

		// $this->Paginator->settings = $this->paginate;
		// $this->Paginator->settings['order'] = array(
		// 	"$searchField" => 'desc'
		// );
		// $data = $this->Paginator->paginate('Item', array(
			
		// 		"$searchField" => $searchValues,
		// 	)
		// );

		// $data1 = $this->Paginator->paginate('Item', array(
			
		// 		"$searchField !=" => $searchValues,
		// 	)
		// );
		// print_r($searchField);
		
		$this->set(array('similarItems' => $similarItems, 'select' => $arraySelect, 'originalRecords' => $originalRecords));
	}

	

}
