<?php

App::uses('AuthComponent', 'Controller/Component');

class SzAuthComponent extends AuthComponent {

	public $components = array('Auth');

	private static $level = 0;

	private static $isAdmin = false;

	private static $roles = null;

	public function initialize($controller) {
		if (!isset(self::$roles)) {
			self::$roles = array(
				'global' => array(),
				'forums' => array()
			);

			$controller->loadModel('User');
			$controller->loadModel('Group');

			$userId = $this->Auth->user('id');
			$groupId = 1;

			if ($userId !== null) {
				$controller->User->id = $userId;

				if (!$controller->User->exists()) {
					return;
				}

				$groupId = $controller->User->field('group');

				if ($groupId == 2) {
					self::$isAdmin = true;
					return;
				}
			}

			$controller->Group->id = $groupId;

			$group = $controller->Group->read();

			foreach ($group['Role'] as $role) {
				self::$roles['global'][$role['key']] = $role['level'];
			}

			foreach ($group['ForumAccess'] as $forumAccess) {
				self::$roles['forums'][$forumAccess['forum']] = array(
					'view' => $forumAccess['view'],
					'reply' => $forumAccess['reply'],
					'create' => $forumAccess['create'],
					'moderate' => $forumAccess['moderate']
				);
			}

			self::$level = $group['Group']['level'];
		}
	}

	/**
	 * Vérifie si l'utilisateur à l'accès nécessaire
	 *
	 * @param role Identifiant du rôle
	 * @return true si l'utilisateur a l'accès requis
	 */
	public static function hasRole($name) {
		return array_key_exists($name, self::$roles['global']) || self::$isAdmin;
	}

	/**
	 * Vérifie si l'utilisateur à l'accès nécessaire pour pouvoir accéder à l'administration
	 *
	 * @param level Niveau de privilèges
	 * @return true si l'utilisateur a l'accès requis
	 */
	public static function hasRoleLevel($level) {
		return (self::$level >= $level) || self::$isAdmin;
	}

	/**
	 * Vérifie si l'utilisateur à l'accès nécessaire par rapport à un forum
	 *
	 * @param forum Identifiant du forum concerné
	 * @param role Identifiant du rôle
	 * @return true si l'utilisateur a l'accès requis
	 */
	public static function hasForumRole($forum, $name) {
		return @self::$roles['forums'][$forum][$name] || self::$isAdmin;
	}

}
