<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package SKT Charity
 */
?>
<div id="footer-wrapper">
    	<div class="container">
             <div class="cols-3 widget-column-1">
             <div class="columnfix"> 
             <h5><?php echo get_theme_mod('contact_title',__('Contact Info','skt-charity')); ?></h5>                   
                   <p><?php echo get_theme_mod('contact_add',__('100 King St, Melbourne PIC 4000,<br /> Australia','skt-charity')); ?></p>
              <div class="phone-no"><?php echo get_theme_mod('contact_no',__('<strong>Phone:</strong> +123 456 7890','skt-charity')); ?> <br  />
           <strong> <?php esc_attr_e('Email:','skt-charity');?></strong>
           <a href="mailto:<?php echo sanitize_email(get_theme_mod('contact_mail','contact@company.com')); ?>"><?php echo esc_attr(get_theme_mod('contact_mail','contact@company.com')); ?></a></div>
           
           <div class="clear"></div>                
                  <div class="social-icons">
					<?php if ( get_theme_mod('fb_link') != "") { ?>
                    <a title="facebook" class="fb" target="_blank" href="<?php echo esc_url(get_theme_mod('fb_link','#facebook')); ?>"></a> 
                    <?php } else { ?>
                    <?php echo '<a href="#" target="_blank" class="fb" title="facebook"></a>'; } ?>
                    
                    <?php if ( get_theme_mod('twitt_link') != "") { ?>
                    <a title="twitter" class="tw" target="_blank" href="<?php echo esc_url(get_theme_mod('twitt_link','#twitter')); ?>"></a>
                    <?php } else { ?>
                    <?php echo '<a href="#" target="_blank" class="tw" title="twitter"></a>'; } ?> 
                    
                    <?php if ( get_theme_mod('gplus_link') != "") { ?>
                    <a title="google-plus" class="gp" target="_blank" href="<?php echo esc_url(get_theme_mod('gplus_link','#gplus')); ?>"></a>
                    <?php } else { ?>
                    <?php echo '<a href="#" target="_blank" class="gp" title="google-plus"></a>'; } ?>
                    
                    <?php if ( get_theme_mod('linked_link') != "") { ?> 
                    <a title="linkedin" class="in" target="_blank" href="<?php echo esc_url(get_theme_mod('linked_link','#linkedin')); ?>"></a>
                    <?php } else { ?>
                    <?php echo '<a href="#" target="_blank" class="in" title="linkedin"></a>'; } ?>
                  </div> 
                   </div> 
            </div><!--end .widget-column-1-->   
              
                      
               <div class="cols-3 widget-column-2">
                <div class="columnfix"> 
                   <h5><?php echo get_theme_mod('about_title',__('About Charity','skt-charity')); ?></h5>            	
				<p><?php echo get_theme_mod('about_description',__('Donec ut ex ac nulla pellentesque mollis in a enim. Praesent placerat sapien mauris, vitae sodales tellus venenatis ac. Suspendisse suscipit velit id ultricies auctor. <br /> <br />Egestas et erat a, vehicula interdum augue Donec ut ex ac nulla pellentesque mollis in a enim. Praesent placerat sapien mauris.','skt-charity')); ?></p>             
                     </div>
                </div><!--end .widget-column-3-->
                
                <div class="cols-3 widget-column-3">
                 <div class="columnfix"> 
                <h5><?php echo get_theme_mod('social_title',__('Latest Posts','skt-charity')); ?></h5>  
                 <?php $args = array( 'posts_per_page' => 2, 'post__not_in' => get_option('sticky_posts'), 'orderby' => 'date', 'order' => 'desc' );
                    query_posts( $args ); ?>
                  <?php while ( have_posts() ) :  the_post(); ?>
                  	<div class="recent-post">
                    
                    <a href="<?php the_permalink(); ?>">
                    <?php if ( has_post_thumbnail() ) { $src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'thumbnail' );   $thumbnailSrc = $src[0]; ?>
                        <img src="<?php echo $thumbnailSrc; ?>" alt="" width="60" height="auto" ><?php } 
                    else { ?>
                        <img src="<?php echo esc_url( get_template_directory_uri()); ?>/images/img_404.png" width="60"  />
                    <?php } ?></a>
					<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    <span><?php echo the_author_link(); ?> &nbsp; | &nbsp; <?php echo get_the_date(); ?></span>
                    </div>
                    <?php endwhile; ?>
                    <?php wp_reset_query(); ?>
                   </div>
                </div><!--end .widget-column-4-->
            <div class="clear"></div>
        </div><!--end .container-->
        <div class="copyright-wrapper">
        <div class="container">
            	<div class="copyright-txt"><?php esc_attr_e('&copy; 2016','skt-charity');?> <?php bloginfo('name'); ?>. <?php esc_attr_e('All Rights Reserved', 'skt-charity');?></div>
                <div class="design-by"><?php printf('<a href="'.esc_url(SKT_URL).'" rel="nofollow" target="_blank">SKT WordPress Themes</a>' ); ?></div>
            </div>
            <div class="clear"></div>
        </div>
    </div>
<?php wp_footer(); ?>

</body>
</html>