(function ( $ ) {
	'use strict';

	$( document ).ready(
		function () {
			qodefSearchFullscreen.init();
		}
	);

	var qodefSearchFullscreen = {
		init: function () {
			var $searchOpener    = $( 'a.qodef-search-opener' ),
				$searchHolder    = $( '.qodef-fullscreen-search-holder' ),
				$closeOverlay    = $searchHolder.find( '.qodef-fullscreen-search-overlay-close-holder' ),
				$predefinedClose = $searchHolder.find( '.qodef-source--predefined.qodef-m-close .qodef-m-icon' ).first();

			if ( $searchOpener.length && $searchHolder.length ) {
				$searchOpener.on(
					'click',
					function ( e ) {
						e.preventDefault();
						var $thisOpener = $( this );

						if ( qodefCore.body.hasClass( 'qodef-fullscreen-search--opened' ) ) {
							$predefinedClose.length ? qodefSearchFullscreen.resetCursorPosition( $predefinedClose, $searchOpener ) : null;
							$predefinedClose.length ? $predefinedClose.addClass( 'qodef--active' ) : null;
							qodefSearchFullscreen.closeFullscreen( $searchHolder );
						} else {
							qodefSearchFullscreen.openFullscreen( $searchHolder );
						}

						$closeOverlay.on(
							'click',
							function() {
								$predefinedClose.length ? $predefinedClose.removeClass( 'qodef--active' ) : null;
								qodefSearchFullscreen.closeFullscreen( $thisOpener );
							}
						);
					}
				);

				//Close on escape
				$( document ).keyup(
					function ( e ) {
						if ( e.keyCode === 27 && qodefCore.body.hasClass( 'qodef-fullscreen-search--opened' ) ) { //KeyCode for ESC button is 27
							qodefSearchFullscreen.closeFullscreen( $searchHolder );
						}
					}
				);
			}

			if ($searchOpener.hasClass( 'qodef-source--predefined' )) {
				if (qodef.windowWidth > 1024) {
					qodefSearchFullscreen.initCloseCursor( $predefinedClose, $closeOverlay );
				}
			}
		},
		initCloseCursor: function($holder, $overlay) {

			$holder.appendTo( $( '.qodef-fullscreen-search-holder' ) ).addClass( 'qodef-fs-close-cursor' );
			var $fsCloseCursor = $( '.qodef-fs-close-cursor' );

			$overlay.on(
				'mouseenter',
				function() {
					$fsCloseCursor.addClass( 'qodef--active' );
				}
			).on(
				'mouseleave',
				function() {
					$fsCloseCursor.removeClass( 'qodef--active' );
				}
			);
			$( window ).on(
				'mousemove',
				function (e) {

					if ($fsCloseCursor.hasClass( 'qodef--active' )) {
						var x = e.clientX,
							y = e.clientY;

						TweenMax.to(
							$fsCloseCursor,
							.5,
							{
								x: x,
								y: y,
								ease: Power3.easeOut,
							}
						);
					}
				}
			);
		},
		resetCursorPosition: function($cursor, $menuOpener) {
			TweenMax.set(
				$cursor,
				{
					x: $menuOpener.offset().left + 27,
					y: $menuOpener.offset().top + 5,
				}
			);
		},
		openFullscreen: function ( $searchHolder ) {
			qodefCore.body.removeClass( 'qodef-fullscreen-search--fadeout' );
			qodefCore.body.addClass( 'qodef-fullscreen-search--opened qodef-fullscreen-search--fadein' );

			setTimeout(
				function () {
					$searchHolder.find( '.qodef-m-form-field' ).focus();
				},
				900
			);

			qodefCore.qodefScroll.disable();
		},
		closeFullscreen: function ( $searchHolder ) {
			qodefCore.body.removeClass( 'qodef-fullscreen-search--opened qodef-fullscreen-search--fadein' );
			qodefCore.body.addClass( 'qodef-fullscreen-search--fadeout' );

			setTimeout(
				function () {
					$searchHolder.find( '.qodef-m-form-field' ).val( '' );
					$searchHolder.find( '.qodef-m-form-field' ).blur();
					qodefCore.body.removeClass( 'qodef-fullscreen-search--fadeout' );
				},
				300
			);

			qodefCore.qodefScroll.enable();
		}
	};

})( jQuery );
