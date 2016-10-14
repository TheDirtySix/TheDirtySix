<?php

/***** Theme Info Page *****/

if (!function_exists('maisha_theme_info_page')) {
	function maisha_theme_info_page() {
		add_theme_page(esc_html__('Welcome to Maisha Lite', 'maisha'), esc_html__('Theme Info', 'maisha'), 'edit_theme_options', 'blog', 'maisha_display_theme_page');
	}
}
add_action('admin_menu', 'maisha_theme_info_page');

if (!function_exists('maisha_display_theme_page')) {
	function maisha_display_theme_page() {
		$theme_data = wp_get_theme(); ?>
		<div class="theme-info-wrap">
			<h1>
				<?php printf(esc_html__('Welcome to %1s %2s', 'maisha'), $theme_data->Name, $theme_data->Version); ?>
			</h1>
			<div class="theme-description">
				<?php echo $theme_data->Description; ?>
			</div>
			<hr>
			<div id="getting-started">
				<h3>
					<?php printf(esc_html__('Getting Started with %s', 'maisha'), $theme_data->Name); ?>
				</h3>
				<div class="ad-row clearfix">
					<div class="ad-col-1-2">
						<div class="section">
							<h4>
								<?php esc_html_e('Theme Documentation', 'maisha'); ?>
							</h4>
							<p class="about">
								<?php printf(esc_html__('Please check the documentation to get better overview of how the theme is structured.', 'maisha'), $theme_data->Name); ?>
							</p>
							<p>
								<a href="<?php echo esc_url('http://www.anarieldesign.com/documentation/maishalite/'); ?>" target="_blank" class="button button-secondary">
									<?php esc_html_e('Visit Documentation', 'maisha'); ?>
								</a>
							</p>
						</div>
						<div class="section">
							<h4>
								<?php esc_html_e('Theme Options', 'maisha'); ?>
							</h4>
							<p class="about">
								<?php printf(esc_html__('Click "Customize" to open the Customizer.',  'maisha'), $theme_data->Name); ?>
							</p>
							<p>
								<a href="<?php echo admin_url('customize.php'); ?>" class="button button-primary">
									<?php esc_html_e('Customize', 'maisha'); ?>
								</a>
							</p>
						</div>
						<div class="section">
							<h4>
								<?php esc_html_e('Maisha Pro', 'maisha'); ?>
							</h4>
							<p class="about">
								<?php esc_html_e('Full version of this theme includes additional features; additional page templates, custom widgets, additional front page options, different blog options, different theme options, WooCommerce support, color options & premium theme support.', 'maisha'); ?>
							</p>
							<p>
								<a href="<?php echo esc_url('http://www.anarieldesign.com/themes/non-profit-wordpress-theme/'); ?>" target="_blank" class="button button-secondary">
									<?php esc_html_e('Read more about Maisha', 'maisha'); ?>
								</a>
							</p>
						</div>
					</div>
					<div class="ad-col-1-2">
						<img src="<?php echo get_template_directory_uri(); ?>/screenshot.png" alt="<?php esc_html_e('Theme Screenshot', 'maisha'); ?>" />
					</div>
				</div>
			</div>
			<hr>
			<div id="theme-author">
				<p>
					<?php printf(esc_html__('%1s is proudly brought to you by %2s. If you like %3s: %4s.', 'maisha'), $theme_data->Name, '<a target="_blank" href="http://www.anarieldesign.com/" title="Anariel Design">Anariel Design</a>', $theme_data->Name, '<a target="_blank" href="https://wordpress.org/support/view/theme-reviews/maisha-lite?filter=5" title="Maisha Lite Review">' . esc_html__('Rate this theme', 'maisha') . '</a>'); ?>
				</p>
			</div>
		</div><?php
	}
}

?>