<?php 
    get_header(); 
?>
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
        
		
		<div class="front-main">
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> 
                   <?php the_content(); ?>
                   
                   <div class="projects-fields">
                        
                        <table id="projects-loop">
                            
                            </tr>
                            
                                <?php
                                     
                                     $labels = get_field_object( 'projects' );
                                     if( $subs = $labels['sub_fields'] ) :
                                         
                                         foreach( $subs as $subl ) :
                                ?>             
                                          <td class="labels"><?php echo __( $subl['label'], 'fields' ); ?></td>
                                          
                                <?php endforeach; endif; ?>
                                
                            </tr>
                            
                            <?php
                                
                                if( $fields = get_field( 'projects' ) ) :
                                
                                    foreach( $fields as $field ) :
                            ?>
                                          <tr>
                                             <td class="values"><?php echo __( $field['name'], 'fields' ); ?></td>
                                             <td class="values"><?php echo __( $field['owner'], 'fields' ); ?></td>
                                             <td class="values"><?php echo __( $field['prime_contractor'], 'fields' ); ?></td>
                                             <td class="values"><?php echo __( $field['timeline'], 'fields' ); ?></td>
                                             <td class="values"><?php echo __( $field['work_responsibilities'], 'fields' ); ?></td>
                                          </tr>
                            
                            <?php        
                                    endforeach;
                                
                                endif;
                            
                            ?>
                        
                        </table>
                   
                   </div>
                   
                </div>
			</div>
		</div>
		
	<?php endwhile; else: ?>

	<?php endif; ?>
	</div>
</div>
<?php get_footer(); ?>