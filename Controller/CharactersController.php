<?php

App::uses('AppController', 'Controller');

class CharactersController extends AppController {

	public $uses = array('Character');

	public $layout = 'user';

	public function index() {
		$this->set('realms', $this->Character->Realm->find('all', array(
			'contain' => array(
				'Character' => array(
					'conditions' => array(
						'user' => $this->Auth->user('id')
					)
				)
			)
		)));
	}

	public function create() {
		if ($this->request->is('post')) {
			$data = $this->data;

			$this->Character->create();

			if ($this->Character->save($data, true, array('class', 'user', 'realm', 'name'))) {
				$this->redirect(array('action' => 'index'));
			}
		}

		$this->set('realms', $this->Character->Realm->find('list'));
		$this->set('classes', $this->Character->CharacterClass->find('list'));
	}

	public function delete($id) {
		$this->Character->id = $id;

		if (!$this->Character->exists()) {
			throw new NotFoundException("Le personnage demandé est introuvable");
		}

		if ($this->Character->field('user') != $this->Auth->user('id')) {
			throw new UnauthorizedException("Vous n'êtes pas autorisé à supprimer ce personnage");
		}

		$this->Character->delete();

		$this->redirect(array('action' => 'index'));
	}

	public function beforeFilter() {
		$this->Auth->deny();
	}

}
