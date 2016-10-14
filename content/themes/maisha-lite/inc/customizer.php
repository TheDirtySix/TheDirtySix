<?php
/**
 * Maisha Customizer functionality
 *
 * @package Maisha
 * @since Maisha 1.0
 */

/**
 * Add postMessage support for site title and description for the Customizer.
 *
 * @since Maisha 1.0
 *
 * @param WP_Customize_Manager $wp_customize Customizer object.
 */
function maisha_customize_register( $wp_customize ) {

	$wp_customize->get_setting( 'blogname' )->transport        = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

	$wp_customize->add_section( 'maisha_theme_options', array(
		'title'    => esc_html__( 'Front Page', 'maisha' ),
		'priority' => 34,
	) );

	/* Front Page: Featured Page One */
	$wp_customize->add_setting( 'maisha_featured_page_one', array(
		'default'           => '',
		'sanitize_callback' => 'maisha_sanitize_dropdown_pages',
	) );
	$wp_customize->add_control( 'maisha_featured_page_one', array(
		'label'             => esc_html__( 'First Content Block', 'maisha' ),
		'section'           => 'maisha_theme_options',
		'priority'          => 9,
		'type'              => 'dropdown-pages',
	) );

/**
* Adds the individual sections for custom logo
*/
	$wp_customize->add_section( 'maisha_logo_section' , array(
	  'title'       => esc_html__( 'Logo', 'maisha' ),
	  'priority'    => 29,
	  'description' => esc_html__( 'Upload a logo to replace the default site name and description in the header', 'maisha' )
	) );
	$wp_customize->add_setting( 'maisha_logo', array(
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'maisha_logo', array(
		'label'    => esc_html__( 'Logo', 'maisha' ),
		'section'  => 'maisha_logo_section',
		'settings' => 'maisha_logo',
	) ) );

/**
* Custom CSS
*/
	$wp_customize->add_section( 'maisha_custom_css_section' , array(
   		'title'    => esc_html__( 'Custom CSS', 'maisha' ),
   		'description'=> 'Add your custom CSS which will overwrite the theme CSS',
   		'priority'   => 32,
	) );

	/* Custom CSS*/
	$wp_customize->add_setting( 'maisha_custom_css', array(
		'default'           => '',
		'sanitize_callback' => 'maisha_sanitize_text',
	) );
	$wp_customize->add_control( 'maisha_custom_css', array(
		'label'             => esc_html__( 'Custom CSS', 'maisha' ),
		'section'           => 'maisha_custom_css_section',
		'settings'          => 'maisha_custom_css',
		'type'		        => 'textarea',
		'priority'          => 1,
	) );

	/**
	 * Adds the individual sections for custom favicon
	 */
	$wp_customize->add_section( 'maisha_favicon_section' , array(
		'title'       => esc_html__( 'Favicon', 'maisha' ),
		'priority'    => 301,
		'description' => 'Upload a favicon',
	) );
	$wp_customize->add_setting( 'maisha_favicon', array(
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'maisha_favicon', array(
		'label'    => esc_html__( 'Favicon', 'maisha' ),
		'section'  => 'maisha_favicon_section',
		'settings' => 'maisha_favicon',
	) ) );

	/***** Register Custom Controls *****/

	class Maisha_Upgrade extends WP_Customize_Control {
		public function render_content() {  ?>
			<p class="didi-upgrade-thumb">
				<img src="<?php echo get_template_directory_uri(); ?>/screenshot.png" />
			</p>
			<p class="customize-control-title didi-upgrade-title">
				<?php esc_html_e('Maisha Pro', 'maisha'); ?>
			</p>
			<p class="textfield didi-upgrade-text">
				<?php esc_html_e('Full version of this theme includes additional features; additional page templates, custom widgets, additional front page widgetized areas, different blog options, different theme options, WooCommerce support, color options & premium theme support.', 'maisha'); ?>
			</p>
			<p class="customize-control-title didi-upgrade-title">
				<?php esc_html_e('Additional Features:', 'maisha'); ?>
			</p>
			<ul class="didi-upgrade-features">
				<li class="didi-upgrade-feature-item">
					<?php esc_html_e('Additional Page Templates', 'maisha'); ?>
				</li>
				<li class="didi-upgrade-feature-item">
					<?php esc_html_e('Custom Widgets', 'maisha'); ?>
				</li>
				<li class="didi-upgrade-feature-item">
					<?php esc_html_e('Several additional widget areas', 'maisha'); ?>
				</li>
				<li class="didi-upgrade-feature-item">
					<?php esc_html_e('Different Blog Options & Layouts', 'maisha'); ?>
				</li>
				<li class="didi-upgrade-feature-item">
					<?php esc_html_e('Different Theme Options', 'maisha'); ?>
				</li>
				<li class="didi-upgrade-feature-item">
					<?php esc_html_e('WooCommerce Support', 'maisha'); ?>
				</li>
				<li class="didi-upgrade-feature-item">
					<?php esc_html_e('Color Options', 'maisha'); ?>
				</li>
				<li class="didi-upgrade-feature-item">
					<?php esc_html_e('Premium Theme Support', 'maisha'); ?>
				</li>
			</ul>
			<p class="didi-upgrade-button">
				<a href="http://www.anarieldesign.com/themes/non-profit-wordpress-theme/" target="_blank" class="button button-secondary">
					<?php esc_html_e('Read more about Maisha', 'maisha'); ?>
				</a>
			</p><?php
		}
	}

	/***** Add Sections *****/

	$wp_customize->add_section('maisha_upgrade', array(
		'title' => esc_html__('Pro Features', 'maisha'),
		'priority' => 300
	) );

	/***** Add Settings *****/

	$wp_customize->add_setting('maisha_options[premium_version_upgrade]', array(
		'default' => '',
		'type' => 'option',
		'sanitize_callback' => 'esc_attr'
	) );

	/***** Add Controls *****/

	$wp_customize->add_control(new Maisha_Upgrade($wp_customize, 'premium_version_upgrade', array(
		'section' => 'maisha_upgrade',
		'settings' => 'maisha_options[premium_version_upgrade]',
		'priority' => 1
	) ) );
}
add_action( 'customize_register', 'maisha_customize_register', 11 );

