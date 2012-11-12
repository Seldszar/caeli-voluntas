<?php

App::uses('AppController', 'Controller');

class RecruitmentController extends AppController {

	public $uses = array('CharacterClass', 'CharacterSpec');

	public $layout = 'user';

	public function index() {}

	public function sidebarData() {
		$this->CharacterClass->contain(array(
			'CharacterSpec' => array(
				'conditions' => array(
					'recruitment_active' => true
				)
			)
		));

		return $this->CharacterClass->find('all');
	}

	public function tooltip($id) {
		$this->CharacterClass->id = $id;

		if (!$this->CharacterClass->exists()) {
			throw new NotFoundException();
		}

		$this->CharacterClass->contain(array(
			'CharacterSpec'
		));

		$this->set('class', $this->CharacterClass->read());
	}

	public function admin_index() {
		$this->set('classes', $this->CharacterClass->find('all'));
	}

	public function admin_toggle() {
		if (!$this->request->is('ajax')) {
			throw new MethodNotAllowedException();
		}

		$this->CharacterSpec->id = $this->data['id'];

		if (!$this->CharacterSpec->exists()) {
			throw new NotFoundException();
		}

		$value = !((bool)$this->CharacterSpec->field('recruitment_active'));

		$this->CharacterSpec->saveField('recruitment_active', $value);

		return new CakeResponse(array('body' => json_encode(array('value' => $value))));
	}

}
