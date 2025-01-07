<?php
add_action( 'wp_enqueue_scripts', 'enqueue_parent_theme_style' );
/**
 * Enqueue parent style function
 *
 * @return void
 */
function enqueue_parent_theme_style() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
}
