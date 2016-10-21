<?php get_header(); ?>
<!--Sub Header-->
<div id="sub_header">
    <div class="container">
        <div class="row">
            <div class="st-title-wrap">                
                <h3 class="page-title"><?php variantlp_breadcrumbs(); ?></h3>
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
                <!--Blog-->
                <div class="blog content_bar" role="main">
                    <div class="blog-content">
                        <?php
                        if (have_posts()): while (have_posts()): the_post();
                                get_template_part('content', 'single');
                            endwhile;
                        endif;
                        wp_link_pages(array('before' => '' . __('Pages:', 'variant-landing-page'), 'after' => ''));
                        ?>
                        <nav id="nav-single">
                            <span class="nav-previous"><?php previous_post_link('%link', __('<span class="meta-nav">&larr;</span> Previous post', 'variant-landing-page')); ?></span>
                            <span class="nav-next"><?php next_post_link('%link', __('Next post <span class="meta-nav">&rarr;</span>', 'variant-landing-page')); ?></span>
                        </nav><!-- #nav-single -->
                    </div>		
                </div>
                <!--/Blog-->
            </div>
        </div>
        <div class="col-md-4">
            <div id="sidebar" class="sidebar side-blog">
                <?php get_sidebar(); ?>
            </div>
        </div>             
    </div>
</div>
</div>
<!--/Content Wrapper-->
<?php get_footer(); ?>