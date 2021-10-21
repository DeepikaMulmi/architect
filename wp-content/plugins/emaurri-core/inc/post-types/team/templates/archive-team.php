<?php

get_header();

$params            = array();
$params['content'] = 'shortcode';

// Include cpt content template
emaurri_core_template_part( 'post-types/team', 'templates/content', '', $params );

get_footer();
