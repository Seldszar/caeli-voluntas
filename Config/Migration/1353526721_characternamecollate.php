<?php

class CharacterNameCollate extends CakeMigration {

	/**
	 * Migration description
	 *
	 * @var string
	 * @access public
	 */
	public $description = 'Correction de l\'interclassement pour le nom du personnage qui doit pouvoir effectuer des vérifications plus précises';

	/**
	 * Actions to be performed
	 *
	 * @var array $migration
	 * @access public
	 */
	public $migration = array(
		'up' => array(
			'alter_field' => array(
				'characters' => array(
					'name' => array('collate' => 'utf8_bin')
				)
			)
		),
		'down' => array(
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
