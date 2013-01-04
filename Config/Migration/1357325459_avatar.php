<?php

class Avatar extends CakeMigration {

/**
 * Migration description
 *
 * @var string
 * @access public
 */
	public $description = 'Renommage du champ gravatar_hash';

/**
 * Actions to be performed
 *
 * @var array $migration
 * @access public
 */
	public $migration = array(
		'up' => array(
			'rename_field' => array(
				'users' => array(
					'gravatar_hash' => 'avatar'
				)
			)
		),
		'down' => array(
			'rename_field' => array(
				'users' => array(
					'avatar' => 'gravatar_hash'
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
