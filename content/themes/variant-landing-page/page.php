<?php get_header(); ?>
<!--Sub Header-->
<div id="sub_header">
    <div class="container">
        <div class="row">
            <div class="col-md-12">	
                <div class="st-title-wrap">
                    <h1 class="page-title"><?php the_title(); ?></h1>
                    <?php if ($post->post_excerpt != '') { ?>
                        <h2 class="page-description"><?php echo esc_html($post->post_excerpt); ?></h2>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>

</div>
<!--Sub Header-->
</header>
<!--/Header-->
<!--Content Wrapper-->
<div id="content_wrapper" class="content single">
    <div class="container">
        <div class="row">            
            <div class="col-md-8">
                <div class="page-content content_bar" role="main">
                    <?php
                    if (have_posts()): while (have_posts()): the_post();
                            the_content();
                        endwhile;
                    endif;
                    ?>
                    <?php wp_link_pages(array('before' => '' . __('Pages:', 'variant-landing-page'), 'after' => '')); ?>
                </div>
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