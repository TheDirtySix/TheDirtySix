<?php get_header(); ?>
<!--Sub Header-->
<div id="sub_header">
    <div class="container">
        <div class="row">
            <div class="st-title-wrap">
                <h1 class="page-title">
                    <?php
                    if (is_day()) :
                        printf(__('Daily Archives: %s', 'variant-landing-page'), esc_html(get_the_date()));
                    elseif (is_month()) :
                        printf(__('Monthly Archives: %s', 'variant-landing-page'), esc_html(get_the_date('F Y')));
                    elseif (is_year()) :
                        printf(__('Yearly Archives: %s', 'variant-landing-page'), esc_html(get_the_date('Y')));
                    else :
                        _e('Blog Archives', 'variant-landing-page');
                    endif;
                    ?>
                </h1>
                <?php
                $term_description = term_description();
                if (!empty($term_description)) {
                    ?>
                    <h2 class="page-description"><?php echo $term_description; ?></h2>
                    <?php
                }
                ?>				
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
                <div class="row">
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
            </div>
            <div class="col-md-4">
                <div class="row">
                    <div id="sidebar" class="sidebar">
                        <?php get_sidebar(); ?>
                    </div>
                </div>
            </div> 
        </div>
    </div>
</div>
<!--/Content Wrapper-->
<?php get_footer(); ?>