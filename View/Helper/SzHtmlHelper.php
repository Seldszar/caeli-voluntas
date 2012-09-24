<?php

App::uses('HtmlHelper', 'View/Helper');

class SzHtmlHelper extends HtmlHelper {

	public function getCrumbListStr($separator = " - ", $startText = false) {
		$crumbs = $this->_prepareCrumbs($startText);
		if (!empty($crumbs)) {
			$out = array();
			foreach ($crumbs as $crumb) {
				array_unshift($out, $crumb[0]);
			}
			return join($separator, $out);
		} else {
			return null;
		}
	}

}
