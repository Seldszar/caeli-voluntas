<?php

App::uses('AppModel', 'Model');

class CharacterClass extends AppModel {

	var $hasMany = array(
		'CharacterSpec' => array(
			'foreignKey' => 'class',
			'dependent' => true
		)
	);

}
