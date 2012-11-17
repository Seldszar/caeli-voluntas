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

		$topic = $this->ForumTopic->read();

		if (!$this->Acl->hasForumRole($topic['ForumTopic']['forum'], 'view')) {
			throw new UnauthorizedException("Vous n'êtes pas autorisé à accéder à ce forum");
		}

		$this->ForumTopic->saveField('num_views', ++$topic['ForumTopic']['num_views']);

		$this->paginate = array(
			'ForumPost' => array(
				'limit' => 10,
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

		$track = (array)$this->Cookie->read('threadsViewed');
		$track[$id] = time();

		$this->Cookie->write('threadsViewed', $track);
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

		$this->ForumTopic->contain(array(
			'Forum',
			'FirstPost'
		));

		$topic = $this->ForumTopic->read();

		$postId = $topic['FirstPost']['id'];

		if (!$this->Acl->hasForumRole($topic['ForumTopic']['forum'], 'moderate') && $topic['FirstPost']['created_by'] != $this->Auth->user('id')) {
			throw new UnauthorizedException("Vous n'êtes pas autorisé à éditer ce sujet");
		}

		if ($this->request->is('put')) {
			$data = $this->data;

			$data['ForumTopic']['id'] = $id;
			$data['ForumPost']['id'] = $postId;
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

		$topic = $this->ForumTopic->read();

		if (!$this->Acl->hasForumRole($topic['ForumTopic']['forum'], 'moderate') && $topic['FirstPost']['created_by'] != $this->Auth->user('id')) {
			throw new UnauthorizedException("Vous n'êtes pas autorisé à supprimer ce sujet");
		}

		if ($this->ForumTopic->delete()) {
			$this->Forum->id = $topic['ForumTopic']['forum'];

			if ($this->Forum->updateStatistics()) {
				$this->redirect(array('controller' => 'forums', 'action' => 'view', $topic['ForumTopic']['forum']));
			}
		}
	}

}
