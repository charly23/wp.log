<?php
if( is_front_page() ) {
	$pageClass = 'front-page';
} else {
	$pageClass = 'sub-page';
}
?>
<!DOCTYPE html >
<html <?php language_attributes(); ?>>

<head>
<!--[if !IE]><!--><script type="text/javascript">if (/*@cc_on!@*/false) { document.documentElement.className+='ie10 ie'; }</script><!--<![endif]-->
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
<meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE" />

<title><?php
	/*Print the <title> tag based on what is being viewed.*/
	global $page, $paged;

	wp_title( '|', true, 'right' );
	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		echo bloginfo('name')." $site_description";
    } else {
        echo bloginfo('name')." $site_description";
    }
	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'jeen' ), max( array($paged, $page) ) );
	?></title>

<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<link rel="shortcut icon" href="<?php bloginfo('template_url'); ?>/images/favicon2.png" type="image/x-icon" />
<link rel="icon" href="<?php bloginfo('template_url'); ?>/images/favicon2.png" type="image/x-icon"/>
<link rel="apple-touch-icon" href="<?php bloginfo('template_url'); ?>/images/appleicon.png"/>

<?php wp_head(); ?>

</head>
<?php flush(); ?>
<body <?php body_class( $pageClass ); ?> itemscope itemtype="http://schema.org/WebPage">

<!--[if lte IE 6]>
<div id="ie6alert">
	<div><strong>Your browser (Internet Explorer 6) is no longer supported.</strong>
		<p>IE6 has since been superceded twice. Please upgrade to any of these free browsers</p>
		<ul>
			<li><a href="http://www.getfirefox.com" title="Firefox">Firefox</a></li>
			<li><a href="http://www.google.com/chrome" title="Chrome">Chrome</a></li>
			<li><a href="http://www.apple.com/safari/" title="Safari">Safari</a></li>
			<li><a href="http://www.microsoft.com/windows/internet-explorer/" title="Internet Explorer">Internet Explorer</a></li>
			<li><a href="http://www.google.com/chromeframe?prefersystemlevel=true" title="Google Chrome Frame">Google Chrome Frame</a></li>
		</ul>
	</div>
</div>
<![endif]-->

