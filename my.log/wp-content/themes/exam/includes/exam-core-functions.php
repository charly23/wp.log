<?php
/**
 * Jeen Core Functions
 *
 * Stable modules are stored here
 * Stable means that no alteration of the module is needed for it to work
 */

/*****************************************************************
 * JEEN CUSTOM FUNCTIONS
 *****************************************************************
 *
 * Shorten the text and add a postfix
 *
 * @param1 String 	- Content to be shortened
 * @param2 Integer 	- Limit of characters to be returned
 * @param3 String 	- postfix (default: '...')
 *
 * @return String
 */
function ShortenText($text, $chars_limit = 10 , $after = "..." ) {
	$chars_text = strlen($text);
	$text = $text." ";
	$text = substr($text,0,$chars_limit);
	$text = substr($text,0,strrpos($text,' '));
	/* $text = strip_tags($text); */
	if ($chars_text > $chars_limit) { $text = $text.$after; }
	return $text;
}

/**
 * Google maps titan shortcode to fix W3C Error
 *
 * @param1 Array	- Short code attributes
 *
 * @return String	- HTML iFrame of the Google Maps
 */
function exam_google_map( $atts ) {
	if ( empty( $atts ) ) return;

	extract(shortcode_atts(array(
		'address' => ''
	), $atts));

	$s_src = 'https://maps.google.com/maps?iwloc=near&amp;output=embed&amp;q=' . urlencode($address);
	$s_iframe = '<iframe src="' . $s_src . '"></iframe>';

	return $s_iframe;
}

