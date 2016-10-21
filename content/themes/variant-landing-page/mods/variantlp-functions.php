<?php
define('VARIANTLP_DIR', get_template_directory() . '/mods/');
define('VARIANTLP_DIR_URI', trailingslashit(get_template_directory_uri()) . 'mods/');

require VARIANTLP_DIR . 'class-tgm-plugin-activation.php' ;

/**
 * Register TGM
 */
add_action('tgmpa_register', 'variantlp_register_required_plugins');

/**
 * Load customizer class
 */
require_once VARIANTLP_DIR . '/inc/customizer/variant-customizer.php';
require_once VARIANTLP_DIR . '/inc/customizer/variant-custom-controls.php';

/**
 * Generates contact form
 * @return string
 */
function variantlp_lead_form($form_link, $height = '540', $echo = false, $position = '') {
    $iframe = '';
    if ($position) {
        $position = '&l=' . $position;
    }

    $form_custom_style = VARIANTLP_DIR_URI . 'assets/css/form-style/form.css';

    $find = 'form/share';
    $replace = 'e/form';
    $form_link = str_replace($find, $replace, $form_link);

    $src = esc_url($form_link . '/i?fgcss=' . $form_custom_style . $position);
    $atts = "height='" . $height . "' allowTransparency='true' frameborder='0' scrolling='yes' style='width:100%;border:none'";
    $iframe = "<iframe " . $atts . "   src='" . $src . "'>" . __('Your Contact', 'variant-landing-page') . "</iframe>";
    if ($echo) {
        echo $iframe;
    }
    return $iframe;
}

/**
 * Get form id from given url
 * @param type $url
 * @return type
 */
function variantlp_get_formID($url) {
    if ($url) {
        $s = explode("/", $url);
        return end($s);
    }
}

/**
 * Get theme option value
 * @param type $option_id
 * @param type $default
 * @return type mixed
 */
function variantlp_get_option($option_id, $default = '') {
    if (function_exists('get_theme_mod')) {
        $option_val = get_theme_mod($option_id);
        if ($option_val != '') {
            return get_theme_mod($option_id);
        }
    }
    return $default;
}

/**
 * Load landing page template
 */
function variantlp_load_template() {
    include_once VARIANTLP_DIR . 'template/landing-page.php';
}

/**
 * Landing page template selector
 * @return type string
 */
function variantlp_template_selector() {
    $templates_arr = array('template1');
    $template = variantlp_get_option('template_designs', 'template1');
    if (in_array($template, $templates_arr)) {
        return $template;
    }
}

/**
 * Enqueue stylesheet
 */
function variantlp_stylesheet_enqueue() {
    if (is_front_page() || is_home()) {
        wp_enqueue_style('variantlp-bootstrap-css', VARIANTLP_DIR_URI . "assets/css/core/bootstrap.css");
        wp_enqueue_style('variantlp-fontawesome', VARIANTLP_DIR_URI . "assets/css/font-awesome/css/font-awesome.min.css");
        wp_enqueue_style('variantlp-font', '//fonts.googleapis.com/css?family=Raleway:400,100,200,300,500,700,600,800,900');
        wp_enqueue_style('variantlp-base-style', VARIANTLP_DIR_URI . "assets/css/style.css");
        wp_enqueue_style('variantlp-template-css', VARIANTLP_DIR_URI . "assets/css/template-style/template.css");
    }
}

add_action('wp_enqueue_scripts', 'variantlp_stylesheet_enqueue');

/**
 * Manage template with admin bar
 */
function variantlp_header() {
    if (current_user_can('manage_options')) {
        ?>
        <style>
            .template_one{
                position:relative;
            }
            .template_one .top_feature_container{
                margin-top: -26px;
            }
            .top_feature_container .header {
                margin-top: 44px !important;
            }
        </style>
        <?php
    }
}

add_action('wp_enqueue_scripts', 'variantlp_header');

function variantlp_template_bg() {
    $bg_id = 'vlp_top_bg_img';
    $default_bg = 'template_one_top_bg';
    $position = 'fixed';
    $min_height = '450px';
    ?>
    <style id="top_background" type="text/css">
        .top_feature_container {
            background: url("<?php echo esc_url(variantlp_get_option($bg_id, VARIANTLP_DIR_URI . 'assets/imgs/' . $default_bg . '.png')); ?>") <?php echo esc_html($position); ?> center top repeat-x;
            width: 100%;
            min-height: <?php echo esc_html($min_height); ?>;
            color: #fff;
        }
    </style>
    <?php
}

add_action('wp_enqueue_scripts', 'variantlp_template_bg');

