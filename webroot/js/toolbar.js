(function($) {

	$.fn.toolbar = function(params) {
		params = $.extend({
			tags: {},
			class: null
		}, params);

		var $t = $(this);
		var $b = $('<div class="ui-toolbar"></div>').insertBefore($t);

		$.each(params.tags, function(key, val) {
			$b.append('<a href="#" class="' + key + '"><span></span></a>');
		});

		var o = $t.offset();

		$t.addClass('has-ui-toolbar');
		$b.addClass(params.class);

		$b.children('a').click(function() {
			var v = $t.val();
			var ss = $t[0].selectionStart;
			var se = $t[0].selectionEnd;
			var str = params.tags[this.className].format(v.substring(ss, se));

			$t.val(v.substring(0, ss) + str + v.substring(se, v.length)).focus()[0].selectionStart += str.length;

			return false;
		});
	};

})(jQuery);