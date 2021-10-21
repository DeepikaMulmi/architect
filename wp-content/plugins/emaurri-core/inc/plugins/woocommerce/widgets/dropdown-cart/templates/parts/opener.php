<a itemprop="url" class="qodef-m-opener" href="<?php echo esc_url( wc_get_cart_url() ); ?>">
	<span class="qodef-m-opener-icon">
		<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="13.69px" height="18.1px" viewBox="0 0 13.69 18.1" enable-background="new 0 0 13.69 18.1" xml:space="preserve">
		<g>
			<path fill="none" stroke="currentColor" stroke-miterlimit="10" d="M2.41,5c0-2.46,1.99-4.45,4.45-4.45c2.46,0,4.45,1.99,4.45,4.45"/>
			<rect x="0.54" y="4.98" fill="none" stroke="currentColor" stroke-miterlimit="10" width="12.62" height="12.57"/>
		</g>
		</svg>
	</span>
	<span class="qodef-m-opener-label"><?php echo esc_html__( 'Cart', 'emaurri-core' ); ?></span>
	<span class="qodef-m-opener-count"><?php echo '(' . WC()->cart->cart_contents_count . ')'; ?></span>
</a>
