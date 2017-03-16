<?php get_header(); ?>
	<div id="sub-page" class="main-content main-sub-page">
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		<h1 class="page-title"><?php the_title(); ?></h1>
		<?php the_content(); ?>
		<div class="contact-wrapper">
			<div class="section-pad-wrapper">
				<div class="contact-form">
					<div class="section-pad-wrappper">
					<?php gravity_form('Contact Us', false, false); ?>
					</div>
				</div>
				<div class="contact-info">
					<div class="google-maps">
						<?php
							jeen_google_map();
						?>
					</div>
					<div class="contact-details">
						<?php if ( is_active_sidebar( 'contact-page-number' ) ) : ?>
							<div class="contact-info">
								<?php dynamic_sidebar( 'contact-page-number' ); ?>
							</div>
						<?php endif; ?>
					</div> <!-- contact-details -->
				</div> <!-- contact-info -->
			</div>
		</div> <!-- contact-wrapper -->
	<?php endwhile; else: ?>

	<?php endif; ?>
	</div> <!-- main-content -->
<?php get_footer(); ?>