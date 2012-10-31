<?php

App::uses('AppModel', 'Model');

class User extends AppModel {

	public $belongsTo = array(
		'Group' => array(
			'foreignKey' => 'group'
		)
	);

	public $hasMany = array(
		'UserBan' => array(
			'foreignKey' => 'user',
			'dependent' => true
		),
		'Character' => array(
			'foreignKey' => 'user',
			'dependent' => true
		)
	);

	public function __construct($id = false, $table = null, $ds = null) {
		parent::__construct($id, $table, $ds);
		
		$this->virtualFields['avatar_url'] = sprintf("CONCAT('http://www.gravatar.com/avatar/', %s.gravatar_hash, '?d=identicon')", $this->alias);
	}

	public $validate = array(
		'username' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => "Vous devez saisir un nom d'utilisateur"
			),
			'alphaNumeric' => array(
				'rule' => 'alphaNumeric',
				'message' => "Vous devez saisir un nom d'utilisateur valide'"
			),
			'isUnique' => array(
				'rule' => 'isUnique',
				'message' => "Le nom d'utilisateur existe déjà"
			)
		),
		'email' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => 'Vous devez saisir une adresse e-mail'
			),
			'email' => array(
				'rule' => array('email', true),
				'message' => 'Vous devez saisir une adresse e-mail valide'
			),
			'isUnique' => array(
				'rule' => 'isUnique',
				'message' => "L'adresse e-mail existe déjà"
			)
		),
		'email_confirm' => array(
			'sameAsField' => array(
				'rule' => array('sameAsField', 'email'),
				'message' => 'Les adresses e-mails doivent être identiques'
			)
		),
		'password' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => 'Vous devez saisir un mot de passe'
			)
		),
		'password_confirm' => array(
			'sameAsField' => array(
				'rule' => array('sameAsField', 'password'),
				'message' => 'Les mots de passe doivent être identiques'
			)
		)
	);

	public function sameAsField($check, $field2) {
		$value = array_keys($check);
		$field1 = $this->data[$this->alias][$value[0]];
		$field2 = $this->data[$this->alias][$field2];

		return !empty($field1) && !empty($field2) && ($field1 === $field2);
	}

	public function valueExists($check) {
		$value = array_keys($check);
		$field = $value[0];
		$value = $this->data[$this->alias][$value[0]];

		return $this->find('count', array(
			'conditions' => array(
				$field => $value
			)
		));
	}

	public function beforeSave() {
		if (isset($this->data[$this->alias]['password'])) {
			$this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
		}

		if (isset($this->data[$this->alias]['email_confirm'])) {
			unset($this->data[$this->alias]['email_confirm']);
		}

		if (isset($this->data[$this->alias]['password_confirm'])) {
			unset($this->data[$this->alias]['password_confirm']);
		}

		return true;
	}

}
