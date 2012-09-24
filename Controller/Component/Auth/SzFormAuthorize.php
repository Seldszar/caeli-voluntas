<?php

App::uses('BaseAuthorize', 'Controller/Component/Auth');

class SzFormAuthorize extends BaseAuthorize {

	public function 

    protected function _findUser($username, $password) {
        $userModel = $this->settings['userModel'];
		list($plugin, $model) = pluginSplit($userModel);
		$fields = $this->settings['fields'];

		$conditions = array(
			$model . '.' . $fields['username'] => $username,
			$model . '.' . $fields['password'] => $this->_password($password),
			$model . '.' . $fields['last_ip'] => $this->_password($password),
		);

		if (!empty($this->settings['scope'])) {
			$conditions = array_merge($conditions, $this->settings['scope']);
		}

		$result = ClassRegistry::init($userModel)->find('first', array(
			'conditions' => $conditions,
			'recursive' => (int)$this->settings['recursive'],
			'contain' => $this->settings['contain'],
		));

		if (empty($result) || empty($result[$model])) {
			return false;
		}

		$user = $result[$model];

		unset($user[$fields['password']]);
		unset($result[$model]);

		return array_merge($user, $result);
    }

}