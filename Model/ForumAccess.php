<?php

App::uses('AppModel', 'Model');

class ForumAccess extends AppModel {

	public $belongsTo = array(
		'Forum' => array(
			'foreignKey' => 'forum'
		),
		'Group' => array(
			'foreignKey' => 'group'
		)
	);

}
