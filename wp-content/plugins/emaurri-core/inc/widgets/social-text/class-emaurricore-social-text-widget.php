<?php

if ( ! function_exists( 'emaurri_core_add_social_text_widget' ) ) {
	/**
	 * function that add widget into widgets list for registration
	 *
	 * @param array $widgets
	 *
	 * @return array
	 */
	function emaurri_core_add_social_text_widget( $widgets ) {
		$widgets[] = 'EmaurriCore_Social_Text_Widget';

		return $widgets;
	}

	add_filter( 'emaurri_core_filter_register_widgets', 'emaurri_core_add_social_text_widget' );
}

if ( class_exists( 'QodeFrameworkWidget' ) ) {
    class EmaurriCore_Social_Text_Widget extends QodeFrameworkWidget {

        public function map_widget() {
            $this->set_base( 'emaurri_core_social_text' );
            $this->set_name( esc_html__( 'Emaurri Social Text', 'emaurri-core' ) );
            $this->set_description( esc_html__( 'Add social text links into widget areas', 'emaurri-core' ) );
	        $this->set_widget_option(
		        array(
			        'field_type' => 'text',
			        'name'       => 'widget_title',
			        'title'      => esc_html__( 'Title', 'emaurri-core' ),
		        )
	        );
            for ( $n = 1; $n <= 4; $n ++ ) {
                $this->set_widget_option(
                    array(
                        'field_type' => 'text',
                        'name'       => 'social_text_' . $n,
                        'title'      => sprintf( esc_html__( 'Social Text %s', 'emaurri-core' ), $n )
                    )
                );
                $this->set_widget_option(
                    array(
                        'field_type' => 'text',
                        'name'       => 'social_link_' . $n,
                        'title'      => sprintf( esc_html__( 'Social Link %s', 'emaurri-core' ), $n )
                    )
                );
                $this->set_widget_option(
                    array(
                        'field_type' => 'select',
                        'name'       => 'social_link_target_' . $n,
                        'title'      => sprintf( esc_html__( 'Social Link Target %s', 'emaurri-core' ), $n ),
                        'options'    => array(
                            '_self'  => esc_html__( 'Same Window', 'emaurri-core' ),
                            '_blank' => esc_html__( 'New Window', 'emaurri-core' ),
                        )
                    )
                );
            }
            $this->set_widget_option(
                array(
                    'field_type' => 'color',
                    'name'       => 'text_color',
                    'title'      => esc_html__( 'Text Color', 'emaurri-core' )
                )
            );
            $this->set_widget_option(
                array(
                    'field_type' => 'color',
                    'name'       => 'text_hover_color',
                    'title'      => esc_html__( 'Text Hover Color', 'emaurri-core' )
                )
            );
            $this->set_widget_option(
                array(
                    'field_type' => 'text',
                    'name'       => 'widget_margin',
                    'title'      => esc_html__( 'Widget Margin', 'emaurri-core' ),
                    'description' => 'Insert margin in top right bottom left (e.g. 10px 5px 10px 5px)'
                )
            );
        }

        public function render( $atts ) {
            $widget_styles = array();
            $text_styles   = array();
            $text_data     = array();

            if ( ! empty( $atts[ 'text_color' ] ) ) {
                $text_styles[] = 'color: ' . $atts[ 'text_color' ] . ';';
            }

            if ( ! empty( $atts[ 'widget_margin' ] ) ) {
                $widget_styles[] = 'margin: ' . $atts[ 'widget_margin'] . ';';
            }

            if ( ! empty( $atts['text_hover_color'] ) ) {
                $text_data['data-hover-color'] = $atts['text_hover_color'];
            }

            echo '<div ' . qode_framework_get_inline_style( $widget_styles ) . ' class="qodef-social-text">';

            for ( $n = 1; $n <= 4; $n ++ ) {
                $text   = ! empty( $atts[ 'social_text_' . $n ] ) ? $atts[ 'social_text_' . $n ] : '';
                $link   = ! empty( $atts[ 'social_link_' . $n ] ) ? $atts[ 'social_link_' . $n ] : '#';
                $target = ! empty( $atts[ 'social_link_target_' . $n ] ) ? $atts[ 'social_link_target_' . $n ] : '_self';

                if ( ! empty( $text ) ) {
                    echo '<a ' . qode_framework_get_inline_style($text_styles) . '  ' . qode_framework_get_inline_attrs( $text_data ) . ' href="' . esc_url($link) . '" target="' . esc_attr($target) . '" class="qodef-social-text-link">' . esc_html($text) . '</a>';
                }
            }

            echo '</div>';
        }
    }
}