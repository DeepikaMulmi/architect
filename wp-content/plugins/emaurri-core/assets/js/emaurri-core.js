(function ( $ ) {
	'use strict';

	// This case is important when theme is not active
	if ( typeof qodef !== 'object' ) {
		window.qodef = {};
	}

	window.qodefCore                = {};
	qodefCore.shortcodes            = {};
	qodefCore.listShortcodesScripts = {
		qodefSwiper: qodef.qodefSwiper,
		qodefPagination: qodef.qodefPagination,
		qodefFilter: qodef.qodefFilter,
		qodefMasonryLayout: qodef.qodefMasonryLayout,
		qodefJustifiedGallery: qodef.qodefJustifiedGallery,
	};

	qodefCore.body         = $( 'body' );
	qodefCore.html         = $( 'html' );
	qodefCore.windowWidth  = $( window ).width();
	qodefCore.windowHeight = $( window ).height();
	qodefCore.scroll       = 0;

	$( document ).ready(
		function () {
			qodefCore.scroll = $( window ).scrollTop();
			qodefInlinePageStyle.init();
		}
	);

	$( window ).resize(
		function () {
			qodefCore.windowWidth  = $( window ).width();
			qodefCore.windowHeight = $( window ).height();
		}
	);

	$( window ).scroll(
		function () {
			qodefCore.scroll = $( window ).scrollTop();
		}
	);

	var qodefScroll = {
		disable: function () {
			if ( window.addEventListener ) {
				window.addEventListener(
					'wheel',
					qodefScroll.preventDefaultValue,
					{ passive: false }
				);
			}

			// window.onmousewheel = document.onmousewheel = qodefScroll.preventDefaultValue;
			document.onkeydown = qodefScroll.keyDown;
		},
		enable: function () {
			if ( window.removeEventListener ) {
				window.removeEventListener(
					'wheel',
					qodefScroll.preventDefaultValue,
					{ passive: false }
				);
			}
			window.onmousewheel = document.onmousewheel = document.onkeydown = null;
		},
		preventDefaultValue: function ( e ) {
			e = e || window.event;
			if ( e.preventDefault ) {
				e.preventDefault();
			}
			e.returnValue = false;
		},
		keyDown: function ( e ) {
			var keys = [37, 38, 39, 40];
			for ( var i = keys.length; i--; ) {
				if ( e.keyCode === keys[i] ) {
					qodefScroll.preventDefaultValue( e );
					return;
				}
			}
		}
	};

	qodefCore.qodefScroll = qodefScroll;

	var rowBackgroundText = {
		init: function ($this, settings) {
				var row          = $this;
				var text         = settings.bg_text,
					margin       = settings.bg_margin,
					marginLaptop = settings.bg_margin_laptop,
					fontSize     = settings.bg_font_size,
					color        = settings.bg_color,
					zIndex       = settings.bg_z_index;

			if ( text.length && typeof ( text ) != 'undefined' ) {

				var words = text.split( " " );

				for (var i = 0; i < words.length; i++) {
					words[i] = '<span class="qodef-row-background-word">' + words[i] + '</span>';

					text = words.join( " " );
				}
			}

			row.append( '<div class="qodef-row-background-text"><div class="qodef-row-background-text-inner">' + text + '</div></div>' );

			var textInner = $this.find( '.qodef-row-background-text' );

			if ( qodef.windowWidth > 1024 ) {
				if (margin.length && typeof ( margin ) != 'undefined' ) {
					textInner.css( 'margin', margin );
				}
			}
			if ( qodef.windowWidth < 1441 && qodef.windowWidth > 1025 ) {
				if ( marginLaptop.length && typeof (marginLaptop) != 'undefined' ) {
					textInner.css( 'margin', marginLaptop );
				}
			}

			if ( fontSize.length && typeof ( fontSize ) != 'undefined' ) {
				textInner.css( 'font-size', fontSize );
			}

			if ( settings.bg_color.length && typeof ( settings.bg_color ) != 'undefined' ) {
				color = settings.bg_color;
				textInner.css( 'color', color );
			}

			if (settings.bg_z_index.length && typeof (settings.bg_z_index) != 'undefined' ) {
				zIndex = settings.bg_z_index;
				textInner.css( 'z-index', zIndex );
			}

				setTimeout(
					function () {
						var $rowBgWord = $( '.qodef-row-background-word' );
						if ( $rowBgWord.length ) {
							$rowBgWord.each(
								function () {
									var $thisBgText       = $( this ),
										thisBgTextContent = $thisBgText.text().trim(),
										thisBgTextArray   = thisBgTextContent.split( '' );
									$thisBgText.empty();

									thisBgTextArray.forEach(
										function (item, index) {
											if (item === " ") {
												$thisBgText.append( '<span class="qodef-bg-text-char qodef--empty-char">' + item + '</span>' )
											} else {
												$thisBgText.append( '<span class="qodef-bg-text-char">' + item + '</span>' )
											}
										}
									);
									$thisBgText.appear(
										function () {
											$thisBgText.addClass( 'qodef--appeared' );
										},
										{ accX: 0, accY: -300 }
									);
								}
							)
						}
					},
					300
				);
		}
	};

	qodefCore.rowBackgroundText = rowBackgroundText;

	var qodefPerfectScrollbar = {
		init: function ( $holder ) {
			if ( $holder.length ) {
				qodefPerfectScrollbar.qodefInitScroll( $holder );
			}
		},
		qodefInitScroll: function ( $holder ) {
			var $defaultParams = {
				wheelSpeed: 0.6,
				suppressScrollX: true
			};

			var $ps = new PerfectScrollbar(
				$holder[0],
				$defaultParams
			);

			$( window ).resize(
				function () {
					$ps.update();
				}
			);
		}
	};

	var qodefInlinePageStyle = {
		init: function () {
			this.holder = $( '#emaurri-core-page-inline-style' );

			if ( this.holder.length ) {
				var style = this.holder.data( 'style' );

				if ( style.length ) {
					$( 'head' ).append( '<style type="text/css">' + style + '</style>' );
				}
			}
		}
	};

})( jQuery );

(function ( $ ) {
	'use strict';

	$( document ).ready(
	    function () {
            qodefBackToTop.init();
        }
	);

	var qodefBackToTop = {
		init: function () {
			this.holder = $( '#qodef-back-to-top' );

			if ( this.holder.length ) {
				// Scroll To Top
				this.holder.on(
					'click',
					function ( e ) {
						e.preventDefault();
						qodefBackToTop.animateScrollToTop();
					}
				);

				qodefBackToTop.showHideBackToTop();
			}
		},
		animateScrollToTop: function () {
			var startPos = qodef.scroll,
				newPos   = qodef.scroll,
				step     = .9,
				animationFrameId;

			var startAnimation = function () {
				if ( newPos === 0 ) {
                    return;
                }

				newPos < 0.0001 ? newPos = 0 : null;

				var ease = qodefBackToTop.easingFunction( (startPos - newPos) / startPos );
				$( 'html, body' ).scrollTop( startPos - (startPos - newPos) * ease );
				newPos = newPos * step;

				animationFrameId = requestAnimationFrame( startAnimation );
			};
			startAnimation();
			$( window ).one(
				'wheel touchstart',
				function () {
					cancelAnimationFrame( animationFrameId );
				}
			);
		},
		easingFunction: function ( n ) {
			return 0 == n ? 0 : Math.pow( 1024, n - 1 );
		},
		showHideBackToTop: function () {
			$( window ).scroll( function () {
				var $thisItem = $( this ),
					b         = $thisItem.scrollTop(),
					c         = $thisItem.height(),
					d;

				if ( b > 0 ) {
					d = b + c / 2;
				} else {
					d = 1;
				}

				if ( d < 1e3 ) {
					qodefBackToTop.addClass( 'off' );
				} else {
					qodefBackToTop.addClass( 'on' );
				}
			} );
		},
		addClass: function ( a ) {
			this.holder.removeClass( 'qodef--off qodef--on' );

			if ( a === 'on' ) {
				this.holder.addClass( 'qodef--on' );
			} else {
				this.holder.addClass( 'qodef--off' );
			}
		}
	};

})( jQuery );

(function ( $ ) {
	'use strict';

	$( window ).on(
		'load',
		function () {
			qodefUncoverFooter.init();
		}
	);

	var qodefUncoverFooter = {
		holder: '',
		init: function () {
			this.holder = $( '#qodef-page-footer.qodef--uncover' );

			if ( this.holder.length && ! qodefCore.html.hasClass( 'touchevents' ) ) {
				qodefUncoverFooter.addClass();
				qodefUncoverFooter.setHeight( this.holder );

				$( window ).resize(
					function () {
						qodefUncoverFooter.setHeight( qodefUncoverFooter.holder );
					}
				);
			}
		},
		setHeight: function ( $holder ) {
			$holder.css( 'height', 'auto' );

			var footerHeight = $holder.outerHeight();

			if ( footerHeight > 0 ) {
				$( '#qodef-page-outer' ).css(
					{
						'margin-bottom': footerHeight,
						'background-color': qodefCore.body.css( 'backgroundColor' )
					}
				);

				$holder.css( 'height', footerHeight );
			}
		},
		addClass: function () {
			qodefCore.body.addClass( 'qodef-page-footer--uncover' );
		}
	};

})( jQuery );

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

(function ( $ ) {
	'use strict';

	$( document ).ready(
		function () {
			qodefHeaderScrollAppearance.init();
		}
	);

	var qodefHeaderScrollAppearance = {
		appearanceType: function () {
			return qodefCore.body.attr( 'class' ).indexOf( 'qodef-header-appearance--' ) !== -1 ? qodefCore.body.attr( 'class' ).match( /qodef-header-appearance--([\w]+)/ )[1] : '';
		},
		init: function () {
			var appearanceType = this.appearanceType();

			if ( appearanceType !== '' && appearanceType !== 'none' ) {
				qodefCore[appearanceType + 'HeaderAppearance']();
			}
		}
	};

})( jQuery );

(function ( $ ) {
	'use strict';

	$( document ).ready(
	    function () {
            qodefMobileHeaderAppearance.init();
        }
	);

	/*
	 **	Init mobile header functionality
	 */
	var qodefMobileHeaderAppearance = {
		init: function () {
			if ( qodefCore.body.hasClass( 'qodef-mobile-header-appearance--sticky' ) ) {

				var docYScroll1   = qodefCore.scroll,
					displayAmount = qodefGlobal.vars.mobileHeaderHeight + qodefGlobal.vars.adminBarHeight,
					$pageOuter    = $( '#qodef-page-outer' );

				qodefMobileHeaderAppearance.showHideMobileHeader( docYScroll1, displayAmount, $pageOuter );

				$( window ).scroll(
				    function () {
                        qodefMobileHeaderAppearance.showHideMobileHeader( docYScroll1, displayAmount, $pageOuter );
                        docYScroll1 = qodefCore.scroll;
                    }
				);

				$( window ).resize(
				    function () {
                        $pageOuter.css( 'padding-top', 0 );
                        qodefMobileHeaderAppearance.showHideMobileHeader( docYScroll1, displayAmount, $pageOuter );
                    }
				);
			}
		},
		showHideMobileHeader: function ( docYScroll1, displayAmount, $pageOuter ) {
			if ( qodefCore.windowWidth <= 1024 ) {
				if ( qodefCore.scroll > displayAmount * 2 ) {
					//set header to be fixed
					qodefCore.body.addClass( 'qodef-mobile-header--sticky' );

					//add transition to it
					setTimeout(
						function () {
							qodefCore.body.addClass( 'qodef-mobile-header--sticky-animation' );
						},
						300
					); //300 is duration of sticky header animation

					//add padding to content so there is no 'jumping'
					$pageOuter.css( 'padding-top', qodefGlobal.vars.mobileHeaderHeight );
				} else {
					//unset fixed header
					qodefCore.body.removeClass( 'qodef-mobile-header--sticky' );

					//remove transition
					setTimeout(
						function () {
							qodefCore.body.removeClass( 'qodef-mobile-header--sticky-animation' );
						},
						300
					); //300 is duration of sticky header animation

					//remove padding from content since header is not fixed anymore
					$pageOuter.css( 'padding-top', 0 );
				}

				if ( (qodefCore.scroll > docYScroll1 && qodefCore.scroll > displayAmount) || (qodefCore.scroll < displayAmount * 3) ) {
					//show sticky header
					qodefCore.body.removeClass( 'qodef-mobile-header--sticky-display' );
				} else {
					//hide sticky header
					qodefCore.body.addClass( 'qodef-mobile-header--sticky-display' );
				}
			}
		}
	};

})( jQuery );

