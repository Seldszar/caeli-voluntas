<?php

class UserSignature extends CakeMigration {

	/**
	 * Migration description
	 *
	 * @var string
	 * @access public
	 */
	public $description = 'Ajout d\un nouveau champ permettant à l\'utilisateur de définir saisir une signature';

	/**
	 * Actions to be performed
	 *
	 * @var array $migration
	 * @access public
	 */
	public $migration = array(
		'up' => array(
			'create_field' => array(
				'users' => array(
					'signature' => array('type' => 'text', 'null' => true, 'default' => null)
				)
			)
		),
		'down' => array(
			'drop_field' => array(
				'users' => array(
					'signature'
				)
			)
		),
	);

	/**
	 * Before migration callback
	 *
	 * @param string $direction, up or down direction of migration process
	 * @return boolean Should process continue
	 * @access public
	 */
	public function before($direction) {
		return true;
	}

	/**
	 * After migration callback
	 *
	 * @param string $direction, up or down direction of migration process
	 * @return boolean Should process continue
	 * @access public
	 */
	public function after($direction) {
		return true;
	}
}
