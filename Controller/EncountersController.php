<?php

App::uses('AppController', 'Controller');

class EncountersController extends AppController {

	public $uses = array('Encounter', 'EncounterZone');

	public $layout = 'user';

	public function admin_create($id) {
		$this->EncounterZone->id = $id;

		if (!$this->EncounterZone->exists()) {
			throw new NotFoundException("La zone de rencontre demandée est introuvable");
		}

		if ($this->request->is('post')) {
			$data = $this->data;

			$this->Encounter->set('zone', $id);

			if ($this->Encounter->save($data)) {
				$this->redirect(array('controller' => 'encounterZones', 'action' => 'view', $id));
			}
		}

		$this->set('zone', $this->EncounterZone->read());
	}

	public function admin_edit($id) {
		$this->Encounter->id = $id;

		if (!$this->Encounter->exists()) {
			throw new NotFoundException("La rencontre demandée est introuvable");
		}

		$this->Encounter->contain(array('EncounterZone'));

		$encounter = $this->Encounter->read();

		if ($this->request->is('put')) {
			$data = $this->data;

			if ($this->Encounter->save($data)) {
				$this->redirect(array('controller' => 'encounterZones', 'action' => 'view', $encounter['EncounterZone']['id']));
			}
		} else {
			$this->data = $encounter;
		}

		$this->set('encounter', $encounter);
	}

	public function admin_delete($id) {
		$this->Encounter->id = $id;

		if (!$this->Encounter->exists()) {
			throw new NotFoundException();
		}

		$zoneId = $this->Encounter->field('zone');

		if ($this->Encounter->delete()) {
			$this->redirect(array('controller' => 'encounterZones', 'action' => 'view', $zoneId));
		}
	}

	public function admin_toggle() {
		if (!$this->request->is('ajax')) {
			throw new MethodNotAllowedException();
		}

		$data = $this->data;

		$this->Encounter->id = $data['id'];

		if (!$this->Encounter->exists()) {
			throw new NotFoundException();
		}

		if (!in_array($data['difficulty'], array('normal', 'heroic'))) {
			throw new NotFoundException();
		}

		$value = !((bool)$this->Encounter->field($data['difficulty']));

		$this->Encounter->saveField($data['difficulty'], $value);

		return new CakeResponse(array('body' => json_encode(array('value' => $value))));
	}

	public function admin_order($id) {
		if (!$this->request->is('ajax')) {
			throw new MethodNotAllowedException();
		}

		$this->EncounterZone->id = $id;

		if (!$this->EncounterZone->exists()) {
			throw new NotFoundException();
		}

		foreach ($this->data['encounter'] as $k => $id) {
			$this->Encounter->id = $id;

			if ($this->Encounter->exists()) {
				$this->Encounter->saveField('position', $k);
			}
		}

		return new CakeResponse(array('body' => json_encode(array('error' => null))));
	}

	public function beforeFilter() {
		parent::beforeFilter();

		if (isset($this->params['admin']) && !$this->Acl->hasRole('manage_encounters')) {
			throw new UnauthorizedException("Vous n'êtes pas autorisé à accéder à cette page");
		}
	}

}
