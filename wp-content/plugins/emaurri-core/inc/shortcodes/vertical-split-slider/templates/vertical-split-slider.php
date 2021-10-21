<div <?php qode_framework_class_attribute( $holder_classes ); ?>>
	<div class="ms-left">
		<?php
		foreach ( $items as $key => $item ) :
			$slide_image_styles = $this_object->get_slide_image_styles( $item );
			$slide_content_styles = $this_object->get_slide_content_styles( $item );
			$slide_data         = $this_object->get_slide_data( $item );
			?>
			<?php if ( 'image-left' === $item['slide_layout'] ) : ?>
				<div class="qodef-m-slide-image ms-section ms-table" <?php echo qode_framework_get_inline_attrs( $slide_data ); ?> <?php qode_framework_inline_style( $slide_image_styles ); ?>></div>
			<?php else : ?>
				<div class="qodef-m-slide-content ms-section ms-table" <?php echo qode_framework_get_inline_attrs( $slide_data ); ?> <?php qode_framework_inline_style( $slide_content_styles ); ?>>
					<div class="qodef-m-slide-content-holder">

						<?php
						if ( '0' !== $item['predefined_section'] ) {
							if ( qode_framework_is_installed( 'elementor' ) ) {
								$content = Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $item['predefined_section'] );
								echo do_shortcode( $content );
							}
						} else {
							if ( ! empty( $item['slide_content_image'] ) ) :
								?>
							<div class="qodef-m-slide-image-wrapper">
								<?php echo wp_get_attachment_image( $item['slide_content_image'], 'full', false, array( 'class' => 'qodef-m-image' ) ); ?>
								<?php
								endif;
							?>
							</div>
							<?php if ( ! empty( $item['slide_content_title'] ) ) : ?>
								<<?php echo esc_attr( $item['slide_content_title_tag'] ); ?> class="qodef-m-title">
									<?php echo esc_html( $item['slide_content_title'] ); ?>
								</<?php echo esc_attr( $item['slide_content_title_tag'] ); ?>>
							<?php endif; ?>

							<?php if ( ! empty( $item['slide_content_subtitle'] ) ) : ?>
								<div class="qodef-m-subtitle">
									<?php echo esc_html( $item['slide_content_subtitle'] ); ?>
								</div>
							<?php endif; ?>

							<?php if ( ! empty( $item['slide_content_text'] ) ) : ?>
								<p class="qodef-m-text"><?php echo wp_kses( nl2br( $item['slide_content_text'] ), array( 'br' => array() ) ); ?></p>
							<?php endif; ?>

							<?php
							if ( '' !== $item['slide_content_button_text'] ) {
								$button_params = array(
									'link'             => $item['slide_content_button_link'],
									'text'             => $item['slide_content_button_text'],
									'target'           => $item['slide_content_button_target'],
									'size'             => 'normal',
									'button_layout'    => 'outlined',
									'custom_class'     => 'qodef-m-button',
								);
								echo EmaurriCore_Button_Shortcode::call_shortcode( $button_params );
							}
							?>
					<?php } ?>
					</div>
				</div>
			<?php endif; ?>
		<?php endforeach; ?>
	</div><!-- .ms-left -->
	<div class="ms-right">
		<?php
		foreach ( $items as $key => $item ) :
			$slide_image_styles = $this_object->get_slide_image_styles( $item );
			?>
			<?php if ( 'image-right' === $item['slide_layout'] ) : ?>
				<div class="qodef-m-slide-image ms-section ms-table" <?php qode_framework_inline_style( $slide_image_styles ); ?>></div>
			<?php else : ?>
				<div class="qodef-m-slide-content ms-section ms-table" <?php qode_framework_inline_style( $slide_content_styles ); ?>>
					<div class="qodef-m-slide-content-holder">
						<?php
						if ( '0' !== $item['predefined_section'] ) {
							if ( qode_framework_is_installed( 'elementor' ) ) {
								$content = Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $item['predefined_section'] );
								echo do_shortcode( $content );
							}
						} else {

							if ( ! empty( $item['slide_content_image'] ) ) :
								echo wp_get_attachment_image( $item['slide_content_image'], 'full', false, array( 'class' => 'qodef-m-image' ) );
							endif;
							?>

							<?php if ( ! empty( $item['slide_content_title'] ) ) : ?>
								<<?php echo esc_attr( $item['slide_content_title_tag'] ); ?> class="qodef-m-title">
									<?php echo esc_html( $item['slide_content_title'] ); ?>
								</<?php echo esc_attr( $item['slide_content_title_tag'] ); ?>>
							<?php endif; ?>

							<?php if ( ! empty( $item['slide_content_subtitle'] ) ) : ?>
								<div class="qodef-m-subtitle">
									<?php echo esc_html( $item['slide_content_subtitle'] ); ?>
								</div>
							<?php endif; ?>

							<?php if ( ! empty( $item['slide_content_text'] ) ) : ?>
								<p class="qodef-m-text"><?php echo wp_kses( nl2br( $item['slide_content_text'] ), array( 'br' => array() ) ); ?></p>
							<?php endif; ?>

							<?php
							if ( '' !== $item['slide_content_button_text'] ) {
								$button_params = array(
									'link'             => $item['slide_content_button_link'],
									'text'             => $item['slide_content_button_text'],
									'target'           => $item['slide_content_button_target'],
									'size'             => 'normal',
									'button_layout'    => 'outlined',
									'custom_class'     => 'qodef-m-button',
								);
								echo EmaurriCore_Button_Shortcode::call_shortcode( $button_params );
							}
						}
						?>
					</div>
				</div>
			<?php endif; ?>
		<?php endforeach; ?>
	</div><!-- .ms-right -->
