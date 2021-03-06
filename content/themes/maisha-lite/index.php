<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * e.g., it puts together the home page when no home.php file exists.
 *
 * Learn more: {@link https://codex.wordpress.org/Template_Hierarchy}
 *
 * @package Maisha
 * @since Maisha 1.0
 */

get_header(); ?>
    <div id="content" class="hfeed site">
        <div class="content site-content">
            <main class="main site-main" role="main">
                <div class="single-themes-page clear news">
                    <div class="two_third">
                        <div id="primary" class="content-area">
                            <?php if ( have_posts() ) : ?>
                                <?php
									// Start the loop.
									while ( have_posts() ) : the_post();

										/*
										 * Include the Post-Format-specific template for the content.
										 * If you want to override this in a child theme, then include a file
										 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
										 */
										get_template_part( 'content', get_post_format() );

									// End the loop.
									endwhile;

									// Previous/next page navigation.
									the_posts_pagination( array(
										'prev_text'          => esc_html__( 'Previous page', 'maisha' ),
										'next_text'          => esc_html__( 'Next page', 'maisha' ),
										'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'maisha' ) . ' </span>',
									) );

								// If no content, include the "No posts found" template.
								else :
									get_template_part( 'content', 'none' );

								endif;
							?>
                        </div>
                    </div>
                    <div class="one_third lastcolumn">
                        <div id="sidebar" class="sidebar">
                        <?php get_sidebar(); ?>
                        </div><!-- .sidebar -->
                    </div>
                </div>
            </main><!-- .content-area -->
        </div><!-- .site-content -->
    </div><!-- .site -->
<?php get_footer(); ?>