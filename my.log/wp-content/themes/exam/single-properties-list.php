<?php 
    get_header(); 
?>
<style type="text/css">
table tr td {
    padding-right: 20px;
}
.back-button {
    margin-bottom: 15px;
}
.back-button a {
    background: #e1bd44;
    color: #fff;
    display: inline-block;
    padding: 5px;
    padding-left: 15px;
    padding-right: 15px;
}
</style>
<div class="main-content">
	<div id="sub-page" class="main-sub-page clearfix">
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		<div class="page-title-wrap">
            <h1 class="page-title-entry"><?php the_title(); ?></h1>
            <?php			
					$breadcrumb = array(
						'delimiter'		=> '<span class="breadcrumb-arrow"> / </span>',
						'wrap_before'	=> '<div class="jeen-breadcrumb" >',
						'wrap_after'	=> '</div>',
						'before'		=> '',
						'after'			=> '',
						'home'			=> 'Home', // home label of the loaded page
						//'taxonomy'		=> 'service_categories', // taxonomy of the loaded page
						// 'post_type'		=> 'POST_TYPE', // post type of the loaded page
						'root'			=> '', // root label of the loaded page
						'root_slug'		=> '' // root slug of the loaded page
					);
						
					echo jeen_breadcrumbs($breadcrumb);	
				?>
             <div class="extra-space"></div>   
        </div>
        
		<div class="back-button">
            <a href="/">Back to Home</a>
        </div>
        
        
        
        <?php the_content(); ?>
	<?php endwhile; else: ?>

	<?php endif; ?>
	</div>
</div>
<?php get_footer(); ?>