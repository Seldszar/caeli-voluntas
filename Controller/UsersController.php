<?php

App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');
App::uses('CakeTime', 'Utility');
App::uses('Security', 'Utility');

class UsersController extends AppController {

	public $uses = array('User', 'Group');

	public $helpers = array('Time');

	public function index() {
		$this->User->id = $this->Auth->user('id');

		if (!$this->User->exists()) {
			throw new NotFoundException("L'utilisateur demandé est introuvable");
		}

		$this->User->contain(array('Character', 'Group'));

		$this->set('user', $this->User->read());
	}

	public function email() {
		$this->User->id = $this->Auth->user('id');

		if (!$this->User->exists()) {
			throw new NotFoundException("L'utilisateur demandé est introuvable");
		}

		if ($this->request->is('post')) {
			$data = $this->data;

			if ($this->User->save($data, true, array('email', 'email_confirm'))) {
				$this->redirect(array('action' => 'index'));
			}
		}
	}

	public function password() {
		$this->User->id = $this->Auth->user('id');

		if (!$this->User->exists()) {
			throw new NotFoundException("L'utilisateur demandé est introuvable");
		}

		if ($this->request->is('post')) {
			$data = $this->data;

			if ($this->User->save($data, true, array('password', 'password_confirm'))) {
				$this->redirect(array('action' => 'index'));
			}
		}
	}

	public function register() {
		if ($this->request->is('post')) {
			$data = $this->data;
			$salt = Security::generateAuthKey();

			$this->User->create();
			$this->User->set(
				array(
					'last_ip' => $this->request->clientIp(),
					'salt' => $salt,
					'group' => 3
				)
			);

			if ($this->User->save($data)) {
				$email = new CakeEmail('default');
				$email->to($data['User']['email'])
					->template('confirmRegistration')
					->emailFormat('text')
					->subject("Confirmation d'inscription")
					->viewVars(array('salt' => $salt))
					->send();

				$this->render('registerConfirm');
			}
		}
	}

	public function registerConfirm($salt) {
		$user = $this->User->findBySalt($salt, array('id', 'created'));

		if (!$user) {
			throw new NotFoundException("La clé de confirmation est introuvable");
		}

		if (!CakeTime::wasWithinLast(Configure::read('Confirmation.expires'), $user['User']['created'])) {
			throw new UnauthorizedException("La clé de confirmation a expirée");
		}

		$this->User->id = $user['User']['id'];
		$this->User->set(array(
			'active' => true,
			'salt' => null
		));

		if ($this->User->save()) {
			$this->Session->setFlash("Votre compte a été activé avec succès, vous pouvez désormais vous connecter", "success_message");
			$this->redirect(array('action' => 'login'));
		}
	}

	public function login() {
		if ($this->request->is('post')) {
			if ($this->Auth->login()) {
				$this->User->id = $this->Auth->user('id');
				$this->User->save(array(
					'last_login' => CakeTime::toServer(time()),
					'last_ip' => $this->request->clientIp()
				), false);

				$this->redirect($this->Auth->redirect());
			} else {
				$this->Session->setFlash("Informations de connexion invalides, veuillez vérifier vos identifiants", "error_message");
			}
		}
	}

	public function logout() {
		$this->redirect($this->Auth->logout());
	}

	public function lostPassword() {
		if ($this->request->is('post')) {
			$data = $this->data;
			$this->User->set($data);

			$validator = $this->User->validator();
			unset($validator['email']['isUnique']);
			$validator['email']['exists'] = array(
				'rule' => 'valueExists',
				'message' => "L'adresse e-mail est introuvable"
			);

			if ($this->User->validates()) {
				$user = $this->User->findByEmail($data['User']['email'], array('id'));
				$salt = Security::generateAuthKey();
				$this->User->id = $user['User']['id'];

				$this->User->saveField('salt', $salt);

				$email = new CakeEmail('default');
				$email->to($data['User']['email'])
					->template('retrievePassword')
					->emailFormat('text')
					->subject("Récupération de votre mot de passe")
					->viewVars(array('salt' => $salt))
					->send();

				$this->Session->setFlash("Un e-mail de réinitialisation de mot de passe vous a été envoyé", "success_message");
				$this->redirect(array('action' => 'login'));
			}
		}
	}

	public function resetPassword($salt) {
		$user = $this->User->findBySalt($salt, array('id'));
		if (!$user) {
			throw new NotFoundException("La clé de réinitialisation de mot de passe est introuvable");
		}

		if ($this->request->is('post')) {
			$data = $this->data;
			$this->User->id = $user['User']['id'];

			$this->User->set('salt', null);

			if ($this->User->save($data)) {
				$this->Session->setFlash("Votre mot de passe a été réinitialisé avec succès, vous pouvez désormais vous connecter", "success_message");
				$this->redirect(array('action' => 'login'));
			}
		}
	}

	public function view($id) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException("L'utilisateur demandé est introuvable");
		}

		$this->User->contain(array(
			'Character' => array(
				'Realm'
			),
			'Group'
		));

		$this->set('user', $this->User->read());
	}

	public function edit($id = null) {
		if ($id) {
			if (!$this->Acl->hasRole('moderate_users')) {
				throw new UnauthorizedException("Vous n'êtes pas autorisé à éditer cet utilisateur");
			}
		} else {
			$id = $this->Auth->user('id');
		}

		$user = $this->User->read(null, $id);
		if (!$user) {
			throw new NotFoundException("L'utilisateur demandé est introuvable");
		}

		if ($this->request->is('put')) {
			if ($this->User->save($this->data, array('callbacks' => false))) {
				if ($id != $this->Auth->user('id')) {
					$this->redirect(array('action' => 'view', $id));
				} else {
					$this->redirect(array('action' => 'index'));
				}
			}
		} else {
			$this->data = $user;
		}

		$this->set('user', $user);
		$this->set('groups', $this->Group->find('list', array(
			'conditions' => array(
				'visible' => true
			)
		)));
	}

	public function avatar() {
		$this->User->id = $this->Auth->user('id');

		if (!$this->User->exists()) {
			throw new NotFoundException("L'utilisateur demandé est introuvable");
		}

		if ($this->request->isPost()) {
			$data = $this->request->data;
			$this->User->save($data);
		} else if ($this->request->isDelete()) {
			$this->User->saveField('avatar', null);
		}

		$this->set('user', $this->User->read());
	}

	public function admin_index() {
		$this->set('groups', $this->Group->find('all', array(
			'contain' => array(
				'User' => array(
					'order' => 'username ASC'
				)
			),
			'conditions' => array(
				'visible' => true
			)
		)));
	}

	public function admin_tooltip($id) {
		$this->User->id = $id;

		if (!$this->User->exists()) {
			throw new NotFoundException("L'utilisateur demandé est introuvable");
		}

		$this->set('user', $this->User->read());
	}

	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->deny(array('email', 'password', 'index', 'edit'));
	}

	public function beforeRender() {
		$layout = 'user';

		switch ($this->request->action) {
			case 'view':
				$layout = 'two_column';
			break;

			case 'register':
			case 'registerConfirm':
			case 'login':
			case 'lostPassword':
			case 'resetPassword':
				$layout = 'one_column';
			break;
		}

		$this->layout = $layout;
	}

}
