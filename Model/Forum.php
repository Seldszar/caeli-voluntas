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
		foreach ($results as $k => $result) {
			if (is_array($result) && array_key_exists('ForumAccess', $result)) {
				$accesses = $result['ForumAccess'];
				$results[$k]['ForumAccess'] = array();

				foreach ($accesses as $access) {
					$results[$k]['ForumAccess'][$access['group']] = array(
						'view' => $access['view'],
						'reply' => $access['reply'],
						'create' => $access['create'],
						'moderate' => $access['moderate']
					);
				}
			}
		}

		return $results;
	}

	public function beforeSave($options = array()) {
		return $this->ForumAccess->deleteAll(array('forum' => $this->data['Forum']['id']));
	}

}
