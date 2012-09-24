<?php

App::uses('AppController', 'Controller');

class EncounterZonesController extends AppController {

	public $uses = array('EncounterZone');

	public $layout = 'user';

	public function sidebarData() {
		return $this->EncounterZone->find('all', array(
			'order' => array(
				'position' => 'ASC',
				'id' => 'DESC'
			),
			'contain' => array('Encounter')
		));
	}

	public function tooltip() {
		$this->EncounterZone->id = $this->data['id'];

		if (!$this->request->is('ajax')) {
			throw new MethodNotAllowedException();
		}

		if (!$this->EncounterZone->exists()) {
			throw new NotFoundException("La zone de rencontre demandée est introuvable");
		}

		$this->set('zone', $this->EncounterZone->read());
	}

	public function admin_index() {
		$this->set('zones', $this->EncounterZone->find('all', array(
			'order' => array(
				'position' => 'ASC',
				'id' => 'DESC'
			)
		)));
	}

	public function admin_view($id) {
		$this->EncounterZone->id = $id;

		if (!$this->EncounterZone->exists()) {
			throw new NotFoundException("La zone de rencontre demandée est introuvable");
		}

		$this->set('zone', $this->EncounterZone->read());
	}

	public function admin_create() {
		if ($this->request->is('post')) {
			$data = $this->data;

			if ($this->EncounterZone->save($data)) {
				$this->redirect(array('action' => 'view', $this->EncounterZone->getInsertID()));
			}
		}
	}

	public function admin_edit($id) {
		$this->EncounterZone->id = $id;

		if (!$this->EncounterZone->exists()) {
			throw new NotFoundException("La zone de rencontre demandée est introuvable");
		}

		$zone = $this->EncounterZone->read();

		if ($this->request->is('put')) {
			$data = $this->data;

			if ($this->EncounterZone->save($data)) {
				$this->redirect(array('action' => 'view', $id));
			}
		} else {
			$this->data = $zone;
		}
	}

	public function admin_order() {
		if (!$this->request->is('ajax')) {
			throw new MethodNotAllowedException();
		}

		$position = 0;

		foreach ($this->data['encounter-zone'] as $encounterId) {
			$this->EncounterZone->id = $encounterId;

			if ($this->EncounterZone->exists()) {
				$this->EncounterZone->saveField('position', $position++);
			}
		}

		return new CakeResponse(array('body' => json_encode(array('error' => null))));
	}

	public function admin_delete($id) {
		$this->EncounterZone->id = $id;

		if (!$this->EncounterZone->exists()) {
			throw new NotFoundException("La zone de rencontre demandée est introuvable");
		}

		if ($this->EncounterZone->delete()) {
			$this->redirect(array('action' => 'index'));
		}
	}

	public function beforeFilter() {
		parent::beforeFilter();

		if (isset($this->params['admin']) && !$this->Acl->hasRole('manage_encounters')) {
			throw new UnauthorizedException("Vous n'êtes pas autorisé à accéder à cette page");
		}
	}

}
