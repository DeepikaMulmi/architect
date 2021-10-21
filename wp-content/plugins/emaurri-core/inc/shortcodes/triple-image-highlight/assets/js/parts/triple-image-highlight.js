(function ($) {
	"use strict";

	qodefCore.shortcodes.emaurri_core_triple_image_highlight = {};

	$( document ).on(
		'ready',
		function () {
			qodefTripleImageHighlight.init();
		}
	);

	var qodefTripleImageHighlight = {
		init: function () {
			var tfihShortcodes = $( '.qodef-triple-image-highlight' );

			if (!tfihShortcodes.length) {
				return;
			}
			var initClasses = function (c, l, r) {
				c.addClass('qodef-c');
				l.addClass('qodef-l');
				r.addClass('qodef-r');
			}
			var resetIndexes = function (c, l, r) {
				c.css('z-index', 30);
				l.css('z-index', 20);
				r.css('z-index', 20);
			}
			var setTriggerSize = function (holder, inner) {
				holder.find('div[class*="trigger"]').width(Math.round(inner.position().left));
			}
			var setPositioning = function (holder, inner) {
				var left = holder.find('.qodef-l'),
					right = holder.find('.qodef-r'),
					centered = holder.find('.qodef-c');

				var xOffset = inner.position().left + window.innerWidth / 12.5;

				left.css({
					'visibility': 'visible',
					'transform': 'matrix(0.65,0,0,0.65,-' + xOffset + ',0)'
				});
				right.css({
					'visibility': 'visible',
					'transform': 'matrix(0.65,0,0,0.65,' + xOffset + ',0)'
				});
				centered.css({
					'transform': 'matrix(1, 0, 0, 1, 0, 0)'
				});
			}
			var rotateAnimation = function (holder, inner, direction) {
				holder.data('animating', true);

				if (direction == 'left') {
					var toFront = holder.find('.qodef-l'),
						toBack = holder.find('.qodef-c'),
						toPrep = holder.find('.qodef-r');

					toPrep.removeClass('qodef-r').addClass('qodef-l');
					toBack.removeClass('qodef-c').addClass('qodef-r');
					toFront.removeClass('qodef-l').addClass('qodef-c');
				} else {
					var toFront = holder.find('.qodef-r'),
						toBack = holder.find('.qodef-c'),
						toPrep = holder.find('.qodef-l');

					toPrep.removeClass('qodef-l').addClass('qodef-r');
					toBack.removeClass('qodef-c').addClass('qodef-l');
					toFront.removeClass('qodef-r').addClass('qodef-c');
				}

				toPrep.css(
					{
						'z-index': 15,
						'transition': 'transform .5s, transform-origin .5s'
					}
				);
				toBack.css(
					{
						'z-index': 25,
						'transition': 'transform 1s cubic-bezier(0.19, 1, 0.22, 1) .2s, \
									box-shadow .3s'
					}
				);
				toFront.css(
					{
						'z-index': 20,
						'transition': 'transform .75s cubic-bezier(0.86, 0, 0.07, 1) .5s, \
									box-shadow .3s'
					}
				);

				holder.find('a').css('pointer-events', 'none');
				setTimeout(function () {
					holder.find('a').css('pointer-events', 'auto');
					resetIndexes(toFront, toPrep, toBack);
				}, 500);

				toFront.one('transitionend', function () {
					holder.data('animating', false);
					clearInterval(holder.data('autoplay'));
					holder.data('autoplay', setInterval(function () {
						navigate(holder, inner);
					}, 3000));
				})
			}
			var navigate = function (holder, inner, event) {
				var direction,
					linkActive = false;

				if (typeof event !== 'undefined') {
					switch (event.target.className) {
						case 'qodef-left-trigger':
							direction = 'left';
							break;
						case 'qodef-right-trigger':
							direction = 'right';
							break;
						case 'qodef-e-link':
							linkActive = true;
							holder.data('animating', false);
							clearInterval(holder.data('autoplay'));
							break;
					}
				} else {
					direction = 'right';
				}

				if (!linkActive) {
					rotateAnimation(holder, inner, direction)
					setPositioning(holder, inner);
				}
			}
			tfihShortcodes.each(function () {
				var holder = $(this),
					inner = holder.find('.qodef-e-inner'),
					centeredH = holder.find('.qodef-e-image-holder.qodef--center'),
					leftH = holder.find('.qodef-e-image-holder.qodef--left'),
					rightH = holder.find('.qodef-e-image-holder.qodef--right');

				//state
				holder
					.data('animating', false)
					.data('autoplay', false);

				initClasses(centeredH, leftH, rightH);
				resetIndexes(centeredH, leftH, rightH);
				setTriggerSize(holder, inner);

				holder.waitForImages(function () {
					// holder.appear(function () {
					holder.css('visibility', 'visible');
					setPositioning(holder, inner);
					holder.data('autoplay', setInterval(function () {
						navigate(holder, inner);
					}, 3000));
					// }, {accX: 0, accY: 300});
				});

				holder.on('click', function (event) {
					if (!holder.data('animating')) {
						clearInterval(holder.data('autoplay'));
						navigate(holder, inner, event);
					}
				});

				if ( holder.hasClass( 'qodef-navigation-enabled' ) ) {
					var left = holder.find('.qodef-left-arrow'),
						right = holder.find('.qodef-right-arrow');

					left.on('click', function() {
						if (!holder.data('animating')) {
							rotateAnimation(holder, inner, 'left')
							setPositioning(holder, inner);
						}
					});
					right.on('click', function() {
						if (!holder.data('animating')) {
							rotateAnimation(holder, inner, 'right')
							setPositioning(holder, inner);
						}
					});
				}

				$(window).on('resize', function () {
					setPositioning(holder, inner);
					setTriggerSize(holder, inner);
					inner.find('>div').css('transition', 'none');
				})
			});
		}
	}

	qodefCore.shortcodes.emaurri_core_triple_image_highlight.qodefTripleImageHighlight = qodefTripleImageHighlight;

})(jQuery);