(function ( $ ) {
	'use strict';

	$( document ).ready(
		function () {
			qodefNavMenu.init();
		}
	);

	var qodefNavMenu = {
		init: function () {
			qodefNavMenu.dropdownBehavior();
			qodefNavMenu.wideDropdownPosition();
			qodefNavMenu.dropdownPosition();
		},
		dropdownBehavior: function () {
			var $menuItems = $( '.qodef-header-navigation > ul > li' );

			$menuItems.each(
				function () {
					var $thisItem = $( this );

					if ( $thisItem.find( '.qodef-drop-down-second' ).length ) {
						$thisItem.waitForImages(
							function () {
								var $dropdownHolder      = $thisItem.find( '.qodef-drop-down-second' ),
									$dropdownMenuItem    = $dropdownHolder.find( '.qodef-drop-down-second-inner ul' ),
									dropDownHolderHeight = $dropdownMenuItem.outerHeight();

								if ( navigator.userAgent.match( /(iPod|iPhone|iPad)/ ) ) {
									$thisItem.on(
										'touchstart mouseenter',
										function () {
											$dropdownHolder.css(
												{
													'height': dropDownHolderHeight,
													'overflow': 'visible',
													'visibility': 'visible',
													'opacity': '1',
												}
											);
										}
									).on(
										'mouseleave',
										function () {
											$dropdownHolder.css(
												{
													'height': '0px',
													'overflow': 'hidden',
													'visibility': 'hidden',
													'opacity': '0',
												}
											);
										}
									);
								} else {
									if ( qodefCore.body.hasClass( 'qodef-drop-down-second--animate-height' ) ) {
										var animateConfig = {
											interval: 0,
											over: function () {
												setTimeout(
													function () {
														$dropdownHolder.addClass( 'qodef-drop-down--start' ).css(
															{
																'visibility': 'visible',
																'height': '0',
																'opacity': '1',
															}
														);
														$dropdownHolder.stop().animate(
															{
																'height': dropDownHolderHeight,
															},
															400,
															'easeInOutQuint',
															function () {
																$dropdownHolder.css( 'overflow', 'visible' );
															}
														);
													},
													100
												);
											},
											timeout: 100,
											out: function () {
												$dropdownHolder.stop().animate(
													{
														'height': '0',
														'opacity': 0,
													},
													100,
													function () {
														$dropdownHolder.css(
															{
																'overflow': 'hidden',
																'visibility': 'hidden',
															}
														);
													}
												);

												$dropdownHolder.removeClass( 'qodef-drop-down--start' );
											}
										};

										$thisItem.hoverIntent( animateConfig );
									} else {
										var config = {
											interval: 0,
											over: function () {
												setTimeout(
													function () {
														$dropdownHolder.addClass( 'qodef-drop-down--start' ).stop().css( { 'height': dropDownHolderHeight } );
													},
													150
												);
											},
											timeout: 150,
											out: function () {
												$dropdownHolder.stop().css( { 'height': '0' } ).removeClass( 'qodef-drop-down--start' );
											}
										};

										$thisItem.hoverIntent( config );
									}
								}
							}
						);
					}
				}
			);
		},
		wideDropdownPosition: function () {
			var $menuItems = $( '.qodef-header-navigation > ul > li.qodef-menu-item--wide' );

			if ( $menuItems.length ) {
				$menuItems.each(
					function () {
						var $menuItem        = $( this );
						var $menuItemSubMenu = $menuItem.find( '.qodef-drop-down-second' );

						if ( $menuItemSubMenu.length ) {
							$menuItemSubMenu.css( 'left', 0 );

							var leftPosition = $menuItemSubMenu.offset().left;

							if ( qodefCore.body.hasClass( 'qodef--boxed' ) ) {
								//boxed layout case
								var boxedWidth = $( '.qodef--boxed #qodef-page-wrapper' ).outerWidth();
								leftPosition   = leftPosition - (qodefCore.windowWidth - boxedWidth) / 2;
								$menuItemSubMenu.css( { 'left': -leftPosition, 'width': boxedWidth } );

							} else if ( qodefCore.body.hasClass( 'qodef-drop-down-second--full-width' ) ) {
								//wide dropdown full width case
								$menuItemSubMenu.css( { 'left': -leftPosition } );
							} else {
								//wide dropdown in grid case
								$menuItemSubMenu.css( { 'left': -leftPosition + (qodefCore.windowWidth - $menuItemSubMenu.width()) / 2 } );
							}
						}
					}
				);
			}
		},
		dropdownPosition: function () {
			var $menuItems = $( '.qodef-header-navigation > ul > li.qodef-menu-item--narrow.menu-item-has-children' );

			if ( $menuItems.length ) {
				$menuItems.each(
					function () {
						var $thisItem         = $( this ),
							menuItemPosition  = $thisItem.offset().left,
							$dropdownHolder   = $thisItem.find( '.qodef-drop-down-second' ),
							$dropdownMenuItem = $dropdownHolder.find( '.qodef-drop-down-second-inner ul' ),
							dropdownMenuWidth = $dropdownMenuItem.outerWidth(),
							menuItemFromLeft  = $( window ).width() - menuItemPosition;

						if ( qodef.body.hasClass( 'qodef--boxed' ) ) {
							//boxed layout case
							var boxedWidth   = $( '.qodef--boxed #qodef-page-wrapper' ).outerWidth();
							menuItemFromLeft = boxedWidth - menuItemPosition;
						}

						var dropDownMenuFromLeft;

						if ( $thisItem.find( 'li.menu-item-has-children' ).length > 0 ) {
							dropDownMenuFromLeft = menuItemFromLeft - dropdownMenuWidth;
						}

						$dropdownHolder.removeClass( 'qodef-drop-down--right' );
						$dropdownMenuItem.removeClass( 'qodef-drop-down--right' );
						if ( menuItemFromLeft < dropdownMenuWidth || dropDownMenuFromLeft < dropdownMenuWidth ) {
							$dropdownHolder.addClass( 'qodef-drop-down--right' );
							$dropdownMenuItem.addClass( 'qodef-drop-down--right' );
						}
					}
				);
			}
		}
	};

})( jQuery );

(function ( $ ) {
	'use strict';

	$( window ).on(
		'load',
		function () {
			qodefParallaxBackground.init();
		}
	);

	/**
	 * Init global parallax background functionality
	 */
	var qodefParallaxBackground = {
		init: function ( settings ) {
			this.$sections = $( '.qodef-parallax' );

			// Allow overriding the default config
			$.extend( this.$sections, settings );

			var isSupported = ! qodefCore.html.hasClass( 'touchevents' ) && ! qodefCore.body.hasClass( 'qodef-browser--edge' ) && ! qodefCore.body.hasClass( 'qodef-browser--ms-explorer' );

			if ( this.$sections.length && isSupported ) {
				this.$sections.each(
					function () {
						qodefParallaxBackground.ready( $( this ) );
					}
				);
			}
		},
		ready: function ( $section ) {
			$section.$imgHolder  = $section.find( '.qodef-parallax-img-holder' );
			$section.$imgWrapper = $section.find( '.qodef-parallax-img-wrapper' );
			$section.$img        = $section.find( 'img.qodef-parallax-img' );

			var h           = $section.height(),
				imgWrapperH = $section.$imgWrapper.height();

			$section.movement = 100 * (imgWrapperH - h) / h / 2; //percentage (divided by 2 due to absolute img centering in CSS)

			$section.buffer       = window.pageYOffset;
			$section.scrollBuffer = null;


			//calc and init loop
			requestAnimationFrame(
				function () {
					$section.$imgHolder.animate( { opacity: 1 }, 100 );
					qodefParallaxBackground.calc( $section );
					qodefParallaxBackground.loop( $section );
				}
			);

			//recalc
			$( window ).on(
				'resize',
				function () {
					qodefParallaxBackground.calc( $section );
				}
			);
		},
		calc: function ( $section ) {
			var wH = $section.$imgWrapper.height(),
				wW = $section.$imgWrapper.width();

			if ( $section.$img.width() < wW ) {
				$section.$img.css(
					{
						'width': '100%',
						'height': 'auto',
					}
				);
			}

			if ( $section.$img.height() < wH ) {
				$section.$img.css(
					{
						'height': '100%',
						'width': 'auto',
						'max-width': 'unset',
					}
				);
			}
		},
		loop: function ( $section ) {
			if ( $section.scrollBuffer === Math.round( window.pageYOffset ) ) {
				requestAnimationFrame(
					function () {
						qodefParallaxBackground.loop( $section );
					}
				); //repeat loop

				return false; //same scroll value, do nothing
			} else {
				$section.scrollBuffer = Math.round( window.pageYOffset );
			}

			var wH   = window.outerHeight,
				sTop = $section.offset().top,
				sH   = $section.height();

			if ( $section.scrollBuffer + wH * 1.2 > sTop && $section.scrollBuffer < sTop + sH ) {
				var delta = (Math.abs( $section.scrollBuffer + wH - sTop ) / (wH + sH)).toFixed( 4 ), //coeff between 0 and 1 based on scroll amount
					yVal  = (delta * $section.movement).toFixed( 4 );

				if ( $section.buffer !== delta ) {
					$section.$imgWrapper.css( 'transform', 'translate3d(0,' + yVal + '%, 0)' );
				}

				$section.buffer = delta;
			}

			requestAnimationFrame(
				function () {
					qodefParallaxBackground.loop( $section );
				}
			); //repeat loop
		}
	};

	qodefCore.qodefParallaxBackground = qodefParallaxBackground;

})( jQuery );

(function ( $ ) {
	'use strict';

	$( document ).ready(
		function () {
			qodefSideArea.init();
		}
	);

	var qodefSideArea = {
		init: function () {
			var $sideAreaOpener = $( 'a.qodef-side-area-opener' ),
				$sideAreaClose  = $( '#qodef-side-area-close' ),
				$sideArea       = $( '#qodef-side-area' );

			qodefSideArea.openerHoverColor( $sideAreaOpener );

			// Open Side Area
			$sideAreaOpener.on(
				'click',
				function ( e ) {
					e.preventDefault();

					if ( ! qodefCore.body.hasClass( 'qodef-side-area--opened' ) ) {
						qodefSideArea.openSideArea();

						$( document ).keyup(
							function ( e ) {
								if ( e.keyCode === 27 ) {
									qodefSideArea.closeSideArea();
								}
							}
						);
					} else {
						qodefSideArea.closeSideArea();
					}
				}
			);

			$sideAreaClose.on(
				'click',
				function ( e ) {
					e.preventDefault();
					qodefSideArea.closeSideArea();
				}
			);

			if ( $sideArea.length && typeof qodefCore.qodefPerfectScrollbar === 'object' ) {
				qodefCore.qodefPerfectScrollbar.init( $sideArea );
			}
		},
		openSideArea: function () {
			var $wrapper      = $( '#qodef-page-wrapper' );
			var currentScroll = $( window ).scrollTop();

			$( '.qodef-side-area-cover' ).remove();
			$wrapper.prepend( '<div class="qodef-side-area-cover"/>' );
			qodefCore.body.removeClass( 'qodef-side-area-animate--out' ).addClass( 'qodef-side-area--opened qodef-side-area-animate--in' );

			$( '.qodef-side-area-cover' ).on(
				'click',
				function ( e ) {
					e.preventDefault();
					qodefSideArea.closeSideArea();
				}
			);

			$( window ).scroll(
				function () {
					if ( Math.abs( qodefCore.scroll - currentScroll ) > 400 ) {
						qodefSideArea.closeSideArea();
					}
				}
			);
		},
		closeSideArea: function () {
			qodefCore.body.removeClass( 'qodef-side-area--opened qodef-side-area-animate--in' ).addClass( 'qodef-side-area-animate--out' );
		},
		openerHoverColor: function ( $opener ) {
			if ( typeof $opener.data( 'hover-color' ) !== 'undefined' ) {
				var hoverColor    = $opener.data( 'hover-color' );
				var originalColor = $opener.css( 'color' );

				$opener.on(
					'mouseenter',
					function () {
						$opener.css( 'color', hoverColor );
					}
				).on(
					'mouseleave',
					function () {
						$opener.css( 'color', originalColor );
					}
				);
			}
		}
	};

})( jQuery );

