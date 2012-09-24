<?php

App::uses('AppModel', 'Model');

class GalleryImage extends AppModel {

	public $validate = array(
		'image' => array(
			'extension' => array(
				'rule' => 'extension',
				'message' => 'Vous devez sélectionner une image valide'
			),
			'isUploadedFile' => array(
				'rule' => 'isUploadedFile',
				'message' => "Une est survenue lors de l'envoi de l'image"
			),
			'moveUploadedFile' => array(
				'rule' => 'moveUploadedFile',
				'message' => "Une est survenue lors de l'envoi de l'image"
			)
		)
	);

	public $virtualFields = array(
		'file_url' => 'CONCAT("/img/gallery/", GalleryImage.file)'
	);

	public function isUploadedFile($params) {
		$val = array_shift($params);

		if ((isset($val['error']) && $val['error'] == 0) || (!empty($val['tmp_name']) && $val['tmp_name'] != 'none')) {
			return is_uploaded_file($val['tmp_name']);
		}

		return false;
	}

	public function moveUploadedFile($params) {
		$val = array_shift($params);
		$fileName = uniqid() . '.' . pathinfo($val['name'], PATHINFO_EXTENSION);
		$isMoved = @move_uploaded_file($val['tmp_name'], IMAGES . DS . 'gallery' . DS . $fileName);
		
		if ($isMoved) {
			$this->set('file', $fileName);
		}

		return $isMoved;
	}

}
