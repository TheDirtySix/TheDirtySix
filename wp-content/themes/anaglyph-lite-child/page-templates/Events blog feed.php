<?php
/*
 * Template Name: Events blog feed
 * Description: Full-width content
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 *
 * @package WordPress
 * @subpackage Anaglyph_Theme
 * @since Anaglyph Theme 1.0
 */

get_header(); ?>
	<?php
		query_posts('cat=1');
			while (have_posts()) : the_post();
			the_content();
				endwhile;
					?>
	<?php
		global $prefix;
		$layout = 0;
		$page_layout = get_post_meta(get_the_ID(), $prefix.'page_layout', true); 
		if (!empty($page_layout)) $layout = $page_layout;
	
		// Start the Loop.
		while ( have_posts() ) : the_post(); ?>
			<?php do_action('anaglyph_before_page_content')?>
			<section id="page-content" class="block">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<div id="content" role="main">							
								<?php
									if ($layout == 0) {
										get_template_part( 'content', 'page' );
										do_action('anaglyph_comments_template');
									} else if ($layout == 1) {
										echo '<div class="row">';
											echo '<div class="col-md-8">';
												get_template_part( 'content', 'page' );
												do_action('anaglyph_comments_template');
											echo '</div>';
											echo '<div class="col-md-4">';
												get_sidebar_part();					
											echo '</div>';
										echo '</div>';
									} else if ($layout == 2) {
										echo '<div class="row">';
											echo '<div class="col-md-4">';
												get_sidebar_part();					
											echo '</div>';
											echo '<div class="col-md-8">';
												get_template_part( 'content', 'page' );
												do_action('anaglyph_comments_template');
											echo '</div>';
										echo '</div>';
									}
								?>
							</div>
						</div>	
					</div>
				</div>
			</section>
		<?php endwhile; ?>
<?php
   get_footer();