(function ( $ ) {
	'use strict';

	$( document ).ready(
		function () {
			qodefSpinner.init();
		}
	);

	$( window ).on(
		'elementor/frontend/init',
		function () {
			var isEditMode = Boolean( elementorFrontend.isEditMode() );

			if ( isEditMode ) {
				qodefSpinner.init( isEditMode );
			}
		}
	);

	var qodefSpinner = {
		init: function ( isEditMode ) {
			this.holder = $( '#qodef-page-spinner:not(.qodef-layout--emaurri)' );

			if ( this.holder.length ) {
				qodefSpinner.animateSpinner( this.holder, isEditMode );
				qodefSpinner.fadeOutAnimation();
			}
		},
		animateSpinner: function ( $holder, isEditMode ) {
			$( window ).on(
				'load',
				function () {
					qodefSpinner.fadeOutLoader( $holder );
				}
			);

			if ( isEditMode ) {
				qodefSpinner.fadeOutLoader( $holder );
			}
		},
		fadeOutLoader: function ( $holder, speed, delay, easing ) {
			speed = speed ? speed : 600;
			delay = delay ? delay : 0;
			easing = easing ? easing : 'swing';

			$holder.delay( delay ).fadeOut( speed, easing );

			$( window ).on(
				'bind',
				'pageshow',
				function ( event ) {
					if ( event.originalEvent.persisted ) {
						$holder.fadeOut( speed, easing );
					}
				}
			);
		},
		fadeOutAnimation: function () {

			// Check for fade out animation
			if ( qodefCore.body.hasClass( 'qodef-spinner--fade-out' ) ) {
				var $pageHolder = $( '#qodef-page-wrapper' ),
					$linkItems  = $( 'a' );

				// If back button is pressed, than show content to avoid state where content is on display:none
				window.addEventListener(
					'pageshow',
					function ( event ) {
						var historyPath = event.persisted || (typeof window.performance !== 'undefined' && window.performance.navigation.type === 2);
						if ( historyPath && ! $pageHolder.is( ':visible' ) ) {
							$pageHolder.show();
						}
					}
				);

				$linkItems.on(
					'click',
					function ( e ) {
						var $clickedLink = $( this );

						if (
							e.which === 1 && // check if the left mouse button has been pressed
							$clickedLink.attr( 'href' ).indexOf( window.location.host ) >= 0 && // check if the link is to the same domain
							! $clickedLink.hasClass( 'remove' ) && // check is WooCommerce remove link
							$clickedLink.parent( '.product-remove' ).length <= 0 && // check is WooCommerce remove link
							$clickedLink.parents( '.woocommerce-product-gallery__image' ).length <= 0 && // check is product gallery link
							typeof $clickedLink.data( 'rel' ) === 'undefined' && // check pretty photo link
							typeof $clickedLink.attr( 'rel' ) === 'undefined' && // check VC pretty photo link
							! $clickedLink.hasClass( 'lightbox-active' ) && // check is lightbox plugin active
							(typeof $clickedLink.attr( 'target' ) === 'undefined' || $clickedLink.attr( 'target' ) === '_self') && // check if the link opens in the same window
							$clickedLink.attr( 'href' ).split( '#' )[0] !== window.location.href.split( '#' )[0] // check if it is an anchor aiming for a different page
						) {
							e.preventDefault();

							$pageHolder.fadeOut(
								600,
								'easeOutSine',
								function () {
									window.location = $clickedLink.attr( 'href' );
								}
							);
						}
					}
				);
			}
		}
	};

})( jQuery );

(function ( $ ) {
	'use strict';

	qodefCore.shortcodes.emaurri_core_accordion = {};

	$( document ).ready(
		function () {
			qodefAccordion.init();
		}
	);

	var qodefAccordion = {
		init: function () {
			this.holder = $( '.qodef-accordion' );

			if ( this.holder.length ) {
				this.holder.each(
					function () {
						var $thisHolder = $( this );

						if ( $thisHolder.hasClass( 'qodef-behavior--accordion' ) ) {
							qodefAccordion.initAccordion( $thisHolder );
						}

						if ( $thisHolder.hasClass( 'qodef-behavior--toggle' ) ) {
							qodefAccordion.initToggle( $thisHolder );
						}

						$thisHolder.addClass( 'qodef--init' );
					}
				);
			}
		},
		initAccordion: function ( $accordion ) {
			$accordion.accordion(
				{
					animate: 'swing',
					collapsible: true,
					active: 0,
					icons: '',
					heightStyle: 'content',
				}
			);
		},
		initToggle: function ( $toggle ) {
			var $toggleAccordionTitle   = $toggle.find( '.qodef-accordion-title' ),
				$toggleAccordionContent = $toggleAccordionTitle.next();

			$toggle.addClass( 'accordion ui-accordion ui-accordion-icons ui-widget ui-helper-reset' );
			$toggleAccordionTitle.addClass( 'ui-accordion-header ui-state-default ui-corner-top ui-corner-bottom' );
			$toggleAccordionContent.addClass( 'ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom' ).hide();

			$toggleAccordionTitle.each(
				function () {
					var $thisTitle = $( this );

					$thisTitle.hover(
						function () {
							$thisTitle.toggleClass( 'ui-state-hover' );
						}
					);

					$thisTitle.on(
						'click',
						function () {
							$thisTitle.toggleClass( 'ui-accordion-header-active ui-state-active ui-state-default ui-corner-bottom' );
							$thisTitle.next().toggleClass( 'ui-accordion-content-active' ).slideToggle( 400 );
						}
					);
				}
			);
		}
	};

	qodefCore.shortcodes.emaurri_core_accordion.qodefAccordion = qodefAccordion;

})( jQuery );

(function ( $ ) {
	'use strict';

	qodefCore.shortcodes.emaurri_core_button = {};

	$( document ).ready(
		function () {
			qodefButton.init();
		}
	);

	var qodefButton = {
		init: function () {
			this.buttons = $( '.qodef-button' );

			if ( this.buttons.length ) {
				this.buttons.each(
					function () {
						var $thisButton = $( this );

						qodefButton.buttonHoverColor( $thisButton );
						qodefButton.buttonHoverBgColor( $thisButton );
						qodefButton.buttonHoverBorderColor( $thisButton );
						qodefButton.buttonHoverCornerColor( $thisButton );
					}
				);
			}
		},
		buttonHoverColor: function ( $button ) {
			if ( typeof $button.data( 'hover-color' ) !== 'undefined' ) {
				var hoverColor    = $button.data( 'hover-color' );
				var originalColor = $button.css( 'color' );

				$button.on(
					'mouseenter touchstart',
					function () {
						qodefButton.changeColor( $button, 'color', hoverColor );
					}
				);
				$button.on(
					'mouseleave touchend',
					function () {
						qodefButton.changeColor( $button, 'color', originalColor );
					}
				);
			}
		},
		buttonHoverBgColor: function ( $button ) {
			if ( typeof $button.data( 'hover-background-color' ) !== 'undefined' ) {
				var hoverBackgroundColor    = $button.data( 'hover-background-color' );
				var originalBackgroundColor = $button.css( 'background-color' );

				$button.on(
					'mouseenter touchstart',
					function () {
						qodefButton.changeColor( $button, 'background-color', hoverBackgroundColor );
					}
				);
				$button.on(
					'mouseleave touchend',
					function () {
						qodefButton.changeColor( $button, 'background-color', originalBackgroundColor );
					}
				);
			}
		},
		buttonHoverBorderColor: function ( $button ) {
			if ( typeof $button.data( 'hover-border-color' ) !== 'undefined' ) {
				var hoverBorderColor    = $button.data( 'hover-border-color' );
				var originalBorderColor = $button.css( 'borderTopColor' );

				$button.on(
					'mouseenter touchstart',
					function () {
						qodefButton.changeColor( $button, 'border-color', hoverBorderColor );
					}
				);
				$button.on(
					'mouseleave touchend',
					function () {
						qodefButton.changeColor( $button, 'border-color', originalBorderColor );
					}
				);
			}
		},
		buttonHoverCornerColor: function ( $button ) {
			if ( typeof $button.data( 'hover-corner-color' ) !== 'undefined' ) {
				var $corner             = $button.find('.qodef-m-corner');
				var hoverCornerColor    = $button.data( 'hover-corner-color' );
				var originalCornerColor = $corner.css( 'color' );

				$button.on(
					'mouseenter touchstart',
					function () {
						qodefButton.changeColor( $corner, 'color', hoverCornerColor );
					}
				);
				$button.on(
					'mouseleave touchend',
					function () {
						qodefButton.changeColor( $corner, 'color', originalCornerColor );
					}
				);
			}
		},
		changeColor: function ( $button, cssProperty, color ) {
			$button.css( cssProperty, color );
		}
	};

	qodefCore.shortcodes.emaurri_core_button.qodefButton = qodefButton;

})( jQuery );

(function ( $ ) {
	'use strict';

	qodefCore.shortcodes.emaurri_core_countdown = {};

	$( document ).ready(
		function () {
			qodefCountdown.init();
		}
	);

	var qodefCountdown = {
		init: function () {
			this.countdowns = $( '.qodef-countdown' );

			if ( this.countdowns.length ) {
				this.countdowns.each(
					function () {
						var $thisCountdown    = $( this ),
							$countdownElement = $thisCountdown.find( '.qodef-m-date' ),
							options           = qodefCountdown.generateOptions( $thisCountdown );

						qodefCountdown.initCountdown( $countdownElement, options );
					}
				);
			}
		},
		generateOptions: function ( $countdown ) {
			var options  = {};
			options.date = typeof $countdown.data( 'date' ) !== 'undefined' ? $countdown.data( 'date' ) : null;

			options.weekLabel       = typeof $countdown.data( 'week-label' ) !== 'undefined' ? $countdown.data( 'week-label' ) : '';
			options.weekLabelPlural = typeof $countdown.data( 'week-label-plural' ) !== 'undefined' ? $countdown.data( 'week-label-plural' ) : '';

			options.dayLabel       = typeof $countdown.data( 'day-label' ) !== 'undefined' ? $countdown.data( 'day-label' ) : '';
			options.dayLabelPlural = typeof $countdown.data( 'day-label-plural' ) !== 'undefined' ? $countdown.data( 'day-label-plural' ) : '';

			options.hourLabel       = typeof $countdown.data( 'hour-label' ) !== 'undefined' ? $countdown.data( 'hour-label' ) : '';
			options.hourLabelPlural = typeof $countdown.data( 'hour-label-plural' ) !== 'undefined' ? $countdown.data( 'hour-label-plural' ) : '';

			options.minuteLabel       = typeof $countdown.data( 'minute-label' ) !== 'undefined' ? $countdown.data( 'minute-label' ) : '';
			options.minuteLabelPlural = typeof $countdown.data( 'minute-label-plural' ) !== 'undefined' ? $countdown.data( 'minute-label-plural' ) : '';

			options.secondLabel       = typeof $countdown.data( 'second-label' ) !== 'undefined' ? $countdown.data( 'second-label' ) : '';
			options.secondLabelPlural = typeof $countdown.data( 'second-label-plural' ) !== 'undefined' ? $countdown.data( 'second-label-plural' ) : '';

			return options;
		},
		initCountdown: function ( $countdownElement, options ) {
			var $weekHTML   = '<span class="qodef-digit-wrapper"><span class="qodef-digit">%w</span><span class="qodef-label">' + '%!w:' + options.weekLabel + ',' + options.weekLabelPlural + ';</span></span>';
			var $dayHTML    = '<span class="qodef-digit-wrapper"><span class="qodef-digit">%d</span><span class="qodef-label">' + '%!d:' + options.dayLabel + ',' + options.dayLabelPlural + ';</span></span>';
			var $hourHTML   = '<span class="qodef-digit-wrapper"><span class="qodef-digit">%H</span><span class="qodef-label">' + '%!H:' + options.hourLabel + ',' + options.hourLabelPlural + ';</span></span>';
			var $minuteHTML = '<span class="qodef-digit-wrapper"><span class="qodef-digit">%M</span><span class="qodef-label">' + '%!M:' + options.minuteLabel + ',' + options.minuteLabelPlural + ';</span></span>';
			var $secondHTML = '<span class="qodef-digit-wrapper"><span class="qodef-digit">%S</span><span class="qodef-label">' + '%!S:' + options.secondLabel + ',' + options.secondLabelPlural + ';</span></span>';

			$countdownElement.countdown(
				options.date,
				function ( event ) {
					$( this ).html( event.strftime( $weekHTML + $dayHTML + $hourHTML + $minuteHTML + $secondHTML ) );
				}
			);
		}
	};

	qodefCore.shortcodes.emaurri_core_countdown.qodefCountdown = qodefCountdown;

})( jQuery );

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

