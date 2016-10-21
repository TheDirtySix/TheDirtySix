<?php
/**
 * The template for displaying Category pages.
 *
 */
get_header();
?>
<!--Sub Header-->
<div id="sub_header">
    <div class="container">
        <div class="row">
            <div class="st-title-wrap">
                <h1 class="page-title"><?php printf(__('Category Archives: %s', 'variant-landing-page'), '' . single_cat_title('', false) . ''); ?></h1>
                <?php
                $variantlp_category_description = category_description();
                if (!empty($variantlp_category_description)) {
                    ?>
                    <h2 class="page-description"><?php echo $variantlp_category_description; ?></h2>
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
                <!--Blog-->
                <div class="blog" role="main">
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