/**
 *
 * New breadcrumb to replace dimox breadcrumb 
 *
 * @param 	Array 	contains the attributes to be used in creating breadcrumbs
 * 
 * Note: Breadcrumb Structure Pattern {Home}/{Custom Root Slug}/{Page Post type Root Slug to heirarchy Page Post type}/{taxonomy parent to heirarchy taxonomy}/{custom post to heirarchy custom post} | {Media Attachment} | {Date (Year/Month/Day)} | {Tags} | {Error 404} | {Search item} | {Author}
**/
function exam_breadcrumbs($a_args = '') {
	$a_defaults = array(
		'delimiter'		=> '<span>&#47;</span>',
		'wrap_before'	=> '<div class="jeen-breadcrumb" >',
		'wrap_after'	=> '</div>',
		'before'		=> '',
		'after'			=> '',
		'home'			=> 'home',
		'taxonomy'		=> '',
		'parent_root_slug'		=> ''
	);
	$a_args = wp_parse_args( $a_args, $a_defaults );
	extract($a_args, EXTR_SKIP);

	$queried_object = get_queried_object();

	$s_breadcrumbs = '';

	if ( ( ! is_home() && ! is_front_page() ) ) {
		$s_breadcrumbs = $wrap_before;

		// check if home argument is set and add home link if set
		if ( !empty( $home ) ) {

			$a_args=array(
				'url' 		=> home_url(),
				'label' 	=> $home,
				'before' 	=> $before,
				'after' 	=> $after,
				'delimiter' => $delimiter
			);

			$s_breadcrumbs .= createBreadcrumbLink( $a_args );
		}

		// check if has root page in the breadcrumb and add root page link
		if ( !empty( $root ) && !empty($root_slug) ) {

			$a_args=array(
				'url' 		=> home_url().'/'.$root_slug,
				'label' 	=> $root,
				'before' 	=> $before,
				'after' 	=> $after,
				'delimiter' => $delimiter
			);

			$s_breadcrumbs .= createBreadcrumbLink( $a_args );
		}

		// if has slug rewrite define and if root page is not a subpage
		if(!empty($parent_root_slug)) {

			$o_parent_page = get_custom_parent_page($parent_root_slug);

			if( $o_parent_page ) {
				$a_args=array(
					'url' 		=> get_permalink($o_parent_page->ID),
					'label' 	=> $o_parent_page->post_title,
					'before' 	=> $before,
					'after' 	=> $after,
					'delimiter' => $delimiter
				);

				$s_breadcrumbs .= createBreadcrumbLink( $a_args );
			}
		}

		// check if custom taxonomy archive page is being displayed
		if( is_tax() || is_category()) {
			$s_term_id = (get_query_var( 'cat' )) ? get_query_var( 'cat' ) : $queried_object->term_id;
			$s_taxonomy = (get_query_var( 'taxonomy' )) ? get_query_var( 'taxonomy' ) : 'category';
			$a_ancestors = get_ancestors( $s_term_id, $s_taxonomy );
			if(count($a_ancestors)>1){
				$a_ancestors = array_reverse( $a_ancestors );
			}

			foreach ( $a_ancestors as $i_ancestor ) {
				$o_ancestor = get_term( $i_ancestor, $s_taxonomy );

				$a_args=array(
					'url' 		=> get_term_link( $o_ancestor->slug, $s_taxonomy ),
					'label' 	=> $o_ancestor->name,
					'before' 	=> $before,
					'after' 	=> $after,
					'delimiter' => $delimiter
				);

				$s_breadcrumbs .= createBreadcrumbLink( $a_args );
			}

			$s_current_label = (get_query_var('category_name')) ? esc_html(get_query_var('category_name')) : esc_html($queried_object->name);

			
		}  elseif ( (is_single() && !is_attachment()) || is_page()) {
			if($i_assigned_page_id = get_option('titan_'.get_post_type())) {
				$a_args = array(
					'parent_id'	=> $i_assigned_page_id,
					'delimiter'	=> $delimiter,
					'before'	=> $before,
					'after'		=> $after
				);
				$s_breadcrumbs .= page_walker($a_args);
			}
			else {
				// get posts rewrite slug heirarchy tree
				$o_post_type = get_post_type_object( get_post_type() );
				
				if(!empty($slug)) {
					$slug = $o_post_type->rewrite['slug'];
					$a_args=array(
						'name' => $slug,
						'post_type' => 'page',
						'post_status' => 'publish',
						'numberposts' => 1
					);
					
					$a_parent_page = get_custom_parent_page($slug);

					if($a_parent_page) {
						$a_args = array(
							'parent_id'	=> $a_parent_page->ID,
							'delimiter'	=> $delimiter,
							'before'	=> $before,
							'after'		=> $after
						);

						$s_breadcrumbs .= page_walker($a_args);
					}
				}
			}
			

			if(!empty($taxonomy)) {
				// get post taxonomy/category heirarchy tree
				if ( $terms = wp_get_post_terms( $queried_object->ID, $taxonomy, array( 'orderby' => 'parent', 'order' => 'DESC' ) ) ) { // check if current post type belongs to a custom taxonomy and gets its tree links

					$main_term = $terms[0];
					$a_ancestors = get_ancestors( $main_term->term_id, $taxonomy );
					if(count($a_ancestors)>1){
						$a_ancestors = array_reverse( $a_ancestors );
					}

					// add the parent term to $a_ancestors
					array_push($a_ancestors, $main_term->term_id);

					foreach ( $a_ancestors as $i_ancestor ) {
						$o_ancestor = get_term( $i_ancestor, $taxonomy );

						$a_args=array(
							'url' 		=> get_term_link( $o_ancestor->slug, $taxonomy ),
							'label' 	=> $o_ancestor->name,
							'before' 	=> $before,
							'after' 	=> $after,
							'delimiter' => $delimiter
						);

						$s_breadcrumbs .= createBreadcrumbLink( $a_args );
					}

				}
			}
			
			// get posts heirarchy tree
			$a_args = array(
				'parent_id'	=> $queried_object->post_parent,
				'delimiter'	=> $delimiter,
				'before'	=> $before,
				'after'		=> $after
			);

			$s_breadcrumbs .= page_walker($a_args);

			$s_current_label = esc_html(get_the_title());

		} elseif ( is_tag() ) { // checks if page is tag page and add to breadcrumb
			$s_current_label = 'Posts tagged &ldquo;' . $queried_object->name . '&rdquo;';

		} elseif ( is_year() ) { // check if page is loading year archive page and add year link to it (e.g add this pattern to url baseurl()/2012)

			$s_current_label =  get_the_time('Y');

		} elseif ( is_month() ) { // check if page is loading month archive page and add month link to it (e.g add this pattern to url baseurl()/2012/12)
			
			// get year link
			$a_args=array(
				'url' 		=> get_year_link(get_the_time('Y')),
				'label' 	=> get_the_time('Y'),
				'before' 	=> $before,
				'after' 	=> $after,
				'delimiter' => $delimiter
			);

			$s_breadcrumbs .= createBreadcrumbLink( $a_args );

			$s_current_label =  get_the_time('F');

		} elseif ( is_day() ) { // check if page is loading day archive page and add day link to it (e.g add this pattern to url baseurl()/2012/12/12)

			// get year link
			$a_args=array(
				'url' 		=> get_year_link(get_the_time('Y')),
				'label' 	=> get_the_time('Y'),
				'before' 	=> $before,
				'after' 	=> $after,
				'delimiter' => $delimiter
			);

			$s_breadcrumbs .= createBreadcrumbLink( $a_args );

			// get month link
			$a_args=array(
				'url' 		=> get_month_link(get_the_time('Y'),get_the_time('m')),
				'label' 	=> get_the_time('F'),
				'before' 	=> $before,
				'after' 	=> $after,
				'delimiter' => $delimiter
			);

			$s_breadcrumbs .= createBreadcrumbLink( $a_args );			

			$s_current_label =  get_the_time('d');

		}  elseif ( is_author() ) { // checks if page is author page and add to breadcrumb

			$userdata = get_userdata($author);
			$s_current_label = 'Author:' . ' ' . $userdata->display_name;

		} elseif ( is_attachment() ) { // checks if page is loading media and add to breadcrumb

			$s_current_label = esc_html(get_the_title());

		} elseif ( is_search() ) {  // checks if page is search page and add to breadcrumb

			$s_current_label = 'Search results for &ldquo;' . get_search_query() . '&rdquo;';

		} elseif ( is_404() ) {  // checks if page is page 404 and add to breadcrumb
			
			$s_current_label = 'Error 404';

		}

		$s_breadcrumbs .= $before .'<span class="current">'. $s_current_label .'</span>'. $after. $wrap_after;
		
		return $s_breadcrumbs;
	}
}

