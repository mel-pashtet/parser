<?php

class SiteController extends AppController {

	public function beforeFilter() {
		parent::beforeFilter();
		// $this->Auth->allow();
	}

	public function index() {
	}
}
