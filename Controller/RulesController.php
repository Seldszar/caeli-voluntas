<?php

App::uses('AppController', 'Controller');

class RulesController extends AppController {

	public $uses = array('Page');

	public $layout = 'two_column';

	public function index() {
		$this->Page->id = 'rules';

		if (!$this->Page->exists()) {
			throw new NotFoundException();
		}

		$this->set('page', $this->Page->read());
	}

	public function admin_index() {
		$this->Page->id = 'rules';

		if (!$this->Page->exists()) {
			throw new NotFoundException();
		}

		$this->layout = 'user';

		$this->set('page', $this->Page->read());
	}

	public function admin_edit() {
		$this->Page->id = 'rules';

		if (!$this->Page->exists()) {
			throw new NotFoundException();
		}

		$this->layout = 'user';

		$page = $this->Page->read();

		if ($this->request->is('put')) {
			$data = $this->data;

			if ($this->Page->save($data)) {
				$this->redirect(array('action' => 'index'));
			}
		} else {
			$this->data = $page;
		}
	}

	public function beforeFilter() {
		parent::beforeFilter();

		if (@$this->params['admin'] && !$this->Acl->hasRole('edit_rules')) {
			throw new UnauthorizedException("Vous n'êtes pas autorisé à accéder à cette page");
		}
	}

}
