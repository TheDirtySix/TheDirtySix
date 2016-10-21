<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package WordPress
 */
get_header();
?>
<!--Sub Header-->
<header id="sub_header">
    <div class="container">
        <div class="row">
            <div class="st-title-wrap">
                <span class="page-title">
                    <?php _e('This is somewhat embarrassing, isn&rsquo;t it?', 'variant-landing-page'); ?>
                </span>                    
                <?php get_search_form(); ?>				
            </div>
        </div>
    </div>
</header>
<!--Sub Header-->
</header>
<!--/Header-->
<!--Content Wrapper-->
<div id="content_wrapper" class="content single">
    <div class="container">
        <div class="row">            
            <div class="col-md-8">
                <!--Blog-->
                <div class="blog content_bar">
                    <div class="post">
                        <h2 class="error_pera">
                            <?php _e('It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching, or one of the links below, can help.', 'variant-landing-page'); ?>
                        </h2>            
                        <div class="error_list">
                            <?php the_widget('WP_Widget_Recent_Posts', array('number' => 10), array('widget_id' => '404')); ?>
                            <div class="widget">
                                <h2 class="widgettitle">
                                    <?php _e('Most Used Categories.', 'variant-landing-page'); ?>
                                </h2>
                                <ul class="error_list">
                                    <?php wp_list_categories(array('orderby' => 'count', 'order' => 'DESC', 'show_count' => 1, 'title_li' => '', 'number' => 10)); ?>
                                </ul>
                            </div>
                            <?php
                            /* translators: %1$s: smilie */
                            $archive_content = '<p>' . sprintf(__('Try looking in the monthly archives. %1$s', 'variant-landing-page'), convert_smilies(':)')) . '</p>';
                            the_widget('WP_Widget_Archives', array('count' => 0), array('after_title' => '</h2>' . $archive_content));
                            ?>
                        </div>
                    </div>
                </div>
                <!--/Blog-->
            </div>
            <div class="col-md-4">
                <div id="sidebar" class="sidebar">
                    <?php get_sidebar(); ?>
                </div>
            </div> 
        </div>
    </div>
</div>
<!--/Content Wrapper-->
<?php get_footer(); ?>