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
