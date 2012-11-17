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

		$topic = $this->ForumTopic->read();

		if (!$this->Acl->hasForumRole($topic['ForumTopic']['forum'], 'reply')) {
			throw new UnauthorizedException("Vous n'êtes pas autorisé à répondre à ce sujet");
		}

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
		}

		$this->set('topic', $topic);
	}

	public function edit($id) {
		$this->ForumPost->id = $id;

		if (!$this->ForumPost->exists()) {
			throw new NotFoundException("Le message demandé n'existe pas");
		}

		$this->ForumPost->contain(array(
			'ForumTopic' => array(
				'Forum' => array('id', 'name')
			)
		));

		$post = $this->ForumPost->read();

		if (!$this->Acl->hasForumRole($id, 'moderate') && $post['ForumPost']['created_by'] != $this->Auth->user('id')) {
			throw new UnauthorizedException("Vous n'êtes pas autorisé à éditer ce message");
		}

		if ($post['ForumPost']['id'] == $post['ForumTopic']['first_post']) {
			$this->redirect(array('controller' => 'topics', 'action' => 'edit', $post['ForumPost']['topic']));
		}

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