(function ( $ ) {
	'use strict';

	qodefCore.shortcodes.emaurri_core_google_map = {};

	$( document ).ready(
		function () {
			qodefGoogleMap.init();
		}
	);

	var qodefGoogleMap = {
		init: function () {
			this.holder = $( '.qodef-google-map' );

			if ( this.holder.length ) {
				this.holder.each(
					function () {
						if ( typeof window.qodefGoogleMap !== 'undefined' ) {
							window.qodefGoogleMap.init( $( this ).find( '.qodef-m-map' ) );
						}
					}
				);
			}
		}
	};

	qodefCore.shortcodes.emaurri_core_google_map.qodefGoogleMap = qodefGoogleMap;

})( jQuery );

(function ( $ ) {
	'use strict';

	qodefCore.shortcodes.emaurri_core_icon = {};

	$( document ).ready(
		function () {
			qodefIcon.init();
		}
	);

	var qodefIcon = {
		init: function () {
			this.icons = $( '.qodef-icon-holder' );

			if ( this.icons.length ) {
				this.icons.each(
					function () {
						var $thisIcon = $( this );

						qodefIcon.iconHoverColor( $thisIcon );
						qodefIcon.iconHoverBgColor( $thisIcon );
						qodefIcon.iconHoverBorderColor( $thisIcon );
					}
				);
			}
		},
		iconHoverColor: function ( $iconHolder ) {
			if ( typeof $iconHolder.data( 'hover-color' ) !== 'undefined' ) {
				var spanHolder    = $iconHolder.find( 'span' );
				var originalColor = spanHolder.css( 'color' );
				var hoverColor    = $iconHolder.data( 'hover-color' );

				$iconHolder.on(
					'mouseenter',
					function () {
						qodefIcon.changeColor(
							spanHolder,
							'color',
							hoverColor
						);
					}
				);
				$iconHolder.on(
					'mouseleave',
					function () {
						qodefIcon.changeColor(
							spanHolder,
							'color',
							originalColor
						);
					}
				);
			}
		},
		iconHoverBgColor: function ( $iconHolder ) {
			if ( typeof $iconHolder.data( 'hover-background-color' ) !== 'undefined' ) {
				var hoverBackgroundColor    = $iconHolder.data( 'hover-background-color' );
				var originalBackgroundColor = $iconHolder.css( 'background-color' );

				$iconHolder.on(
					'mouseenter',
					function () {
						qodefIcon.changeColor(
							$iconHolder,
							'background-color',
							hoverBackgroundColor
						);
					}
				);
				$iconHolder.on(
					'mouseleave',
					function () {
						qodefIcon.changeColor(
							$iconHolder,
							'background-color',
							originalBackgroundColor
						);
					}
				);
			}
		},
		iconHoverBorderColor: function ( $iconHolder ) {
			if ( typeof $iconHolder.data( 'hover-border-color' ) !== 'undefined' ) {
				var hoverBorderColor    = $iconHolder.data( 'hover-border-color' );
				var originalBorderColor = $iconHolder.css( 'borderTopColor' );

				$iconHolder.on(
					'mouseenter',
					function () {
						qodefIcon.changeColor(
							$iconHolder,
							'border-color',
							hoverBorderColor
						);
					}
				);
				$iconHolder.on(
					'mouseleave',
					function () {
						qodefIcon.changeColor(
							$iconHolder,
							'border-color',
							originalBorderColor
						);
					}
				);
			}
		},
		changeColor: function ( iconElement, cssProperty, color ) {
			iconElement.css(
				cssProperty,
				color
			);
		}
	};

	qodefCore.shortcodes.emaurri_core_icon.qodefIcon = qodefIcon;

})( jQuery );

(function ( $ ) {
	'use strict';

	qodefCore.shortcodes.emaurri_core_image_gallery                    = {};
	qodefCore.shortcodes.emaurri_core_image_gallery.qodefSwiper        = qodef.qodefSwiper;
	qodefCore.shortcodes.emaurri_core_image_gallery.qodefMasonryLayout = qodef.qodefMasonryLayout;

})( jQuery );

(function ( $ ) {
	'use strict';

	qodefCore.shortcodes.emaurri_core_image_with_text                    = {};
	qodefCore.shortcodes.emaurri_core_image_with_text.qodefMagnificPopup = qodef.qodefMagnificPopup;

})( jQuery );

(function ( $ ) {
	'use strict';

	qodefCore.shortcodes.emaurri_core_progress_bar = {};

	$( document ).ready(
		function () {
			qodefProgressBar.init();
		}
	);

	/**
	 * Init progress bar shortcode functionality
	 */
	var qodefProgressBar = {
		init: function () {
			this.holder = $( '.qodef-progress-bar' );

			if ( this.holder.length ) {
				this.holder.each(
					function () {
						var $thisHolder = $( this ),
							layout      = $thisHolder.data( 'layout' );

						$thisHolder.appear(
							function () {
								$thisHolder.addClass( 'qodef--init' );

								var $container = $thisHolder.find( '.qodef-m-canvas' ),
									data       = qodefProgressBar.generateBarData( $thisHolder, layout ),
									number     = $thisHolder.data( 'number' ) / 100;

								switch (layout) {
									case 'circle':
										qodefProgressBar.initCircleBar( $container, data, number );
										break;
									case 'semi-circle':
										qodefProgressBar.initSemiCircleBar( $container, data, number );
										break;
									case 'line':
										data = qodefProgressBar.generateLineData( $thisHolder, number );
										qodefProgressBar.initLineBar( $container, data );
										break;
									case 'custom':
										qodefProgressBar.initCustomBar( $container, data, number );
										break;
								}
							}
						);
					}
				);
			}
		},
		generateBarData: function ( thisBar, layout ) {
			var activeWidth   = thisBar.data( 'active-line-width' );
			var activeColor   = thisBar.data( 'active-line-color' );
			var inactiveWidth = thisBar.data( 'inactive-line-width' );
			var inactiveColor = thisBar.data( 'inactive-line-color' );
			var easing        = 'linear';
			var duration      = typeof thisBar.data( 'duration' ) !== 'undefined' && thisBar.data( 'duration' ) !== '' ? parseInt( thisBar.data( 'duration' ), 10 ) : 1600;
			var textColor     = thisBar.data( 'text-color' );

			return {
				strokeWidth: activeWidth,
				color: activeColor,
				trailWidth: inactiveWidth,
				trailColor: inactiveColor,
				easing: easing,
				duration: duration,
				svgStyle: {
					width: '100%',
					height: '100%'
				},
				text: {
					style: {
						color: textColor
					},
					autoStyleContainer: false
				},
				from: {
					color: inactiveColor
				},
				to: {
					color: activeColor
				},
				step: function ( state, bar ) {
					if ( layout !== 'custom' ) {
						bar.setText( Math.round( bar.value() * 100 ) + '%' );
					}
				},
			};
		},
		generateLineData: function ( thisBar, number ) {
			var height         = thisBar.data( 'active-line-width' );
			var activeColor    = thisBar.data( 'active-line-color' );
			var inactiveHeight = thisBar.data( 'inactive-line-width' );
			var inactiveColor  = thisBar.data( 'inactive-line-color' );
			var duration       = typeof thisBar.data( 'duration' ) !== 'undefined' && thisBar.data( 'duration' ) !== '' ? parseInt( thisBar.data( 'duration' ), 10 ) : 1600;
			var textColor      = thisBar.data( 'text-color' );

			return {
				percentage: number * 100,
				duration: duration,
				fillBackgroundColor: activeColor,
				backgroundColor: inactiveColor,
				height: height,
				inactiveHeight: inactiveHeight,
				followText: thisBar.hasClass( 'qodef-percentage--floating' ),
				textColor: textColor,
			};
		},
		initCircleBar: function ( $container, data, number ) {
			if ( qodefProgressBar.checkBar( $container ) ) {
				var $bar = new ProgressBar.Circle( $container[0], data );

				$bar.animate( number );
			}
		},
		initSemiCircleBar: function ( $container, data, number ) {
			if ( qodefProgressBar.checkBar( $container ) ) {
				var $bar = new ProgressBar.SemiCircle( $container[0], data );

				$bar.animate( number );
			}
		},
		initCustomBar: function ( $container, data, number ) {
			if ( qodefProgressBar.checkBar( $container ) ) {
				var $bar = new ProgressBar.Path( $container[0], data );

				$bar.set( 0 );
				$bar.animate( number );
			}
		},
		initLineBar: function ( $container, data ) {
			$container.LineProgressbar( data );
		},
		checkBar: function ( $container ) {
			// check if svg is already in container, elementor fix
			if ( $container.find( 'svg' ).length ) {
				return false;
			}

			return true;
		}
	};

	qodefCore.shortcodes.emaurri_core_progress_bar.qodefProgressBar = qodefProgressBar;

})( jQuery );

(function ( $ ) {
	'use strict';

	qodefCore.shortcodes.emaurri_core_swapping_image_gallery = {};

	$( document ).ready(
		function () {
			qodefSwappingImageGallery.init();
		}
	);

	var qodefSwappingImageGallery = {
		init: function () {
			this.holder = $( '.qodef-swapping-image-gallery' );

			if ( this.holder.length ) {
				this.holder.each(
					function () {
						var $thisHolder = $( this );
						qodefSwappingImageGallery.createSlider( $thisHolder );
					}
				);
			}
		},
		createSlider: function ( $holder ) {
			var $swiperHolder     = $holder.find( '.qodef-m-image-holder' );
			var $paginationHolder = $holder.find( '.qodef-m-thumbnails-holder .qodef-grid-inner' );
			var spaceBetween      = 0;
			var slidesPerView     = 1;
			var centeredSlides    = false;
			var loop              = false;
			var autoplay          = false;
			var speed             = 800;

			var $swiper = new Swiper(
				$swiperHolder,
				{
					slidesPerView: slidesPerView,
					centeredSlides: centeredSlides,
					spaceBetween: spaceBetween,
					autoplay: autoplay,
					loop: loop,
					speed: speed,
					pagination: {
						el: $paginationHolder,
						type: 'custom',
						clickable: true,
						bulletClass: 'qodef-m-thumbnail',
					},
					on: {
						init: function () {
							$swiperHolder.addClass( 'qodef-swiper--initialized' );
							$paginationHolder.find( '.qodef-m-thumbnail' ).eq( 0 ).addClass( 'qodef--active' );
						},
						slideChange: function slideChange() {
							var swiper      = this;
							var activeIndex = swiper.activeIndex;
							$paginationHolder.find( '.qodef--active' ).removeClass( 'qodef--active' );
							$paginationHolder.find( '.qodef-m-thumbnail' ).eq( activeIndex ).addClass( 'qodef--active' );
						}
					},
				}
			);
		}
	};

	qodefCore.shortcodes.emaurri_core_swapping_image_gallery.qodefSwappingImageGallery = qodefSwappingImageGallery;

})( jQuery );

