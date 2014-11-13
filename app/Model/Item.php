<?php

class Item extends Model {
	var $name = 'Item';
	var $hasMany = array('ItemPhotos' =>
		array('className'    => 'ItemPhotos',
			  'conditions'   => '',
			  'order'        => '',
			  'dependent'    =>  true,
			  'foreignKey'   => 'item_id'
		)
	);
}