/**
 * Register the required plugins for this theme.
 *
 * In this example, we register five plugins:
 * - one included with the TGMPA library
 * - two from an external source, one from an arbitrary source, one from a GitHub repository
 * - two from the .org repo, where one demonstrates the use of the `is_callable` argument
 *
 * The variable passed to tgmpa_register_plugins() should be an array of plugin
 * arrays.
 *
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 */
function variantlp_register_required_plugins() {
    /*
     * Array of plugin arrays. Required keys are name and slug.
     * If the source is NOT from the .org repo, then source is also required.
     */
    $plugins = array(
        // Option tree plugin from the WordPress Plugin Repository.
        array(
            'name' => 'FormGet Contact Form',
            'slug' => 'formget-contact-form',
            'required' => false,
            'force_activation' => false,
            'force_deactivation' => true,
        ),
    );

    /*
     * Array of configuration settings. Amend each line as needed.
     *
     * TGMPA will start providing localized text strings soon. If you already have translations of our standard
     * strings available, please help us make TGMPA even better by giving us access to these translations or by
     * sending in a pull-request with .po file(s) with the translations.
     *
     * Only uncomment the strings in the config array if you want to customize the strings.
     */
    $config = array(
        'id' => 'tgmpa', // Unique ID for hashing notices for multiple instances of TGMPA.
        'default_path' => '', // Default absolute path to bundled plugins.
        'menu' => 'tgmpa-install-plugins', // Menu slug.
        'parent_slug' => 'themes.php', // Parent menu slug.
        'capability' => 'edit_theme_options', // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
        'has_notices' => true, // Show admin notices or not.
        'dismissable' => true, // If false, a user cannot dismiss the nag message.
        'dismiss_msg' => '', // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false, // Automatically activate plugins after installation or not.
        'message' => '', // Message to output right before the plugins table.
        'strings' => array(
            'page_title' => __('Install Recommended Plugins', 'variant-landing-page'),
            'menu_title' => __('Install Plugins', 'variant-landing-page'),
            'installing' => __('Installing Plugin: %s', 'variant-landing-page'), // %s = plugin name.
            'oops' => __('Something went wrong with the plugin API.', 'variant-landing-page'),
            'notice_can_install_required' => _n_noop(
                    'This theme recommends the following plugin to add lead form on landing page: %1$s.', 'This theme requires the following plugins: %1$s.', 'variant-landing-page'
            ), // %1$s = plugin name(s).
            'notice_can_install_recommended' => _n_noop(
                    'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'variant-landing-page'
            ), // %1$s = plugin name(s).
            'notice_cannot_install' => _n_noop(
                    'Sorry, but you do not have the correct permissions to install the %1$s plugin.', 'Sorry, but you do not have the correct permissions to install the %1$s plugins.', 'variant-landing-page'
            ), // %1$s = plugin name(s).
            'notice_ask_to_update' => _n_noop(
                    'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'variant-landing-page'
            ), // %1$s = plugin name(s).
            'notice_ask_to_update_maybe' => _n_noop(
                    'There is an update available for: %1$s.', 'There are updates available for the following plugins: %1$s.', 'variant-landing-page'
            ), // %1$s = plugin name(s).
            'notice_cannot_update' => _n_noop(
                    'Sorry, but you do not have the correct permissions to update the %1$s plugin.', 'Sorry, but you do not have the correct permissions to update the %1$s plugins.', 'variant-landing-page'
            ), // %1$s = plugin name(s).
            'notice_can_activate_required' => _n_noop(
                    'This theme recommends the following plugin to add lead form on landing page is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'variant-landing-page'
            ), // %1$s = plugin name(s).
            'notice_can_activate_recommended' => _n_noop(
                    'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'variant-landing-page'
            ), // %1$s = plugin name(s).
            'notice_cannot_activate' => _n_noop(
                    'Sorry, but you do not have the correct permissions to activate the %1$s plugin.', 'Sorry, but you do not have the correct permissions to activate the %1$s plugins.', 'variant-landing-page'
            ), // %1$s = plugin name(s).
            'install_link' => _n_noop(
                    'Begin installing plugin', 'Begin installing plugins', 'variant-landing-page'
            ),
            'update_link' => _n_noop(
                    'Begin updating plugin', 'Begin updating plugins', 'variant-landing-page'
            ),
            'activate_link' => _n_noop(
                    'Begin activating plugin', 'Begin activating plugins', 'variant-landing-page'
            ),
            'return' => __('Return to Required Plugins Installer', 'variant-landing-page'),
            'plugin_activated' => __('Plugin activated successfully.', 'variant-landing-page'),
            'activated_successfully' => __('The following plugin was activated successfully:', 'variant-landing-page'),
            'plugin_already_active' => __('No action taken. Plugin %1$s was already active.', 'variant-landing-page'), // %1$s = plugin name(s).
            'plugin_needs_higher_version' => __('Plugin not activated. A higher version of %s is needed for this theme. Please update the plugin.', 'variant-landing-page'), // %1$s = plugin name(s).
            'complete' => __('All plugins installed and activated successfully. %1$s', 'variant-landing-page'), // %s = dashboard link.
            'contact_admin' => __('Please contact the administrator of this site for help.', 'variant-landing-page'),
            'nag_type' => 'updated', // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
        ),
    );


    tgmpa($plugins, $config);
}

function variantlp_formgetform_ajaxcallback() {
    ob_clean();
    $form_id = trim($_POST['formid']);
    if ($form_id) {
        ?>
        <div class="form_wrapper_custom">
            <?php
            //$height = variantlp_get_option('vlp_form_height', '482');
            echo variantlp_lead_form($form_id);
            ?>
        </div>
        <?php
    } else {
        echo '<a class="fg-placeholder" href="http://www.formget.com/app/" target="new"><img src="' . VARIANTLP_DIR_URI . 'assets/imgs/fg-placeholder.png" alt="Formget Placeholder" /></a>';
    }
    die();
}

function variantlp_formgetform_ajax() {
    add_action('wp_ajax_variantlp_form_ajax', 'variantlp_formgetform_ajaxcallback');
    add_action('wp_ajax_nopriv_variantlp_form_ajax', 'variantlp_formgetform_ajaxcallback');
}

add_action('init', 'variantlp_formgetform_ajax');
