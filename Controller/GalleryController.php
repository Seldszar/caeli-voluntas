<?php

App::uses('AppController', 'Controller');

class GalleryController extends AppController {

	public $uses = array('GalleryImage');

	public function index() {
		$this->paginate = array(
			'GalleryImage' => array(
				'limit' => 9
			)
		);

		$this->set('images', $this->paginate('GalleryImage'));
	}

	public function view($id) {
		$this->GalleryImage->id = $id;

		if (!$this->GalleryImage->exists()) {
			throw new NotFoundException("L'image demandée n'existe pas");
		}

		$this->set('image', $this->GalleryImage->read());
	}

	public function admin_index() {
		$this->set('images', $this->GalleryImage->find('all'));
	}

	public function admin_create() {
		if ($this->request->is('post')) {
			$data = $this->data;
			if ($this->GalleryImage->save($data)) {
				$this->redirect(array('action' => 'index'));
			}
		}
	}
	
	public function admin_delete($id) {
		$this->GalleryImage->id = $id;

		if (!$this->GalleryImage->exists()) {
			throw new NotFoundException("L'image demandée n'existe pas");
		}
		
		if ($this->GalleryImage->delete()) {
			$this->redirect(array('action' => 'index'));
		}
	}

	public function beforeFilter() {
		parent::beforeFilter();

		if (isset($this->params['admin']) && !$this->Acl->hasRole('manage_gallery')) {
			throw new UnauthorizedException("Vous n'êtes pas autorisé à accéder à cette page");
		}
	}

}
