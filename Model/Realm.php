<?php

App::uses('AppModel', 'Model');

class Realm extends AppModel {

	public $hasMany = array(
		'Character' => array(
			'foreignKey' => 'realm'
		)
	);

}
