<?php get_header(); ?>
<!--Sub Header-->
<div id="sub_header">
    <div class="container">
        <div class="row">
            <div class="st-title-wrap">
                <h1 class="page-title"><?php the_title(); ?></h1>
                <h3 class="page-description"><?php echo esc_html($post->post_excerpt); ?></h3>
            </div>
        </div>
    </div>
</div>
<!--Sub Header-->
</header>
<div id="content_wrapper" class="content single">
    <div class="container">	
        <div class="row"> 
            <div class="col-md-8">
                <!--Blog-->
                <div class="blog content_bar" role="main">
                    <div class="blog-content">
                        <?php
                        if (have_posts()): while (have_posts()): the_post();
                                get_template_part('content');
                            endwhile;
                        endif;
                        ?>
                    </div>
                    <?php
                    variantlp_pagination();
                    ?>
                </div>
                <!--/Blog-->
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