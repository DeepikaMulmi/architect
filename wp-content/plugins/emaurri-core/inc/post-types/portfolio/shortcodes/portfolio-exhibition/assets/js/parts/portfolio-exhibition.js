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
