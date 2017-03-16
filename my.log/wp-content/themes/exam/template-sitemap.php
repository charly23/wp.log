<?php get_header(); ?>
<div class="main-content">
	<div id="sub-page" class="main-sub-page">
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		<h1 class="page-title"><?php the_title(); ?></h1>
		<?php the_content(); ?>
	<?php endwhile; else: ?>

	<?php endif; ?>
	</div>
</div>
<?php get_footer(); ?>