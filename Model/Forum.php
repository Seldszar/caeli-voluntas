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

	public function beforeSave($options = array()) {
		return $this->ForumAccess->deleteAll(array('forum' => $this->data['Forum']['id']));
	}

}
