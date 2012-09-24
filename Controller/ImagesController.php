<?php

App::uses('Controller', 'Controller');

class ImagesController extends Controller {

	public $uses = false;

	public function generate($size, $file) {
		$this->autoRender = false;

		$directory = IMAGES;
		$path = $directory . $file;

		list($srcWidth, $srcHeight) = getimagesize($path);

		$sizeRatio = $srcWidth / $srcHeight;
		$dstWidth = round($size * ($sizeRatio < 1 ? $sizeRatio : 1));
		$dstHeight = round($size / ($sizeRatio > 1 ? $sizeRatio : 1));

		$srcImage = imagecreatefromjpeg($path);
		$dstImage = imagecreatetruecolor($dstWidth, $dstHeight);

		if (imagecopyresized($dstImage, $srcImage, 0, 0, 0, 0, $dstWidth, $dstHeight, $srcWidth, $srcHeight)) {
			$this->response->type(array('jpeg' => 'image/jpeg'));
			$this->response->type('jpeg');

			imagejpeg($dstImage);
		}

		imagedestroy($srcImage);
		imagedestroy($dstImage);
	}

}
