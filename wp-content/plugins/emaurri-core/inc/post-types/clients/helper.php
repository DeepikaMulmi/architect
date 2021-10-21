<?php

if ( ! function_exists( 'emaurri_core_manage_clients_custom_columns' ) ) {
	/**
	 * Function that add custom dashboard columns for current module
	 *
	 * @param array $columns
	 *
	 * @return array
	 */
	function emaurri_core_manage_clients_custom_columns( $columns ) {
		$columns['logo_image'] = esc_html__( 'Logo Image', 'emaurri-core' );

		return $columns;
	}

	add_filter( 'manage_clients_posts_columns', 'emaurri_core_manage_clients_custom_columns' );
}

if ( ! function_exists( 'emaurri_core_manage_clients_custom_columns_data' ) ) {
	/**
	 * Function that return custom dashboard columns content
	 *
	 * @param string $column
	 * @param int $post_id
	 *
	 * @return string that contains html content
	 */
	function emaurri_core_manage_clients_custom_columns_data( $column, $post_id ) {
		switch ( $column ) {
			case 'logo_image':
				$client_image = get_post_meta( $post_id, 'qodef_logo_image', true );
				echo wp_get_attachment_image( $client_image, 'thumbnail' );
				break;
		}
	}

	add_action( 'manage_clients_posts_custom_column', 'emaurri_core_manage_clients_custom_columns_data', 10, 2 );
}
