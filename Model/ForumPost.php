<?php

App::uses('AppModel', 'Model');

class ForumPost extends AppModel {

	var $belongsTo = array(
		'ForumTopic' => array(
			'foreignKey' => 'topic'
		),
		'CreatedBy' => array(
			'className' => 'User',
			'foreignKey' => 'created_by'
		),
		'EditedBy' => array(
			'className' => 'User',
			'foreignKey' => 'edited_by'
		)
	);

	var $validate = array(
		'content' => array(
			'rule' => 'notEmpty',
			'message' => 'Vous devez saisir un message'
		)
	);

	/*public function afterSave($created) {
		if ($created) {
			$this->ForumTopic->id = $this->field('topic');
			$this->saveField('last_post', $this->getInsertID());
		}
	}*/

}
