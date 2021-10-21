(function ($) {
	"use strict";

	$( document ).ready(
		function () {
			qodefEmaurriSpinner.init();
		}
	);

	$( window ).on(
		'elementor/frontend/init',
		function () {
			var isEditMode = Boolean( elementorFrontend.isEditMode() );
			if (isEditMode) {
				qodefEmaurriSpinner.init( isEditMode );
			}
		}
	);

	var qodefEmaurriSpinner = {
		init: function (isEditMode) {
			this.holder = $( '#qodef-page-spinner.qodef-layout--emaurri' );

			if (this.holder.length) {
				qodefEmaurriSpinner.animateSpinner( this.holder, isEditMode );
			}
		},
		animateSpinner: function ($holder, isEditMode) {
			var $letter = $holder.find( '.qodef-m-emaurri-text span' ),
				tl      = new TimelineMax( { repeat: -1, repeatDelay: 0 } )

			tl.staggerFromTo(
				$letter,
				1,
				{
					opacity: 0,
					y: 10,
				},
				{
					opacity: 1,
					y: 0,
					ease: Power3.easeInOut
				},
				.3
			);
			tl.staggerTo(
				$letter,
				1,
				{
					opacity: 0,
					delay: 0,
					ease: Power2.easeInOut,
					repeat: 0
				},
				.05
			);

			isEditMode && qodefEmaurriSpinner.finishAnimation( $holder );

			$( window ).on(
				'load',
				function () {
					tl.eventCallback(
						"onRepeat",
						function () {
							tl.pause().kill();
							qodefEmaurriSpinner.finishAnimation( $holder );
						}
					);
				}
			);
		},
		finishAnimation: function ($holder) {
			qodefEmaurriSpinner.fadeOutLoader( $holder );
			setTimeout(
				function () {
					var landingRev = $( '#qodef-landing-rev' ).find( 'rs-module' );
					landingRev.length && landingRev.revstart();
				},
				300
			);
		},
		fadeOutLoader: function ($holder, speed, delay, easing) {
			speed  = speed ? speed : 600;
			delay  = delay ? delay : 0;
			easing = easing ? easing : 'linear';

			$holder.delay( delay ).fadeOut( speed, easing );

			$( window ).on(
				'bind',
				'pageshow',
				function (event) {
					if (event.originalEvent.persisted) {
						$holder.fadeOut( speed, easing );
					}
				}
			);
		}
	};

})( jQuery );
