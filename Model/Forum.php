<?php

App::uses('AppModel', 'Model');

class Forum extends AppModel {

	public $displayField = 'name';

	public $belongsTo = array(
		'ForumCategory' => array(
			'foreignKey' => 'category'
		)
	);

	public $hasMany = array(
		'ForumTopic' => array(
			'foreignKey' => 'forum',
			'dependent' => true,
			'order' => array(
				'last_post' => 'DESC'
			)/*,
			'counterCache' => array(
				'num_topics' => true
			)*/
		),
		'ForumAccess' => array(
			'foreignKey' => 'forum',
			'dependent' => true
		)
	);

	public $validate = array(
		'name' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => 'Vous devez saisir un nom'
			)
		)
	);

	public function afterFind($results, $primary = false) {
		if ($primary) {
			$results = $this->buildAccessList($results);
		} else {
			foreach ($results as $k => $result) {
				$results[$k] = $this->buildAccessList($result);
			}
		}

		return $results;
	}

	public function beforeSave($options = array()) {
		return $this->ForumAccess->deleteAll(array('forum' => $this->data['Forum']['id']));
	}

	/**
	 * Génère la liste des droits concernant un forum
	 *
	 * @param result Résultat d'une requête représentant un forum
	 * @result array Ligne passée en paramètre modifiée
	 * @access private
	 */
	private function buildAccessList($result) {
		$accesses = (isset($result['ForumAccess']) ? $result['ForumAccess'] : array());

		foreach ($accesses as $access) {
			$results[$k]['ForumAccess'][$access['group']] = array(
				'view' => $access['view'],
				'reply' => $access['reply'],
				'create' => $access['create'],
				'moderate' => $access['moderate']
			);
		}

		return $result;
	}

}
