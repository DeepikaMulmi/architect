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
