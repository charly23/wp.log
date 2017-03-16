<?php get_header(); ?>
<div class="main-content">
	<div id="sub-page" class="main-sub-page">
		<div id="sub-page" class="main-sub-page search-results-page">
		<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'titan' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
		
		<?php 
			if(have_posts()) {
				// Start the Loop
				while ( have_posts() ) {
					// set up global post variable
					the_post();
		?>
			<div class="clearfix margin-bottom-30">
				<div class="left">
					<h3 class="margin-bottom-10"><?php echo get_the_title()?></h3>
					<div>
						<div><?php echo get_the_time('m.d.Y'); ?></div>
						<div><?php echo ShortenText(strip_tags(get_the_content()),300); ?></div>
						<div class="find-more"><a href="<?php echo get_permalink(); ?>">Read More</a></div>
					</div>
				</div>
			</div>
		<?php 
			}
		?>	
		<div class="titan-pagination">
		<?php
			global $wp_query;

			$a_args = array(	
				'base' 			=> str_replace( 999999, '%#%', esc_url( get_pagenum_link( 999999 ) ) ), // 99999 is used since the function get_pagenum_link() only accepts integer as param
				'current' 		=> max( 1, get_query_var('paged') ),
				'total' 		=> $wp_query->max_num_pages,
				'prev_text' 	=> 'Prev',
				'next_text' 	=> 'Next',
				'type'			=> 'list',
				'end_size'		=> 3,
				'mid_size'		=> 3
			);
			echo paginate_links( apply_filters( 'jeen_pagination_args', $a_args ) );
		?>	
		</div>
		<?php	
		} else {
		?>
		<p>No items available.</p>
		<?php } ?>
	</div>
	</div>
</div>
<?php get_footer(); ?>