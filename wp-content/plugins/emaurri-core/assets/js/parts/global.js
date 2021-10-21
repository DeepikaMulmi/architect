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
