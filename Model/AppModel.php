<?php
/**
 * Application model for Cake.
 *
 * This file is application-wide model file. You can put all
 * application-wide model-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Model
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('Model', 'Model');

/**
 * Application model for Cake.
 *
 * Add your application-wide methods in the class below, your models
 * will inherit them.
 *
 * @package       app.Model
 */
class AppModel extends Model {

	public $actsAs = array('Containable');

	public function beforeSave($options = array()) {
		$field = 'created_by';

		if ($this->id) {
			$field = 'edited_by';

			if ($this->hasField('edited') && !isset($this->data[$this->alias]['edited'])) {
				$this->set('edited', CakeTime::toServer(time()));
			}
		}

		if ($this->hasField($field) && !isset($this->data[$this->alias][$field])) {
			$this->set($field, AuthComponent::user('id'));
		}

		return true;
	}

	/**
	 * Bascule la valeur d'un champ représentant un booléen
	 *
	 * @param $fieldName Nom du champ à basculer
	 * @return boolean True si l'opération s'est déroulée avec succès ; sinon false
	 */
	public function toggleField($fieldName) {
		return $this->saveField($fieldName, $this->getDataSource()->expression('NOT ' . $fieldName));
	}

	/**
	 * Incrémente la valeur d'un champ
	 *
	 * @param $fieldName Nom du champ à incrémenter
	 * @param $value Valeur d'incrémentation
	 * @return boolean True si l'opération s'est déroulée avec succès ; sinon false
	 */
	public function incrementField($fieldName, $value = 1) {
		return $this->saveField($fieldName, $this->getDataSource()->expression($fieldName . ' + ' . $value));
	}

}
