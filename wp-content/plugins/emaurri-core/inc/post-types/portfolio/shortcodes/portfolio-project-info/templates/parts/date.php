<?php
$date       = get_the_time( get_option( 'date_format' ), $project_id );

if ( ! empty( $date ) ) { ?>
    <div class="qodef-e-date"><?php echo esc_html( $date ); ?></div>
<?php }