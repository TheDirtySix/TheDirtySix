<?php

/**
 * Contains methods for customizing the theme customization screen.
 * 
 * @link http://codex.wordpress.org/Theme_Customization_API
 * @since MyTheme 1.0
 */
class Variantlp_Customize {

    /**
     * This hooks into 'customize_register' (available as of WP 3.4) and allows
     * you to add new sections and controls to the Theme Customize screen.
     * 
     * Note: To enable instant preview, we have to actually write a bit of custom
     * javascript. See live_preview() for more.
     *  
     * @see add_action('customize_register',$func)
     * @param \WP_Customize_Manager $wp_customize
     * @link http://ottopress.com/2012/how-to-leverage-the-theme-customizer-in-your-own-themes/
     * @since MyTheme 1.0
     */
    public static function register($wp_customize) {
        //=============================================================
        // Remove header image, title tagline and widgets option from theme customizer
        //=============================================================
        $wp_customize->remove_control("header_image");
        $wp_customize->remove_panel("widgets");
        $wp_customize->remove_section('title_tagline');
        //=============================================================
        // Remove Colors, Background image, and Static front page 
        // option from theme customizer     
        //=============================================================
        $wp_customize->remove_section("colors");
        $wp_customize->remove_section("background_image");
        $wp_customize->remove_section("static_front_page");
        include_once 'variant-sections.php';
        //include_once 'variant-tpl.php';
        /**
         * Sections 
         */
        VariantLPS::sections($wp_customize);

        /**
         * Settings
         */
        self::settings($wp_customize);
    }

    /**
     * This will output the custom WordPress settings to the live theme's WP head.
     * 
     * Used by hook: 'wp_head'
     * 
     * @see add_action('wp_head',$func)
     */
    public static function header_output() {
        ?>
        <!--Customizer CSS--> 
        <style type="text/css">
        <?php
        self::generate_css('#site-title a', 'color', 'header_textcolor', '#');
        self::generate_css('body', 'background-color', 'background_color', '#');
        self::generate_css('a', 'color', 'link_textcolor');
        ?>
        </style> 
        <!--/Customizer CSS-->
        <?php
    }

    /**
     * This outputs the javascript needed to automate the live settings preview.
     * Also keep in mind that this function isn't necessary unless your settings 
     * are using 'transport'=>'postMessage' instead of the default 'transport'
     * => 'refresh'
     * 
     * Used by hook: 'customize_preview_init'
     * 
     * @see add_action('customize_preview_init',$func)
     * @since MyTheme 1.0
     */
    public static function live_preview() {
        wp_enqueue_script('variantlp-customize-preview', VARIANTLP_DIR_URI . 'assets/js/variantlp-customizer.js', array('customize-preview'), '20141216', true);
        wp_localize_script('variantlp-customize-preview', 'variantlp_ajax', array(
            'ajaxurl' => admin_url('admin-ajax.php'),
                )
        );
    }

    /**
     * This will generate a line of CSS for use in header output. If the setting
     * ($mod_name) has no defined value, the CSS will not be output.
     * 
     * @uses get_theme_mod()
     * @param string $selector CSS selector
     * @param string $style The name of the CSS *property* to modify
     * @param string $mod_name The name of the 'theme_mod' option to fetch
     * @param string $prefix Optional. Anything that needs to be output before the CSS property
     * @param string $postfix Optional. Anything that needs to be output after the CSS property
     * @param bool $echo Optional. Whether to print directly to the page (default: true).
     * @return string Returns a single line of CSS with selectors and a property.
     * @since MyTheme 1.0
     */
    public static function generate_css($selector, $style, $mod_name, $prefix = '', $postfix = '', $echo = true) {
        $return = '';
        $mod = get_theme_mod($mod_name);
        if (!empty($mod)) {
            $return = sprintf('%s { %s:%s; }', $selector, $style, $prefix . $mod . $postfix
            );
            if ($echo) {
                echo $return;
            }
        }
        return $return;
    }

    /**
     * Filter option types
     * @param type $type
     * @return string
     */
    public static function option_type($type) {
        switch ($type) {
            case 'textarea-simple':
            case 'css':
                return 'textarea';
                break;
            case 'list-item':
                return 'list-item';
                break;
            default:
                return $type;
                break;
        }
    }

