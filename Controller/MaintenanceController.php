<?php

App::uses('AppController', 'Controller');

class MaintenanceController extends AppController {

	public $layout = 'maintenance';

	public function index() {
		$this->set('message', "En maintenance");
	}

}