// create breadcrumb link
function createBreadcrumbLink( $a_args = array() ) {
	$s_url 			= esc_url($a_args['url']);
	$s_label 		= esc_html($a_args['label']);
	$s_before 		= $a_args['before'];
	$s_after 		= $a_args['after'];
	$s_delimiter 	= $a_args['delimiter'];

	return $s_before. '<a href="'.$s_url.'">'.$s_label.'</a>'.$s_after.$s_delimiter;
}

// get the parent root slug post object
function get_custom_parent_page($s_parent_slug){
	$a_args=array(
			'name' => $s_parent_slug,
			'post_type' => 'page',
			'post_status' => 'publish',
			'numberposts' => 1
	);
	$a_posts = get_posts($a_args);
	
	if( $a_posts )
		return $a_posts[0];
	else
		return FALSE;
}

function page_walker($a_args){

	$a_page_htree	= array();
	$i_parent_id	= $a_args['parent_id'];
	$s_breadcrumbs 	= '';
	
	// get the heirarchy tree of the post
	while ( $i_parent_id ) {
		$o_page = get_page( $i_parent_id );
		$a_page_htree[] = $o_page->ID;
		$i_parent_id  = $o_page->post_parent;
	}

	$a_page_htree = array_reverse( $a_page_htree );

	foreach ( $a_page_htree as $i_pageid ){

		$a_args=array(
			'url' 		=> get_permalink($i_pageid),
			'label' 	=> get_the_title( $i_pageid),
			'before' 	=> $a_args['before'],
			'after' 	=> $a_args['after'],
			'delimiter' => $a_args['delimiter']
		);

		$s_breadcrumbs .= createBreadcrumbLink( $a_args );

	}

	return $s_breadcrumbs;
}


/**
 * This function will register all the Jeen Custom Post Types to the settings group to be used in the Settings page
**/
function register_exam_custom_post_settings() {
	global $jeen_custom_post_types;
	
	foreach($jeen_custom_post_types as $post_type) {
		register_setting( 'jeen-custom-post-settings-group', 'jeen_'.$post_type );
	}
}

/**
 * This function will pull up the content of the Settings Page.
**/
function titan_custom_post_settings_contents() {
	require_once('content_custom_post_settings.php');
}

/**
 * This function will register the Settings Page to the menu
**/
function exam_custom_post_settings_page() {
	global $jeen_custom_post_types;
	
	if($jeen_custom_post_types) {
		add_options_page (
			'Jeen Custom Posts',
			'Jeen Custom Posts',
			'manage_options',
			'jeen_custom_post_settings',
			'jeen_custom_post_settings_contents'
		);
	
		add_action( 'admin_init', 'register_jeen_custom_post_settings' );
	}
}

?>