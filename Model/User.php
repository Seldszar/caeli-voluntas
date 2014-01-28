<?php

App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
App::uses('String', 'Utility');

class User extends AppModel {

	public $order = "username";

	public $belongsTo = array(
		'Group' => array(
			'foreignKey' => 'group'
		)
	);

	public function __construct($id = false, $table = null, $ds = null) {
		parent::__construct($id, $table, $ds);
		$this->virtualFields['avatar_url'] = sprintf('IF(%1$s.avatar IS NULL, CONCAT(\'http://www.gravatar.com/avatar/\', MD5(LOWER(%1$s.email)), \'?d=identicon\'), CONCAT(\'avatars/\', %1$s.avatar))', $this->alias);
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

	public function isUploadedFile($file) {
		if (isset($file['error']) && $file['error'] == 0)
			return is_uploaded_file($file['tmp_name']);

		return false;
	}

	public function beforeSave($options = array()) {
		if (isset($this->data[$this->alias]['avatar'])) {
			$file = $this->data[$this->alias]['avatar'];

			if (!$this->isUploadedFile($file))
				return false;

			$extension = pathinfo($file['name'], PATHINFO_EXTENSION);
			$avatar = strtolower(base64_encode(String::uuid()) . '.' . $extension);

			if (!move_uploaded_file($file['tmp_name'], IMAGES . DS . 'avatars' . DS . $avatar))
				return false;
			
			$this->data[$this->alias]['avatar'] = $avatar;
		}
	
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
