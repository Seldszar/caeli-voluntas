<?php

App::uses('AppController', 'Controller');
App::uses('CakeTime', 'Utility');

class PostsController extends AppController {

	public $uses = array('ForumPost', 'ForumTopic', 'Forum', 'ForumAccess');

	public $helpers = array('Time');

	public function create($id) {
		$this->ForumTopic->id = $id;

		if (!$this->ForumTopic->exists()) {
			throw new NotFoundException("Le fil de discussion demandé est introuvable");
		}

		$forumId = $this->ForumTopic->field('forum');

		if (!$this->Acl->hasForumRole(forumId, 'reply')) {
			throw new UnauthorizedException("Vous n'êtes pas autorisé à répondre à ce sujet");
		}

		if (!$this->Acl->hasForumRole($forumId, 'moderate') && $this->ForumTopic->field('closed')) {
			throw new UnauthorizedException("Le fil de discussion est fermé");
		}

		$this->ForumTopic->contain(array(
			'Forum',
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

		if ($this->request->is('post')) {
			$data = $this->data;

			$this->ForumPost->set('topic', $id);

			if ($this->ForumPost->save($data)) {
				$this->ForumTopic->set(array(
					'num_replies' => $this->ForumPost->find('count', array('conditions' => array('topic' => $id))) - 1,
					'last_post' => $this->ForumPost->getInsertID()
				));

				if ($this->ForumTopic->save()) {
					$this->Forum->id = $topic['ForumTopic']['forum'];

					if ($this->Forum->updateStatistics()) {
						$this->redirect(array('controller' => 'topics', 'action' => 'view', $id));
					}
				}
			}
		} else if (isset($this->request->query['quote'])) {
			$this->ForumPost->id = $this->request->query['quote'];
			
			if ($this->ForumPost->exists()) {
				$this->request->data['ForumPost']['content'] =
					sprintf('[quote=%s]%s[/quote]', $this->ForumPost->CreatedBy->field('username'), $this->ForumPost->field('content'));
				;
			}
		}

		$this->set('topic', $topic);
	}

	public function edit($id) {
		$this->ForumPost->id = $id;

		if (!$this->ForumPost->exists()) {
			throw new NotFoundException("Le message demandé n'existe pas");
		}

		if (!$this->Acl->hasForumRole($this->ForumTopic->field('forum'), 'moderate') && $this->ForumTopic->field('closed')) {
			throw new UnauthorizedException("Le fil de discussion est fermé");
		}

		if (!$this->Acl->hasForumRole($id, 'moderate') && $this->ForumPost->field('created_by') != $this->Auth->user('id')) {
			throw new UnauthorizedException("Vous n'êtes pas autorisé à éditer ce message");
		}

		if ($id == $this->ForumPost->ForumTopic->field('first_post')) {
			$this->redirect(array('controller' => 'topics', 'action' => 'edit', $this->ForumPost->ForumTopic->field('id')));
		}

		$this->ForumPost->contain(array(
			'ForumTopic' => array(
				'Forum',
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
			)
		));

		$post = $this->ForumPost->read();

		if ($this->request->is('put')) {
			$data = $this->data;

			$data['ForumPost']['id'] = $id;

			if ($this->ForumPost->save($data)) {
				$this->redirect(array('controller' => 'topics', 'action' => 'view', $post['ForumPost']['topic']));
			}
		} else {
			$this->data = $post;
		}

		$this->set('post', $post);
	}

	public function delete($id) {
		$this->ForumPost->id = $id;

		if (!$this->ForumPost->exists()) {
			throw new NotFoundException("Le message demandé n'existe pas");
		}

		$post = $this->ForumPost->read();

		if ($this->Auth->user('id') != $post['ForumPost']['created_by']) {
			throw new UnauthorizedException("Vous n'êtes pas autorisé à supprimer ce message");
		}

		if ($post['ForumPost']['id'] == $post['ForumTopic']['first_post']) {
			$this->redirect(array('controller' => 'topics', 'action' => 'delete', $post['ForumPost']['topic']));
		}

		if ($this->ForumPost->delete()) {
			$this->ForumTopic->id = $post['ForumPost']['topic'];

			$lastPost = $this->ForumPost->find('first', array(
				'conditions' => array(
					'topic' => $post['ForumPost']['topic']
				),
				'order' => array(
					'ForumPost.id' => 'DESC'
				)
			));

			$this->ForumTopic->set(array(
				'num_replies' => $this->ForumPost->find('count', array('conditions' => array('topic' => $post['ForumPost']['topic']))) - 1,
				'last_post' => $lastPost['ForumPost']['id']
			));

			if ($this->ForumTopic->save()) {
				$this->Forum->id = $this->ForumTopic->field('forum');

				if ($this->Forum->updateStatistics()) {
					$this->redirect(array('controller' => 'topics', 'action' => 'view', $post['ForumPost']['topic']));
				}
			}
		}
	}

}
