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
