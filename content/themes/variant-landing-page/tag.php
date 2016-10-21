<?php get_header(); ?>
<!--Sub Header-->
<header id="sub_header">
    <div class="container">
        <div class="row">
            <div class="st-title-wrap">
                <span class="page-title">
                    <?php printf(__('Tag Archives: %s', 'variant-landing-page'), '' . single_tag_title('', false) . ''); ?>
                </span>
                <?php
                $term_description = term_description();
                if (!empty($term_description)) {
                    ?>
                    <span class="page-description"><?php echo $term_description; ?></span>
                    <?php
                }
                ?>				
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
                    endif;
                    variantlp_pagination();
                    ?>
                    <!--/Blog-->
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