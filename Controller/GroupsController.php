<?php

App::uses('AppController', 'Controller');

class GroupsController extends AppController {

	public $uses = array('Group', 'Role');

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

		$roles = array();

		if (!in_array($id, array(1, 2))) {
			$roles = $this->Role->find('list');
		}

		$this->set('roles', $roles);
	}

	public function admin_edit($id) {
		$this->Group->id = $id;

		if (!$this->Group->exists()) {
			throw new NotFoundException("Le groupe demandé est introuvable");
		}

		if ($this->request->is('put')) {
			$data = $this->data;

			if (in_array($id, array(1, 2))) {
				unset($data['Role']);
			}

			if ($this->Group->save($data)) {
				$this->redirect(array('action' => 'index'));
			}
		} else {
			$this->Group->contain(array('Role'));
			$this->data = $this->Group->read();
		}

		$roles = array();

		if (!in_array($id, array(1, 2))) {
			$roles = $this->Role->find('list');
		}

		$this->set('roles', $roles);
	}

	public function admin_delete($id) {
		$this->Group->id = $id;

		if (!$this->Group->exists()) {
			throw new NotFoundException("Le groupe demandé est introuvable");
		}

		$userCount = $this->Group->User->find('count', array('conditions' => array('group' => $id)));
		$canDelete = false;

		if ($userCount == 0) {
			$canDelete = true;
		} else if ($this->request->is('put')) {
			$data = $this->data;

			if ($this->Group->User->updateAll(array('group' => $data['Group']['id']), array('group' => $id))) {
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

		if ($this->Auth->user()) {
			if (isset($this->params['admin']) && !$this->Acl->hasRole('manage_groups')) {
				throw new UnauthorizedException("Vous n'êtes pas autorisé à accéder à cette page");
			}
		}
	}

}