(function ( $ ) {
	'use strict';

	qodefCore.shortcodes.emaurri_core_tabs = {};

	$( document ).ready(
		function () {
			qodefTabs.init();
		}
	);

	var qodefTabs = {
		init: function () {
			this.holder = $( '.qodef-tabs' );

			if ( this.holder.length ) {
				this.holder.each(
					function () {
						qodefTabs.initTabs( $( this ) );
					}
				);
			}
		},
		initTabs: function ( $tabs ) {
			$tabs.children( '.qodef-tabs-content' ).each(
				function ( index ) {
					index = index + 1;

					var $that    = $( this ),
						link     = $that.attr( 'id' ),
						$navItem = $that.parent().find( '.qodef-tabs-navigation li:nth-child(' + index + ') a' ),
						navLink  = $navItem.attr( 'href' );

					link = '#' + link;

					if ( link.indexOf( navLink ) > -1 ) {
						$navItem.attr(
							'href',
							link
						);
					}
				}
			);

			$tabs.addClass( 'qodef--init' ).tabs();
		}
	};

	qodefCore.shortcodes.emaurri_core_tabs.qodefTabs = qodefTabs;

})( jQuery );

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
(function ( $ ) {
	'use strict';

	qodefCore.shortcodes.emaurri_vertical_split_slider = {};

	$( document ).ready(
		function () {
			qodefVerticalSplitSlider.init();
		}
	);

	var qodefVerticalSplitSlider = {
		init: function () {
			var $holder            = $( '.qodef-vertical-split-slider' ),
				$headerInner       = $( '#qodef-page-header-inner' ),
				breakpoint         = qodefVerticalSplitSlider.getBreakpoint( $holder ),
				initialHeaderStyle = '';

			if ( $headerInner.hasClass( 'qodef-skin--light' ) ) {
				initialHeaderStyle = 'light';
			} else if ( $headerInner.hasClass( 'qodef-skin--dark' ) ) {
				initialHeaderStyle = 'dark';
			}

			if ( $holder.length ) {
				$holder.multiscroll(
					{
						scrollingSpeed: 700,
						easing: 'easeInOutQuart',
						navigation: true,
						navigationPosition: 'right',
						afterRender: function () {
							qodefCore.body.addClass( 'qodef-vertical-split-slider--initialized' );
							qodefVerticalSplitSlider.headerClassHandler( $( '.ms-left .ms-section:first-child' ).data( 'header-skin' ), initialHeaderStyle, $headerInner );
						},
						onLeave: function ( index, nextIndex ) {
							qodefVerticalSplitSlider.headerClassHandler( $( $( '.ms-left .ms-section' )[nextIndex - 1] ).data( 'header-skin' ), initialHeaderStyle, $headerInner );
						},
					}
				);

				$holder.height( qodefCore.windowHeight );
				qodefVerticalSplitSlider.buildAndDestroy( breakpoint );

				$( window ).resize(
					function () {
						qodefVerticalSplitSlider.buildAndDestroy( breakpoint );
					}
				);
			}
		},
		getBreakpoint: function ( $holder ) {
			if ( $holder.hasClass( 'qodef-disable-below--768' ) ) {
				return 768;
			} else {
				return 1024;
			}
		},
		buildAndDestroy: function ( breakpoint ) {
			if ( qodefCore.windowWidth <= breakpoint ) {
				$.fn.multiscroll.destroy();
				$( 'html, body' ).css( 'overflow', 'initial' );
				qodefCore.body.removeClass( 'qodef-vertical-split-slider--initialized' );
			} else {
				$.fn.multiscroll.build();
				qodefCore.body.addClass( 'qodef-vertical-split-slider--initialized' );
			}
		},
		headerClassHandler: function ( slideHeaderStyle, initialHeaderStyle, $headerInner ) {
			var $controls = $( '#multiscroll-nav' );

			if ( slideHeaderStyle !== undefined && slideHeaderStyle !== '' ) {
				$headerInner.removeClass( 'qodef-skin--light qodef-skin--dark' ).addClass( 'qodef-skin--' + slideHeaderStyle );

				if ( $controls.length ) {
					$controls.removeClass( 'qodef-skin--light qodef-skin--dark' ).addClass( 'qodef-skin--' + slideHeaderStyle );
				}
			} else if ( initialHeaderStyle !== '' ) {
				$headerInner.removeClass( 'qodef-skin--light qodef-skin--dark' ).addClass( 'qodef-skin--' + slideHeaderStyle );

				if ( $controls.length ) {
					$controls.removeClass( 'qodef-skin--light qodef-skin--dark' ).addClass( 'qodef-skin--' + slideHeaderStyle );
				}
			} else {
				$headerInner.removeClass( 'qodef-skin--light qodef-skin--dark' );

				if ( $controls.length ) {
					$controls.removeClass( 'qodef-skin--light qodef-skin--dark' );
				}
			}
		}
	};

	qodefCore.shortcodes.emaurri_vertical_split_slider.qodefVerticalSplitSlider = qodefVerticalSplitSlider;

})( jQuery );

(function ( $ ) {
	'use strict';

	qodefCore.shortcodes.emaurri_core_video_button                    = {};
	qodefCore.shortcodes.emaurri_core_video_button.qodefMagnificPopup = qodef.qodefMagnificPopup;

})( jQuery );

(function ($) {
    "use strict";

    $(document).ready(function () {
        qodefSocialTextWidget.init();
    });

    var qodefSocialTextWidget = {
        init: function () {
            var $holder = $('.qodef-social-text');

            if ( $holder.length) {
                $holder.each( function () {
                    var $thisHolder = $(this);

                    qodefSocialTextWidget.textHoverColor( $thisHolder );
                });
            }
        },
        textHoverColor: function ( $holder ) {
            var $textLink = $holder.find('.qodef-social-text-link');

            if ( $textLink.length ) {
                $textLink.each( function () {
                    var $thisTextLink = $(this);

                    if ( typeof $thisTextLink.data('hover-color') !== 'undefined' ) {
                        var hoverColor = $thisTextLink.data('hover-color');
                        var originalColor = $thisTextLink.css('color');

                        $thisTextLink.on('mouseenter', function () {
                            qodefSocialTextWidget.changeColor($thisTextLink, 'color', hoverColor);
                        });
                        $thisTextLink.on('mouseleave', function () {
                            qodefSocialTextWidget.changeColor($thisTextLink, 'color', originalColor);
                        });
                    }
                });
            }
        },
        changeColor: function ( $holder, $cssProperty, $color ) {
            $holder.css($cssProperty, $color);
        }
    };

})(jQuery);
(function ( $ ) {
	'use strict';

	$( window ).on(
		'load',
		function () {
			qodefStickySidebar.init();
		}
	);

	var qodefStickySidebar = {
		init: function () {
			var info = $( '.widget_emaurri_core_sticky_sidebar' );

			if ( info.length && qodefCore.windowWidth > 1024 ) {
				info.wrapper = info.parents( '#qodef-page-sidebar' );
				info.c       = 24;
				info.offsetM = info.offset().top - info.wrapper.offset().top;
				info.adj     = 15;

				qodefStickySidebar.callStack( info );

				$( window ).on(
					'resize',
					function () {
						if ( qodefCore.windowWidth > 1024 ) {
							qodefStickySidebar.callStack( info );
						}
					}
				);

				$( window ).on(
					'scroll',
					function () {
						if ( qodefCore.windowWidth > 1024 ) {
							qodefStickySidebar.infoPosition( info );
						}
					}
				);
			}
		},
		calc: function ( info ) {
			var content = $( '.qodef-page-content-section' ),
				headerH = qodefCore.body.hasClass( 'qodef-header-appearance--none' ) ? 0 : parseInt( qodefGlobal.vars.headerHeight, 10 );

			info.start = content.offset().top;
			info.end   = content.outerHeight();
			info.h     = info.wrapper.height();
			info.w     = info.outerWidth();
			info.left  = info.offset().left;
			info.top   = headerH + qodefGlobal.vars.adminBarHeight + info.c - info.offsetM;
			info.data( 'state', 'top' );
		},
		infoPosition: function ( info ) {
			if ( qodefCore.scroll < info.start - info.top && qodefCore.scroll + info.h && info.data( 'state' ) !== 'top' ) {
				TweenMax.to(
					info.wrapper,
					.1,
					{
						y: 5,
					}
				);
				TweenMax.to(
					info.wrapper,
					.3,
					{
						y: 0,
						delay: .1,
					}
				);
				info.data( 'state', 'top' );
				info.wrapper.css(
					{
						'position': 'static',
					}
				);
			} else if ( qodefCore.scroll >= info.start - info.top && qodefCore.scroll + info.h + info.adj <= info.start + info.end &&
				info.data( 'state' ) !== 'fixed' ) {
				var c = info.data( 'state' ) === 'top' ? 1 : -1;
				info.data( 'state', 'fixed' );
				info.wrapper.css(
					{
						'position': 'fixed',
						'top': info.top,
						'left': info.left,
						'width': info.w,
					}
				);
				TweenMax.fromTo(
					info.wrapper,
					.2,
					{
						y: 0
					},
					{
						y: c * 10,
						ease: Power4.easeInOut
					}
				);
				TweenMax.to(
					info.wrapper,
					.2,
					{
						y: 0,
						delay: .2,
					}
				);
			} else if ( qodefCore.scroll + info.h + info.adj > info.start + info.end && info.data( 'state' ) !== 'bottom' ) {
				info.data( 'state', 'bottom' );
				info.wrapper.css(
					{
						'position': 'absolute',
						'top': info.end - info.h - info.adj,
						'left': 0,
					}
				);
				TweenMax.fromTo(
					info.wrapper,
					.1,
					{
						y: 0
					},
					{
						y: -5,
					}
				);
				TweenMax.to(
					info.wrapper,
					.3,
					{
						y: 0,
						delay: .1,
					}
				);
			}
		},
		callStack: function ( info ) {
			this.calc( info );
			this.infoPosition( info );
		}
	};

})( jQuery );

(function ( $ ) {
	'use strict';

	var shortcode = 'emaurri_core_blog_list';

	qodefCore.shortcodes[shortcode] = {};

	if ( typeof qodefCore.listShortcodesScripts === 'object' ) {
		$.each(
			qodefCore.listShortcodesScripts,
			function ( key, value ) {
				qodefCore.shortcodes[shortcode][key] = value;
			}
		);
	}

	qodefCore.shortcodes[shortcode].qodefResizeIframes = qodef.qodefResizeIframes;

})( jQuery );

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

(function ( $ ) {
	'use strict';

	var fixedHeaderAppearance = {
		showHideHeader: function ( $pageOuter, $header ) {
			if ( qodefCore.windowWidth > 1024 ) {
				if ( qodefCore.scroll <= 0 ) {
					qodefCore.body.removeClass( 'qodef-header--fixed-display' );
					$pageOuter.css( 'padding-top', '0' );
					$header.css( 'margin-top', '0' );
				} else {
					qodefCore.body.addClass( 'qodef-header--fixed-display' );
					$pageOuter.css( 'padding-top', parseInt( qodefGlobal.vars.headerHeight + qodefGlobal.vars.topAreaHeight ) + 'px' );
					$header.css( 'margin-top', parseInt( qodefGlobal.vars.topAreaHeight ) + 'px' );
				}
			}
		},
		init: function () {

			if ( ! qodefCore.body.hasClass( 'qodef-header--vertical' ) ) {
				var $pageOuter = $( '#qodef-page-outer' ),
					$header    = $( '#qodef-page-header' );

				fixedHeaderAppearance.showHideHeader( $pageOuter, $header );

				$( window ).scroll(
					function () {
						fixedHeaderAppearance.showHideHeader( $pageOuter, $header );
					}
				);

				$( window ).resize(
					function () {
						$pageOuter.css( 'padding-top', '0' );
						fixedHeaderAppearance.showHideHeader( $pageOuter, $header );
					}
				);
			}
		}
	};

	qodefCore.fixedHeaderAppearance = fixedHeaderAppearance.init;

})( jQuery );

