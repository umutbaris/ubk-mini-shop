<?php
/*
 * WordPress only looks for PHP files right inside the mu-plugins
 * directory, and (unlike for normal plugins) not for files in
 * subdirectories. Therefor we create a proxy PHP loader file inside the
 * mu-plugins directory.
 *
 * @see http://codex.wordpress.org/Must_Use_Plugins
 */

/**
 * Let admins include their
 */
// if ( defined( 'WP_ENVIRONMENT' ) && 'dev' === strtolower( WP_ENVIRONMENT ) ) {
// 	$dev = SRCPATH . 'dev/dev.php';
// 	if ( file_exists( $dev ) ) {
// 		include $dev;
// 	}
// }

array_map( function( $plugin ) {
	require WPMU_PLUGIN_DIR . $plugin;
}, array(
	'/advanced-custom-fields/acf.php',
    '/json-api/json-api.php'
	) 
);
