<?php

App::uses('AppModel', 'Model');

class Event extends AppModel {

	public $findMethods = array(
		'groupByDate' => true,
		'groupByStatus' => true
	);

	public $belongsTo = array(
		'CreatedBy' => array(
			'className' => 'User',
			'foreignKey' => 'created_by'
		),
		'EventType' => array(
			'foreignKey' => 'type'
		)
	);

	public $hasMany = array(
		'EventParticipant' => array(
			'foreignKey' => 'event'
		)
	);

	public $validate = array(
		'name' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => "Vous devez saisir un nom"
			)
		),
		'begin' => array(
			'isGreaterThanNow' => array(
				'rule' => 'isGreaterThanNow',
				'message' => "Vous devez saisir une date valide"
			)
		)
	);

	protected function _findGroupByDate($state, $query, $results = array()) {
		if ($state == 'before') {
			return $query;
		}

		$_results = array();

		foreach ($results as $result) {
			$_results[date('Y-m-d', strtotime($result[$this->alias]['begin']))][] = $result;
		}

		return $_results;
	}

	protected function _findGroupByStatus($state, $query, $results = array()) {
		if ($state == 'before') {
			return $query;
		}

		$_results = array();

		foreach ($results as $result) {
			$_results[date('Y-m-d', strtotime($result[$this->alias]['begin']))][] = $result;
		}

		return $_results;
	}

	public function isGreaterThanNow($check) {
		$value = array_values($check);
	    $date = $value[0];

	    return strtotime($date) > time();
	}

}
