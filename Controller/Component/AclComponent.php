<?php

class AclComponent extends Component {

	public $components = array('Auth');

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

			if (isset($group['Role'])) {
				foreach ($group['Role'] as $role) {
					self::$roles['global'][] = $role['key'];
				}
			}

			if (isset($group['ForumAccess'])) {
				foreach ($group['ForumAccess'] as $forumAccess) {
					self::$roles['forums'][$forumAccess['forum']] = array(
						'view' => $forumAccess['view'],
						'reply' => $forumAccess['reply'],
						'create' => $forumAccess['create'],
						'moderate' => $forumAccess['moderate']
					);
				}
			}
		}
	}

	/**
	 * Vérifie si l'utilisateur à l'accès nécessaire
	 *
	 * @param name Identifiant du rôle
	 * @return true si l'utilisateur a l'accès requis
	 */
	public static function hasRole($name) {
		return in_array($name, self::$roles['global']) || self::$isAdmin;
	}

	/**
	 * Vérifie si l'utilisateur à un des accès nécessaires
	 *
	 * @param roles Liste de rôles
	 * @return True si l'utilisateur a l'accès requis ; sinon false
	 */
	public static function hasAnyRole($roles) {
		foreach ($roles as $role) {
			if (self::hasRole($role)) {
				return true;
			}
		}

		return false;
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

	/**
	 * Indique si l'utilisateur courant est administrateur
	 *
	 * @return boolean Tru si l'utilisateur est administrateur ; sinon false
	 */
	public static function isAdmin() {
		return self::$isAdmin;
	}

	/**
	 * Renvoie la liste des forums accessibles par l'utilisateur courant
	 *
	 * @return array Liste des forums accesibles
	 */
	public static function getForumsViewable() {
		$forums = array();

		foreach (self::$roles['forums'] as $k => $v) {
			if ($v['view']) {
				$forums[] = $k;
			}
		}

		return $forums;
	}

}
