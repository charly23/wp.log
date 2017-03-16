<?php
/**
 * functions and definitions
 *
 * This file contains the essential and mostly updated functions and definitions
 * The stable modules, that are not updated upon a new site implementation are moved
 * to the core files
 *
 * Core File Definitions:
 * @see includes/jeen-core-functions.php	- core functions and definitions must be stored here
 * @see includes/jeen-core-hooks.php		- actions and filters must be stored here
 */

/*****************************************************************
 * GLOBAL SETTINGS
 *****************************************************************
 * Global Variable declaration block
 *
 */
define('TEMPLATE_URL', get_bloginfo('template_url'));
define('TEMPLATE_DIR', get_template_directory());
define('BLOG_NAME', get_bloginfo('name'));
define('SITE_URL', get_bloginfo('url'));
define('S_NO_IMAGE', TEMPLATE_URL.'/images/noimage.gif');
$titan_custom_post_types = array();

/**
 * Include Exam Core Files
 */
require_once('includes/exam-core-functions.php');
require_once('includes/exam-core-hooks.php');

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 960;
}

/**
 * Add the Exam Woocommerce Functions if plugin is activated
 */

if ( ! function_exists( 'exam_setup' ) ) {
	/**
	 * Intitiate Exam Theme Essential Configurations
	 *
	 * @added This theme styles the visual editor with editor-style.css to match the theme style
	 * @added This theme uses post thumbnails
	 * @added Image Sizes, to be used in various part of the sites
	 * @registered 3 Nav menus, Primary, Footer Top (usually used for mid menus), Footer Bottom
	 *
	 */
	function exam_setup() {
		add_editor_style();
		add_theme_support( 'post-thumbnails' );
        add_image_size('services-icons', 104, 104, false);
        add_image_size('membership-image', 197, 119, false);
        add_image_size('slick-banner-slide', 1800, 520, true);
        add_image_size('page-featured-image', 340, 270, true);
		
		register_nav_menus( array(
			'primary' => __( 'Primary Navigation', 'jeen' ),
			'footer-nav' => __( 'Footer Top Navigation', 'jeen' ),
			'footer-nav-b' => __( 'Footer Bottom Navigation', 'jeen' )
		) );
	}
}

/**
 * This function will enqueue the scripts and styles to be added in the theme
 */
function exam_enqueue_script() {

	// check the last parameter, dependencies. Eg. Array(‘jquery’) means this script requires jquery and wp will load jquery first before loading this script
	// this can make sure that the scripts are included in the right order and reduce javascript erros.
	wp_enqueue_script( 'jquery-fancybox', TEMPLATE_URL.'/js/jquery.fancybox.pack.js', array('jquery'), '',true );
	wp_enqueue_script( 'jquery-fancybox-media', TEMPLATE_URL.'/js/jquery.fancybox-media.js', array('jquery'), '',true );
	wp_enqueue_script( 'jquery-cycle', TEMPLATE_URL.'/js/jquery.cycle.js', array('jquery'), '',true );
	wp_enqueue_script( 'bootstrap-js', TEMPLATE_URL.'/js/bootstrap.min.js', array('jquery'), '',true );
	wp_enqueue_script( 'slick-js', TEMPLATE_URL.'/js/slick.min.js', array('jquery'), '',true );
	wp_enqueue_script( 'slickvav-js', TEMPLATE_URL.'/js/jquery.slicknav.min.js', array('jquery'), '',true );
	wp_enqueue_script( 'read-more-js', TEMPLATE_URL.'/js/jquery.read.slide.more.js', array('jquery'), '',true );
	wp_enqueue_script( 'jeen-theme-script', TEMPLATE_URL.'/js/scripts.js', array('jquery'), '1.0', true );


	// styles to be enqueued upon the load of the theme
	wp_enqueue_style( 'jeen-normalize', TEMPLATE_URL.'/css/normalize.css' );
	wp_enqueue_style( 'jquery.fancybox', TEMPLATE_URL.'/css/jquery.fancybox.css' );
	wp_enqueue_style( 'bootstrap-css', TEMPLATE_URL.'/css/bootstrap.min.css' );
	wp_enqueue_style( 'jeen-style', TEMPLATE_URL.'/css/style.css' );
}

if ( ! function_exists( 'exam_widgets_init' ) ) {
	/**
	 * Register widgetized areas, including two sidebars and two widget-ready columns in the footer.
	 *
	 * To override jeen_widgets_init() in a child theme, remove the action hook and add your own
	 * function tied to the init hook.
	 */
	function exam_widgets_init() {
		// First Widget Area
		register_sidebar( array(
			'name' => __( 'First Widget Area', 'jeen' ),
			'id' => 'first-widget-area',
			'description' => __( 'The first widget area', 'jeen' ),
			'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>'
		) );
		
		register_sidebar( array(
			'name' => __( 'Header Contact Number', 'jeen' ),
			'id' => 'header-contact-number',
			'description' => __( 'The header contact number', 'jeen' ),
			'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>'
		) );
		
		register_sidebar( array(
			'name' => __( 'Contact Page Number', 'jeen' ),
			'id' => 'contact-page-number',
			'description' => __( 'The contact page number', 'jeen' ),
			'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>'
		) );
		register_sidebar( array(
			'name' => __( 'Featured Widget', 'jeen' ),
			'id' => 'featured-widget',
			'description' => __( 'The featured widget area', 'jeen' ),
			'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>'
		) );
		register_sidebar( array(
			'name' => __( 'Banner Widget', 'jeen' ),
			'id' => 'banner-widget',
			'description' => __( 'The banner widget area', 'jeen' ),
			'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>'
		) );
		register_sidebar( array(
			'name' => __( 'Footer Content Widget', 'jeen' ),
			'id' => 'footer-content-widget',
			'description' => __( 'The footer content widget', 'jeen' ),
			'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>'
		) );
	}
}

