<?php
/**
 * For more info: https://developer.wordpress.org/themes/basics/theme-functions/
 *
 */

// WP Head and other cleanup functions
require_once(get_template_directory().'/functions/cleanup.php');

// Register scripts and stylesheets
require_once(get_template_directory().'/functions/enqueue-scripts.php');

// Register custom menus and menu walkers
require_once(get_template_directory().'/functions/menus.php');

// ACF
require_once(get_template_directory().'/functions/acf.php');

// Add functions to this file that are only for this specific test install
require_once(get_template_directory().'/functions/site.php');

?>
