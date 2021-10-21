<?php
$static_title_tag = isset( $static_title_tag ) && ! empty( $static_title_tag ) ? $static_title_tag : 'h2';

if ( ! empty ( $static_title ) ) { ?>
    <<?php echo esc_attr( $static_title_tag ); ?> class="qodef-e-static-title">
        <?php echo esc_html( $static_title ); ?>
    </<?php echo esc_attr( $static_title_tag ); ?>>
<?php }
