<?php
if (get_option('show_on_front') == 'page') {
    get_header();
    ?>
    </header>
    <!--/Header-->
    <!--Content Wrapper-->
    <div id="content_wrapper" class="content single">
        <div class="container">	
            <div class="row"> 
                <div class="col-md-8" role="main">
                    <!--Blog-->
                    <div class="blog content_bar">
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
    <?php
} else {

    /**
     * Template loader
     */
    variantlp_load_template();
}
