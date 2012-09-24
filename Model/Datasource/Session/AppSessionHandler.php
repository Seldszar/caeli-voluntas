<?php

App::uses('CakeSessionHandlerInterface', 'Model/Datasource/Session');

class AppSessionHandler implements CakeSessionHandlerInterface {

	public function open() {
		return true;
	}

	public function close() {
		return true;
	}

	public function read($id) {
		return true;
	}

	public function write($id, $data) {
		return true;
	}

	public function destroy($id) {
		$user = App::import('Model', 'User');

		$this->User->id = $id;
		return $this->User->saveField('is_online', false);
	}

	public function gc($expires = null) {
		return true;
	}

}
