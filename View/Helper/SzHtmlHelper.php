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

	public function link($title, $url = null, $options = array(), $confirmMessage = false) {
		if (isset($options['current'])) {
			if ($this->url($url) == $this->request->here) {
				$options['class'][] = is_string($options['current']) ? $options['current'] : 'current';
			}

			unset($options['current']);
		}

		return parent::link($title, $url, $options, $confirmMessage);
	}

}