(function ( $ ) {
	'use strict';

	var stickyHeaderAppearance = {
		header: '',
		docYScroll: 0,
		init: function () {
			var displayAmount = stickyHeaderAppearance.displayAmount();

			// Set variables
			stickyHeaderAppearance.header 	  = $( '.qodef-header-sticky' );
			stickyHeaderAppearance.docYScroll = $( document ).scrollTop();

			// Set sticky visibility
			stickyHeaderAppearance.setVisibility( displayAmount );

			$( window ).scroll(
				function () {
					stickyHeaderAppearance.setVisibility( displayAmount );
				}
			);
		},
		displayAmount: function () {
			if ( qodefGlobal.vars.qodefStickyHeaderScrollAmount !== 0 ) {
				return parseInt( qodefGlobal.vars.qodefStickyHeaderScrollAmount, 10 );
			} else {
				return parseInt( qodefGlobal.vars.headerHeight + qodefGlobal.vars.adminBarHeight, 10 );
			}
		},
		setVisibility: function ( displayAmount ) {
			var isStickyHidden = qodefCore.scroll < displayAmount;

			if ( stickyHeaderAppearance.header.hasClass( 'qodef-appearance--up' ) ) {
				var currentDocYScroll = $( document ).scrollTop();

				isStickyHidden = (currentDocYScroll > stickyHeaderAppearance.docYScroll && currentDocYScroll > displayAmount) || (currentDocYScroll < displayAmount);

				stickyHeaderAppearance.docYScroll = $( document ).scrollTop();
			}

			stickyHeaderAppearance.showHideHeader( isStickyHidden );
		},
		showHideHeader: function ( isStickyHidden ) {
			if ( isStickyHidden ) {
				qodefCore.body.removeClass( 'qodef-header--sticky-display' );
			} else {
				qodefCore.body.addClass( 'qodef-header--sticky-display' );
			}
		},
	};

	qodefCore.stickyHeaderAppearance = stickyHeaderAppearance.init;

})( jQuery );

(function ( $ ) {
	'use strict';

	$( document ).ready(
		function () {
			qodefSideAreaMobileHeader.init();
		}
	);

	var qodefSideAreaMobileHeader = {
		init: function () {
			var $holder = $( '#qodef-side-area-mobile-header' );

			if ( $holder.length && qodefCore.body.hasClass( 'qodef-mobile-header--side-area' ) ) {
				var $navigation = $holder.find( '.qodef-m-navigation' );

				qodefSideAreaMobileHeader.initOpenerTrigger( $holder, $navigation );
				qodefSideAreaMobileHeader.initNavigationClickToggle( $navigation );

				if ( typeof qodefCore.qodefPerfectScrollbar === 'object' ) {
					qodefCore.qodefPerfectScrollbar.init( $holder );
				}
			}
		},
		initOpenerTrigger: function ( $holder, $navigation ) {
			var $openerIcon = $( '.qodef-side-area-mobile-header-opener' ),
				$closeIcon  = $holder.children( '.qodef-m-close' );

			if ( $openerIcon.length && $navigation.length ) {
				$openerIcon.on(
					'tap click',
					function ( e ) {
						e.stopPropagation();
						e.preventDefault();

						if ( $holder.hasClass( 'qodef--opened' ) ) {
							$holder.removeClass( 'qodef--opened' );
						} else {
							$holder.addClass( 'qodef--opened' );
						}
					}
				);
			}

			$closeIcon.on(
				'tap click',
				function ( e ) {
					e.stopPropagation();
					e.preventDefault();

					if ( $holder.hasClass( 'qodef--opened' ) ) {
						$holder.removeClass( 'qodef--opened' );
					}
				}
			);
		},
		initNavigationClickToggle: function ( $navigation ) {
			var $menuItems = $navigation.find( 'ul li.menu-item-has-children' );

			$menuItems.each(
				function () {
					var $thisItem        = $( this ),
						$elementToExpand = $thisItem.find( ' > .qodef-drop-down-second, > ul' ),
						$dropdownOpener  = $thisItem.find( '> a' ),
						slideUpSpeed     = 'fast',
						slideDownSpeed   = 'slow';

					$dropdownOpener.on(
						'click tap',
						function ( e ) {
							e.preventDefault();
							e.stopPropagation();

							if ( $elementToExpand.is( ':visible' ) ) {
								$thisItem.removeClass( 'qodef-menu-item--open' );
								$elementToExpand.slideUp( slideUpSpeed );
							} else if ( $dropdownOpener.parent().parent().children().hasClass( 'qodef-menu-item--open' ) && $dropdownOpener.parent().parent().parent().hasClass( 'qodef-vertical-menu' ) ) {
								$thisItem.parent().parent().children().removeClass( 'qodef-menu-item--open' );
								$thisItem.parent().parent().children().find( ' > .qodef-drop-down-second' ).slideUp( slideUpSpeed );

								$thisItem.addClass( 'qodef-menu-item--open' );
								$elementToExpand.slideDown( slideDownSpeed );
							} else {

								if ( ! $thisItem.parents( 'li' ).hasClass( 'qodef-menu-item--open' ) ) {
									$menuItems.removeClass( 'qodef-menu-item--open' );
									$menuItems.find( ' > .qodef-drop-down-second, > ul' ).slideUp( slideUpSpeed );
								}

								if ( $thisItem.parent().parent().children().hasClass( 'qodef-menu-item--open' ) ) {
									$thisItem.parent().parent().children().removeClass( 'qodef-menu-item--open' );
									$thisItem.parent().parent().children().find( ' > .qodef-drop-down-second, > ul' ).slideUp( slideUpSpeed );
								}

								$thisItem.addClass( 'qodef-menu-item--open' );
								$elementToExpand.slideDown( slideDownSpeed );
							}
						}
					);
				}
			);
		},
	};

})( jQuery );

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

(function ( $ ) {
	'use strict';

	$( document ).ready(
		function () {
			qodefSearch.init();
		}
	);

	var qodefSearch = {
		init: function () {
			this.search = $( 'a.qodef-search-opener' );

			if ( this.search.length ) {
				this.search.each(
					function () {
						var $thisSearch = $( this );

						qodefSearch.searchHoverColor( $thisSearch );
					}
				);
			}
		},
		searchHoverColor: function ( $searchHolder ) {
			if ( typeof $searchHolder.data( 'hover-color' ) !== 'undefined' ) {
				var hoverColor    = $searchHolder.data( 'hover-color' ),
					originalColor = $searchHolder.css( 'color' );

				$searchHolder.on(
					'mouseenter',
					function () {
						$searchHolder.css( 'color', hoverColor );
					}
				).on(
					'mouseleave',
					function () {
						$searchHolder.css( 'color', originalColor );
					}
				);
			}
		}
	};

})( jQuery );

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

(function ( $ ) {
	'use strict';

	$( document ).ready(
		function () {
			qodefProgressBarSpinner.init();
		}
	);

	var qodefProgressBarSpinner = {
		percentNumber: 0,
		init: function () {
			this.holder = $( '#qodef-page-spinner.qodef-layout--progress-bar' );

			if ( this.holder.length ) {
				qodefProgressBarSpinner.animateSpinner( this.holder );
			}
		},
		animateSpinner: function ( $holder ) {

			var $numberHolder = $holder.find( '.qodef-m-spinner-number-label' ),
				$spinnerLine  = $holder.find( '.qodef-m-spinner-line-front' ),
				numberIntervalFastest,
				windowLoaded  = false;

			$spinnerLine.animate(
				{ 'width': '100%' },
				10000,
				'linear'
			);

			var numberInterval = setInterval(
				function () {
					qodefProgressBarSpinner.animatePercent( $numberHolder, qodefProgressBarSpinner.percentNumber );

					if ( windowLoaded ) {
						clearInterval( numberInterval );
					}
				},
				100
			);

			$( window ).on(
				'load',
				function () {
					windowLoaded = true;

					numberIntervalFastest = setInterval(
						function () {
							if ( qodefProgressBarSpinner.percentNumber >= 100 ) {
								clearInterval( numberIntervalFastest );
								$spinnerLine.stop().animate(
									{ 'width': '100%' },
									500
								);

								setTimeout(
									function () {
										$holder.addClass( 'qodef--finished' );

										setTimeout(
											function () {
												qodefProgressBarSpinner.fadeOutLoader( $holder );
											},
											1000
										);
									},
									600
								);
							} else {
								qodefProgressBarSpinner.animatePercent( $numberHolder, qodefProgressBarSpinner.percentNumber );
							}
						},
						6
					);
				}
			);
		},
		animatePercent: function ( $numberHolder, percentNumber ) {
			if ( percentNumber < 100 ) {
				percentNumber += 5;
				$numberHolder.text( percentNumber );

				qodefProgressBarSpinner.percentNumber = percentNumber;
			}
		},
		fadeOutLoader: function ( $holder, speed, delay, easing ) {
			speed = speed ? speed : 600;
			delay = delay ? delay : 0;
			easing = easing ? easing : 'swing';

			$holder.delay( delay ).fadeOut( speed, easing );

			$( window ).on(
				'bind',
				'pageshow',
				function ( event ) {
					if ( event.originalEvent.persisted ) {
						$holder.fadeOut( speed, easing );
					}
				}
			);
		}
	};

})( jQuery );

(function ( $ ) {
	'use strict';

	qodefCore.shortcodes.emaurri_core_instagram_list = {};

	$( document ).ready(
		function () {
			qodefInstagram.init();
		}
	);

	var qodefInstagram = {
		init: function () {
			this.holder = $( '.sbi.qodef-instagram-swiper-container' );

			if ( this.holder.length ) {
				this.holder.each(
					function () {
						var $thisHolder     = $( this ),
							sliderOptions   = $thisHolder.parent().attr( 'data-options' ),
							$instagramImage = $thisHolder.find( '.sbi_item.sbi_type_image' ),
							$imageHolder    = $thisHolder.find( '#sbi_images' );

						$thisHolder.attr( 'data-options', sliderOptions );

						$imageHolder.addClass( 'swiper-wrapper' );

						if ( $instagramImage.length ) {
							$instagramImage.each(
								function () {
									$( this ).addClass( 'qodef-e qodef-image-wrapper swiper-slide' );
								}
							);
						}

						if ( typeof qodef.qodefSwiper === 'object' ) {
							qodef.qodefSwiper.init( $thisHolder );
						}
					}
				);
			}
		},
	};

	qodefCore.shortcodes.emaurri_core_instagram_list.qodefInstagram = qodefInstagram;
	qodefCore.shortcodes.emaurri_core_instagram_list.qodefSwiper    = qodef.qodefSwiper;

})( jQuery );

(function ( $ ) {
	'use strict';

	/*
	 **	Re-init scripts on gallery loaded
	 */
	$( document ).on(
		'yith_wccl_product_gallery_loaded',
		function () {

			if ( typeof qodefCore.qodefWooMagnificPopup === 'function' ) {
				qodefCore.qodefWooMagnificPopup.init();
			}
		}
	);

})( jQuery );

(function ( $ ) {
	'use strict';

	var shortcode = 'emaurri_core_product_list';

	qodefCore.shortcodes[shortcode] = {};

	if ( typeof qodefCore.listShortcodesScripts === 'object' ) {
		$.each(
			qodefCore.listShortcodesScripts,
			function ( key, value ) {
				qodefCore.shortcodes[shortcode][key] = value;
			}
		);
	}

})( jQuery );

(function ( $ ) {
	'use strict';

	qodefCore.shortcodes.emaurri_core_clients_list             = {};
	qodefCore.shortcodes.emaurri_core_clients_list.qodefSwiper = qodef.qodefSwiper;

})( jQuery );

