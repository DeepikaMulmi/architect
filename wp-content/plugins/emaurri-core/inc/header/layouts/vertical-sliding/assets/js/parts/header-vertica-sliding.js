(function ( $ ) {
	'use strict';

	$( document ).ready(
	    function () {
            qodefVerticalSlidingNavMenu.init();
        }
	);

	/**
	 * Function object that represents vertical menu area.
	 * @returns {{init: Function}}
	 */
	var qodefVerticalSlidingNavMenu = {
		openedScroll: 0,

		initNavigation: function ( $verticalSlidingMenuObject ) {
			var $verticalSlidingNavObject = $verticalSlidingMenuObject.find( '.qodef-header-vertical-sliding-navigation' );

			if ( $verticalSlidingNavObject.hasClass( 'qodef-vertical-sliding-drop-down--below' ) ) {
				qodefVerticalSlidingNavMenu.dropdownClickToggle( $verticalSlidingNavObject );
			} else if ( $verticalSlidingNavObject.hasClass( 'qodef-vertical-sliding-drop-down--side' ) ) {
				qodefVerticalSlidingNavMenu.dropdownFloat( $verticalSlidingNavObject );
			}
		},
		dropdownClickToggle: function ( $verticalSlidingNavObject ) {
			var $menuItems = $verticalSlidingNavObject.find( 'ul li.menu-item-has-children' );

			$menuItems.each(
				function () {
					var $elementToExpand = $( this ).find( ' > .qodef-drop-down-second, > ul' );
					var menuItem         = this;
					var $dropdownOpener  = $( this ).find( '> a' );
					var slideUpSpeed     = 'fast';
					var slideDownSpeed   = 'slow';

					$dropdownOpener.on(
						'click tap',
						function ( e ) {
							e.preventDefault();
							e.stopPropagation();

							if ( $elementToExpand.is( ':visible' ) ) {
								$( menuItem ).removeClass( 'qodef-menu-item--open' );
								$elementToExpand.slideUp( slideUpSpeed );
							} else if ( $dropdownOpener.parent().parent().children().hasClass( 'qodef-menu-item--open' ) && $dropdownOpener.parent().parent().parent().hasClass( 'qodef-vertical-menu' ) ) {
								$( this ).parent().parent().children().removeClass( 'qodef-menu-item--open' );
								$( this ).parent().parent().children().find( ' > .qodef-drop-down-second' ).slideUp( slideUpSpeed );

								$( menuItem ).addClass( 'qodef-menu-item--open' );
								$elementToExpand.slideDown( slideDownSpeed );
							} else {

								if ( ! $( this ).parents( 'li' ).hasClass( 'qodef-menu-item--open' ) ) {
									$menuItems.removeClass( 'qodef-menu-item--open' );
									$menuItems.find( ' > .qodef-drop-down-second, > ul' ).slideUp( slideUpSpeed );
								}

								if ( $( this ).parent().parent().children().hasClass( 'qodef-menu-item--open' ) ) {
									$( this ).parent().parent().children().removeClass( 'qodef-menu-item--open' );
									$( this ).parent().parent().children().find( ' > .qodef-drop-down-second, > ul' ).slideUp( slideUpSpeed );
								}

								$( menuItem ).addClass( 'qodef-menu-item--open' );
								$elementToExpand.slideDown( slideDownSpeed );
							}
						}
					);
				}
			);
		},
		dropdownFloat: function ( $verticalSlidingNavObject ) {
			var $menuItems = $verticalSlidingNavObject.find( 'ul li.menu-item-has-children' );
			var $allDropdowns = $menuItems.find( ' > .qodef-drop-down-second > .qodef-drop-down-second-inner > ul, > ul' );

			$menuItems.each(
				function () {
					var $elementToExpand = $( this ).find( ' > .qodef-drop-down-second > .qodef-drop-down-second-inner > ul, > ul' );
					var menuItem         = this;

					if ( Modernizr.touch ) {
						var $dropdownOpener = $( this ).find( '> a' );

						$dropdownOpener.on(
							'click tap',
							function ( e ) {
								e.preventDefault();
								e.stopPropagation();

								if ( $elementToExpand.hasClass( 'qodef-float--open' ) ) {
									$elementToExpand.removeClass( 'qodef-float--open' );
									$( menuItem ).removeClass( 'qodef-menu-item--open' );
								} else {
									if ( ! $( this ).parents( 'li' ).hasClass( 'qodef-menu-item--open' ) ) {
										$menuItems.removeClass( 'qodef-menu-item--open' );
										$allDropdowns.removeClass( 'qodef-float--open' );
									}

									$elementToExpand.addClass( 'qodef-float--open' );
									$( menuItem ).addClass( 'qodef-menu-item--open' );
								}
							}
						);
					} else {
						//must use hoverIntent because basic hover effect doesn't catch dropdown
						//it doesn't start from menu item's edge
						$( this ).hoverIntent(
							{
								over: function () {
									$elementToExpand.addClass( 'qodef-float--open' );
									$( menuItem ).addClass( 'qodef-menu-item--open' );
								},
								out: function () {
									$elementToExpand.removeClass( 'qodef-float--open' );
									$( menuItem ).removeClass( 'qodef-menu-item--open' );
								},
								timeout: 300
							}
						);
					}
				}
			);
		},
		verticalSlidingAreaScrollable: function ( $verticalSlidingMenuObject ) {
			return $verticalSlidingMenuObject.hasClass( 'qodef-with-scroll' );
		},
		initVerticalSlidingAreaScroll: function ( $verticalSlidingMenuObject ) {
			if ( qodefVerticalSlidingNavMenu.verticalSlidingAreaScrollable( $verticalSlidingMenuObject ) && typeof qodefCore.qodefPerfectScrollbar === 'object' ) {
				qodefCore.qodefPerfectScrollbar.init( $verticalSlidingMenuObject );
			}
		},
		verticalSlidingAreaShowHide: function ( $verticalSlidingMenuObject ) {
			var $verticalSlidingMenuOpener = $verticalSlidingMenuObject.find( '.qodef-vertical-sliding-menu-opener' );

			$verticalSlidingMenuOpener.on(
				'click',
				function ( e ) {
					e.preventDefault();

					if ( ! $verticalSlidingMenuObject.hasClass( 'qodef-vertical-sliding-menu--opened' ) ) {
						$verticalSlidingMenuObject.addClass( 'qodef-vertical-sliding-menu--opened' );
						qodefVerticalSlidingNavMenu.openedScroll = qodef.window.scrollTop();
					} else {
						$verticalSlidingMenuObject.removeClass( 'qodef-vertical-sliding-menu--opened' );
					}
				}
			);
		},
		verticalSlidingAreaCloseOnScroll: function ( $verticalSlidingMenuObject ) {
			qodef.window.on(
				'scroll',
				function () {
					if ( $verticalSlidingMenuObject.hasClass( 'qodef-vertical-sliding-menu--opened' ) && Math.abs( qodef.scroll - qodefVerticalSlidingNavMenu.openedScroll ) > 400 ) {
						$verticalSlidingMenuObject.removeClass( 'qodef-vertical-sliding-menu--opened' );
					}
				}
			);
		},
		init: function () {
			var $verticalSlidingMenuObject = $( '.qodef-header--vertical-sliding #qodef-page-header' );

			if ( $verticalSlidingMenuObject.length ) {
				qodefVerticalSlidingNavMenu.verticalSlidingAreaShowHide( $verticalSlidingMenuObject );
				qodefVerticalSlidingNavMenu.verticalSlidingAreaCloseOnScroll( $verticalSlidingMenuObject );
				qodefVerticalSlidingNavMenu.initNavigation( $verticalSlidingMenuObject );
				qodefVerticalSlidingNavMenu.initVerticalSlidingAreaScroll( $verticalSlidingMenuObject );
			}
		}
	};

})( jQuery );
