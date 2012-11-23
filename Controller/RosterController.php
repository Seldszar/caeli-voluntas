<?php

App::uses('AppController', 'Controller');

class RosterController extends AppController {

	public $uses = array('Character', 'CharacterClass');

	public $layout = 'two_column';

	public function index() {
		$this->CharacterClass->contain(
			array(
				'Character' => array(
					'conditions' => array(
						'in_roster' => true
					),
					'User'
				)
			)
		);

		$this->set('roster', $this->CharacterClass->find('all'));
	}

	public function admin_index() {
		$this->set('roster', $this->Character->find('all', array(
			'conditions' => array(
				'in_roster' => true
			),
			'order' => array(
				'class' => 'ASC'
			)
		)));
	}

	public function admin_create() {
		if ($this->request->is('post')) {
			$data = $this->data;

			$this->Character->id = $data['Character']['id'];

			if (!$this->Character->exists()) {
				throw new NotFoundException("Le personnage n'existe pas");
			}

			if ($this->Character->saveField('in_roster', true)) {
				$this->redirect(array('action' => 'index'));
			}
		}

		$characters = $this->Character->find('list', array(
			'conditions' => array(
				'in_roster' => false
			)
		));

		if (empty($characters)) {
			throw new Exception("Il n'y a aucun personnage à ajouter");
		}

		$this->set('characters', $characters);
	}

	public function admin_delete($id) {
		$this->Character->id = $id;

		if (!$this->Character->exists()) {
			throw new NotFoundException("Le personnage demandé n'existe pas");
		}

		if ($this->Character->saveField('in_roster', false)) {
			$this->redirect(array('action' => 'index'));
		}
	}

}
