<?php
/**
 * Archive: Habitacion CPT
 * Redirects /habitaciones/ to the styled Habitaciones page template.
 */

// Try to find a page using the Habitaciones template
$pages = get_posts([
    'post_type'   => 'page',
    'meta_key'    => '_wp_page_template',
    'meta_value'  => 'template-habitaciones.php',
    'numberposts' => 1,
    'post_status' => 'publish',
]);

if ( ! empty($pages) ) {
    wp_redirect( get_permalink($pages[0]->ID), 301 );
    exit;
}

// Fallback: try slug 'habitaciones'
$page = get_page_by_path('habitaciones');
if ( $page && $page->post_status === 'publish' ) {
    wp_redirect( get_permalink($page->ID), 301 );
    exit;
}

// Last resort: render template directly
include( get_template_directory() . '/template-habitaciones.php' );
exit;
