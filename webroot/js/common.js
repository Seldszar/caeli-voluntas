String.prototype.format = function() {
	var t = this;
	$.each(arguments, function(k, v) {
		t = t.replace("{" + k + "}", v);
	});
	return t;
};
