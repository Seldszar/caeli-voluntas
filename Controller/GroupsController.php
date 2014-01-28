<?php

App::uses('AppController', 'Controller');

class GroupsController extends AppController {

	public $layout = 'two_column';

	public $uses = array('Group', 'User', 'Role');

	public function index() {
		$this->set('groups', $this->Group->findAllByVisibleInRoster(true));
	}

	public function admin_index() {
		$this->set('groups', $this->Group->find('all'));
	}

	public function admin_create() {
		if ($this->request->is('post')) {
			$data = $this->data;

			if (in_array($id, array(1, 2))) {
				unset($data['Role']);
			}

			if ($this->Group->save($data)) {
				$this->redirect(array('action' => 'index'));
			}
		}

		$this->set('roles', $this->Role->find('list'));
	}

	public function admin_edit($id) {
		$this->Group->id = $id;

		if (!$this->Group->exists()) {
			throw new NotFoundException("Le groupe demandé est introuvable");
		}

		$this->Group->contain(array(
			'Role'
		));

		if ($this->request->is('put')) {
			$data = $this->data;

			if (!$this->Group->field('editable')) {
				unset($data['Role']);
			}

			if ($this->Group->save($data)) {
				$this->redirect(array('action' => 'index'));
			}
		} else {
			$this->data = $this->Group->read();
		}

		$roles = array();

		if ($this->Group->field('editable')) {
			$roles = $this->Role->find('list');
		}

		$this->set('roles', $roles);
	}

	public function admin_delete($id) {
		$this->Group->id = $id;

		if (!$this->Group->exists()) {
			throw new NotFoundException("Le groupe demandé est introuvable");
		}

		$userCount = $this->User->find('count', array('conditions' => array('group' => $id)));
		$canDelete = false;

		if ($userCount == 0) {
			$canDelete = true;
		} else if ($this->request->is('put')) {
			$data = $this->data;

			if ($this->User->updateAll(array('group' => $data['Group']['id']), array('group' => $id))) {
				$canDelete = true;
			}
		} else {
			$this->set('groups', $this->Group->find('list', array(
				'conditions' => array(
					'id <>' => $id,
					'visible' => true
				)
			)));
		}

		if ($canDelete) {
			if ($this->Group->delete()) {
				$this->redirect(array('action' => 'index'));
			}
		}
	}

	public function beforeFilter() {
		parent::beforeFilter();

		if (isset($this->params['admin']) && !$this->Acl->hasRole('manage_groups')) {
			throw new UnauthorizedException("Vous n'êtes pas autorisé à accéder à cette page");
		}
	}

}
