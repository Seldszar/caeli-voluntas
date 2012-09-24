<?php

App::uses('AppModel', 'Model');

class BlogArticle extends AppModel {

	public $belongsTo = array(
		'CreatedBy' => array(
			'className' => 'User',
			'foreignKey' => 'created_by'
		)
	);

	public $validate = array(
		'title' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => "Vous devez saisir le titre"
			)
		),
		'content' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => "Vous devez saisir le contenu"
			)
		)
	);

}
