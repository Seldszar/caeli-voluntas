<?php

App::uses('AppHelper', 'View/Helper');

class BBCodeHelper extends AppHelper {

	public function parse($str) {
		$str = preg_replace(array(
				//"#" . PHP_EOL . PHP_EOL . "+#",
				"#\[b\](.*)\[/b\]#Usi",
				"#\[u\](.*)\[/u\]#Usi",
				"#\[i\](.*)\[/i\]#Usi",
				"#\[s\](.*)\[/s\]#Usi",
				"#\[list\](.*)\[/list\]#Usi",
				"#\[\*\](.*)\[/\*\]#Usi",
				"#\[quote\](.*)\[/quote\]#Usi",
				"#\[quote=(.*)\](.*)\[/quote\]#Usi",
				"#\[a\](.*)\[/a\]#Usi",
				"#\[a=(.*)\](.*)\[/a\]#Usi",
				"#\[url\](.*)\[/url\]#Usi",
				"#\[url=(.*)\](.*)\[/url\]#Usi",
				"#\[img\](.*)\[/img\]#Usi",
				"#\[img=(.*)\](.*)\[/img\]#Usi",
			), array(
				//PHP_EOL,
				"<b>$1</b>",
				"<u>$1</u>",
				"<i>$1</i>",
				"<s>$1</s>",
				"<ul>$1</ul>",
				"<li>$1</li>",
				"<blockquote>$1</blockquote>",
				"<blockquote><div class=\"by-line\">$1</div>$2</blockquote>",
				"<a href=\"$1\">$1</a>",
				"<a href=\"$1\">$2</a>",
				"<a href=\"$1\">$1</a>",
				"<a href=\"$1\">$2</a>",
				"<img src=\"$1\" />",
				"<img title=\"$1\" src=\"$2\" />",
			),
			$str
		);

		$str = nl2br($str);

		return $str;
	}

}
