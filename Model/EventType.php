<?php

App::uses('AppModel', 'Model');

class EventType extends AppModel {

	public $virtualFields = array(
		'image_path' => "CONCAT('/img/events/', image)"
	);

}
