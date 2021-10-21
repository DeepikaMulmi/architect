(function ( $ ) {
	'use strict';

	qodefCore.shortcodes.emaurri_core_text_marquee = {};

	$( document ).ready(
		function () {
			qodefTextMarquee.init();
		}
	);

	var qodefTextMarquee = {
		init: function () {
			this.holder = $( '.qodef-text-marquee' );

			if ( this.holder.length ) {
				this.holder.each(
					function () {
						qodefTextMarquee.initMarquee( $( this ) );
						qodefTextMarquee.initResponsive( $( this ).find( '.qodef-m-content' ) );
					}
				);
			}
		},
		initResponsive: function ( thisMarquee ) {
			var fontSize,
				lineHeight,
				coef1 = 1,
				coef2 = 1;

			if ( qodefCore.windowWidth < 1480 ) {
				coef1 = 0.8;
			}

			if ( qodefCore.windowWidth < 1200 ) {
				coef1 = 0.7;
			}

			if ( qodefCore.windowWidth < 768 ) {
				coef1 = 0.55;
				coef2 = 0.65;
			}

			if ( qodefCore.windowWidth < 600 ) {
				coef1 = 0.45;
				coef2 = 0.55;
			}

			if ( qodefCore.windowWidth < 480 ) {
				coef1 = 0.4;
				coef2 = 0.5;
			}

			fontSize = parseInt( thisMarquee.css( 'font-size' ) );

			if ( fontSize > 200 ) {
				fontSize = Math.round( fontSize * coef1 );
			} else if ( fontSize > 60 ) {
				fontSize = Math.round( fontSize * coef2 );
			}

			thisMarquee.css( 'font-size', fontSize + 'px' );

			lineHeight = parseInt( thisMarquee.css( 'line-height' ) );

			if ( lineHeight > 70 && qodefCore.windowWidth < 1440 ) {
				lineHeight = '1.2em';
			} else if ( lineHeight > 35 && qodefCore.windowWidth < 768 ) {
				lineHeight = '1.2em';
			} else {
				lineHeight += 'px';
			}

			thisMarquee.css( 'line-height', lineHeight );
		},
		initMarquee: function ( thisMarquee ) {
			var elements = thisMarquee.find( '.qodef-m-text' ),
				delta    = 0.05;

			elements.each(
				function ( i ) {
					$( this ).data( 'x', 0 );
				}
			);

			requestAnimationFrame(
				function () {
					qodefTextMarquee.loop( thisMarquee, elements, delta );
				}
			);
		},
		inRange: function ( thisMarquee ) {
			if ( qodefCore.scroll + qodefCore.windowHeight >= thisMarquee.offset().top && qodefCore.scroll < thisMarquee.offset().top + thisMarquee.height() ) {
				return true;
			}

			return false;
		},
		loop: function ( thisMarquee, elements, delta ) {
			if ( ! qodefTextMarquee.inRange( thisMarquee ) ) {
				requestAnimationFrame(
					function () {
						qodefTextMarquee.loop( thisMarquee, elements, delta );
					}
				);
				return false;
			} else {
				elements.each(
					function ( i ) {
						var el = $( this );
						el.css( 'transform', 'translate3d(' + el.data( 'x' ) + '%, 0, 0)' );
						el.data( 'x', (el.data( 'x' ) - delta).toFixed( 2 ) );
						el.offset().left < -el.width() - 25 && el.data( 'x', 100 * Math.abs( i - 1 ) );
					}
				);
				requestAnimationFrame(
					function () {
						qodefTextMarquee.loop( thisMarquee, elements, delta );
					}
				);
			}
		}
	};

	qodefCore.shortcodes.emaurri_core_text_marquee.qodefTextMarquee = qodefTextMarquee;

})( jQuery );
