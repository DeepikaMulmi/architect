(function ( $ ) {
	'use strict';

	$( document ).ready(
		function () {
			qodefNotice.init();
		}
	);

	var qodefNotice = {
		init: function () {
			this.noticeHolder = $( '.qodef-admin-notice' );

			if ( this.noticeHolder.length ) {
				this.handleNotice();
			}
		},
		handleNotice: function () {
			var submitButton = this.noticeHolder.find('.qodef-statistics-button'),
				nonceHolder = this.noticeHolder.find('#qi-addons-for-elementor-notice-nonce');

			if( submitButton.length ) {
				submitButton.each( function () {
					var thisSubmitButton = $(this),
						noticeAction = thisSubmitButton.hasClass('qodef-statistics--allowed') ? 'allowed' : 'disallowed';

					thisSubmitButton.on( 'click', function ( e ) {
						e.preventDefault();

						$.ajax(
							{
								type: 'POST',
								data: {
									action: 'qi_adddons_for_elementor_notice',
									notice_action: noticeAction,
									nonce: nonceHolder.val()
								},
								url: ajaxurl,
								success: function ( data ) {
									var response = $.parseJSON( data );

									if( response.status === 'success' ){
										qodefNotice.noticeHolder.slideUp('fast');
									}
								}
							}
						);
					} )
				} )
			}
		}
	};

})( jQuery );
