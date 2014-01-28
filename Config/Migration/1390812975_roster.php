<?php

class Roster extends CakeMigration {

/**
 * Migration description
 *
 * @var string
 * @access public
 */
	public $description = '';

/**
 * Actions to be performed
 *
 * @var array $migration
 * @access public
 */
	public $migration = array(
		'up' => array(
            'drop_table' => array('characters'),
            'create_field' => array(
				'groups' => array(
					'position' => array('type' => 'integer', 'null' => false, 'default' => 0)
				)
			)
		),
		'down' => array(
            'create_table' => array(
                'characters' => array(
					'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
					'class' => array('type' => 'integer', 'null' => false, 'default' => null),
					'user' => array('type' => 'integer', 'null' => false, 'default' => null),
					'realm' => array('type' => 'integer', 'null' => false, 'default' => null),
					'name' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 25),
					'in_roster' => array('type' => 'boolean', 'null' => false, 'default' => false),
					'indexes' => array(
						'PRIMARY' => array('column' => 'id', 'unique' => true)
					)
				)
            ),
            'drop_field' => array(
                'groups' => array('position')
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
