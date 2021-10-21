(function ( $ ) {
	'use strict';

	qodefCore.shortcodes.emaurri_core_counter = {};

	$( document ).ready(
		function () {
			qodefCounter.init();
		}
	);

	var qodefCounter = {
		init: function () {
			this.counters = $( '.qodef-counter' );

			if ( this.counters.length ) {
				this.counters.each(
					function () {
						var $thisCounter    = $( this ),
							$counterElement = $thisCounter.find( '.qodef-m-digit' ),
							options         = qodefCounter.generateOptions( $thisCounter );

						qodefCounter.counterScript( $counterElement, options );
					}
				);
			}
		},
		generateOptions: function ( $counter ) {
			var options   = {};
			options.start = typeof $counter.data( 'start-digit' ) !== 'undefined' && $counter.data( 'start-digit' ) !== '' ? $counter.data( 'start-digit' ) : 0;
			options.end   = typeof $counter.data( 'end-digit' ) !== 'undefined' && $counter.data( 'end-digit' ) !== '' ? $counter.data( 'end-digit' ) : null;
			options.step  = typeof $counter.data( 'step-digit' ) !== 'undefined' && $counter.data( 'step-digit' ) !== '' ? $counter.data( 'step-digit' ) : 1;
			options.delay = typeof $counter.data( 'step-delay' ) !== 'undefined' && $counter.data( 'step-delay' ) !== '' ? parseInt( $counter.data( 'step-delay' ), 10 ) : 100;
			options.txt   = typeof $counter.data( 'digit-label' ) !== 'undefined' && $counter.data( 'digit-label' ) !== '' ? $counter.data( 'digit-label' ) : '';

			return options;
		},
		counterScript: function ( $counterElement, options ) {
			var defaults = {
				start: 0,
				end: null,
				step: 1,
				delay: 50,
				txt: '',
			};

			var settings = $.extend( defaults, options || {} );
			var nb_start = settings.start;
			var nb_end   = settings.end;

			$counterElement.text( nb_start + settings.txt );

			var counter = function () {
				// Definition of conditions of arrest
				if ( nb_end !== null && nb_start >= nb_end ) {
					return;
				}
				// incrementation
				nb_start = nb_start + settings.step;

				if ( nb_start >= nb_end ) {
					nb_start = nb_end;
				}
				// display
				$counterElement.text( nb_start + settings.txt );
			};

			// Timer
			// Launches every "settings.delay"
			$counterElement.appear(
				function () {
					setInterval( counter, settings.delay );
				},
				{ accX: 0, accY: 0 }
			);
		}
	};

	qodefCore.shortcodes.emaurri_core_counter.qodefCounter = qodefCounter;

})( jQuery );
