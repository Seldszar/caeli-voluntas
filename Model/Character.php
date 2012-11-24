<?php

App::uses('AppModel', 'Model');
App::uses('HttpSocket', 'Network/Http');

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

	public $virtualFields = array(
		//'avatar_url' => "CONCAT('http://eu.battle.net/static-render/eu/', avatar)"
	);

	public function beforeSave($options = array()) {
		$this->data[$this->alias]['user'] = AuthComponent::user('id');
		return true;
	}

	public function afterFind($results, $primary = false) {
		foreach ($results as &$v) {
			$this->Realm->id = $v[$this->alias]['realm'];

			$avatarUrl = false;
			$name = $v[$this->alias]['name'];
			$slug = $this->Realm->field('slug');
			$http = new HttpSocket();

			if ($response = $http->get(sprintf('http://eu.battle.net/api/wow/character/%s/%s', $slug, $name))) {
				if ($response->isOk()) {
					$data = json_decode($response->body);
					$avatarUrl = sprintf('http://eu.battle.net/static-render/eu/%s?alt=/wow/static/images/2d/avatar/%d-%d.jpg', $data->thumbnail, $data->race, $data->gender);
				}
			}

			$v[$this->alias]['armory_url'] = sprintf('http://eu.battle.net/wow/fr/character/%s/%s/simple', $slug, $name);
			$v[$this->alias]['avatar_url'] = $avatarUrl;
		}

		return $results;
	}

	public function __construct($id = false, $table = null, $ds = null) {
		parent::__construct($id, $table, $ds);
	}

}
