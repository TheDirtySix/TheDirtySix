<?php
/**
 * Template Name: Blog
 */
get_header();
?>
<!--Sub Header-->
<header id="sub_header">
    <div class="container">
        <div class="row">
            <div class="st-title-wrap">
                <span class="page-description"><?php printf(__('Search Results for: %s', 'variant-landing-page'), '' . esc_html(get_search_query()) . ''); ?>				
                </span>				
                <?php get_search_form(true); ?>
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
                <div class="blog" role="main">
                    <?php
                    if (have_posts()): while (have_posts()): the_post();
                            get_template_part('content');
                        endwhile;
                        variantlp_pagination();
                    else:
                        get_template_part('content', 'none');
                    endif;
                    ?>
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