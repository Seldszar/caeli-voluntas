<?php

App::uses('AppHelper', 'View/Helper');

class AclHelper extends AppHelper {

	public function hasAnyRole($roles) {
		return AclComponent::hasAnyRole($roles);
	}

	public function hasRole($role) {
		return AclComponent::hasRole($role);
	}

	public static function hasForumRole($forum, $name) {
		return AclComponent::hasForumRole($forum, $name);
	}

	public static function isAdmin() {
		return AclComponent::isAdmin();
	}

}
