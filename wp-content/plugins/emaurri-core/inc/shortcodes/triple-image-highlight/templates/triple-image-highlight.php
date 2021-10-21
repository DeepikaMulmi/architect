<div <?php qode_framework_class_attribute( $holder_classes ); ?>>
    <div class="qodef-e-holder">
        <div class="qodef-e-inner">
            <?php 
                $images = array('center', 'left', 'right');
            ?>
            <?php foreach ( $images as $image ) { ?>
                <div class="qodef-e-image-holder qodef--<?php echo esc_attr( $image ); ?>">
                    <?php if ( ! empty( ${ $image . '_link' } ) ) { ?>
                        <a class="qodef-e-link"
                            href="<?php echo esc_url( ${ $image . '_link' } ) ?>"
                            target="<?php echo esc_attr( $target ) ?>">
                        </a>
                    <?php } ?>
                    <img class="qodef-e-image--<?php echo esc_attr( $image ) ?>"
                        src="<?php echo wp_get_attachment_url( ${ $image . '_image' } ); ?>"
                        alt="<?php echo get_the_title( ${ $image . '_image' } ) ?>" />
                </div>
            <?php } ?>
        </div>
        <div class="qodef-left-trigger"></div>
        <div class="qodef-right-trigger"></div>
    </div>

	<?php
	if ( 'yes' === $navigation_enabled ) {
		?>

	<div class="qodef-left-arrow"><?php echo emaurri_core_get_svg_icon( 'pagination-arrow-left' ); ?></div>
	<div class="qodef-right-arrow"><?php echo emaurri_core_get_svg_icon( 'pagination-arrow-left' ); ?></div>
		<?php
	}
	?>
</div>