</div>
<div class="qodef-vss-responsive qodef-m">
	<?php
	foreach ( $items as $key => $item ) :
		$slide_image_styles = $this_object->get_slide_image_styles( $item );
		$slide_content_styles = $this_object->get_slide_content_styles( $item );
		?>
		<div class="qodef-m-slide-image" <?php qode_framework_inline_style( $slide_image_styles ); ?>></div>
		<div class="qodef-m-slide-content" <?php qode_framework_inline_style( $slide_content_styles ); ?>>
			<div class="qodef-m-slide-content-holder">
				<?php
				if ( '0' !== $item['predefined_section'] ) {
					if ( qode_framework_is_installed( 'elementor' ) ) {
						$content = Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $item['predefined_section'] );
						echo do_shortcode( $content );
					}
				} else {
					if ( ! empty( $item['slide_content_image'] ) ) :
						echo wp_get_attachment_image( $item['slide_content_image'], 'full', false, array( 'class' => 'qodef-m-image' ) );
					endif;
					?>

					<?php if ( ! empty( $item['slide_content_title'] ) ) : ?>
						<<?php echo esc_attr( $item['slide_content_title_tag'] ); ?> class="qodef-m-title">
							<?php echo esc_html( $item['slide_content_title'] ); ?>
						</<?php echo esc_attr( $item['slide_content_title_tag'] ); ?>>
					<?php endif; ?>

					<?php if ( ! empty( $item['slide_content_subtitle'] ) ) : ?>
						<div class="qodef-m-subtitle">
							<?php echo esc_html( $item['slide_content_subtitle'] ); ?>
						</div>
					<?php endif; ?>

					<?php if ( ! empty( $item['slide_content_text'] ) ) : ?>
						<p class="qodef-m-text"><?php echo wp_kses( nl2br( $item['slide_content_text'] ), array( 'br' => array() ) ); ?></p>
					<?php endif; ?>

					<?php
					if ( '' !== $item['slide_content_button_text'] ) {
						$button_params = array(
							'link' => $item['slide_content_button_link'],
							'text' => $item['slide_content_button_text'],
							'target' => $item['slide_content_button_target'],
							'size' => 'normal',
							'button_layout' => 'outlined',
							'custom_class' => 'qodef-m-button',
						);
						echo EmaurriCore_Button_Shortcode::call_shortcode( $button_params );
					}
				}
				?>
			</div>
		</div>
	<?php endforeach; ?>
</div>
