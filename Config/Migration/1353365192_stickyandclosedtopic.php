<?php

class StickyAndClosedTopic extends CakeMigration {

	/**
	 * Migration description
	 *
	 * @var string
	 * @access public
	 */
	public $description = 'Ajout de la possibilité de fermer et/ou épingler un fil de discussion';

	/**
	 * Actions to be performed
	 *
	 * @var array $migration
	 * @access public
	 */
	public $migration = array(
		'up' => array(
			'create_field' => array(
				'forum_topics' => array(
					'sticky' => array('type' => 'boolean', 'null' => false, 'default' => false),
					'closed' => array('type' => 'boolean', 'null' => false, 'default' => false)
				)
			)
		),
		'down' => array(
			'drop_field' => array(
				'forum_topics' => array(
					'sticky',
					'closed'
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
