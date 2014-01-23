<?php

App::uses('AppModel', 'Model');

class Character extends AppModel {

	public $belongsTo = array(
		'CharacterClass' => array(
			'foreignKey' => 'class'
		),
		'User' => array(
			'foreignKey' => 'user'
		),
		'Realm' => array(
			'foreignKey' => 'realm'
		)
	);

	public $validate = array(
		'name' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => 'Vous devez saisir le nom du personnage'
			),
			'maxLength' => array(
				'rule' => array('maxLength', 25),
				'message' => 'Le nom du personnage ne doit pas dépasser 25 caractères'
			),
			'isUnique' => array(
				'rule' => 'isUnique',
				'message' => 'Le personnage existe déjà'
			)
		),
		'realm' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => 'Vous devez sélectionner un royaume'
			)
		),
		'class' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => 'Vous devez sélectionner une classe'
			)
		)
	);

	public function beforeSave($options = array()) {
		$this->data[$this->alias]['user'] = AuthComponent::user('id');
		return true;
	}

}
