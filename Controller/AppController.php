<?php

App::uses('Controller', 'Controller');

class AppController extends Controller {

	public $layout = 'one_column';

	var $components = array(
		'Session',
		'Auth' => array(
			'authError' => "Vous devez d'abord vous connecter avant de pouvoir accéder à cette page",
	        'loginAction' => array('controller' => 'users', 'action' => 'login', 'admin' => false),
	        'loginRedirect' => array('controller' => 'blog', 'action' => 'index', 'admin' => false),
	        'logoutRedirect' => array('controller' => 'blog', 'action' => 'index', 'admin' => false),
			'authenticate' => array(
				'Form' => array(
					'fields' => array('username' => 'email'),
					'scope' => array('User.active' => true)
				)
			)
		),
	    'Acl'
	);

	public $helpers = array(
		'Html' => array(
			'className' => 'SzHtml'
		),
		'BBCode',
		'Session' => array(
			//'className' => 'CaSession'
		)
	);

	public function beforeFilter() {
		$this->Auth->allow();

		if ($this->params['prefix'] == 'admin') {
			$this->Auth->deny();
		}
	}

	public function beforeRender() {
		if ($this->params['prefix'] == 'admin') {
			$this->layout = 'user';
		}

		if($this->name == 'CakeError') {
			$this->layout = 'error';
		}

	    if ($this->request->is('ajax')) {
			$this->layout = 'ajax';
		}
	}

}