if ( !function_exists( 'exam_register_rc' ) ) {
	/**
	 * Initiation for the Custom Post types used by the Jeen Theme is declared here
	 *
	 * @use $a_types for easy declaration.  Setup the array based on the pattern indicated by the Banner Custom Post Type
	 */
	function exam_register_rc() {
		global $titan_custom_post_types;
		
		$a_types = array(
				/**
				 * Declare Banner Custom Post Type ( Use this as the template for declaration )
				 *
				 * @optoinal slug
				 * @optional supports
				 */
				array(
						'the_type'	=> 'banner-slide',
						'single'	=> 'Banner',
						'plural'	=> 'Banners',
						'slug'		=> ''
						// 'supports'	=> ''
				)
				
		);

		foreach ($a_types as $a_type) {
			// This will merge the defaults and the passed data
			$a_type = wp_parse_args($a_type, array(
				'the_type'		=> '',
				'single'		=> '',
				'plural'		=> '',
				'slug'			=> '',
				'supports'		=> array('title','editor','thumbnail','page-attributes'),
				'has_archive'	=> false
			));

			$a_labels = array(
					'name' 					=> _x($a_type['plural'], 'post type general name'),
					'singular_name' 		=> _x($a_type['single'], 'post type singular name'),
					'add_new' 				=> _x('Add New', $a_type['single']),
					'add_new_item' 			=> __('Add New ' . $a_type['single']),
					'edit_item' 			=> __('Edit ' . $a_type['single']),
					'new_item' 				=> __('New ' . $a_type['single']),
					'view_item' 			=> __('View ' . $a_type['single']),
					'search_items' 			=> __('Search ' . $a_type['plural']),
					'not_found' 			=>  __('No ' . $a_type['plural'] . ' found'),
					'not_found_in_trash'	=> __('No ' . $a_type['plural'] . ' found in Trash')
			);

			$a_rewrite = array(
					'slug'                => $a_type['slug'],
					'with_front'          => true,
					'pages'               => true,
					'feeds'               => true
			);

			$a_args = array(
					'labels' 		=> $a_labels,
					'public' 		=> true,
					'has_archive' 	=> $a_type['has_archive'],
					'rewrite'       => $a_rewrite,
					'supports' 		=> $a_type['supports']
			);

			register_post_type($a_type['the_type'], $a_args);
			$titan_custom_post_types[] = $a_type['the_type'];
		}
	}
}

// REGISTER CUSTOM TAXONOMIES
	function register_taxonomies()  {

		$a_taxonomies = array(
			// Genres
			array(
				// Custom post type name that you want to have an category
				"the_type"			=> "news-list",
				"the_taxonomies"	=> "news_categories",
				"single"			=> "News Category",
				"plural"			=> "News Categories",
				"root_slug"			=> "news_categories",
			)
		);

		foreach ($a_taxonomies as $a_taxonomy) {
			$s_the_type = $a_taxonomy["the_type"];
			$s_the_taxonomies = $a_taxonomy["the_taxonomies"];
			$s_single = $a_taxonomy["single"];
			$s_plural = $a_taxonomy["plural"];
			$s_root_slug = $a_taxonomy["root_slug"];

			$a_labels = array(
				'name'                       => _x( $s_plural, 'Taxonomy General Name', 'text_domain' ),
				'singular_name'              => _x( $s_single, 'Taxonomy Singular Name', 'text_domain' ),
				'menu_name'                  => __( $s_plural, 'text_domain' ),
				'all_items'                  => __( 'All '.$s_plural, 'text_domain' ),
				'parent_item'                => __( 'Parent '.$s_single, 'text_domain' ),
				'parent_item_colon'          => __( 'Parent '.$s_single.':', 'text_domain' ),
				'new_item_name'              => __( 'New '.$s_single.' Name', 'text_domain' ),
				'add_new_item'               => __( 'Add New '.$s_single, 'text_domain' ),
				'edit_item'                  => __( 'Edit '.$s_single, 'text_domain' ),
				'update_item'                => __( 'Update '.$s_single, 'text_domain' ),
				'separate_items_with_commas' => __( 'Separate '.strtolower($s_plural).' with commas', 'text_domain' ),
				'search_items'               => __( 'Search '.strtolower($s_plural), 'text_domain' ),
				'add_or_remove_items'        => __( 'Add or remove '.strtolower($s_plural), 'text_domain' ),
				'choose_from_most_used'      => __( 'Choose from the most used '.strtolower($s_plural), 'text_domain' ),
			);

			$a_rewrite = array(
				'slug'                       => $s_root_slug,
				'with_front'                 => true,
				'hierarchical'               => true,
			);

			$a_args = array(
				'labels'                     => $a_labels,
				'hierarchical'               => true,
				'public'                     => true,
				'show_ui'                    => true,
				'show_admin_column'          => true,
				'show_in_nav_menus'          => true,
				'show_tagcloud'              => true,
				'rewrite'                    => $a_rewrite,
			);

			register_taxonomy( $s_the_taxonomies, $s_the_type, $a_args );

		} // end of foreach

} // end of function register_taxonomies
	
// Hook into the 'init' action
add_action( 'init', 'register_taxonomies', 1 );
	
?>