    static function settings($wp_customize) {

        /**
         * Client testimonial
         */
        $variantlp_settings = array(
            /**
             * General Settings
             */
            array('id' => 'vlp_logo',
                'label' => __('Logo', 'variant-landing-page'),
                'sanitize_callback' => 'esc_url',
                'section' => 'general_settings',
                'type' => 'upload',
                'default' => VARIANTLP_DIR_URI . "assets/imgs/variant-logo.png",
                'desc' => __('Upload your logo image.', 'variant-landing-page'),
            ),
            array('id' => 'vlp_contact_number',
                'label' => __('Contact Number', 'variant-landing-page'),
                'sanitize_callback' => 'esc_attr',
                'section' => 'general_settings',
                'type' => 'text',
                'default' => '555-555-5555',
                'desc' => __('Enter your contact number.', 'variant-landing-page'),
            ),
            array('id' => 'vlp_top_heading',
                'label' => __('Top Heading', 'variant-landing-page'),
                'sanitize_callback' => 'wp_kses_post',
                'section' => 'general_settings',
                'type' => 'text',
                'default' => 'Best <span>Landing Page</span> Theme',
                'desc' => __('Enter your heading text. This would be displayed on the top of the your template.', 'variant-landing-page'),
            ),
            array('id' => 'vlp_top_description',
                'label' => __('Top Description', 'variant-landing-page'),
                'sanitize_callback' => 'esc_html',
                'section' => 'general_settings',
                'type' => 'textarea',
                'default' => 'Capture Leads Instantly and Sell Your Services With Variant Landing Page Theme',
                'desc' => __('Enter your short description to describe about your business.', 'variant-landing-page'),
            ),
            array('id' => 'vlp_top_bg_img',
                'label' => __('Top Background Image', 'variant-landing-page'),
                'sanitize_callback' => 'esc_url',
                'section' => 'general_settings',
                'type' => 'upload',
                'default' => VARIANTLP_DIR_URI . 'assets/imgs/template_one_top_bg.png',
                'desc' => __('Upload background image. This would be displayed on the top section.', 'variant-landing-page'),
            ),
            /**
             * Lead Form
             */
            array('id' => 'vlp_lead_form',
                'label' => __('Lead Form', 'variant-landing-page'),
                'sanitize_callback' => 'esc_html',
                'section' => 'lead_form_section',
                'type' => 'textarea',
                'default' => '',
                'desc' => __('Enter here embed share form link. If you are not getting this, follow the readme.txt.', 'variant-landing-page'),
                'transport' => 'refresh'
            ),
            /**
             * Featured items
             * ===============
             */
            /**
             * Feature 1
             */
            array('id' => 'vlp_fa_border1',
                'label' => __('Feature Item 1', 'variant-landing-page'),
                'sanitize_callback' => 'esc_attr',
                'section' => 'featured_items',
                'type' => 'border',
                'default' => '',
                'desc' => ''
            ),
            array('id' => 'vlp_fa_icon_class1',
                'label' => __('Icon Class 1', 'variant-landing-page'),
                'sanitize_callback' => 'esc_attr',
                'section' => 'featured_items',
                'type' => 'text',
                'default' => 'fa-comment-o',
                'desc' => ''
            ),
            array('id' => 'vlp_fa_heading1',
                'label' => __('Heading Text 1', 'variant-landing-page'),
                'sanitize_callback' => 'esc_attr',
                'section' => 'featured_items',
                'type' => 'text',
                'default' => __('Conversion Optimized', 'variant-landing-page'),
                'desc' => ''
            ),
            array('id' => 'vlp_fa_description1',
                'label' => __('Description 1', 'variant-landing-page'),
                'sanitize_callback' => 'esc_attr',
                'section' => 'featured_items',
                'type' => 'textarea',
                'default' => __('Collect leads instantly and start selling your services.', 'variant-landing-page'),
                'desc' => ''
            ),
            /**
             * Feature 2
             */
            array('id' => 'vlp_fa_border2',
                'label' => __('Feature Item 2', 'variant-landing-page'),
                'sanitize_callback' => 'esc_attr',
                'section' => 'featured_items',
                'type' => 'border',
                'default' => '',
                'desc' => ''
            ),
            array('id' => 'vlp_fa_icon_class2',
                'label' => __('Icon Class 2', 'variant-landing-page'),
                'sanitize_callback' => 'esc_attr',
                'section' => 'featured_items',
                'type' => 'text',
                'default' => 'fa-comment-o',
                'desc' => ''
            ),
            array('id' => 'vlp_fa_heading2',
                'label' => __('Heading Text 2', 'variant-landing-page'),
                'sanitize_callback' => 'esc_attr',
                'section' => 'featured_items',
                'type' => 'text',
                'default' => __('Completely Responsive', 'variant-landing-page'),
                'desc' => ''
            ),
            array('id' => 'vlp_fa_description2',
                'label' => __('Description 2', 'variant-landing-page'),
                'sanitize_callback' => 'esc_attr',
                'section' => 'featured_items',
                'type' => 'textarea',
                'default' => __('Variant is completely responsive and looks cool across all devices.', 'variant-landing-page'),
                'desc' => ''
            ),
            /**
             * Feature 3
             */
            array('id' => 'vlp_fa_border3',
                'label' => __('Feature Item 3', 'variant-landing-page'),
                'sanitize_callback' => 'esc_attr',
                'section' => 'featured_items',
                'type' => 'border',
                'default' => '',
                'desc' => ''
            ),
            array('id' => 'vlp_fa_icon_class3',
                'label' => __('Icon Class 3', 'variant-landing-page'),
                'sanitize_callback' => 'esc_attr',
                'section' => 'featured_items',
                'type' => 'text',
                'default' => 'fa-comment-o',
                'desc' => ''
            ),
            array('id' => 'vlp_fa_heading3',
                'label' => __('Heading Text 3', 'variant-landing-page'),
                'sanitize_callback' => 'esc_attr',
                'section' => 'featured_items',
                'type' => 'text',
                'default' => __('Various Styling Options', 'variant-landing-page'),
                'desc' => ''
            ),
            array('id' => 'vlp_fa_description3',
                'label' => __('Description 3', 'variant-landing-page'),
                'sanitize_callback' => 'esc_attr',
                'section' => 'featured_items',
                'type' => 'textarea',
                'default' => __('Create any kind of Form via FormGet and use it on Landing Page.', 'variant-landing-page'),
                'desc' => ''
            ),
            /**
             * Testimonial Settings
             */
            array('id' => 'vlp_testimonial_heading_text',
                'label' => __('Testimonial Heading', 'variant-landing-page'),
                'sanitize_callback' => 'esc_attr',
                'section' => 'client_testimonial',
                'type' => 'text',
                'default' => '',
                'desc' => __('Enter heading text for testimonial section.', 'variant-landing-page'),
            ),
            /**
             * Testimonial 1
             */
            array('id' => 'vlp_ct_border1',
                'label' => __('Testimonial 1', 'variant-landing-page'),
                'sanitize_callback' => 'esc_url',
                'section' => 'client_testimonial',
                'type' => 'border',
                'default' => '',
                'desc' => ''
            ),
            array('id' => 'vlp_ct_image1',
                'label' => __('Image 1', 'variant-landing-page'),
                'sanitize_callback' => 'esc_url',
                'section' => 'client_testimonial',
                'type' => 'upload',
                'default' => VARIANTLP_DIR_URI . 'assets/imgs/testimonial1.png',
                'desc' => ''
            ),
            array('id' => 'vlp_ct_description1',
                'label' => __('Description 1', 'variant-landing-page'),
                'sanitize_callback' => 'esc_html',
                'section' => 'client_testimonial',
                'type' => 'textarea',
                'default' => __('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis ligula mauris, euismod volutpat felis ac, ultrices tincidunt felis. Duis aliquam lorem erat, non efficitur metus volutpat maximus.', 'variant-landing-page'),
                'desc' => ''
            ),
            array('id' => 'vlp_ct_link_url1',
                'label' => __('Link Url 1', 'variant-landing-page'),
                'sanitize_callback' => 'esc_url',
                'section' => 'client_testimonial',
                'type' => 'text',
                'default' => '#',
                'desc' => ''
            ),
            array('id' => 'vlp_ct_link_text1',
                'label' => __('LinkText 1', 'variant-landing-page'),
                'sanitize_callback' => 'esc_attr',
                'section' => 'client_testimonial',
                'type' => 'text',
                'default' => __('Client Name, Company', 'variant-landing-page'),
                'desc' => ''
            ),
            /**
             * Testimonial 2
             */
            array('id' => 'setting_border2',
                'label' => __('Testimonial 2', 'variant-landing-page'),
                'sanitize_callback' => 'esc_url',
                'section' => 'client_testimonial',
                'type' => 'border',
                'default' => '',
                'desc' => ''
            ),
            array('id' => 'vlp_ct_image2',
                'label' => __('Image 2', 'variant-landing-page'),
                'sanitize_callback' => 'esc_url',
                'section' => 'client_testimonial',
                'type' => 'upload',
                'default' => VARIANTLP_DIR_URI . 'assets/imgs/testimonial2.png',
                'desc' => ''
            ),
            array('id' => 'vlp_ct_description2',
                'label' => __('Description 2', 'variant-landing-page'),
                'sanitize_callback' => 'esc_html',
                'section' => 'client_testimonial',
                'type' => 'textarea',
                'default' => __('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis ligula mauris, euismod volutpat felis ac, ultrices tincidunt felis. Duis aliquam lorem erat, non efficitur metus volutpat maximus.', 'variant-landing-page'),
                'desc' => ''
            ),
            array('id' => 'vlp_ct_link_url2',
                'label' => __('Link Url 2', 'variant-landing-page'),
                'sanitize_callback' => 'esc_url',
                'section' => 'client_testimonial',
                'type' => 'text',
                'default' => '#',
                'desc' => ''
            ),
            array('id' => 'vlp_ct_link_text2',
                'label' => __('LinkText 2', 'variant-landing-page'),
                'sanitize_callback' => 'esc_attr',
                'section' => 'client_testimonial',
                'type' => 'text',
                'default' => __('Client Name, Company', 'variant-landing-page'),
                'desc' => ''
            ),
            /**
             * Footer Setting
             */
            array('id' => 'vlp_footer_text',
                'label' => __('Footer Text', 'variant-landing-page'),
                'sanitize_callback' => 'esc_html',
                'section' => 'footer_setting',
                'type' => 'text',
                'default' => __('Enter your footer text like copyright notice of your business.', 'variant-landing-page'),
                'desc' => ''
            ),
        );

        foreach ($variantlp_settings as $setting) {
            $transport = (isset($setting['transport'])) ? $setting['transport'] : 'postMessage';
            $wp_customize->add_setting(
                    $setting['id'], array('default' => $setting['default'], 'capability' => 'edit_theme_options', 'transport' => $transport, 'sanitize_callback' => $setting['sanitize_callback'])
            );
            if ($setting['type'] == 'border') {
                $wp_customize->add_control(new Variantlp_Customize_HR($wp_customize, $setting['id'], array(
                    'label' => $setting['label'],
                    'section' => $setting['section'],
                    'type' => 'text',
                    'description' => $setting['desc'],
                        ))
                );
            } elseif ($setting['type'] == 'upload') {
                $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, $setting['id'], array(
                    'label' => $setting['label'],
                    'section' => $setting['section'],
                    'description' => $setting['desc'],
                        ))
                );
            } else {
                $wp_customize->add_control($setting['id'], array(
                    'label' => $setting['label'],
                    'section' => $setting['section'],
                    'type' => $setting['type'],
                    'description' => $setting['desc'],
                        )
                );
            }
        }
    }

}

