<?php
/**
 * Titan Core Hooks
 *
 * add_action, add_filters are added here that is always used by the Titan Themes
 */

/**
 * Tell WordPress to run titan_setup() when the 'after_setup_theme' hook is run.
 *
 * @see jeen_setup()
 */
add_action( 'after_setup_theme', 'exam_setup' );

/**
 * Register sidebars.
 *
 * @see jeen_widgets_init()
 */
add_action( 'widgets_init', 'exam_widgets_init' );

/**
 * Add hook to initiate Custom Post Types
 * Set priority to avoid plugin conflicts
 *
 * @see jeen_register_rc()
 */
add_action('init', 'exam_register_rc', 1);

/**
 * This function will enqueue the scripts and styles to be added in the theme
 *
 * @see jeen_enqueue_script()
 */
add_action( 'wp_enqueue_scripts', 'exam_enqueue_script' );

/**
 * Google maps titan shortcode to fix W3C Error
 *
 * @see jeen_google_map()
 */
add_shortcode( 'exam_google_map', 'exam_google_map' );

/**
 * Unregister junk hooks in wp_head
 */
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'feed_links', 2);
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'feed_links_extra', 3);
remove_action('wp_head', 'start_post_rel_link', 10, 0);
remove_action('wp_head', 'parent_post_rel_link', 10, 0);
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0);


/**
 * This hook will register the Settings Page for the Titan Custom Post Types
 *
 * @see jeen_custom_post_settings_page() @ jeen-core-functions.php
 */
add_action( 'admin_menu', 'exam_custom_post_settings_page' );

?>