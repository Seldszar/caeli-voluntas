<?php

App::uses('AppModel', 'Model');

class EventStatus extends AppModel {

	public $hasMany = array(
		'EventParticipant' => array(
			'foreignKey' => 'status'
		)
	);

}
