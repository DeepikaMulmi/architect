<?php

if ( ! function_exists( 'emaurri_core_filter_clients_list_image_only_no_hover' ) ) {
    /**
     * Function that add variation layout for this module
     *
     * @param array $variations
     *
     * @return array
     */
    function emaurri_core_filter_clients_list_image_only_no_hover( $variations ) {
        $variations['no-hover'] = esc_html__( 'No Hover', 'emaurri-core' );

        return $variations;
    }

    add_filter( 'emaurri_core_filter_clients_list_image_only_animation_options', 'emaurri_core_filter_clients_list_image_only_no_hover' );
}