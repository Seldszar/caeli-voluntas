<?php

App::uses('AppController', 'Controller');

class CharactersController extends AppController {

	public $uses = array('Character', 'CharacterClass', 'Realm');
	public $layout = 'user';

	public function index() {
		$this->set('realms', $this->Realm->find('all', array(
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

			if ($this->Character->save($data)) {
				$this->redirect(array('action' => 'index'));
			}
		}

		$this->set('realms', $this->Realm->find('list'));
		$this->set('classes', $this->CharacterClass->find('list'));
	}

	public function delete($id) {
		$this->Character->id = $id;

		if (!$this->Character->exists()) {
			throw new NotFoundException("Le personnage demandé est introuvable");
		}

		if (!$this->canTouchCharacter($id)) {
			throw new UnauthorizedException("Vous n'êtes pas autorisé à supprimer ce personnage");
		}

		if ($this->Character->delete()) {
			$this->redirect(array('action' => 'index'));
		}
	}

	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->deny();
	}

    /**
     * Indique si l'utilisateur peut effectuer une action sur un personnage
     *
     * @param $id ID du personnage
     * @return boolean True si l'utilisateur y est autorisé ; sinon false
     */
	private function canTouchCharacter($id) {
		$this->Character->id = $id;

		return $this->Acl->hasRole('moderate_users') || $this->Character->field('user') == $this->Auth->user('id');
	}

}
