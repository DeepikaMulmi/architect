(function ( $ ) {
	'use strict';

	$( document ).ready(
		function () {
			qodefFullscreenMenu.init();
		}
	);

	var qodefFullscreenMenu = {
		init: function () {
			var $fullscreenMenuOpener = $( 'a.qodef-fullscreen-menu-opener' ),
				$menuItems            = $( '#qodef-fullscreen-area nav ul li a' ),
				$closeOverlay         = $( '#qodef-fullscreen-area .qodef-fullscreen-menu-overlay-close-holder' ),
				$predefinedClose      = $( '.qodef-fullscreen-menu-opener.qodef-source--predefined .qodef--close' ).first();

			// Open popup menu
			$fullscreenMenuOpener.on(
				'click',
				function ( e ) {
					e.preventDefault();
					var $thisOpener = $( this );

					if ( ! qodefCore.body.hasClass( 'qodef-fullscreen-menu--opened' ) ) {
						$predefinedClose.length ? qodefFullscreenMenu.resetCursorPosition( $predefinedClose, $fullscreenMenuOpener ) : null;
						$predefinedClose.length ? $predefinedClose.addClass( 'qodef--active' ) : null;
						qodefFullscreenMenu.openFullscreen( $thisOpener );

						$( document ).keyup(
							function ( e ) {
								if ( e.keyCode === 27 ) {
									qodefFullscreenMenu.closeFullscreen( $thisOpener );
								}
							}
						);
					} else {
						qodefFullscreenMenu.closeFullscreen( $thisOpener );
					}

					$closeOverlay.on(
						'click',
						function() {
							$predefinedClose.length ? $predefinedClose.removeClass( 'qodef--active' ) : null;
							qodefFullscreenMenu.closeFullscreen( $thisOpener );
						}
					);
				}
			);

			if ($fullscreenMenuOpener.hasClass( 'qodef-source--predefined' )) {
				if (qodef.windowWidth > 1024) {
					qodefFullscreenMenu.initCloseCursor( $predefinedClose, $closeOverlay );
				}
			}

			//open dropdowns
			$menuItems.on(
				'tap click',
				function ( e ) {
					var $thisItem = $( this );

					if ( $thisItem.parent().hasClass( 'menu-item-has-children' ) ) {
						e.preventDefault();
						qodefFullscreenMenu.clickItemWithChild( $thisItem );
					} else if ( $thisItem.attr( 'href' ) !== 'http://#' && $thisItem.attr( 'href' ) !== '#' ) {
						qodefFullscreenMenu.closeFullscreen( $fullscreenMenuOpener );
					}
				}
			);
		},
		initCloseCursor: function($holder, $overlay) {

			$holder.appendTo( $( '#qodef-fullscreen-area' ) ).addClass( 'qodef-fs-close-cursor' );
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
						y     = e.clientY;

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
		openFullscreen: function ( $opener ) {
			$opener.addClass( 'qodef--opened' );
			qodefCore.body.removeClass( 'qodef-fullscreen-menu-animate--out' ).addClass( 'qodef-fullscreen-menu--opened qodef-fullscreen-menu-animate--in' );
			qodefCore.qodefScroll.disable();
		},
		closeFullscreen: function ( $opener ) {
			$opener.removeClass( 'qodef--opened' );
			qodefCore.body.removeClass( 'qodef-fullscreen-menu--opened qodef-fullscreen-menu-animate--in' ).addClass( 'qodef-fullscreen-menu-animate--out' );
			qodefCore.qodefScroll.enable();
			$( 'nav.qodef-fullscreen-menu ul.sub_menu' ).slideUp( 200 );
		},
		clickItemWithChild: function ( thisItem ) {
			var $thisItemParent  = thisItem.parent(),
				$thisItemSubMenu = $thisItemParent.find( '.sub-menu' ).first();

			if ( $thisItemSubMenu.is( ':visible' ) ) {
				$thisItemSubMenu.slideUp( 300 );
				$thisItemParent.removeClass( 'qodef--opened' );
			} else {
				$thisItemSubMenu.slideDown( 300 );
				$thisItemParent.addClass( 'qodef--opened' ).siblings().find( '.sub-menu' ).slideUp( 400 );
			}
		}
	};

})( jQuery );
