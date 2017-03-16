<?php
	/*
		Template Name: News
	*/
	get_header(); 
?>
<div class="main-content">
	<div id="sub-page" class="main-sub-page">
	<?php
		if ( have_posts() ) {
			while ( have_posts() ) {
				the_post();
				echo '<h1 class="page-title">'.get_the_title().'</h1>';
				the_content();
			}
		}
	?>

	<?php
		$i_paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		$a_args	=	array(
			'post_type' => 'news-list',
			'posts_per_page' => 4,
			'paged' => $i_paged
		);
		$o_query = new WP_Query( $a_args );
	?>
		<div class="clearfix">
			<?php
				while ( $o_query->have_posts() ) {
					$o_query->the_post();
			?>
				<div class="clearfix">
					<div class="left">
					<?php
						if(has_post_thumbnail()) {
							the_post_thumbnail('thumbnail');
						} else {
					?>
							<img src="<?php echo S_NO_IMAGE;?>" alt="<?php the_title()?>" width="150" height="150"/>
					<?php }?>
					</div>
					<div class="left relative">
						<h3 ><?php the_title(); ?></h3>
						<div class="news-content">
							<div class="news-date"><?php echo get_the_time('m.d.Y'); ?></div>
							<div class="news-content"><?php echo ShortenText(strip_tags(get_the_content()),300); ?></div>
							<div class="news-link"><a href="<?php echo get_permalink(); ?>">Read More</a></div>
						</div>
					</div>
				</div>
			<?php } ?>
		</div>
		<div class="titan-pagination">
			<?php
				$a_args = array(	
					'base' 			=> str_replace( 999999, '%#%', esc_url( get_pagenum_link( 999999 ) ) ), // 99999 is used since the function get_pagenum_link() only accepts integer as param
					'current' 		=> max( 1, $i_paged ),
					'total' 		=> $o_query->max_num_pages,
					'prev_text' 	=> 'Prev',
					'next_text' 	=> 'Next',
					'type'			=> 'list',
					'end_size'		=> 3,
					'mid_size'		=> 3
				);
				echo paginate_links( apply_filters( 'jeen_pagination_args', $a_args ) );
				wp_reset_postdata();
			?>
		</div>
	</div>
</div> <!-- main-content -->
<?php get_footer(); ?>