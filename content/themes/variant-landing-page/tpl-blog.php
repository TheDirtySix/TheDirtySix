<?php
/**
 * Template Name: Blog
 */
get_header();
?>
<!--Sub Header-->
<div id="sub_header">
    <div class="container">
        <div class="row">
            <div class="st-title-wrap">
                <h1 class="page-title"><?php the_title(); ?></h1>
                <h2 class="page-description"><?php echo esc_html($post->post_excerpt); ?></h2>
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
                        $limit = get_option('posts_per_page');
                        if (get_query_var('paged')) {
                            $paged = get_query_var('paged');
                        } elseif (get_query_var('page')) {
                            $paged = get_query_var('page');
                        } else {
                            $paged = 1;
                        }
                        $args = array(
                            'post_type' => 'post',
                            'post_status' => 'publish',
                            'posts_per_page' => $limit,
                            'paged' => $paged
                        );
                        $BlogQuery = new WP_Query($args);
                        if ($BlogQuery->have_posts()): while ($BlogQuery->have_posts()): $BlogQuery->the_post();
                                get_template_part('content');
                            endwhile;
                        endif;
                        ?>
                    </div>
                    <?php
                    variantlp_pagination($BlogQuery->max_num_pages);
                    wp_reset_query();
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