// Setup the Theme Customizer settings and controls...
add_action('customize_register', array('Variantlp_Customize', 'register'));

// Output custom CSS to live site
add_action('wp_head', array('Variantlp_Customize', 'header_output'));

// Enqueue live preview javascript in Theme Customizer admin screen
add_action('customize_preview_init', array('Variantlp_Customize', 'live_preview'));

/**
 * Update theme mode option
 * @param type $mods
 * @return boolean
 */
function variantlp_update_theme_mods($mods) {
    $theme_slug = get_option('stylesheet');
    $saved_mods = get_option("theme_mods_$theme_slug");
    $merged_mods = array_merge($saved_mods, $mods);
    if (update_option("theme_mods_$theme_slug", $merged_mods)) {
        return true;
    }
    return false;
}

function variantlp_registers() {
    wp_register_script('variantlp_jquery_ui', '//code.jquery.com/ui/1.11.0/jquery-ui.js', array("jquery"), true);
    wp_register_script('variantlp_customizer_script', VARIANTLP_DIR_URI . '/assets/js/customizer.js', array("jquery", "variantlp_jquery_ui"), true);
    wp_enqueue_script('variantlp_customizer_script');
    wp_localize_script('variantlp_customizer_script', 'ink_advert', array(
        'pro' => __('View PRO version', 'variant-landing-page'),
        'url' => esc_url('https://www.inkthemes.com/wp-themes/landing-page-wordpress-theme/'),
        'support_text' => __('Need Help!', 'variant-landing-page'),
        'support_url' => esc_url('https://www.inkthemes.com/lets-connect/')
            )
    );
}

add_action('customize_controls_enqueue_scripts', 'variantlp_registers');
