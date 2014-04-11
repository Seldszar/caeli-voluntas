<?php
class GroupVisibleInRoster extends CakeMigration {

	/**
	 * Migration description
	 *
	 * @var string
	 * @access public
	 */
	public $description = 'Gestion de la visibilité du groupe dans le roster';

	/**
	 * Actions to be performed
	 *
	 * @var array $migration
	 * @access public
	 */
	public $migration = array(
		'up' => array(
			'create_field' => array(
				'groups' => array(
					'visible_in_roster' => array('type' => 'boolean', 'null' => false, 'default' => true)
				)
			)
		),
		'down' => array(
			'drop_field' => array(
				'groups' => array('visible_in_roster')
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