(function ($) {
	"use strict";
	qodefCore.shortcodes.emaurri_core_portfolio_exhibition = {};

	$( window ).on(
		'load',
		function () {
			qodefPortfolioExhibition.init();
		}
	);

	$( window ).resize(
		function () {
			qodefPortfolioExhibition.init();
		}
	);

	var qodefPortfolioExhibition = {
		scrollParams: [],
		scrollBuffer: qodef.scroll + qodef.windowHeight * 0.6,
		scrollingDown: true,
		currentArticleID: 0,
		firstArticleID: 0,
		lastArticleID: 0,
		init: function () {
			var holder = $( '.qodef-portfolio-exhibition' );

			if (qodef.windowWidth > 768 && holder.length) {
				holder.each(
					function () {
						qodefPortfolioExhibition.scrollParams = qodefPortfolioExhibition.getScrollParams( $( this ) );
						qodefPortfolioExhibition.setScrollFunctionality( $( this ) );
						qodefPortfolioExhibition.portfolioExhibitionBackgroundText( $( this ) );
					}
				);
			}
		},
		getScrollParams: function ($holder) {
			var articleScrollParams = [],
				articles            = $holder.find( 'article' );

			if (articles.length) {
				articles.each(
					function(index) {
						var currentArticle = $( this ),
						id                 = currentArticle.data( 'id' ),
						top                = currentArticle.offset().top,
						bottom             = top + currentArticle.outerHeight();

						articleScrollParams.push(
							{
								id: id,
								top: top,
								bottom: bottom
							}
						);

						if (index === 0) {
							qodefPortfolioExhibition.firstArticleID = id;
						}

						if (index + 1 === articles.length) {
							qodefPortfolioExhibition.lastArticleID = id;
						}

						currentArticle.appear(
							function () {
								currentArticle.addClass( 'qodef--appeared' );
							}
						);
					}
				);
			}

			return articleScrollParams;
		},
		scrollDirection: function() {
			var currentScroll = qodef.scroll + qodef.windowHeight * 0.6;

			if (currentScroll > qodefPortfolioExhibition.scrollBuffer) {
				qodefPortfolioExhibition.scrollingDown = true;
			} else {
				qodefPortfolioExhibition.scrollingDown = false;
			}
			qodefPortfolioExhibition.scrollBuffer = currentScroll;
		},
		setScrollFunctionality: function ($holder) {
			qodefPortfolioExhibition.setCurrentArticleID();
			$holder.find( '#' + qodefPortfolioExhibition.currentArticleID ).addClass( 'qodef-in-view' );

			$( window ).scroll(
				function () {
					qodefPortfolioExhibition.scrollDirection();
					qodefPortfolioExhibition.scrollParams.forEach(
						function(item) {
							if (qodef.scroll + qodef.windowHeight * 0.6 > item.top) {
								qodefPortfolioExhibition.currentArticleID = item.id;
							}
						}
					);

					var articles   = $holder.find( '.qodef-slides-info-holder article' ),
					cuurentArticle = articles.filter( '#' + qodefPortfolioExhibition.currentArticleID );

					articles.removeClass( 'qodef-in-view' );
					cuurentArticle.addClass( 'qodef-in-view' );
				}
			);
		},
		setCurrentArticleID: function () {
			qodefPortfolioExhibition.currentArticleID = qodefPortfolioExhibition.scrollParams[0].id;

			qodefPortfolioExhibition.scrollParams.forEach(
				function(item) {
					if (qodef.scroll + qodef.windowHeight * 0.6 > item.top) {
						qodefPortfolioExhibition.currentArticleID = item.id;
					}
				}
			);
		},
		portfolioExhibitionBackgroundText( $holder ) {

			var articles = $holder.find( '.qodef-slides-info-holder article' );

			if (articles.length) {
				articles.each(
					function() {
						var textHolder = $( this ).find( '.qodef-e-portfolio-exhibition-bg-text' ),
							text       = textHolder.text();

						if ( text.length && typeof ( text ) != 'undefined' ) {

							var words = text.split( " " );

							for (var i = 0; i < words.length; i++) {
								words[i] = '<span class="qodef-portfolio-exhibition-bg-word">' + words[i] + '</span>';

								text = words.join( " " );
							}

							textHolder.parent().append( '<div class="qodef-e-portfolio-exhibition-bg-text"><div class="qodef-portfolio-exhibition-bg-text-inner">' + text + '</div></div>' )
							textHolder.remove();
						}

						setTimeout(
							function () {
								var $rowBgWord = $( '.qodef-portfolio-exhibition-bg-word' );
								if ( $rowBgWord.length ) {
									$rowBgWord.each(
										function () {
											var $thisBgText       = $( this ),
												thisBgTextContent = $thisBgText.text().trim(),
												thisBgTextArray   = thisBgTextContent.split( '' );
											$thisBgText.empty();

											thisBgTextArray.forEach(
												function (item, index) {
													if (item === " ") {
														$thisBgText.append( '<span class="qodef-bg-text-char qodef--empty-char">' + item + '</span>' )
													} else {
														$thisBgText.append( '<span class="qodef-bg-text-char">' + item + '</span>' )
													}
												}
											);
										}
									)
								}
							},
							300
						);
					}
				);
			}

		}
	};

	qodefCore.shortcodes.emaurri_core_portfolio_exhibition.qodefPortfolioExhibition = qodefPortfolioExhibition;

})( jQuery );

(function ( $ ) {
	'use strict';

	var shortcode = 'emaurri_core_portfolio_interactive_list';

	qodefCore.shortcodes[shortcode] = {};

	if ( typeof qodefCore.listShortcodesScripts === 'object' ) {
		$.each(
			qodefCore.listShortcodesScripts,
			function ( key, value ) {
				qodefCore.shortcodes[shortcode][key] = value;
			}
		);
	}

	$( window ).on(
		'load',
		function () {
			qodefPortfolioScrollableList.init();
		}
	);

	var qodefPortfolioScrollableList = {
		header : $( '#qodef-page-header' ),
		init: function () {
			var scrollableList = $( '.qodef-portfolio-interactive-list' );

			scrollableList.on(
				'mouseenter',
				function () {
					scrollableList.addClass( 'qodef-ptf-hovered' );
				}
			);

			scrollableList.on(
				'mouseleave',
				function () {
					scrollableList.removeClass( 'qodef-ptf-hovered' );
				}
			);

			if (scrollableList.length && qodef.windowWidth > 768) {
				scrollableList.each(
					function () {
						var thisScrollable = $( this );
						qodefPortfolioScrollableList.qodefProjectsListHover( thisScrollable );
						qodefPortfolioScrollableList.qodefPortfolioScrollFix( thisScrollable );
						qodefPortfolioScrollableList.qodefPortfolioScrollPosition( thisScrollable );
						$( window ).scroll(
							function () {
								qodefPortfolioScrollableList.qodefPortfolioScrollFix( thisScrollable );
							}
						);
						$( window ).resize(
							function () {
								qodefPortfolioScrollableList.qodefPortfolioScrollPosition( thisScrollable );
							}
						);
					}
				);
			}
		},

		qodefPortfolioScrollPosition : function (scrollableHolder) {
			var thisMeta      = scrollableHolder.find( '.qodef-ptf-list-showcase-meta' ),
				thisMetaInner = thisMeta.find( '.qodef-ptf-list-showcase-meta-inner' );
			thisMetaInner.css(
				{
					'left': thisMeta.offset().left,
					'width': thisMeta.width()
				}
			);
		},

		qodefPortfolioScrollFix : function (scrollableHolder) {
			var thisMeta                = scrollableHolder.find( '.qodef-ptf-list-showcase-meta' ),
				thisMetaInner           = thisMeta.find( '.qodef-ptf-list-showcase-meta-items-holder' ),
				thisMetaInnerHeight     = thisMetaInner.height(),
				thisPreview             = scrollableHolder.find( '.qodef-ptf-list-showcase-preview' ),
				thisPreviewOffsetTop    = thisPreview.offset().top,
				thisPreviewOffsetBottom = thisPreview.offset().top + thisPreview.outerHeight();

			if (thisPreviewOffsetTop <= qodef.scroll && thisPreviewOffsetBottom > qodef.scroll) {
				if ( ! thisMeta.hasClass( 'qodef-fix-meta' ) ) {
					thisMeta.addClass( 'qodef-fix-meta' );
					qodefPortfolioScrollableList.qodefPortfolioScrollPosition( scrollableHolder );
				}
				if (thisPreviewOffsetBottom < qodef.scroll + thisMetaInnerHeight) {
					thisMeta.addClass( 'qodef-fix-bottom' );
					thisMetaInner.css( 'top', thisPreviewOffsetBottom - (qodef.scroll + thisMetaInnerHeight) );
				} else {
					thisMeta.removeClass( 'qodef-fix-bottom' );
					// thisMetaInner.css('top', thisPreviewOffsetTop);
				}
			} else {
				thisMeta.removeClass( 'qodef-fix-meta' );
				thisMeta.removeClass( 'qodef-fix-bottom' );
			}
		},

		qodefProjectsListHover : function (scrollableHolder) {
			var thisMeta        = scrollableHolder.find( '.qodef-ptf-list-showcase-meta' ),
			thisMetaHolder      = scrollableHolder.find( '.qodef-ptf-list-showcase-meta-items-holder' ),
			thisPreviewHolder   = scrollableHolder.find( '.qodef-ptf-list-showcase-preview' ),
			thisMetaChildren    = thisMetaHolder.find( '.qodef-ptf-list-showcase-meta-item' ),
			thisPreviewChildren = thisPreviewHolder.find( '.qodef-ptf-list-showcase-preview-item' ),
			thisMetaLink        = thisMetaHolder.find( '.qodef-e-title a' ),
			projectNum          = 1;

			thisPreviewChildren.on(
				'mouseenter',
				function () {
					projectNum         = $( this ).index();
					var currentProject = $( this );

					thisMetaChildren.removeClass( 'active' );
					thisPreviewChildren.removeClass( 'active' );
					thisMetaChildren.clearQueue();
					thisMetaChildren.eq( projectNum ).addClass( 'active' );
					currentProject.addClass( 'active' );
				}
			);

			thisMetaChildren.on(
				'mouseover touch',
				function () {
					projectNum         = $( this ).index();
					var currentProject = $( this );
					var currentPreview = thisPreviewChildren.eq( projectNum );
					var currentScroll  = currentPreview.offset().top - qodef.windowHeight / 2 + currentPreview.height() / 2;
					var scrollFromTop  = thisMeta.offset().top - qodefPortfolioScrollableList.header.height();

					thisMetaChildren.removeClass( 'active' );
					thisPreviewChildren.removeClass( 'active' );
					thisPreviewChildren.clearQueue();
					currentProject.addClass( 'active' );
					currentPreview.addClass( 'active' );

					if (projectNum == 0) {
						qodef.html.stop().animate( {scrollTop: scrollFromTop}, 1200, 'easeOutExpo' );
					} else {
						qodef.html.stop().animate( {scrollTop: currentScroll}, 1200, 'easeOutExpo' );
					}
				}
			);

			thisMetaLink.on(
				'click touch',
				function (e) {
					var thisLink = $( this );

					if ( ! thisLink.parents( '.qodef-ptf-list-showcase-meta-item' ).hasClass( 'active' )) {
						e.preventDefault();
					}
				}
			);

			scrollableHolder.on(
				'mouseleave',
				function () {
					thisMetaChildren.removeClass( 'active' );
					thisPreviewChildren.removeClass( 'active' );
				}
			);

		}
	};

})( jQuery );

