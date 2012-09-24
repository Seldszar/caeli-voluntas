<?php

App::uses('AppController', 'Controller');

class ForumCategoriesController extends AppController {

	public $uses = array('ForumCategory');

	public $layout = 'user';

	public function admin_index() {
		$this->set('categories', $this->ForumCategory->find('all', array(
			'order' => array(
				'position' => 'ASC',
				'id' => 'ASC'
			)
		)));
	}

	public function admin_view($id) {
		$this->ForumCategory->id = $id;

		if (!$this->ForumCategory->exists()) {
			throw new NotFoundException("La catégorie demandée est introuvable");
		}

		$this->ForumCategory->contain(array(
			'Forum' => array('id', 'name', 'description')
		));

		$this->set('category', $this->ForumCategory->read());
	}

	public function admin_create() {
		if ($this->request->is('post')) {
			$data = $this->data;

			if ($this->ForumCategory->save($data)) {
				$this->redirect(array('action' => 'index'));
			}
		}
	}

	public function admin_edit($id) {
		$this->ForumCategory->id = $id;

		if (!$this->ForumCategory->exists()) {
			throw new NotFoundException("La catégorie demandée est introuvable");
		}

		$category = $this->ForumCategory->read();

		if ($this->request->is('put')) {
			$data = $this->data;

			if ($this->ForumCategory->save($data)) {
				$this->redirect(array('action' => 'index'));
			}
		} else {
			$this->data = $category;
		}
	}

	public function admin_delete($id) {
		$this->ForumCategory->id = $id;

		if (!$this->ForumCategory->exists()) {
			throw new NotFoundException("La catégorie demandée est introuvable");
		}

		if ($this->ForumCategory->delete()) {
			$this->redirect(array('action' => 'index'));
		}
	}

	public function admin_order() {
		if (!$this->request->is('ajax')) {
			throw new MethodNotAllowedException();
		}

		$position = 0;

		foreach ($this->data['category'] as $_id) {
			$this->ForumCategory->id = $_id;

			if ($this->ForumCategory->exists()) {
				$this->ForumCategory->saveField('position', $position++);
			}
		}

		return new CakeResponse(array('body' => json_encode(array('error' => null))));
	}

	public function beforeFilter() {
		if (isset($this->params['admin']) && !$this->Acl->hasRole('manage_forums')) {
			throw new UnauthorizedException("Vous n'êtes pas autorisé à accéder à cette page");
		}
	}

}
