<?php

if ( ! function_exists( 'emaurri_core_add_footer_logo_widget' ) ) {
	/**
	 * function that add widget into widgets list for registration
	 *
	 * @param array $widgets
	 *
	 * @return array
	 */
	function emaurri_core_add_footer_logo_widget( $widgets ) {
		$widgets[] = 'EmaurriCore_Footer_Logo_Widget';

		return $widgets;
	}

	add_filter( 'emaurri_core_filter_register_widgets', 'emaurri_core_add_footer_logo_widget' );
}

if ( class_exists( 'QodeFrameworkWidget' ) ) {
	class EmaurriCore_Footer_Logo_Widget extends QodeFrameworkWidget {

		public function map_widget() {
			$this->set_base( 'emaurri_core_footer_logo' );
			$this->set_name( esc_html__( 'Emaurri Footer Logo', 'emaurri-core' ) );
			$this->set_widget_option(
				array(
					'field_type' => 'text',
					'name'       => 'widget_title',
					'title'      => esc_html__( 'Title', 'emaurri-core' ),
				)
			);

			$this->set_widget_option(
				array(
					'field_type' => 'image',
					'name'       => 'image',
					'title'      => esc_html__( 'Logo Image', 'emaurri-core' ),
				)
			);

			$this->set_widget_option(
				array(
					'field_type' => 'text',
					'name'       => 'logo_height',
					'title'      => esc_html__( 'Logo Holder Height', 'emaurri-core' ),
				)
			);

			$this->set_widget_option(
				array(
					'field_type' => 'text',
					'name'       => 'logo_image_height',
					'title'      => esc_html__( 'Logo Image Height', 'emaurri-core' ),
				)
			);

			$this->set_widget_option(
				array(
					'field_type' => 'text',
					'name'       => 'top_margin',
					'title'      => esc_html__( 'Logo Top Margin', 'emaurri-core' ),
				)
			);

			$this->set_widget_option(
				array(
					'field_type' => 'text',
					'name'       => 'border_offset',
					'title'      => esc_html__( 'Border Left Offset', 'emaurri-core' ),
				)
			);

			$this->set_widget_option(
				array(
					'field_type' => 'text',
					'name'       => 'link',
					'title'      => esc_html__( 'Logo Link', 'emaurri-core' ),
				)
			);

			$this->set_widget_option(
				array(
					'field_type' => 'select',
					'name'       => 'target',
					'title'      => esc_html__( 'Logo Link Target', 'emaurri-core' ),
					'options'       => emaurri_core_get_select_type_options_pool( 'link_target', false ),
					'default_value' => '_self',
				)
			);
		}

		public function render( $atts ) { ?>

			<?php
			$style = array();
			$image_style = array();
			$offset = '';

			if ( '' !== $atts['top_margin'] ) {
				$style[] = 'margin-top: ' . $atts['top_margin'];
			}
			if ( '' !== $atts['logo_height'] ) {
				$style[] = 'height: ' . $atts['logo_height'];
			}

			$style = implode( '; ', $style );

			if ( '' !== $atts['logo_image_height'] ) {
				$image_style[] = 'height: ' . $atts['logo_image_height'];
			}

			$image_style = implode( '; ', $image_style );

			if ( '' !== $atts['border_offset'] ) {
				$offset = 'transform: translateX(' . $atts['border_offset'] . ')';
			}

			$link = $atts['link'];
			$target = $atts['target'];

			?>
			<div class="qodef-footer-logo" <?php echo qode_framework_get_inline_style( $style ); ?>>
				<div class="qodef-footer-logo-image"  <?php echo qode_framework_get_inline_style( $image_style ); ?>>
					<?php if ( ! empty( $link ) ) : ?>
						<a itemprop="url" href="<?php echo esc_url( $link ); ?>" target="<?php echo esc_attr( $target ); ?>">
					<?php endif; ?>
						<?php echo wp_get_attachment_image( $atts['image'], 'full' ); ?>
					<?php if ( ! empty( $link ) ) : ?>
						</a>
					<?php endif; ?>
				</div>
				<div class="qodef-footer-logo-border" <?php echo qode_framework_get_inline_style( $offset ); ?>></div>
			</div>
			<?php
		}
	}
}