<div class="outer-wrapper">
	<div class="outer-pad">

		<div id="header" class="header-wrapper">
            
            <div class="overlay-white-left"></div>
			<div class="header-pad container global-width global-width-helper">

				<div class="logo-wrapper col-lg-8 col-md-8 col-sm-12 col-xs-12">
					<div id="logo" class="logo">
						<a href="<?php echo get_home_url(); ?>" title="<?php bloginfo('name'); ?>">
                            <img src="<?php bloginfo('template_url'); ?>/images/logo.png" alt="<?php bloginfo('name'); ?>" />
                        </a>
                        <span id="slogan" class="slogan">
                            <img src="<?php bloginfo('template_url'); ?>/images/slogan.png" alt="<?php bloginfo('name'); ?>" />
                        </span>
					</div>
				</div>

				<div class="headermenu col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="headermenu-inner">No fee to present your case</div>
                    <div class="headermenu-inner">Choose from lawyers in your area</div>
                    <div class="headermenu-inner">A 100% confidential service</div>
				</div>

			</div>
            
		</div>

        <?php if( is_front_page() ) { ?>
            <div class="lawyer-wrapper">
                <div class="lawyer-pad container global-width global-width-helper">

                   <h1>Find a Lawyer for your Legal Issue</h1> 

                   <div class="lawyer-inner_left col-lg-7 col-md-7 col-sm-12 col-xs-12">

                        <h2>Fast, Free and Confidential</h2>

                        <label>Enter Zip Code or City:</label>
                        <div class="lawyer-inner_selectbox input1">
                            <input type="text" name="enter-zip" class="enter-zip" id="enter-zip" value="Does not have to where you live" />
                            <div class="input1-div" id="input1-div"></div>
                        </div>

                        <label>Choose a category:</label>
                        <div class="lawyer-inner_selectbox input2">
                            <span class="select-lawyer" id="select-lawyer" name="select-lawyer">Click to choose a legal category</span>
                            <div class="input2-div" id="input2-div">
                                <?php

                                    $category = array ( 
                                        'Family',
                                        'Criminal Defense',
                                        'Business',
                                        'Personal Injury',
                                        'Bankruptcy & Finances',
                                        'Products & Services',
                                        'Employment', 
                                        'Real Estate',
                                        'Immigration',
                                        'Wills, Trusts & Estates',
                                        'Government',
                                        'Intellectual Property' 
                                    );

                                    foreach( $category as $categorys ) :
                                ?>
                                    <div class="category-items"> 
                                        <?php echo $categorys; ?>
                                    </div>    
                                <?php
                                    endforeach;
                                ?>

                            </div>
                        </div>

                        <div class="lawyer-category">
                            Can't find your category? 
                            <a href="#category_load" class="lawyer-category_content" id="lawyer-category_content">
                                Click here.
                            </a>
                            <div id="category_load" class="category_load">
                                <div class="category_load-title">Whick <span>Family Law</span> issue(s) apply to your case?</div>
                                <div class="category_load-items">
                                    <?php
                                        $more_category = array ( 
                                            'Adoptions',
                                            'Child Support',
                                            'Guardianship',
                                            'Separations',
                                            'Child Custody',
                                            'Divorce',
                                            'Paternity', 
                                            'Spousal Support or Alimony'
                                        );

                                        foreach( $more_category as $more_categorys ) :
                                    ?>
                                             <div class="more_category-items col-lg-6 col-md-6 col-sm-12 col-xs-12"> 
                                                <?php echo $more_categorys; ?>
                                            </div>    
                                    <?php
                                        endforeach;
                                    ?>
                                </div>
                                <div class="category_load-submit">
                                    <a href"#find">Find a Lawyer Now</a>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="lawyer-inner_right col-lg-5 col-md-5 col-sm-12 col-xs-12">

                        <h2>Clients review LegalMatch Lawyers</h2>

                        <div class="lawyer-review_wrap">
                            <?php
                                $fields = get_field( 'lawyers', get_the_ID() );

                                if ( $fields ) : 

                                    $end = end( $fields );

                                    foreach( $fields as $key => $value ) :

                                    $is_last = $end['name'] == $value['name'] ? 'last-item' : null;
                                    $is_star = intval( $value['stars'] );
                            ?>

                                <div class="lawyer-review_item <?php echo $is_last; ?>">
                                    <div class="lawyer-review_left col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                        <img src="<?php echo $value['photo']; ?>" />
                                        <span class="name"><?php echo $value['name']; ?></span>
                                        <span class="location"><?php echo $value['location']; ?></span>
                                    </div>
                                    <div class="lawyer-review_right col-lg-9 col-md-9 col-sm-12 col-xs-12">
                                        <span class="position <?php echo __( 'star' . $is_star, 'star_count' ); ?>"><?php echo $value['type']; ?></span>
                                        <span class="description">"<?php echo $value['description']; ?>"</span>
                                        <a href="#review<?php echo $key; ?>" class="read-review fancy-content">Read Review</a>
                                    </div>
                                    <div class="review<?php echo $key; ?>" id="review<?php echo $key; ?>" style="display: none;">
                                        <div class="review-title">Client Review</div>
                                        <div class="review-inner">
                                            <div class="review-inner_left col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                                <img src="<?php echo $value['photo']; ?>" />
                                            </div>
                                            <div class="review-inner_right col-lg-9 col-md-9 col-sm-12 col-xs-12">
                                                <span class="name"><?php echo ( $value['name'] ); ?></span>
                                                <span class="location"><?php echo $value['location']; ?></span>
                                                <span class="type"><?php echo $value['type']; ?></span>
                                            </div>
                                            <div class="review-rating">
                                                <span class="rating-title">Rating</span>
                                                <span class="rating-count review-stars<?php echo $value['rating']; ?>"">(<?php echo $value['rating']; ?> users)</span>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            <?php
                                endforeach; 
                                endif;
                            ?>
                        </div>
                    </div>

                </div>
            </div>
		<?php } ?>

        <?php if( is_front_page() ) { ?>
        	 <div class="banner-wrapper">
    			<div class="banner-pad">
    
    				<div id="banner" class="banner-wrap">
    					<div class="banner banner-slide">
    						<?php
    							$a_args = array(
    								'post_type'			=> 'banner-slide',
    								'orderby'			=> 'menu_order',
    								'order'				=> 'ASC',
    								'posts_per_page'	=> 8,
    								'meta_key'			=> '_thumbnail_id'
    							);
    							$a_posts = get_posts( $a_args );
    
    							foreach( $a_posts as $o_post ) {
    							//$page_link = get_field( 'page_link', $o_post->ID);
    						?>
    							<div class="banner-slide-item">
    								<?php	
    									if( is_front_page() ) {
    									
    										if ( has_post_thumbnail($o_post->ID) ) { 
    											echo get_the_post_thumbnail($o_post->ID,'slick-banner-slide' , array('alt' => the_title_attribute('echo=0'),'title' =>the_title_attribute('echo=0'))); 
    										} 
    									
    									}
    								?>
    								<div class="banner-content">
    									<div class="banner-content-pad container global-width global-width-helper">
    										<div class="banner-title valign-parent">
    											<div class="valign-item"><?php echo get_the_title( $o_post->ID ); ?></div>
    											<div class="valign-helper"></div>
    										</div>
    									</div>
    								</div>
    							</div>
    						<?php 
    							}
    						?>
    					</div>
    				</div>
    
    			</div>
    		</div>
        <?php } ?>

		<div class="mid-wrapper">
			<div class="mid-pad container global-width global-width-helper">

				<div id="content" class="content-wrapper">
					<div class="content-pad">

						<div class="content <?php echo $pageClass; ?>">