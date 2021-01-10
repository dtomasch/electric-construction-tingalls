<?php



//The default wordpress head is a mess. Let's clean it up by removing all the junk we don't need.
function joints_head_cleanup() {
	// Remove category feeds
	remove_action( 'wp_head', 'feed_links_extra', 3 );
	// Remove post and comment feeds
	remove_action( 'wp_head', 'feed_links', 2 );
	// Remove EditURI link
	remove_action( 'wp_head', 'rsd_link' );
	// Remove Windows live writer
	remove_action( 'wp_head', 'wlwmanifest_link' );
	// Remove index link
	remove_action( 'wp_head', 'index_rel_link' );
	// Remove previous link
	remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
	// Remove start link
	remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
	// Remove links for adjacent posts
	remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
	// Remove WP version
	remove_action( 'wp_head', 'wp_generator' );
} /* end Joints head cleanup */


//  Remove crap we don't need
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'wp_generator' );
remove_action( 'wp_head', 'start_post_rel_link' );
remove_action( 'wp_head', 'index_rel_link' );
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10);
remove_action( 'wp_head', 'wp_shortlink_wp_head' );
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );
remove_action( 'wp_head', 'feed_links_extra', 3 );
remove_action( 'set_comment_cookies', 'wp_set_comment_cookies' );


// —————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————
// —————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————
//
//
// Disable Emoji
//
//
// —————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————
// —————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————

/**
 * Disable the emoji's
 */
function disable_emojis() {
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );

	// Remove from TinyMCE
	add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
}
add_action( 'init', 'disable_emojis' );

/**
 * Filter out the tinymce emoji plugin.
 */
function disable_emojis_tinymce( $plugins ) {
	if ( is_array( $plugins ) ) {
		return array_diff( $plugins, array( 'wpemoji' ) );
	} else {
		return array();
	}
}




// —————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————
// —————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————
//
//
// Disable Gutenberg
//
//
// —————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————
// —————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————

// Alternative
// Fully Disable Gutenberg editor.
add_filter('use_block_editor_for_post_type', '__return_false', 10);
// Don't load Gutenberg-related stylesheets.
add_action( 'wp_enqueue_scripts', 'remove_block_css', 100 );
function remove_block_css() {
wp_dequeue_style( 'wp-block-library' ); // WordPress core
wp_dequeue_style( 'wp-block-library-theme' ); // WordPress core
wp_dequeue_style( 'wc-block-style' ); // WooCommerce
wp_dequeue_style( 'storefront-gutenberg-blocks' ); // Storefront theme
}


// —————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————
// —————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————
//
//
// *** Fully Remove Comments ***
// Add to functions.php
//
//
// —————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————
// —————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————

/** Disable support for comments and trackbacks in post types. */
function df_disable_comments_post_types_support() {
	$post_types = get_post_types();
	foreach ( $post_types as $post_type ) {
		if ( post_type_supports( $post_type, 'comments' ) ) {
			remove_post_type_support( $post_type, 'comments' );
			remove_post_type_support( $post_type, 'trackbacks' );
		}
	}
}
add_action( 'admin_init', 'df_disable_comments_post_types_support' );
/** Close comments on the front-end. */
function df_disable_comments_status() {
	return false;
}
add_filter( 'comments_open', 'df_disable_comments_status', 20, 2 );
add_filter( 'pings_open', 'df_disable_comments_status', 20, 2 );
/** Hide existing comments.
 *
 * @since 1.2
 *
 * @param string $comments Being the comments.
 */
function df_disable_comments_hide_existing_comments( $comments ) {
	$comments = array();
	return $comments;
}
add_filter( 'comments_array', 'df_disable_comments_hide_existing_comments', 10, 2 );
/** Remove comments page in menu. */
function df_disable_comments_admin_menu() {
	remove_menu_page( 'edit-comments.php' );
}
add_action( 'admin_menu', 'df_disable_comments_admin_menu' );
/** Redirect any user trying to access comments page. */
function df_disable_comments_admin_menu_redirect() {
	global $pagenow;
	if ( 'edit-comments.php' === $pagenow ) {
		wp_redirect( admin_url() );
		exit;
	}
}
add_action( 'admin_init', 'df_disable_comments_admin_menu_redirect' );
/** Remove comments metabox from dashboard. */
function df_disable_comments_dashboard() {
	remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'normal' );
}
add_action( 'admin_init', 'df_disable_comments_dashboard' );
/** Remove comments links from admin bar. */
function df_disable_comments_admin_bar() {
	if ( is_admin_bar_showing() ) {
		remove_action( 'admin_bar_menu', 'wp_admin_bar_comments_menu', 60 );
	}
}
add_action( 'init', 'df_disable_comments_admin_bar' );


// —————————————————————————————————————————————————————————————————————————————
// —————————————————————————————————————————————————————————————————————————————
//
//
// *** Remove Image Linking ***
//
//
// —————————————————————————————————————————————————————————————————————————————
// —————————————————————————————————————————————————————————————————————————————

function lj_imagelink_setup() {
	$image_set = get_option( 'image_default_link_type' );

	if ($image_set !== 'none') {
		update_option('image_default_link_type', 'none');
	}
}
add_action('admin_init', 'lj_imagelink_setup');
