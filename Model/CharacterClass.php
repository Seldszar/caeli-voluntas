<?php

App::uses('AppModel', 'Model');

class CharacterClass extends AppModel {

	var $hasMany = array(
		'Character' => array(
			'foreignKey' => 'class'
		),
		'CharacterSpec' => array(
			'foreignKey' => 'class',
			'dependent' => true
		)
	);

}
