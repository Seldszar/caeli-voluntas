<?php

class ForumTracking extends CakeMigration {

	/**
	 * Migration description
	 *
	 * @var string
	 * @access public
	 */
	public $description = 'Ajout de champs pour l\'implémentation du suivi';

	/**
	 * Actions to be performed
	 *
	 * @var array $migration
	 * @access public
	 */
	public $migration = array(
		'up' => array(
			'create_field' => array(
				'forums' => array(
					'num_posts' => array('type' => 'integer', 'null' => false, 'default' => 0),
					'last_post' => array('type' => 'integer', 'null' => true, 'default' => null)
				)
			)
		),
		'down' => array(
			'drop_field' => array(
				'forums' => array(
					'num_posts',
					'last_post'
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
		if (isset($this->callback) && $direction == 'up') {

			$Forum = ClassRegistry::init('Forum');
			$ForumTopic = ClassRegistry::init('ForumTopic');
			$ForumPost = ClassRegistry::init('ForumPost');

			foreach ($Forum->find('all') as $forum) {
				$Forum->id = $forum['Forum']['id'];
				$Forum->updateStatistics();
			}
		}

		return true;
	}
}
