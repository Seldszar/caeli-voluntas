<?php

App::uses('AppController', 'Controller');
App::uses('CakeTime', 'Utility');

class EventsController extends AppController {

	public $uses = array('Event', 'EventType', 'Character', 'EventStatus');

	public $helpers = array('Time');

	public $layout = 'user';

	public function index() {
		$conditions = array();

		if (!$this->Acl->hasRole('moderate_events')) {
			$conditions['begin >='] = CakeTime::toServer(time());
		}

		$events = $this->Event->find('groupByDate', array(
			'conditions' => $conditions,
			'order' => array(
				'begin' => 'DESC'
			),
			'contain' => array(
				'EventType'
			)
		));

		$this->set('events', $events);
	}

	public function view($id) {
		$this->Event->id = $id;

		if (!$this->Event->exists()) {
			throw new NotFoundException("L'événenement demandé n'existe pas");
		}

		$this->Event->contain(array(
			'EventType',
			'CreatedBy'
		));

		$this->EventStatus->contain(array(
			'EventParticipant' => array(
				'conditions' => array(
					'EventParticipant.event' => $id
				),
				'Character',
				'User'
			)
		));

		$this->set('event', $this->Event->read());
		$this->set('statuses', $this->EventStatus->find('all', array(
			'order' => array(
				'EventStatus.position' => 'ASC'
			)
		)));
	}

	public function create() {
		if (!$this->Acl->hasRole('create_event')) {
			throw new UnauthorizedException("Vous n'êtes pas autorisé à accéder à cette page");
		}

		if ($this->request->is('post')) {
			$data = $this->data;

			if (!$this->EventType->exists($data['Event']['type'])) {
				throw new NotFoundException("Le type d'événement n'existe pas");
			}

			if ($this->Event->save($data, array('name', 'description', 'type', 'begin'))) {
				$this->redirect(array('action' => 'index'));
			}
		}

		$this->set('types', $this->EventType->find('list'));
	}

	public function edit($id) {
		$this->Event->id = $id;

		if (!$this->Event->exists()) {
			throw new NotFoundException("Le type d'événement n'existe pas");
		}

		$event = $this->Event->read();

		if ($this->Auth->user('group') != $event['Event']['created_by'] && !$this->Acl->hasRole('moderate_event')) {
			throw new NotFoundException("Vous n'êtes pas autorisé à accéder à cette page");
		}

		if ($this->request->is('put')) {
			$data = $this->data;

			if (!$this->EventType->exists($data['Event']['type'])) {
				throw new NotFoundException("Le type d'événement n'existe pas");
			}

			if ($this->Event->save($data, true, array('name', 'description', 'type', 'begin'))) {
				$this->redirect(array('action' => 'index'));
			}
		} else {
			$this->data = $event;
		}

		$this->set('types', $this->EventType->find('list'));
	}

	public function beforeFilter() {
		$this->Auth->deny();
	}

}