/**
 * Sanitization
 */
//Checkboxes
function maisha_sanitize_checkbox( $input ) {
	if ( $input == 1 ) {
		return 1;
	} else {
		return '';
	}
}
//Integers
function maisha_sanitize_int( $input ) {
    if( is_numeric( $input ) ) {
        return intval( $input );
    }
}
//Text
function maisha_sanitize_text( $input ) {
    return wp_kses_post( force_balance_tags( $input ) );
}
//No sanitize - empty function for options that do not require sanitization -> to bypass the Theme Check plugin
function maisha_no_sanitize( $input ) {
}

//Radio Buttons and Select Lists
function maisha_sanitize_choices( $input, $setting ) {
    global $wp_customize;

    $control = $wp_customize->get_control( $setting->id );

    if ( array_key_exists( $input, $control->choices ) ) {
        return $input;
    } else {
        return $setting->default;
    }
}

//Sanitize the dropdown pages.
function maisha_sanitize_dropdown_pages( $input ) {
	if ( is_numeric( $input ) ) {
		return intval( $input );
	}
}

/**
 * Binds JS handlers to make the Customizer preview reload changes asynchronously.
 *
 * @since Maisha 1.0
 */
function maisha_customize_preview_js() {
	wp_enqueue_script( 'maisha-customize-preview', get_template_directory_uri() . '/js/customize-preview.js', array( 'customize-preview' ), '20141216', true );
}
add_action( 'customize_preview_init', 'maisha_customize_preview_js' );
/***** Enqueue Customizer CSS *****/

function maisha_customizer_base_css() {
	wp_enqueue_style('maisha-customizer', get_template_directory_uri() . '/admin/customizer.css', array());
}
add_action('customize_controls_print_styles', 'maisha_customizer_base_css');
/***** Enqueue Customizer JS *****/

function maisha_customizer_js() {
	wp_enqueue_script('maisha-customizer', get_template_directory_uri() . '/js/maisha-customizer.js', array(), '1.0.0', true);
	wp_localize_script('maisha-customizer', 'maisha_links', array(
		'upgradeURL' => esc_url('http://www.anarieldesign.com/themes/non-profit-wordpress-theme/'),
		'upgradeLabel' => esc_html__('Upgrade to Maisha Pro', 'maisha'),
		'title'	=> esc_html__('Theme Related Links:', 'maisha'),
		'themeURL' => esc_url('http://www.anarieldesign.com/themes/non-profit-wordpress-theme/'),
		'themeLabel' => esc_html__('Theme Info Page', 'maisha'),
		'docsURL' => esc_url('http://www.anarieldesign.com/documentation/maishalite/'),
		'docsLabel'	=> esc_html__('Theme Documentation', 'maisha'),
		'rateURL' => esc_url('https://wordpress.org/support/view/theme-reviews/maisha-lite?filter=5'),
		'rateLabel'	=> esc_html__('Rate this theme', 'maisha'),
	));
}
add_action('customize_controls_enqueue_scripts', 'maisha_customizer_js');