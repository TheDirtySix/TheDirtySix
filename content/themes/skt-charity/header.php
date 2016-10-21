<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div class="container">
 *
 * @package SKT Charity
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php wp_head(); ?>
</head>

<body <?php body_class(''); ?>>
  <div class="headertop">
     <div class="container">     
        <div class="widget-left">
             <?php if ( ! dynamic_sidebar( 'header-info-left' ) ) : ?>
                 <div class="headerinfo">
                   <?php if( get_theme_mod('header_phone', '+123 456 7890') ) { ?>
                    <span class="phoneno"><?php echo esc_html(get_theme_mod('header_phone', '+123 456 7890', 'skt-charity')); ?></span>
                  <?php } ?>
                  <?php if( get_theme_mod('header_address', '1600 Amphitheatre Parkway Mountain View, CA 94043') ) { ?>
                    <span class="address"><?php echo esc_html(get_theme_mod('header_address', '1600 Amphitheatre Parkway Mountain View, CA 94043', 'skt-charity')); ?></span>
                  <?php } ?>                 
                 </div>                 
            <?php endif; // end sidebar widget area ?>     
       </div><!--widget-left-->

            <div class="widget-right">
               <?php if(!dynamic_sidebar('header-info-right')): ?>
                 <div class="headerinfo">               
				  <?php if ( get_theme_mod('donate_link') != "") { ?> 
                     <a class="heart" href="<?php echo esc_url(get_theme_mod('donate_link','#')); ?>"><?php esc_attr_e('Donate','skt-charity'); ?></a>
                    <?php } else { ?>
                     <a class="heart" href="<?php echo esc_url('#');?>"><?php esc_attr_e('Donate','skt-charity'); ?></a>
                   <?php } ?>
                   
                   <?php if ( get_theme_mod('volunteer_link') != "") { ?> 
                     <a class="user" href="<?php echo esc_url(get_theme_mod('volunteer_link','#')); ?>"><?php esc_attr_e('Become a Volunteer','skt-charity'); ?></a>
                    <?php } else { ?>
                     <a class="user" href="<?php echo esc_url('#');?>"><?php esc_attr_e('Become a Volunteer','skt-charity'); ?></a>
                   <?php } ?>
                 </div> 
                <?php endif; ?>
            </div><!--widget-right-->
         <div class="clear"></div>     
    </div>
  </div><!-- .end headertop -->
	<?php 
  		$hideslide = get_theme_mod('hide_slider', '1');
	?>  
  <div <?php if($hideslide != ''){ ?>style="position:relative !important; background-color: rgba(0, 0, 0, 1) !important;"<?php } ?> class="header <?php if ( ! is_front_page() ) { ?>innerheader<?php } ?>">
        <div class="container">
            <div class="logo">
			<?php skt_charity_the_custom_logo(); ?>
            <h1><a href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a></h1>
            <p><?php bloginfo('description'); ?></p>
            </div><!-- logo -->
            <div class="header_right"> 
             <div class="toggle">
                <a class="toggleMenu" href="<?php esc_url('#');?>"><?php esc_attr_e('Menu','skt-charity'); ?></a>
             </div><!-- toggle --> 
             <div class="sitenav">
                    <?php wp_nav_menu(array('theme_location' => 'primary')); ?>
             </div><!-- site-nav -->
            <div class="clear"></div>
          </div><!-- header_right -->
          <div class="clear"></div>
        </div><!-- container -->
  </div><!--.header -->
