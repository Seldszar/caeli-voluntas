<?php

class AclOptimisation extends CakeMigration {

	/**
	 * Migration description
	 *
	 * @var string
	 * @access public
	 */
	public $description = 'Optimisation de la gestion des droits';

	/**
	 * Actions to be performed
	 *
	 * @var array $migration
	 * @access public
	 */
	public $migration = array(
		'up' => array(
			'drop_field' => array(
				'groups' => array(
					'level'
				),
				'roles' => array(
					'level'
				)
			)
		),
		'down' => array(
			'create_field' => array(
				'groups' => array(
					'level' => array('type' => 'integer', 'null' => false, 'default' => 0)
				),
				'roles' => array(
					'level' => array('type' => 'integer', 'null' => false, 'default' => 0)
				)
			)
		)
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
