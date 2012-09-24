<?php

App::uses('AppController', 'Controller');
App::uses('CakeTime', 'Utility');

class EventParticipantsController extends AppController {

	public $uses = array('EventParticipant', 'Event', 'EventStatus', 'Character');

	public $layout = 'user';

	public function answer($id) {
		if (!$this->Acl->hasRole('join_event')) {
			throw new UnauthorizedException("Vous n'êtes pas autorisé à accéder à cette page");
		}

		$this->Event->id = $id;

		if (!$this->Event->exists()) {
			throw new NotFoundException("L'événement demandé n'existe pas");
		}

		$characters = $this->Character->find('list', array('conditions' => array('user' => $this->Auth->user('id'))));

		if (!$characters) {
			throw new UnauthorizedException("Vous n'avez actuellement aucun personnage");
		}

		$participant = $this->EventParticipant->findByUserAndEvent($this->Auth->user('id'), $id);
		$readyToSave = false;
		$data = $this->data;

		if ($this->request->is('put')) {
			$this->EventParticipant->id = $participant['EventParticipant']['id'];

			if ($participant['EventParticipant']['confirmed'] && ($data['EventParticipant']['character'] != $participant['EventParticipant']['character'] || $data['EventParticipant']['status'] != $participant['EventParticipant']['status'])) {
				$this->EventParticipant->set('confirmed', false);
			}

			$readyToSave = true;
		} else if ($this->request->is('post')) {
			$this->EventParticipant->create();
			$this->EventParticipant->set(array(
				'event' => $id,
				'user' => $this->Auth->user('id')
			));
			$readyToSave = true;
		}

		if ($readyToSave) {
			$this->EventParticipant->set('answered', CakeTime::toServer(time()));

			if ($this->EventParticipant->save($data)) {
				$this->redirect(array('controller' => 'events', 'action' => 'view', $id));
			}
		}

		if ($participant) {
			$this->data = $participant;
		}

		$this->set('event', $this->Event->read());
		$this->set('statuses', $this->EventStatus->find('list'));
		$this->set('characters', $characters);
	}

	public function confirm($id) {
		if (!$this->Acl->hasRole('moderate_events')) {
			throw new UnauthorizedException("Vous n'êtes pas autorisé à accéder à cette page");
		}

		$this->EventParticipant->id = $id;

		if (!$this->EventParticipant->exists()) {
			throw new NotFoundException("Le participant à l'événement demandé n'existe pas");
		}

		if ($this->EventParticipant->field('confirmed')) {
			throw new NotFoundException("Le participant à l'événement est déjà confirmé");
		}

		$event = $this->EventParticipant->field('event');

		if ($this->EventParticipant->saveField('confirmed', $id)) {
			$this->redirect(array('controller' => 'events', 'action' => 'view', $event));
		}
	}

}
