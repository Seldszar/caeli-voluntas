<?php

App::uses('AppController', 'Controller');

class ForumsController extends AppController {

	public $uses = array('Forum', 'ForumCategory', 'ForumTopic', 'ForumAccess', 'Group');

	public $helpers = array('Time');

	public $layout = 'one_column';

	public function index() {
		$this->layout = 'two_column';

		$categories = $this->ForumCategory->find('all', array(
			'contain' => array(
				'Forum' => array(
					'LastPost' => array(
						'ForumTopic',
						'CreatedBy'
					)
				)
			)
		));

		foreach ($categories as &$category) {
			$forums = &$category['Forum'];

			foreach ($forums as $k => &$forum) {
				if ($this->Acl->hasForumRole($forum['id'], 'view')) {
					$lastPost = $forum['LastPost'];
					
					if ($lastPost) {
						$threadViewed = $this->Cookie->read("threadsViewed.{$lastPost['topic']}");
					}
					
					$forum['new_messages'] = !$threadViewed || !empty($lastPost) && $threadViewed < $lastPost['created'];
				} else {
					unset($forums[$k]);
				}
			}

			if (empty($forums)) {
				unset($category);
			}
		}

		$this->set('categories', $categories);
	}

	public function view($id) {
		if (!$this->Acl->hasForumRole($id, 'view')) {
			throw new UnauthorizedException("Vous n'êtes pas autorisé à accéder à ce forum");
		}

		$this->Forum->id = $id;

		if (!$this->Forum->exists()) {
			throw new NotFoundException("Le forum demandé est introuvable");
		}

		$paginate = array(
			'ForumTopic' => array(
				'limit' => 20,
				'paramType' => 'querystring',
				'conditions' => array(
					'forum' => $id
				),
				'contain' => array(
					'FirstPost' => 'CreatedBy',
					'LastPost' => 'CreatedBy'
				),
				'order' => array(
					'sticky' => 'DESC',
					'last_post' => 'DESC'
				)
			)
		);

		$this->paginate = $paginate;

		$topics = $this->paginate('ForumTopic');

		foreach ($topics as $k => &$topic) {
			$topic['ForumTopic']['new_messages'] = false;
			$threadViewed = $this->Cookie->read("threadsViewed.{$topic['ForumTopic']['id']}");
			$newMessages = !$threadViewed || !isset($threadViewed) && $threadViewed < $topic['LastPost']['created'];

			if (isset($this->request->query['unread'])) {
				if (!$newMessages) {
					unset($topics[$k]);
				}
			} else {
				$topic['ForumTopic']['new_messages'] = $newMessages;
			}
		}

		$this->set('forum', $this->Forum->read());
		$this->set('topics', $topics);
	}

	public function markread() {
		$categories = $this->ForumCategory->find('all', array(
			'contain' => array(
				'Forum' => array(
					'ForumTopic'
				)
			)
		));

		$threadsViewed = $this->Cookie->read('threadsViewed');

		foreach ($categories as $category) {
			foreach ($category['Forum'] as $forum) {
				if ($this->Acl->hasForumRole($forum['id'], 'view')) {
					$topics = $forum['ForumTopic'];

					foreach ($topics as $topic) {
						$threadsViewed[$topic['id']] = time();
					}
				}
			}
		}

		$this->Cookie->write('threadsViewed', $threadsViewed, false);
		$this->redirect(array('action' => 'index'));
	}

	public function admin_create($id) {
		$this->ForumCategory->id = $id;

		if (!$this->ForumCategory->exists()) {
			throw new NotFoundException("La catégorie demandée est introuvable");
		}

		if ($this->request->is('post')) {
			$data = $this->data;

			$this->Forum->set('category', $id);

			if ($this->Forum->save($data)) {
				$this->redirect(array('controller' => 'forums', 'action' => 'edit', $this->Forum->getInsertID()));
			}
		}

		$this->set('groups', $this->Group->find('all', array('conditions' => array('id <>' => 2))));
		$this->set('category', $this->ForumCategory->read());
	}

	public function admin_edit($id) {
		$this->Forum->id = $id;

		if (!$this->Forum->exists()) {
			throw new NotFoundException("Le forum demandé est introuvable");
		}

		$forum = $this->Forum->read();

		if ($this->request->is('put')) {
			$data = $this->data;
			$data['Forum']['id'] = $id;

			$this->ForumAccess->deleteAll(array('forum' => $id));

			if ($this->Forum->saveAssociated($data)) {
				$this->redirect(array('controller' => 'forumCategories', 'action' => 'view', $forum['Forum']['category']));
			}
		} else {
			$this->data = $forum;
		}

		$this->set('forum', $forum);
		$this->set('categories', $this->ForumCategory->find('list'));
		$this->set('groups', $this->Group->find('all', array('conditions' => array('id <>' => 2))));
	}

	public function admin_delete($id) {
		$this->Forum->id = $id;

		if (!$this->Forum->exists()) {
			throw new NotFoundException("Le forum demandé est introuvable");
		}

		$category = $this->Forum->field('category');

		if ($this->Forum->delete()) {
			$this->redirect(array('controller' => 'forumCategories', 'action' => 'view', $category));
		}
	}

	public function admin_order($id) {
		if (!$this->request->is('ajax')) {
			throw new MethodNotAllowedException();
		}

		$this->ForumCategory->id = $id;

		if (!$this->ForumCategory->exists()) {
			throw new NotFoundException("le forum demandé est introuvable");
		}

		$position = 0;

		foreach ($this->data['forum'] as $_id) {
			$this->Forum->id = $_id;

			if ($this->Forum->exists()) {
				$this->Forum->saveField('position', $position++);
			}
		}

		return new CakeResponse(array('body' => json_encode(array('error' => null))));
	}

	public function beforeFilter() {
		parent::beforeFilter();

		if (isset($this->params['admin']) && !$this->Acl->hasRole('manage_forums')) {
			throw new UnauthorizedException("Vous n'êtes pas autorisé à accéder à cette page");
		}
	}

}
