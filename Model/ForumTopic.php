<?php

App::uses('AppModel', 'Model');

class ForumTopic extends AppModel {

	public $findMethods = array(
		'viewable' => true
	);

	var $hasMany = array(
		'ForumPost' => array(
			'foreignKey' => 'topic',
			'dependent' => true
		)
	);

	var $belongsTo = array(
		'Forum' => array(
			'foreignKey' => 'forum'
		),
		'FirstPost' => array(
			'className' => 'ForumPost',
			'foreignKey' => 'first_post'
		),
		'LastPost' => array(
			'className' => 'ForumPost',
			'foreignKey' => 'last_post'
		)
	);

	var $validate = array(
		'title' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => 'Vous devez saisir le titre du sujet'
			)
		)
	);

	protected function _findViewable($state, $query, $results = array()) {
		if ($state == 'before') {
			$query['conditions']['forum'] = AclComponent::getForumsViewable();
			return $query;
		}

		return $results;
	}

}
