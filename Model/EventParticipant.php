<?php

App::uses('AppModel', 'Model');

class EventParticipant extends AppModel {

	public $belongsTo = array(
		'Event' => array(
			'foreignKey' => 'event'
		),
		'User' => array(
			'foreignKey' => 'user'
		),
		'Character' => array(
			'foreignKey' => 'character'
		),
		'EventStatus' => array(
			'foreignKey' => 'status'
		)
	);

}
