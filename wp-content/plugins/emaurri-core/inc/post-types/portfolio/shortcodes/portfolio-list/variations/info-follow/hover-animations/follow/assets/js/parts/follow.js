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
