<div <?php qode_framework_class_attribute( $holder_classes ); ?>>
	<div class="qodef-m-content qodef--desktop" <?php qode_framework_inline_style( $content_styles ); ?>>
		<?php if ( 'custom-link' === $image_action && ! empty( $link ) ) { ?>
			<a itemprop="url" href="<?php echo esc_url( $link ); ?>" target="<?php echo esc_attr( $target ); ?>">
		<?php } ?>
			<div class="qodef-m-image qodef-image--original" <?php qode_framework_inline_style( $image_styles ); ?>></div>
			<div class="qodef-m-image qodef-image--copy" <?php qode_framework_inline_style( $copy_image_styles ); ?>></div>
		<?php if ( 'custom-link' === $image_action && ! empty( $link ) ) { ?>
			</a>
		<?php } ?>
	</div>
	<div class="qodef-m-content qodef--mobile" <?php qode_framework_inline_style( $mobile_content_styles ); ?>>
		<?php if ( 'custom-link' === $image_action && ! empty( $link ) ) { ?>
			<a itemprop="url" href="<?php echo esc_url( $link ); ?>" target="<?php echo esc_attr( $target ); ?>">
		<?php } ?>
			<div class="qodef-m-image qodef-image--original" <?php qode_framework_inline_style( $mobile_image_styles ); ?>></div>
			<div class="qodef-m-image qodef-image--copy" <?php qode_framework_inline_style( $mobile_copy_image_styles ); ?>></div>
		<?php if ( 'custom-link' === $image_action && ! empty( $link ) ) { ?>
			</a>
		<?php } ?>
	</div>
</div>
