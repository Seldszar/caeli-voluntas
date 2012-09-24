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

	public $findMethods = array(
		'rolesAvailable' => true
	);

	public $validate = array(
		'name' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => 'Vous devez saisir le nom du groupe'
			)
		)
	);

	protected function _findRolesAvailable($state, $query, $results = array()) {
		/*$_results = array();

		if ($state == 'after') {
			foreach ($results['Role'] as $k => $v) {
				$_results[] = $v['key'];
			}
		}*/

		return $results;
	}

}
