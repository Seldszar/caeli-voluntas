<?php

App::uses('AppModel', 'Model');

class Forum extends AppModel {

	public $displayField = 'name';

	public $belongsTo = array(
		'ForumCategory' => array(
			'foreignKey' => 'category'
		),
		'LastPost' => array(
			'className' => 'ForumPost',
			'foreignKey' => 'last_post'
		)
	);

	public $hasMany = array(
		'ForumTopic' => array(
			'foreignKey' => 'forum',
			'dependent' => true,
			'order' => array(
				'last_post' => 'DESC'
			)
		),
		'ForumAccess' => array(
			'foreignKey' => 'forum',
			'dependent' => true
		)
	);

	public $validate = array(
		'name' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => 'Vous devez saisir un nom'
			)
		)
	);

	public function updateStatistics() {
		$this->set('num_topics', $this->ForumTopic->find('count', array(
			'conditions' => array(
				'forum' => $this->id
			)
		)));

		$this->set('num_posts', $this->ForumTopic->ForumPost->find('count', array(
			'contain' => array(
				'ForumTopic'
			),
			'conditions' => array(
				'ForumTopic.forum' => $this->id
			)
		)));

		$lastPost = $this->ForumTopic->ForumPost->find('first', array(
			'contain' => array(
				'ForumTopic'
			),
			'conditions' => array(
				'ForumTopic.forum' => $this->id
			),
			'order' => array(
				'ForumPost.id' => 'DESC'
			)
		));

		$this->set('last_post', $lastPost ? $lastPost['ForumPost']['id'] : null);

		return $this->save();
	}

}
