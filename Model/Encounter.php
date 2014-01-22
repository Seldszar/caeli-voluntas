<?php

App::uses('AppModel', 'Model');

class Encounter extends AppModel {

	public $belongsTo = array(
		'EncounterZone' => array(
			'foreignKey' => 'zone'
		)
	);

	private $_zoneId;

	public function afterSave($created, $options = array()) {
		$this->_zoneId = $this->field('zone');
		$this->_updateStatistics($created);
	}

	public function beforeDelete($cascade = true) {
		$this->_zoneId = $this->field('zone');
		return true;
	}

	public function afterDelete() {
		$this->_updateStatistics(true);
	}

	private function _updateStatistics($updateNumBosses = false) {
		$this->EncounterZone->id = $this->_zoneId;

		// Mise à jour de la progression en mode normal de la zone associée à la rencontre actuelle
		$this->EncounterZone->saveField('normal_progress', $this->find('count', array(
			'conditions' => array(
				'zone' => $this->_zoneId,
				'normal' => true
			)
		)));

		// Mise à jour de la progression en mode héroïque de la zone associée à la rencontre actuelle
		$this->EncounterZone->saveField('heroic_progress', $this->find('count', array(
			'conditions' => array(
				'zone' => $this->_zoneId,
				'heroic' => true
			)
		)));

		if ($updateNumBosses) {
			// Mise à jour du nombre de rencontres de la zone associée à la rencontre actuelle
			$this->EncounterZone->saveField('num_bosses', $this->find('count', array(
				'conditions' => array(
					'zone' => $this->_zoneId
				)
			)));
		}
	}

}
