/*
 * jSlider jQuery plugin
 *
 * Copyright (c) 2009 Giovanni Casassa (senamion.com - senamion.it)
 *
 * Dual licensed under the MIT (MIT-LICENSE.txt)
 * and GPL (GPL-LICENSE.txt) licenses.
 *
 * http://www.senamion.com
 *
 */

jQuery.fn.jSlider = function(o) {

	o = jQuery.extend({
		colorSlider: "#C0C5CA",
		colorPointer: "#A0A5AA",
		colorMSTooltip: "transparent",
		colorMS: "#000000",
		dimXSlider: 150,
		dimYSlider: 5,
		dimXPointer: 9,
		dimYPointer: 9,
		useRel: false
	}, o);

	return this.each(function(i) {
		var elSel = $(this);
		var h = elSel.height();
		var	w = elSel.width();
		var	position = elSel.position();
		var x = position.left + w + 10;
		var y = position.top;
//		var	uuid = $.data(this);
		var	uuid = (elSel.attr('id') || elSel.attr('name') || elSel.attr('class') || 'internalName') + '_jlb';

		var YSlider = y + Math.round((h - o.dimYSlider) / 2);
		var YPointer = y + Math.round((h - o.dimYPointer) / 2);

		// function called when mousedown e mousemove
		function myMouseMove(kmouse){
			if (isMouseDown) {
				var newX = (kmouse.pageX - Math.round(o.dimXPointer / 2));
				if (newX < x)
					newX = x;
				if (newX > (x + o.dimXSlider - o.dimXPointer))
					newX = (x + o.dimXSlider - o.dimXPointer);
				$("#_jlpoi" + uuid).css("left", newX + "px");

				if (isSelect) {
					var	which = Math.floor((newX - x) / distOpt);
					var	txt = (o.useRel) ? elSel.children().eq(which).attr("rel") : elSel.children().eq(which).text();

					$('#_jlms' + uuid).html(txt).css("left", (newX - 2) + "px");
					elSel.val(elSel.children().eq(which).val());
				}
				return false;
			}
		}

		// SELECT
		var	numOpt = $(this).children().length;
		var	distOpt = Math.round(o.dimXSlider / numOpt);
		var	isSelect = false;
		var	isMouseDown = false;

		// BAR
		$('body').append(
			"<div id='_jlbar" + uuid + "' style='position: absolute; top: " + YSlider + "px; left: " + x + "px; width: " + o.dimXSlider + "px; height: " + o.dimYSlider + "px; overflow:hidden; background: " + o.colorSlider + ";' />");

		// MILES STONES AND TOOLTIP
		if ($(this).is("select")) {
			isSelect = true;

			$('body').append(
				"<div id='_jlms" + uuid + "' style='position: absolute; top: " + (YSlider + 1 + 5) + "px; background: " + o.colorMSTooltip + "; padding: 2px 5px;' ></div>");

			$(this).children().each(function(i){
				$('body').append(
					"<div id='ms" + uuid + "' style='position: absolute; top: " + (YSlider + 1) + "px; left: " + (x + Math.round(distOpt / 2) + (i * distOpt)) + "px; width: " + (o.dimYSlider - 2) + "px; height: " + (o.dimYSlider - 2) + "px; overflow:hidden; background: " + o.colorMS + ";' />");
			});
		}

		// POINTER
		$('body').append(
			"<div id='_jlpoi" + uuid + "' style='position: absolute; top: " + YPointer + "px; left: " + x + "px; width: " + o.dimXPointer + "px; height: " + o.dimYPointer + "px; overflow:hidden; background: " + o.colorPointer + ";' />");

		$("#_jlbar" + uuid).click(function(kmouse){
			$('#_jlpoi' + uuid).css("left", (kmouse.pageX - Math.round(o.dimXPointer / 2)) + "px");
			if (isSelect) {
				var	which = Math.floor((kmouse.pageX - x) / distOpt);
				var	txt = (o.useRel) ? elSel.children().eq(which).attr("rel") : elSel.children().eq(which).text();

				$('#_jlms' + uuid).html(txt).css({opacity: "1"}).css("left", (kmouse.pageX - 2) + "px").animate({opacity: "0.4"});
			}
		})

		$("#_jlpoi" + uuid).mousedown(function(){
			var el = $(this);

			isMouseDown = true;
			$(this).css("border", "1px solid red");
			$('#_jlms' + uuid).css({opacity: "1"});
			$('body').mousemove(myMouseMove).mouseup(function(){
				isMouseDown = false;
				$('body').unbind('mousemove', myMouseMove)
				el.css("border", "0");
				// from animate to css
				$('#_jlms' + uuid).css({opacity: "0.4"});
			});
		});

		if (isSelect) {
			$(this).change(function (){
				var which = $(this).find("option").index($(this).find(":selected"));
				var	newX = (x + Math.round(distOpt / 2) + (which * distOpt));
				var	txt = (o.useRel) ? elSel.children().eq(which).attr("rel") : elSel.children().eq(which).text();

				$('#_jlpoi' + uuid).css("left", newX + "px");
				$('#_jlms' + uuid).html(txt).css({opacity: "1"}).css("left", (newX - 2) + "px").animate({opacity: "0.4"});
			});

			$(this).trigger('change');
		}
	});
};