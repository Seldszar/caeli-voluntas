<?php

class GroupOptimisation extends CakeMigration {

	/**
	 * Migration description
	 *
	 * @var string
	 * @access public
	 */
	public $description = 'Optimisation de la gestion des groupes';

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
					'allow_delete',
					'visible'
				)
			)
		),
		'down' => array(
			'create_field' => array(
				'groups' => array(
					'allow_delete' => array('type' => 'boolean', 'null' => false, 'default' => true),
					'visible' => array('type' => 'boolean', 'null' => false, 'default' => true)
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
