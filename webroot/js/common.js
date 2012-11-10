/*! Copyright (c) 2011 Peter (Poetro) Galiba (http://poetro.hu/) MIT Licensed */
(function(c){var b="background-position",d=c.camelCase;function a(g){var f="100%",i="0px",e={top:i,bottom:f,left:i,right:f};return e[g]||g}c.each(["x","y"],function(f,e){var g=d(b+"-"+e);c.cssHooks[g]={get:function(h){var i=c.css(h,b).split(/\s+/,2);return a(i[f])},set:function(h,i){var j=c.css(h,b).split(/\s+/,2);j[f]=a(i);c.style(h,b,j.join(" "))}};c.fx.step[g]=function(h){c.style(h.elem,h.prop,h.now)}})}(jQuery));

String.prototype.format = function() {
	var t = this;
	$.each(arguments, function(k, v) {
		t = t.replace("{" + k + "}", v);
	});
	return t;
};

$(function(){var h=function(){$('body').css({backgroundPositionY:Math.floor(-$(document).scrollTop()/30)+'px'});};$(document).scroll(h);h();});
