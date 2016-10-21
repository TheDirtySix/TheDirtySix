<?php get_header(); ?>
<!--Sub Header-->
<header id="sub_header">
    <div class="container">
        <div class="row">
            <div class="st-title-wrap">
                <h1 class="page-title"><?php printf(__('Author Archives: %s', 'variant-landing-page'), "<span class='vcard'><a class='url fn n' href='" . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . "' title='" . esc_attr(get_the_author()) . "' rel='me'>" . get_the_author() . "</a></span>"); ?></a></h1>
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
                <div class="blog">
                    <?php
                    if (have_posts()): while (have_posts()): the_post();
                            get_template_part('content');
                        endwhile;
                    endif;
                    variantlp_pagination();
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