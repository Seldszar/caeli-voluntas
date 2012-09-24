<?php

App::uses('AppController', 'Controller');

class BlogController extends AppController {

	public $layout = 'two_column';

	public $uses = array('BlogArticle');

	public $helpers = array('Text', 'Time');

	public function index() {
		$this->paginate = array(
			'BlogArticle' => array(
				'limit' => 4,
				'order' => array(
					'BlogArticle.created' => 'DESC'
				),
				'paramType' => 'querystring'
			)
		);

		$this->BlogArticle->contain(array(
			'CreatedBy'
		));

		$this->set('articles', $this->paginate('BlogArticle'));
	}

	public function view($id) {
		$this->BlogArticle->id = $id;

		if (!$this->BlogArticle->exists()) {
			throw new NotFoundException("L'article demandé est introuvable");
		}

		$this->set('article', $this->BlogArticle->read());
	}

	public function admin_index() {
		$this->set('articles', $this->BlogArticle->find('all', array('order' => array('BlogArticle.created' => 'DESC'), 'contain' => array('CreatedBy'))));
	}

	public function admin_create() {
		if ($this->request->is('post')) {
			$data = $this->data;

			if ($this->BlogArticle->save($data, true, array('title', 'content', 'created_by'))) {
				$this->redirect(array('action' => 'index'));
			}
		}
	}

	public function admin_edit($id) {
		$this->BlogArticle->id = $id;

		if (!$this->BlogArticle->exists()) {
			throw new NotFoundException("L'article demandé est introuvable");
		}

		$article = $this->BlogArticle->read();

		if ($this->request->is('put')) {
			$data = $this->data;

			if ($this->BlogArticle->save($data, true, array('title', 'content'))) {
				$this->redirect(array('action' => 'index'));
			}
		} else {
			$this->data = $article;
		}

		$this->set('article', $article);
	}

	public function admin_delete($id) {
		$this->BlogArticle->id = $id;

		if (!$this->BlogArticle->exists()) {
			throw new NotFoundException("L'article demandé est introuvable");
		}

		if ($this->BlogArticle->delete()) {
			$this->redirect(array('action' => 'index'));
		}
	}

	public function beforeFilter() {
		parent::beforeFilter();

		if (isset($this->params['admin']) && !$this->Acl->hasRole('manage_blog')) {
			throw new UnauthorizedException("Vous n'êtes pas autorisé à accéder à cette page");
		}
	}

}