<?php if ( is_front_page() && is_home() ) { ?>

<?php if($hideslide == ''){ ?>
<!-- Slider Section -->
<?php for($sld=7; $sld<10; $sld++) { ?>
<?php if( get_theme_mod('page-setting'.$sld)) { ?>
<?php $slidequery = new WP_query('page_id='.get_theme_mod('page-setting'.$sld,true)); ?>
<?php while( $slidequery->have_posts() ) : $slidequery->the_post();
$image = wp_get_attachment_url( get_post_thumbnail_id($post->ID));
$img_arr[] = $image;
$id_arr[] = $post->ID;
endwhile;
}
}
?>
<?php if(!empty($id_arr)){ ?>
<section id="home_slider">
<div class="slider-wrapper theme-default">
<div id="slider" class="nivoSlider">
	<?php 
	$i=1;
	foreach($img_arr as $url){ ?>
    <?php if(!empty($url)){ ?>
    <img src="<?php echo $url; ?>" title="#slidecaption<?php echo $i; ?>" />
    <?php }else{ ?>
    <img src="<?php echo esc_url( get_template_directory_uri() ) ; ?>/images/slides/default-slide.jpg" title="#slidecaption<?php echo $i; ?>" />
    <?php } ?>
    <?php $i++; }  ?>
</div>   
<?php 
$i=1;
foreach($id_arr as $id){ 
$title = get_the_title( $id ); 
$post = get_post($id); 
$content = apply_filters('the_content', substr(strip_tags($post->post_content), 0, 150)); 
?>                 
<div id="slidecaption<?php echo $i; ?>" class="nivo-html-caption">
<div class="slide_info">
<h2><?php echo $title; ?></h2>
<?php echo $content; ?>
<a class="ReadMore" href="<?php the_permalink(); ?>"><?php esc_attr_e('Donate Now!', 'skt-charity');?></a>
</div>
</div>      
<?php $i++; } ?>       
 </div>
<div class="clear"></div>        
</section>
<?php } else { ?>
<section id="home_slider">
<div class="slider-wrapper theme-default">
    <div id="slider" class="nivoSlider">
    <img src="<?php echo esc_url( get_template_directory_uri() ) ; ?>/images/slides/slider1.jpg" alt="" title="#slidecaption1" />
    <img src="<?php echo esc_url( get_template_directory_uri() ) ; ?>/images/slides/slider2.jpg" alt="" title="#slidecaption2" />
    <img src="<?php echo esc_url( get_template_directory_uri() ) ; ?>/images/slides/slider3.jpg" alt="" title="#slidecaption3" />
    </div>                    
      <div id="slidecaption1" class="nivo-html-caption">
        <div class="slide_info">
                <h2><?php esc_html_e('We Need Your Support to Accommodate, Feed and Educate.','skt-charity'); ?></h2>
                <p><?php esc_html_e('Nunc sed lorem pretium, volutpat tortor id, adipiscing sem. Sed bibendum quis augue nec porta. Ut molestie tortor pulvinar, faucibus justo...','skt-charity'); ?></p>
                <a class="ReadMore" href="<?php the_permalink(); ?>"><?php esc_html_e('Donate Now!', 'skt-charity');?></a>
        </div>
        </div>
        
        <div id="slidecaption2" class="nivo-html-caption">
            <div class="slide_info">
                   <h2><?php esc_html_e('We Need Your Support to Accommodate, Feed and Educate.','skt-charity'); ?></h2>
                <p><?php esc_html_e('Nunc sed lorem pretium, volutpat tortor id, adipiscing sem. Sed bibendum quis augue nec porta. Ut molestie tortor pulvinar, faucibus justo...','skt-charity'); ?></p>
                <a class="ReadMore" href="<?php the_permalink(); ?>"><?php esc_html_e('Donate Now!', 'skt-charity');?></a>
            </div>
        </div>
        
        <div id="slidecaption3" class="nivo-html-caption">
            <div class="slide_info">
                    <h2><?php esc_html_e('We Need Your Support to Accommodate, Feed and Educate.','skt-charity'); ?></h2>
                <p><?php esc_html_e('Nunc sed lorem pretium, volutpat tortor id, adipiscing sem. Sed bibendum quis augue nec porta. Ut molestie tortor pulvinar, faucibus justo...','skt-charity'); ?></p>
                <a class="ReadMore" href="<?php the_permalink(); ?>"><?php esc_html_e('Donate Now!', 'skt-charity');?></a>
            </div>
        </div>
</div>
<div class="clear"></div>
</section>
<!-- Slider Section -->
<?php } } ?>

        <?php
		$hideboxes = get_theme_mod('hide_boxes', '1');
		if( $hideboxes == ''){?>
        <div id="pagearea">
    <div class="container">                
            <?php for($fx=1; $fx<5; $fx++) { ?>
        	<?php if( get_theme_mod('page-column'.$fx,false) ) { ?>
        	<?php $queryvar = new wp_query('page_id='.get_theme_mod('page-column'.$fx,true));				
			while( $queryvar->have_posts() ) : $queryvar->the_post(); ?> 
        	    <div class="one_four_page <?php if($fx % 4 == 0) { echo "last_column"; } ?>">
				 <div class="thumb_four_page">
                     <a href="<?php the_permalink(); ?>">				 
                      <?php if ( has_post_thumbnail() ) { ?>
                            <?php the_post_thumbnail( array(65,65,true));?>                        
                       <?php } else { ?>
                           <img src="<?php echo esc_url( get_template_directory_uri() ) ; ?>/images/img_404.png" width="65" alt=""/>
                       <?php } ?>
                       </a>
                   </div>
                  <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                  <?php echo skt_charity_content('10'); ?>
                 <a class="more" href="<?php the_permalink(); ?>"><?php esc_html_e('Donate Now!','skt-charity'); ?></a>
        	   </div>
             <?php endwhile;
			 wp_reset_query();
			 ?>
        <?php } else { ?>
        <div class="one_four_page <?php if($fx % 4 == 0) { echo "last_column"; } ?>">
              <div class="thumb_four_icon">
                 <a href="<?php echo esc_url('#');?>">
                 <img src="<?php echo esc_url( get_template_directory_uri() ) ; ?>/images/services-icon<?php echo $fx; ?>.png" alt="" />
                 </a>
             </div>
             <h4><a href="<?php echo esc_url('#');?>"><?php esc_html_e('Help Donation','skt-charity'); ?> <?php echo $fx; ?></a></h4>
             <p><?php esc_html_e('Nunc sed lorem pretium, volutpat tortor id, adipiscing sem. ','skt-charity'); ?></p>
             <a class="more" href="<?php echo esc_url('#');?>"><?php esc_html_e('Donate Now!','skt-charity'); ?></a>
         </div>
		<?php }} ?>
      <div class="clear"></div>
    </div><!-- .container -->
 </div><!-- #pagearea -->
 <?php } ?>
	<div class="clear"></div>
<?php
 $hidewlcm = get_theme_mod('hide_welcome', '1');
 if( $hidewlcm == ''){?>	
       <section id="wrapfirst">
            	<div class="container">
                    <div class="welcomewrap">
					<?php if( get_theme_mod('page-setting1')) { ?>
                    <?php $queryvar = new WP_query('page_id='.get_theme_mod('page-setting1' ,true)); ?>
                    <?php while( $queryvar->have_posts() ) : $queryvar->the_post();?>                     
                      <?php the_post_thumbnail( array(300,300, true));?>      
                     <h2><?php the_title(); ?></h2> 
                     <?php the_content(); ?> 
                     <a class="donatebtn" href="<?php the_permalink(); ?>"><?php _e('Donate Now!','skt-charity'); ?></a>                     <div class="clear"></div>
                    <?php endwhile; } else { ?>                   
                    <p><img src="<?php echo esc_url( get_template_directory_uri() ) ; ?>/images/sponsorthumb.jpg"  alt=""/></p>
                    <h2><?php esc_html_e('Sponsor an Orphan Child','skt-charity'); ?></h2>
                    <p><?php echo wp_kses_post('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer sodales suscipit tellus, ut tristique neque suscipit a. Mauris tristique lacus quis leo imperdiet sed pulvinar dui fermentum. Aenean sit amet diam non tortor sagittis varius. Aenean at lorem nulla, sit amet interdum nibh. Mauris sit amet dictum turpis. Sed ut sapien magna. Lorem ipsum dolor sit amet, consectetur adipiscing elit Aliquam gravida odio nec dui ornare tempus elementum lectus rhoncus. <br /> <br />

Suspendisse lobortis pellentesque orci, in sodales nisi pretium sit amet. Aenean vulputate, odio non euismod eleifend, magna nisl elementum lorem, ac venenatis nunc erat et metus. Nulla volutpat urnaeu tellus odio hendrerit nibh. ','skt-charity'); ?></p> 
					<a class="donatebtn" href="<?php echo esc_url('#');?>"><?php _e('Donate Now!','skt-charity'); ?></a>                    <?php } ?>
               </div><!-- welcomewrap-->
              <div class="clear"></div>
            </div><!-- container -->
       </section><?php } ?><div class="clear"></div>    
<?php
}
elseif ( is_front_page() ) { 
?>
<?php if($hideslide == ''){ ?>
<!-- Slider Section -->
<?php for($sld=7; $sld<10; $sld++) { ?>
<?php if( get_theme_mod('page-setting'.$sld)) { ?>
<?php $slidequery = new WP_query('page_id='.get_theme_mod('page-setting'.$sld,true)); ?>
<?php while( $slidequery->have_posts() ) : $slidequery->the_post();
$image = wp_get_attachment_url( get_post_thumbnail_id($post->ID));
$img_arr[] = $image;
$id_arr[] = $post->ID;
endwhile;
}
}
?>
<?php if(!empty($id_arr)){ ?>
<section id="home_slider">
<div class="slider-wrapper theme-default">
<div id="slider" class="nivoSlider">
	<?php 
	$i=1;
	foreach($img_arr as $url){ ?>
    <?php if(!empty($url)){ ?>
    <img src="<?php echo $url; ?>" title="#slidecaption<?php echo $i; ?>" />
    <?php }else{ ?>
    <img src="<?php echo esc_url( get_template_directory_uri() ) ; ?>/images/slides/default-slide.jpg" title="#slidecaption<?php echo $i; ?>" />
    <?php } ?>
    <?php $i++; }  ?>
</div>   
<?php 
$i=1;
foreach($id_arr as $id){ 
$title = get_the_title( $id ); 
$post = get_post($id); 
$content = apply_filters('the_content', substr(strip_tags($post->post_content), 0, 150)); 
?>                 
<div id="slidecaption<?php echo $i; ?>" class="nivo-html-caption">
<div class="slide_info">
<h2><?php echo $title; ?></h2>
<?php echo $content; ?>
<a class="ReadMore" href="<?php the_permalink(); ?>"><?php esc_attr_e('Donate Now!', 'skt-charity');?></a>
</div>
</div>      
<?php $i++; } ?>       
 </div>
<div class="clear"></div>        
</section>
<?php } else { ?>
<section id="home_slider">
<div class="slider-wrapper theme-default">
    <div id="slider" class="nivoSlider">
    <img src="<?php echo esc_url( get_template_directory_uri() ) ; ?>/images/slides/slider1.jpg" alt="" title="#slidecaption1" />
    <img src="<?php echo esc_url( get_template_directory_uri() ) ; ?>/images/slides/slider2.jpg" alt="" title="#slidecaption2" />
    <img src="<?php echo esc_url( get_template_directory_uri() ) ; ?>/images/slides/slider3.jpg" alt="" title="#slidecaption3" />
    </div>                    
      <div id="slidecaption1" class="nivo-html-caption">
        <div class="slide_info">
                <h2><?php esc_html_e('We Need Your Support to Accommodate, Feed and Educate.','skt-charity'); ?></h2>
                <p><?php esc_html_e('Nunc sed lorem pretium, volutpat tortor id, adipiscing sem. Sed bibendum quis augue nec porta. Ut molestie tortor pulvinar, faucibus justo...','skt-charity'); ?></p>
                <a class="ReadMore" href="<?php the_permalink(); ?>"><?php esc_html_e('Donate Now!', 'skt-charity');?></a>
        </div>
        </div>
        
        <div id="slidecaption2" class="nivo-html-caption">
            <div class="slide_info">
                   <h2><?php esc_html_e('We Need Your Support to Accommodate, Feed and Educate.','skt-charity'); ?></h2>
                <p><?php esc_html_e('Nunc sed lorem pretium, volutpat tortor id, adipiscing sem. Sed bibendum quis augue nec porta. Ut molestie tortor pulvinar, faucibus justo...','skt-charity'); ?></p>
                <a class="ReadMore" href="<?php the_permalink(); ?>"><?php esc_html_e('Donate Now!', 'skt-charity');?></a>
            </div>
        </div>
        
        <div id="slidecaption3" class="nivo-html-caption">
            <div class="slide_info">
                    <h2><?php esc_html_e('We Need Your Support to Accommodate, Feed and Educate.','skt-charity'); ?></h2>
                <p><?php esc_html_e('Nunc sed lorem pretium, volutpat tortor id, adipiscing sem. Sed bibendum quis augue nec porta. Ut molestie tortor pulvinar, faucibus justo...','skt-charity'); ?></p>
                <a class="ReadMore" href="<?php the_permalink(); ?>"><?php esc_html_e('Donate Now!', 'skt-charity');?></a>
            </div>
        </div>
</div>
<div class="clear"></div>
</section>
<!-- Slider Section -->
<?php } } ?>
        <?php
		 $hideboxes = get_theme_mod('hide_boxes', '1');
		 if( $hideboxes == ''){?>
        <div id="pagearea">
    <div class="container">                
            <?php for($fx=1; $fx<5; $fx++) { ?>
        	<?php if( get_theme_mod('page-column'.$fx,false) ) { ?>
        	<?php $queryvar = new wp_query('page_id='.get_theme_mod('page-column'.$fx,true));				
			while( $queryvar->have_posts() ) : $queryvar->the_post(); ?> 
        	    <div class="one_four_page <?php if($fx % 4 == 0) { echo "last_column"; } ?>">
				 <div class="thumb_four_page">
                     <a href="<?php the_permalink(); ?>">				 
                      <?php if ( has_post_thumbnail() ) { ?>
                            <?php the_post_thumbnail( array(65,65,true));?>                        
                       <?php } else { ?>
                           <img src="<?php echo esc_url( get_template_directory_uri() ) ; ?>/images/img_404.png" width="65" alt=""/>
                       <?php } ?>
                       </a>
                   </div>
                  <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                  <?php echo skt_charity_content('10'); ?>
                 <a class="more" href="<?php the_permalink(); ?>"><?php esc_html_e('Donate Now!','skt-charity'); ?></a>
        	   </div>
             <?php endwhile;
			 wp_reset_query();
			 ?>
        <?php } else { ?>
        <div class="one_four_page <?php if($fx % 4 == 0) { echo "last_column"; } ?>">
              <div class="thumb_four_icon">
                 <a href="<?php echo esc_url('#');?>">
                 <img src="<?php echo esc_url( get_template_directory_uri() ) ; ?>/images/services-icon<?php echo $fx; ?>.png" alt="" />
                 </a>
             </div>
             <h4><a href="<?php echo esc_url('#');?>"><?php esc_html_e('Help Donation','skt-charity'); ?> <?php echo $fx; ?></a></h4>
             <p><?php esc_html_e('Nunc sed lorem pretium, volutpat tortor id, adipiscing sem. ','skt-charity'); ?></p>
             <a class="more" href="<?php echo esc_url('#');?>"><?php esc_html_e('Donate Now!','skt-charity'); ?></a>
         </div>
		<?php }} ?>
      <div class="clear"></div>
    </div><!-- .container -->
 </div><!-- #pagearea -->
 <?php } ?>
	<div class="clear"></div>
<?php 
$hidewlcm = get_theme_mod('hide_welcome', '1');
if( $hidewlcm == ''){?>
       <section id="wrapfirst">
            	<div class="container">
                    <div class="welcomewrap">
					<?php if( get_theme_mod('page-setting1')) { ?>
                    <?php $queryvar = new WP_query('page_id='.get_theme_mod('page-setting1' ,true)); ?>
                    <?php while( $queryvar->have_posts() ) : $queryvar->the_post();?>                     
                      <?php the_post_thumbnail( array(300,300, true));?>      
                     <h2><?php the_title(); ?></h2> 
                     <?php the_content(); ?> 
                     <a class="donatebtn" href="<?php the_permalink(); ?>"><?php _e('Donate Now!','skt-charity'); ?></a>                     <div class="clear"></div>
                    <?php endwhile; } else { ?>                   
                    <p><img src="<?php echo esc_url( get_template_directory_uri() ) ; ?>/images/sponsorthumb.jpg"  alt=""/></p>
                    <h2><?php esc_html_e('Sponsor an Orphan Child','skt-charity'); ?></h2>
                    <p><?php echo wp_kses_post('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer sodales suscipit tellus, ut tristique neque suscipit a. Mauris tristique lacus quis leo imperdiet sed pulvinar dui fermentum. Aenean sit amet diam non tortor sagittis varius. Aenean at lorem nulla, sit amet interdum nibh. Mauris sit amet dictum turpis. Sed ut sapien magna. Lorem ipsum dolor sit amet, consectetur adipiscing elit Aliquam gravida odio nec dui ornare tempus elementum lectus rhoncus. <br /> <br />

Suspendisse lobortis pellentesque orci, in sodales nisi pretium sit amet. Aenean vulputate, odio non euismod eleifend, magna nisl elementum lorem, ac venenatis nunc erat et metus. Nulla volutpat urnaeu tellus odio hendrerit nibh. ','skt-charity'); ?></p> 
					<a class="donatebtn" href="<?php echo esc_url('#');?>"><?php _e('Donate Now!','skt-charity'); ?></a>                    <?php } ?>
               </div><!-- welcomewrap-->
              <div class="clear"></div>
            </div><!-- container -->
       </section><?php } ?><div class="clear"></div>
<?php
}
elseif ( is_home() ) {
?>

<?php
}
?> 