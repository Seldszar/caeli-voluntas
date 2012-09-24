(function($) {
	$.fn.tooltip = function(url, data) {
		data = $.extend({}, data);

		$(this).hover(function() {
			var $t = $(this).css({cursor: 'help'});
			var $tt = $('#tooltip').hide();

			$.post(url, data, function(res) {
				$('#tooltip').html(res);

				var p = $t.offset();
				var left = p.left + $t.outerWidth();
				var top = p.top - $tt.outerHeight();

				if (left > ($(window).scrollLeft() + $(window).width()))
					left = p.left - $tt.outerWidth();

				if (top < $(window).scrollTop())
					top = p.top + $t.outerHeight();

				p.left = left;
				p.top = top;

				$tt.css({left: p.left, top: p.top}).show();
			});
		}, function() {
			$('#tooltip').hide();
		});

		if ($("#tooltip").length == 0)
			$('<div id="tooltip"></div>').appendTo('body').hide();

		return this;
	};
})(jQuery);