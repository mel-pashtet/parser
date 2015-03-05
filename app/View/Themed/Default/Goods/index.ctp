<?php
	$this->DataGrid->defaults(array(
	    'ajax'          => false,                //Do we use AJAX for pagination, sorting and switching
	    'update'        => '#content',          //Conainer to update when we do an AJAX request
	    'column'        => array(               //Default settings for columns
	        'sort'              => false,       //Sorting on or off
	        'type'              => 'string',    //Type of the column
	        'htmlAttributes'    => false,       //Other HTML attributes
	        'header'            => false,       //Header settings
	        'iconClass'         => 'icon',      //Icon class
	        'indentOnThread'    => false,       //Indent on threaded data
	        'indentSize'        => 2,           //Indent size for nested grids
	        'rawData'           => false,        //Place this data one on one inside the field instead of searching for data
	        'escape'            => false,        //HTML escape retrieved data
	        'autoLink'          => false,        //Automatically create hyperlinks for URLs and e-mail addresses
	    ),
	    'grid'          => array(               //Default grid settings
	        'class' => 'data_grid'              //Class for datagrid
	    ),
	    'pagination'    => array(               //Default settings for pagination
	        'numbers' => array()                //Default settings for numbers
	    ),
	    'filter'        => array(               //Default settings for filters
	        'submit' => array()                 //Settings for submit
	    ),
	    'action' => array(                      //Default settings for actions
	        'options' => array(
	            'type' => 'link'                //Type of action link: can be 'link' or 'image'
	        )
	    ),
	));



	$this->DataGrid->addColumn('Id', 'Good.id');
	$this->DataGrid->addColumn('alias', 'Good.alias', array('sort' => true));
	$this->DataGrid->addColumn('name', 'Good.name', array('sort' => true));
	$this->DataGrid->addColumn('prise Zakup', 'Good.price_zakup', array('sort' => true));
	$this->DataGrid->addColumn('prise Prod', 'Good.price_prod', array('sort' => true));
	$this->DataGrid->addColumn('prise Vozv', 'Good.price_vozv', array('sort' => true));

	//Actions column to add actions to the row
	$this->DataGrid->addColumn('Actions', null, array('type' => 'actions'));

	//Add delete action to the actions column
	$this->DataGrid->addAction('Delete', array('action' => 'delete'), array('Good.id'));
	$this->DataGrid->addAction('Update', array('action' => 'update'), array('Good.id'));

	echo $this->DataGrid->generate($goods);