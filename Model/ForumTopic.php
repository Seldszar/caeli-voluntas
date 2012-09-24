<?php

App::uses('AppModel', 'Model');

class ForumTopic extends AppModel {

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

}