(function ( $ ) {
	'use strict';

	var shortcode = 'emaurri_core_portfolio_list';

	qodefCore.shortcodes[shortcode] = {};

	if ( typeof qodefCore.listShortcodesScripts === 'object' ) {
		$.each(
			qodefCore.listShortcodesScripts,
			function ( key, value ) {
				qodefCore.shortcodes[shortcode][key] = value;
			}
		);
	}

	$( window ).on(
		'load',
		function () {
			qodefPortfolioScrollableList.init();
			qodefSliderFullSwiper.init();
			qodefParallaxElements.init();
		}
	);

	var qodefPortfolioScrollableList = {
		header : $( '#qodef-page-header' ),
		init: function () {
			var scrollableList = $( '.qodef-portfolio-list.qodef-layout--scrollable' );

			scrollableList.on(
				'mouseenter',
				function () {
					scrollableList.addClass( 'qodef-ptf-hovered' );
				}
			);

			scrollableList.on(
				'mouseleave',
				function () {
					scrollableList.removeClass( 'qodef-ptf-hovered' );
				}
			);

			if (scrollableList.length && qodef.windowWidth > 768) {
				scrollableList.each(
					function () {
						var thisScrollable = $( this );
						qodefPortfolioScrollableList.qodefProjectsListHover( thisScrollable );
						qodefPortfolioScrollableList.qodefPortfolioScrollFix( thisScrollable );
						qodefPortfolioScrollableList.qodefPortfolioScrollPosition( thisScrollable );
						$( window ).scroll(
							function () {
								qodefPortfolioScrollableList.qodefPortfolioScrollFix( thisScrollable );
							}
						);
						$( window ).resize(
							function () {
								qodefPortfolioScrollableList.qodefPortfolioScrollPosition( thisScrollable );
							}
						);
					}
				);
			}
		},

		qodefPortfolioScrollPosition : function (scrollableHolder) {
			var thisMeta      = scrollableHolder.find( '.qodef-ptf-list-showcase-meta' ),
				thisMetaInner = thisMeta.find( '.qodef-ptf-list-showcase-meta-inner' );
			thisMetaInner.css(
				{
					'left': thisMeta.offset().left,
					'width': thisMeta.width()
				}
			);
		},

		qodefPortfolioScrollFix : function (scrollableHolder) {
			var thisMeta                = scrollableHolder.find( '.qodef-ptf-list-showcase-meta' ),
				thisMetaInner           = thisMeta.find( '.qodef-ptf-list-showcase-meta-items-holder' ),
				thisMetaInnerHeight     = thisMetaInner.height(),
				thisPreview             = scrollableHolder.find( '.qodef-ptf-list-showcase-preview' ),
				thisPreviewOffsetTop    = thisPreview.offset().top,
				thisPreviewOffsetBottom = thisPreview.offset().top + thisPreview.outerHeight();

			if (thisPreviewOffsetTop <= qodef.scroll && thisPreviewOffsetBottom > qodef.scroll) {
				if ( ! thisMeta.hasClass( 'qodef-fix-meta' ) ) {
					thisMeta.addClass( 'qodef-fix-meta' );
					qodefPortfolioScrollableList.qodefPortfolioScrollPosition( scrollableHolder );
				}
				if (thisPreviewOffsetBottom < qodef.scroll + thisMetaInnerHeight) {
					thisMeta.addClass( 'qodef-fix-bottom' );
					thisMetaInner.css( 'top', thisPreviewOffsetBottom - (qodef.scroll + thisMetaInnerHeight) );
				} else {
					thisMeta.removeClass( 'qodef-fix-bottom' );
					// thisMetaInner.css('top', thisPreviewOffsetTop);
				}
			} else {
				thisMeta.removeClass( 'qodef-fix-meta' );
				thisMeta.removeClass( 'qodef-fix-bottom' );
			}
		},

		qodefProjectsListHover : function (scrollableHolder) {
			var thisMeta        = scrollableHolder.find( '.qodef-ptf-list-showcase-meta' ),
			thisMetaHolder      = scrollableHolder.find( '.qodef-ptf-list-showcase-meta-items-holder' ),
			thisPreviewHolder   = scrollableHolder.find( '.qodef-ptf-list-showcase-preview' ),
			thisMetaChildren    = thisMetaHolder.find( '.qodef-ptf-list-showcase-meta-item' ),
			thisPreviewChildren = thisPreviewHolder.find( '.qodef-ptf-list-showcase-preview-item' ),
			thisMetaLink        = thisMetaHolder.find( '.qodef-e-title a' ),
			projectNum          = 1;

			thisPreviewChildren.on(
				'mouseenter',
				function () {
					projectNum         = $( this ).index();
					var currentProject = $( this );

					thisMetaChildren.removeClass( 'active' );
					thisPreviewChildren.removeClass( 'active' );
					thisMetaChildren.clearQueue();
					thisMetaChildren.eq( projectNum ).addClass( 'active' );
					currentProject.addClass( 'active' );
				}
			);

			thisMetaChildren.on(
				'mouseover touch',
				function () {
					projectNum         = $( this ).index();
					var currentProject = $( this );
					var currentPreview = thisPreviewChildren.eq( projectNum );
					var currentScroll  = currentPreview.offset().top - qodef.windowHeight / 2 + currentPreview.height() / 2;
					var scrollFromTop  = thisMeta.offset().top - qodefPortfolioScrollableList.header.height();

					thisMetaChildren.removeClass( 'active' );
					thisPreviewChildren.removeClass( 'active' );
					thisPreviewChildren.clearQueue();
					currentProject.addClass( 'active' );
					currentPreview.addClass( 'active' );

					if (projectNum == 0) {
						qodef.html.stop().animate( {scrollTop: scrollFromTop}, 1200, 'easeOutExpo' );
					} else {
						qodef.html.stop().animate( {scrollTop: currentScroll}, 1200, 'easeOutExpo' );
					}
				}
			);

			thisMetaLink.on(
				'click touch',
				function (e) {
					var thisLink = $( this );

					if ( ! thisLink.parents( '.qodef-ptf-list-showcase-meta-item' ).hasClass( 'active' )) {
						e.preventDefault();
					}
				}
			);

			scrollableHolder.on(
				'mouseleave',
				function () {
					thisMetaChildren.removeClass( 'active' );
					thisPreviewChildren.removeClass( 'active' );
				}
			);

		}
	};

	var qodefSliderFullSwiper = {
		init: function () {
			var holder = $( '.qodef-portfolio-list.qodef-item-layout--slider-full.qodef-col-num--1.qodef-swiper-container' );

			if ( holder.length ) {
				holder.each(
					function () {
						var thisHolder = $( this );

						if (qodef.windowWidth > 1024) {
							  qodefSliderFullSwiper.initSwiper( thisHolder );
						}
					}
				);
			}
		},
		initSwiper: function ( $holder ) {
			var swiperInstance     = $holder[0].swiper,
				$itemInit          = $holder.find( '.qodef-e.swiper-slide-active' ),
				$contentHolderInit = $itemInit.find( '.qodef-e-inner' );//initial swiper

			$contentHolderInit.clone().addClass( 'qodef--custom-swiper qodef--visible' ).appendTo( $holder );//make duplicate of initial swiper

			swiperInstance.on(
				'slideChangeTransitionStart',
				function() {
					var $item         = $holder.find( '.qodef-e.swiper-slide-active' ),
					$holderClone      = $( '.qodef--custom-swiper' ),
					$image            = $item.find( ' .qodef-e-media-image a' ),
					$imageCloneHolder = $holderClone.find( ' .qodef-e-media-image' ),
					$imageClone       = $imageCloneHolder.find( 'a' ),
					$info             = $item.find( ' .qodef-e-content-inner' ),
					$infoCloneHolder  = $holderClone.find( ' .qodef-e-content' ),
					$infoClone        = $infoCloneHolder.find( ' .qodef-e-content-inner' );

					$imageClone.removeClass( 'qodef--animate-in' ).addClass( 'qodef--animate-out' );
					$infoClone.removeClass( 'qodef--animate-in' ).addClass( 'qodef--animate-out' );

					if ($( '.qodef--animate-out' ).length > 1) {
						$( '.qodef--animate-out' ).not( ':last-child' ).remove();
					}

					$image.clone().addClass( 'qodef--animate-in' ).appendTo( $imageCloneHolder );
					$info.clone().addClass( 'qodef--animate-in' ).appendTo( $infoCloneHolder );
				}
			);
		}
	};

	qodefCore.shortcodes.emaurri_core_portfolio_list.qodefSliderFullSwiper = qodefSliderFullSwiper;

	/**
	 * Parallax Elements Instances
	 */
	var qodefParallaxElements = {
		init: function () {
			var parallaxElements = $( '.qodef-pl-has-parallax .qodef-e-inner' );

			if (parallaxElements.length && qodef.windowWidth > 1024) {
				parallaxElements.each(
					function () {
						var parallaxElement = $( this ),
							randCoeff       = (Math.floor( Math.random() * 2 ) + 1) * 0.1,
							delta           = -Math.round( parallaxElement.height() * randCoeff ),
							dataParallax    = '{"y":' + delta + ', "smoothness":20}';

						parallaxElement.attr( 'data-parallax', dataParallax );
					}
				);

				setTimeout(
					function () {
						ParallaxScroll.init(); //initialzation removed from plugin js file to have it run only on non-touch devices
					},
					100
				); //wait for calcs
			}
		}
	}

	qodefCore.shortcodes.emaurri_core_portfolio_list.qodefParallaxElements = qodefParallaxElements;

})( jQuery );

(function ( $ ) {
	'use strict';

	var shortcode = 'emaurri_core_team_list';

	qodefCore.shortcodes[shortcode] = {};

	if ( typeof qodefCore.listShortcodesScripts === 'object' ) {
		$.each(
			qodefCore.listShortcodesScripts,
			function ( key, value ) {
				qodefCore.shortcodes[shortcode][key] = value;
			}
		);
	}

})( jQuery );

(function ( $ ) {
	'use strict';

	qodefCore.shortcodes.emaurri_core_testimonials_list             = {};
	qodefCore.shortcodes.emaurri_core_testimonials_list.qodefSwiper = qodef.qodefSwiper;

})( jQuery );

(function ( $ ) {
	'use strict';

	$( document ).ready(
		function () {
			qodefInfoFollow.init();
		}
	);

	$( document ).on(
		'emaurri_trigger_get_new_posts',
		function () {
			qodefInfoFollow.init();
		}
	);

	var qodefInfoFollow = {
		init: function () {
			var $gallery = $( '.qodef-hover-animation--follow' );

			if ( $gallery.length ) {
				qodefCore.body.append( '<div class="qodef-follow-info-holder"><div class="qodef-follow-info-inner"><span class="qodef-follow-info-category"></span><br/><span class="qodef-follow-info-title"></span></div></div>' );

				var $followInfoHolder   = $( '.qodef-follow-info-holder' ),
					$followInfoCategory = $followInfoHolder.find( '.qodef-follow-info-category' ),
					$followInfoTitle    = $followInfoHolder.find( '.qodef-follow-info-title' );

				$gallery.each(
					function () {
						$gallery.find( '.qodef-e-inner' ).each(
							function () {
								var $thisItem = $( this );

								//info element position
								$thisItem.on(
									'mousemove',
									function ( e ) {
										if ( e.clientX + 20 + $followInfoHolder.width() > qodefCore.windowWidth ) {
											$followInfoHolder.addClass( 'qodef-right' );
										} else {
											$followInfoHolder.removeClass( 'qodef-right' );
										}

										$followInfoHolder.css(
											{
												top: e.clientY + 20,
												left: e.clientX + 20,
											}
										);
									}
								);

								//show/hide info element
								$thisItem.on(
									'mouseenter',
									function () {
										var $thisItemTitle    = $( this ).find( '.qodef-e-title' ),
											$thisItemCategory = $( this ).find( '.qodef-e-info-category' );

										if ( $thisItemTitle.length ) {
											$followInfoTitle.html( $thisItemTitle.clone() );
										}

										if ( $thisItemCategory.length ) {
											$followInfoCategory.html( $thisItemCategory.html() );
										}

										if ( ! $followInfoHolder.hasClass( 'qodef-is-active' ) ) {
											$followInfoHolder.addClass( 'qodef-is-active' );
										}
									}
								).on(
									'mouseleave',
									function () {
										if ( $followInfoHolder.hasClass( 'qodef-is-active' ) ) {
											$followInfoHolder.removeClass( 'qodef-is-active' );
										}
									}
								);
							}
						);
					}
				);
			}
		}
	};

	qodefCore.shortcodes.emaurri_core_portfolio_list.qodefInfoFollow = qodefInfoFollow;

})( jQuery );
