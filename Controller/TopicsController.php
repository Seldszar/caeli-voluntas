<?php

App::uses('AppController', 'Controller');
App::uses('CakeTime', 'Utility');

class TopicsController extends AppController {

	public $uses = array('ForumTopic', 'Forum', 'ForumPost');

	public $helpers = array('Time');

	public $layout = 'one_column';

	public function view($id) {
		$this->ForumTopic->id = $id;

		if (!$this->ForumTopic->exists()) {
			throw new NotFoundException("Le fil de discussion demandé est introuvable");
		}

		if (!$this->Acl->hasForumRole($this->ForumTopic->field('forum'), 'view')) {
			throw new UnauthorizedException("Vous n'êtes pas autorisé à accéder à ce forum");
		}

		$topic = $this->ForumTopic->read();
		$this->paginate = array(
			'ForumPost' => array(
				'limit' => 25,
				'paramType' => 'querystring',
				'conditions' => array(
					'topic' => $id
				),
				'contain' => array(
					'CreatedBy' => array(
						'Group'
					),
					'EditedBy',
				)
			)
		);

		$this->set('topic', $topic);
		$this->set('posts', $this->paginate('ForumPost'));

		$this->ForumTopic->incrementField('num_views');

		$threadsViewed = $this->Cookie->read("threadsViewed");
		$threadsViewed[$id] = time();
		$this->Cookie->write("threadsViewed", $threadsViewed, false);
	}

	public function create($id) {
		$this->Forum->id = $id;

		if (!$this->Forum->exists()) {
			throw new NotFoundException("Le forum demandé est introuvable");
		}

		if (!$this->Acl->hasForumRole($id, 'create')) {
			throw new UnauthorizedException("Vous n'êtes pas autorisé à créer un nouveau sujet de discussion");
		}

		if ($this->request->is('post')) {
			$data = $this->data;

			$this->ForumTopic->set('forum', $id);

			if ($this->ForumTopic->save($data)) {
				$topicId = $this->ForumTopic->getInsertID();

				$this->ForumPost->set(array(
					'topic' => $topicId,
					'content' => $data['ForumPost'][0]['content']
				));

				if ($this->ForumPost->save()) {
					$postId = $this->ForumPost->getInsertID();

					$this->ForumTopic->id = $topicId;
					$this->ForumTopic->set(array(
						'first_post' => $postId,
						'last_post' => $postId
					));

					if ($this->ForumTopic->save()) {
						if ($this->Forum->updateStatistics()) {
							$this->redirect(array('action' => 'view', $topicId));
						}
					}
				}
			}
		}

		$this->set('forum', $this->Forum->read());
	}

	public function edit($id) {
		$this->ForumTopic->id = $id;

		if (!$this->ForumTopic->exists()) {
			throw new NotFoundException("Le sujet demandé n'existe pas");
		}

		if (!$this->canTouchTopic($id)) {
			throw new UnauthorizedException("Vous n'êtes pas autorisé à éditer ce sujet");
		}

		$this->ForumTopic->contain(array(
			'Forum',
			'FirstPost',
			'ForumPost' => array(
				'order' => array(
					'id' => 'DESC'
				),
				'limit' => 5,
				'CreatedBy' => array(
					'Group'
				),
				'EditedBy'
			)
		));

		$topic = $this->ForumTopic->read();

		if ($this->request->is('put')) {
			$data = $this->data;

			$data['ForumTopic']['id'] = $id;
			$data['ForumPost']['id'] = $topic['FirstPost']['id'];
			$data['ForumPost']['content'] = $data['FirstPost']['content'];

			if ($this->ForumPost->saveAssociated($data, array('deep' => true))) {
				$this->redirect(array('action' => 'view', $id));
			}
		} else {
			$this->data = $topic;
		}

		$this->set('topic', $topic);
	}

	public function delete($id) {
		$this->ForumTopic->id = $id;

		if (!$this->ForumTopic->exists()) {
			throw new NotFoundException("Le fil de discussion demandé n'existe pas");
		}

		if (!$this->canTouchTopic($id)) {
			throw new UnauthorizedException("Vous n'êtes pas autorisé à supprimer ce sujet");
		}

		$forumId = $this->ForumTopic->field('forum');

		if ($this->ForumTopic->delete()) {
			$this->Forum->id = $forumId;

			if ($this->Forum->updateStatistics()) {
				$this->redirect(array('controller' => 'forums', 'action' => 'view', $forumId));
			}
		}
	}

	public function sticky($id) {
		$this->ForumTopic->id = $id;

		if (!$this->ForumTopic->exists()) {
			throw new NotFoundException("Le fil de discussion demandé n'existe pas");
		}

		if (!$this->canTouchTopic($id)) {
			throw new UnauthorizedException("Vous n'êtes pas autorisé à effectuer cette action");
		}

		if ($this->ForumTopic->toggleField('sticky')) {
			$this->redirect(array('controller' => 'topics', 'action' => 'view', $id));
		}
	}

	public function close($id) {
		$this->ForumTopic->id = $id;

		if (!$this->ForumTopic->exists()) {
			throw new NotFoundException("Le fil de discussion demandé n'existe pas");
		}

		if (!$this->canTouchTopic($id)) {
			throw new UnauthorizedException("Vous n'êtes pas autorisé à effectuer cette action");
		}

		if ($this->ForumTopic->toggleField('closed')) {
			$this->redirect(array('controller' => 'topics', 'action' => 'view', $id));
		}
	}

	public function latest($limit = 5) {
		return $this->ForumTopic->find('viewable', array(
			'contain' => array(
				'FirstPost' => array(
					'CreatedBy'
				)
			),
			'order' => array(
				'ForumTopic.id' => 'DESC'
			),
			'limit' => $limit
		));
	}

	/**
	 * Vérifie si l'utilisateur courant peut effecteur une action modifiant le fil de discussion
	 *
	 * @param $id ID du sujet de discussion
	 * @return boolean True si l'utilisateur y est autorisé ; sinon false
	 */
	private function canTouchTopic($id) {
		$this->ForumTopic->id = $id;
		$this->ForumTopic->contain('FirstPost.created_by');
		$topic = $this->ForumTopic->read();

		return $this->Acl->hasForumRole($topic['ForumTopic']['forum'], 'moderate') || $topic['FirstPost']['created_by'] == $this->Auth->user('id');
	}

}
