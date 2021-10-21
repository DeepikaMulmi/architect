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