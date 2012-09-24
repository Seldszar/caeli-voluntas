<?php

App::uses('AppModel', 'Model');

class EncounterZone extends AppModel {

	var $hasMany = array(
		'Encounter' => array(
			'foreignKey' => 'zone',
			'dependent' => true,
			'order' => array(
				'position' => 'ASC',
				'id' => 'ASC'
			)
		)
	);

	var $virtualFields = array(
		'normal_progress_percentage' => 'FLOOR(normal_progress / num_bosses * 100)',
		'heroic_progress_percentage' => 'FLOOR(heroic_progress / num_bosses * 100)',
		'heroic_mode' => 'normal_progress = num_bosses'
	);

}
