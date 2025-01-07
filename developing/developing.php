<?php
/**
 * Plugin Name: Developing WordPress
 * Plugin URI: https://github.com/pbrocks/docker-wp-2025
 * Description: A folder in repository mapped to <code>/plugins</code> folder in Docker container creates WordPress plugin.
 * Author: The API Guys
 * Author URI: https://github.com/pbrocks
 * Version: 0.7.1
 * Text Domain: docker-wp-2025
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! defined( 'WP_DOCKER_PLUGIN_BASE' ) ) {
	// in main plugin file
	define( 'WP_DOCKER_PLUGIN_BASE', __FILE__ );
}

add_action( 'init', 'docker_wp_2025_functionality_init', 1 );
/**
 * Initializes the Keap Connect plugin functionality.
 *
 * This function dynamically loads all PHP files from the 'includes' and 'classes'
 * directories to add functionality for the plugin. These files can contain
 * classes, functions, or any necessary logic for the plugin to work.
 *
 * @return void
 */
function docker_wp_2025_functionality_init() {
	// Include all PHP files in the /includes directory
	if ( file_exists( __DIR__ . '/includes' ) && is_dir( __DIR__ . '/includes' ) ) {
		foreach ( glob( __DIR__ . '/includes/*.php' ) as $filename ) {
			require $filename;
		}
	}

	// Include all PHP files in the /includes/classes directory
	if ( file_exists( __DIR__ . '/includes/classes' ) && is_dir( __DIR__ . '/includes/classes' ) ) {
		foreach ( glob( __DIR__ . '/includes/classes/*.php' ) as $filename ) {
			require $filename;
		}
	}
}
