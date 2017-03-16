<?php 
    get_header(); 
?>

<div class="main-content">
	<div id="sub-page" class="main-sub-page clearfix">
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        
        <?php if( get_the_ID() == 10 ) : ?>
    
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
         
		<div class="front-main">
			<div class="row">
            
				<div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
                     <?php the_content(); ?>
                </div>
                
				<div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                
                           <div class="services-slideshow-wrap">
                                <div class="services-slideshow">
                                     <?php
                                        $links = get_field( 'slideshow' );
                                            
                                            foreach( $links as $link ) {
                                            
                                            $slideshow_image = $link['image']['sizes']['page-featured-image'];
                                                                                   
                                     ?>
                                            <div class="services_slide">
                                                <img src="<?php echo $slideshow_image; ?>" />
                                            </div>
                                            
                                      <?php } ?>      
                                </div>
                           </div> 
                
                     <!-- <div class="sidebar-tabs"> 
                     
                         <ul class="sidebar-tabs__wrap">
                         
                             <?php
                                  
                                  $wp_query = new WP_Query();
                                  $wp_pages = $wp_query->query( array( 'post_type' => 'page','post_parent' => get_the_ID(), 'orderby' => 'menu_order', 'order' => 'ASC' ) );
                                
                                  if( $wp_pages ) : foreach( $wp_pages as $wp_page ) :
                                          
                             ?>    
                                      
                                      <li class="sidebar-tabs__item">
                                          <a href="<?php echo __( get_permalink( $wp_page->ID ) ); ?>" class="">
                                               <?php echo __( get_the_title( $wp_page->ID ) ); ?>
                                          </a>
                                      </li>
                                      
                             <?php endforeach; endif; ?>
                             
                         </ul>
                     
                     </div> -->
                     
                </div>
			</div>
		</div>
		
	<?php endif; 
    
    endwhile; else: ?>

	<?php endif; ?>
	</div>
</div>
<?php get_footer(); ?>