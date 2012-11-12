<?php

App::uses('AppModel', 'Model');

class Group extends AppModel {

	public $hasAndBelongsToMany = array(
		'Role' => array(
			'foreignKey' => 'group',
			'associationForeignKey' => 'role',
			'dependent' => true
		)
	);

	public $hasMany = array(
		'User' => array(
			'foreignKey' => 'group'
		),
		'ForumAccess' => array(
			'foreignKey' => 'group'
		)
	);

	public $validate = array(
		'name' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => 'Vous devez saisir le nom du groupe'
			)
		)
	);

	public function __construct($id = false, $table = null, $ds = null) {
		parent::__construct($id, $table, $ds);

		$this->virtualFields['allow_delete'] = sprintf("%s.id NOT IN (1, 2, 3)", $this->alias);
		$this->virtualFields['visible'] = sprintf("%s.id <> 1", $this->alias);
	}

}
