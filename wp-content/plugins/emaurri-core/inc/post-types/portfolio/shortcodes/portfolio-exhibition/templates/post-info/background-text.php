<?php
$bgtext       = get_post_meta( get_the_ID(), 'qodef_portfolio_item_bg_text', true );
if ( ! empty( $bgtext ) ) {
	echo esc_html( $bgtext );
}
