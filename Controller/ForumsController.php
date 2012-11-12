<?php

App::uses('AppController', 'Controller');

class ForumsController extends AppController {

	public $uses = array('Forum', 'ForumCategory', 'ForumTopic', 'ForumAccess', 'Group');

	public $helpers = array('Time');

	public $layout = 'one_column';

	public function index() {
		$this->layout = 'two_column';

		$categories = $this->ForumCategory->find('all');

		foreach ($categories as $i => $category) {
			foreach ($category['Forum'] as $j => $forum) {
				if (!$this->Acl->hasForumRole($forum['id'], 'view')) {
					unset($categories[$i]['Forum'][$j]);
				}
			}

			if (empty($categories[$i]['Forum'])) {
				unset($categories[$i]);
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

		$this->paginate = array(
			'ForumTopic' => array(
				'limit' => 20,
				'paramType' => 'querystring',
				'conditions' => array(
					'forum' => $id
				),
				'contain' => array(
					'FirstPost' => 'CreatedBy',
					'LastPost' => 'CreatedBy'
				)
			)
		);
		
		$_ = $this;
		
		$topics = array_map(
			function($v) use($_) {
				$track = $_->Cookie->read("forums_track");
				
				if (!is_array($track)) {
					$track = array();
				}
				
				$v['ForumTopic']['tracked'] = in_array($v['ForumTopic']['last_post'], $track);
				return $v;
			}, 
			$this->paginate('ForumTopic')
		);

		$this->set('forum', $this->Forum->read());
		$this->set('topics', $topics);
	}

	public function admin_create() {
		if ($this->request->is('post')) {
			$data = $this->data;

			if ($this->Forum->saveAssociated($data)) {
				$this->redirect(array('controller' => 'forumCategories', 'action' => 'index'));
			}
		}

		$this->set('categories', $this->ForumCategory->find('list'));
		$this->set('groups', $this->Group->find('list', array('conditions' => array('id <>' => 2))));
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

			if ($this->Forum->saveAssociated($data)) {
				$this->redirect(array('controller' => 'forumCategories', 'action' => 'index'));
			}
		} else {
			$this->data = $forum;
		}

		$this->set('forum', $forum);
		$this->set('categories', $this->ForumCategory->find('list'));
		$this->set('groups', $this->Group->find('list', array('conditions' => array('id <>' => 2))));
	}

	public function admin_delete($id) {
		$this->Forum->id = $id;

		if (!$this->Forum->exists()) {
			throw new NotFoundException("Le forum demandé est introuvable");
		}

		if ($this->Forum->delete()) {
			$this->redirect(array('controller' => 'forumCategories', 'action' => 'index'));
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
				$this->Forum->set(array(
					'category' => $id,
					'position' => $position++
				));
				$this->Forum->save();
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
