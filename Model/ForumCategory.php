<?php

App::uses('AppModel', 'Model');

class ForumCategory extends AppModel {

	public $displayField = 'name';

	var $hasMany = array(
		'Forum' => array(
			'foreignKey' => 'category',
			'dependent' => true,
			'order' => array(
				'position' => 'ASC',
				'id' => 'ASC'
			)
		)
	);

}
