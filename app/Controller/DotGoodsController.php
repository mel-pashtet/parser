<?php

class DotGoodsController extends AppController {
	
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
		$goods = $this->DotGood->find('all', array(
			'limit' => isset($_GET['take']) ? $_GET['take'] : null,
			'offset' => isset($_GET['skip']) ? $_GET['skip'] : null,
			'order' => $order,
			'conditions' => $conditions,
		));

		$total = array($this->DotGood->find('count', array(
			'conditions' => $conditions,
		)));
		
		$arrayForGrid = array();
		
		foreach ($goods as $good) {
			$arrayForGrid[] = $good['DotGood'];
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
			if ($this->DotGood->save($this->request->data)) {
			}
		}

	}

	public function delete($id = null) {
		$this->autoRender = false;

		if ($this->request->data) {
			$id = $this->request->data['id'];
		}
		
		if($this->DotGood->delete($id)){

		}
	}

	public function create() {
		$this->autoRender = false;
		if ($this->request->data) {
			if ($this->DotGood->save($this->request->data)) {
			} else {
				// print_r($this->DotGood->validationErrors);die;
			}
		}
	}
	// public function addGoodsToDB() {
	// 	$this->autoRender = false;
		
	// 	$data = array(
	// 		'avtovushivanka' => array('default' => 'Автовышиванка'),
	// 		'watch-pandora' => array('default' => 'Часы Pandora'),
	// 		'power balance' => array('default' => 'Браслет PowerBalance'),
	// 		'power balance 2' => array('default' => 'Браслет PowerBalance 2'),
	// 		'zerosmoke' => array('default' => 'Биомагниты Zerosmoke'),
	// 		'homyak' => array('default' => 'Говорящий хомяк'),
	// 		'sexgum' => array('default' => 'Жвачка Sex Gum'),
	// 		'extazgum' => array('default' => 'Жвачка Extaz Gum'),
	// 		'lossgum' => array('default' => 'Жвачка для похудения'),
	// 		'detonatorgum' => array('default' => 'Жвачка Детонатор'),
	// 		'spray-shelk' => array('default' => 'Жидкий шелк'),
	// 		'savingbox' => array('default' => 'Энергосберегатель'),
	// 		'economitel-vodu' => array('default' => 'Экономитель воды'),
	// 		'fixitpro' => array('default' => 'Карандаш fix it pro'),
	// 		'cream for breasts' => array('default' => 'Крем для груди'),
	// 		'kremchlen' => array('default' => 'Крем для увеличения члена'),
	// 		'kresttoretto' => array('default' => 'Крест торетто'),
	// 		'vlastelinkolec' => array('default' => 'Кольцо Всевластия'),
	// 		'posture-corrector' => array('default' => 'Корректор осанки'),
	// 		'kosmodisk' => array('default' => 'Космодиск'),
	// 		'kulon-trusb' => array('default' => 'Кулон тризуб'),
	// 		'laser' => array('default' => 'Лазеная указка'),
	// 		'flyingfairy' => array('default' => 'Летающая фея'),
	// 		'montea' => array('default' => 'Монастырский чай'),
	// 		'dao-tea' => array('default' => 'Даосский чай'),
	// 		'monsterbeats' => array('default' => 'Наушники MonsterBeats'),
	// 		'card sharp' => array('default' => 'Нож-кредитка'),
	// 		'sosu' => array('default' => 'Носочки SOSU'),
	// 		'bambuk' => array('default' => 'Носки бамбук 20 пар'),
	// 		'nicerdicer' => array('default' => 'Овощерезки найсердайсер'),
	// 		'plenka-sauna' => array('default' => 'Пленка сауна'),
	// 		'dendy' => array('default' => 'Приставка Dendy'),
	// 		'kosichki' => array('default' => 'Прибор для плетения косичек'),
	// 		'magicworm' => array('default' => 'Пушистик байла'),
	// 		'chia-seeds' => array('default' => 'Семена-Чиа'),
	// 		'strutz' => array('default' => 'Стельки штрутц'),
	// 		'teploekran' => array('default' => 'Теплоэкран'),
	// 		'valgus pro' => array('default' => 'Фиксатор Вальгус Про'),
	// 		'sharhan1101' => array('default' => 'Фонарик-электрошокер'),
	// 		'watch-geneva' => array('default' => 'Часы Geneva'),
	// 		'watch-gshock' => array('default' => 'Часы G-Shock'),
	// 		'watch-daytona' => array('default' => 'Часы Rolex Daytona'),
	// 		'watch-skeleton' => array('default' => 'Часы Скелетоны'),
	// 		'watch-ulisnardin' => array('default' => 'Часы Ulysse nardin'),
	// 		'watch-breitling' => array('default' => 'Часы Breitling'),
	// 		'watch-curren' => array('default' => 'Часы Curren'),
	// 		'watch-rado' => array('default' => 'Часы RADO'),
	// 		'watch-patek' => array('default' => 'Часы Patek Philippe'),
	// 		'chehol-tel' => array('default' => 'Чехлы на телефон'),
	// 		'babyliss' => array('default' => 'BabyLissPro'),
	// 		'slim fit' => array('default' => 'Slimfit'),
	// 		'magicglance' => array('default' => 'Magic glance'),
	// 		'magicbeauty' => array('default' => 'Magic beauty'),
	// 		'whitelite' => array('default' => 'Whitelite'),
	// 		'fuelshark' => array('default' => 'Fuelshark'),
	// 		'detonatorgum' => array('default' => 'Жевательная резинка "Детонатор"'),
	// 		'greencoffe' => array('default' => 'Green Coffe'),
	// 		'greentea' => array('default' => 'Зеленый чай для похудения'),
	// 		'gojibarries' => array('default' => 'Средство для похудения "Ягоды Годжи"'),
	// 		'antihrap' => array('default' => 'Клипса-антихрап'),
	// 		'aquagel' => array('default' => 'Аквагель - лучшее средство для авто'),
	// 		'molottora' => array('default' => 'Капли для потенции "Молот тора"'),
	// 		'shevelux' => array('default' => 'Спрей для роста волос "Shevelux"'),
	// 		'elka' => array('default' => 'Елка'),
	// 		'elka15' => array('default' => 'Елка 1.5м'),
	// 		'elka18' => array('default' => 'Елка 1.8м'),
	// 		'elka20' => array('default' => 'Елка 2.0м'),
	// 		'elka22' => array('default' => 'Елка 2.2м'),
	// 		'elka24' => array('default' => 'Елка 2.4м'),
	// 		'elka26' => array('default' => 'Елка 2.6м'),
	// 		'sosna11' => array('default' => 'Сосна 1.1м'),
	// 		'sosna16' => array('default' => 'Сосна 1.6м'),
	// 	);
		
	// 	$priceData = array(
	// 			'savingbox' => array('price' => 660),
	// 			'valgus pro' => array('price' => 498),
	// 			'sosu' => array('price' => 578),
	// 			'posture-corrector' => array('price' => 658),
	// 			'zerosmoke' => array('price' => 498),
	// 			'power balance' => array('price' => 698),
	// 			'power balance 2' => array('price' => 698),
	// 			'chia-seeds' => array('price' => 598),
	// 			'flyingfairy' => array('price' => 1158),
	// 			'vlastelinkolec' => array('price' => 598),
	// 			'sharhan1101' => array('price' => 898),
	// 			'nicerdicer' => array('price' => 798),
	// 			'babyliss' => array('price' => 2800),
	// 			'kosmodisk' => array('price' => 698),
	// 			'monsterbeats' => array('price' => 798),
	// 			'strutz' => array('price' => 598),
	// 			'bambuk' => array('price' => 598),
	// 			'slim fit' => array('price' => 598),
	// 			'chehol-tel' => array('price' => 498),
	// 			'cream for breasts' => array('price' => 640),
	// 			'laser' => array('price' => 820),
	// 			'montea' => array('price' => 600),
	// 			'sexgum' => array('price' => 640),
	// 			'extazgum' => array('price' => 640),
	// 			'dietgum' => array('price' => 694),
	// 			'dendy' => array('price' => 1000),
	// 			'kremchlen' => array('price' => 660),
	// 			'fuelshark' => array('price' => 698),
	// 			'whitelite' => array('price' => 600),
	// 			'economitel-vodu' => array('price' => 660),
	// 			'avtovushivanka' => array('price' => 598),
	// 			'fixitpro' => array('price' => 598),
	// 			'kresttoretto' => array('price' => 598),
	// 			'kulon-trusb' => array('price' => 598),
	// 			'kosichki' => array('price' => 640),
	// 			'watch-breitling' => array('price' => 1070),
	// 			'watch-ulisnardin' => array('price' => 1358),
	// 			'watch-curren' => array('price' => 998),
	// 			'watch-rado' => array('price' => 2590),
	// 			'watch-patek' => array('price' => 998),
	// 			'watch-pandora' => array('price' => 1140),
	// 			'watch-daytona' => array('price' => 1798),
	// 			'spray-shelk' => array('price' => 518),
	// 			'detonatorgum' => array('price' => 952),
	// 			'dao-tea' => array('price' => 598),
	// 			'plenka-sauna' => array('price' => 538),
	// 			'magicworm' => array('price' => 598),
	// 		);
	// 	$saveAll = array();

	// 	foreach ($data as $alias => $name) {
	// 		if(array_key_exists($alias, $priceData)) {
				
	// 			$insAttr = array(
	// 				'DotGood' => array(
	// 					'alias' => $alias,
	// 					'name' => $name['default'],
	// 					'price_prod' => reset($priceData[$alias]),
	// 				)
	// 			);
				
	// 		} else {
	// 			$insAttr = array(
	// 				'DotGood' => array(
	// 					'alias' => $alias,
	// 					'name' => $name['default'],
	// 					'price_prod' => null,
	// 				)
	// 			);
	// 		}
	// 		$saveAll[] = $insAttr;
			
	// 	}

	// 	if ($this->DotGood->saveMany($saveAll)) {
	// 	} else {
	// 		print_r($this->DotGood->validationErrors);
	// 	}
	// 	// die('ops');
	// }

}
