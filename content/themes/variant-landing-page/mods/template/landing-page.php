<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 * @package Inkthemes
 * @subpackage landing_page_theme
 * @since Landing page theme 1.0
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php wp_head(); ?>
    </head>
    <body <?php body_class(); ?>>
        <div class="page_container template_one" role="main">
            <div class="top_feature_container" role="banner">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12"> 
                            <div class="row">
                                <div class="header">
                                    <div class="col-md-6">
                                        <div class="logo">
                                            <a href="<?php echo esc_url(site_url('/')); ?>">
                                                <?php
                                                $defalult_logo = VARIANTLP_DIR_URI . "assets/imgs/variant-logo.png";
                                                ?>
                                                <img src="<?php echo esc_url(variantlp_get_option('vlp_logo', $defalult_logo)); ?>" />
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="contact_detail">    
                                            <p class="font_icon"><i class="fa-phone fa"></i></p>
                                            <span class="c-number"><?php echo esc_html(variantlp_get_option('vlp_contact_number', __('885-5441-122', 'variant-landing-page'))); ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="clear clearfix"></div>
                            <div class="top_feature_content">
                                <h1><?php echo wp_kses_post(variantlp_get_option('vlp_top_heading', __('Best <span>Landing Page</span> Theme', 'variant-landing-page'))); ?></h1>
                                <p><?php echo esc_html(variantlp_get_option('vlp_top_description', __("Capture Leads Instantly and Sell Your Services With Variant Landing Page Theme", 'variant-landing-page'))); ?> </p>
                            </div>
                        </div>
                    </div>
                </div> 
            </div>
            <div class="template_feature_container">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-md-7">
                                    <div class="feature_item_content"> 
                                        <?php
                                        $featured_items = variantlp_get_option('vlp_featured_items');
                                        $feature_dummy_content = array(
                                            array(
                                                'title' => __('Feature 1', 'variant-landing-page'),
                                                'vlp_fa_icon_class' => __('fa-comment-o', 'variant-landing-page'),
                                                'vlp_fa_heading' => __('Completely Responsive', 'variant-landing-page'),
                                                'vlp_fa_description' => __('Variant is completely responsive and looks cool across all devices.', 'variant-landing-page'),
                                            ),
                                            array(
                                                'title' => __('Feature 2', 'variant-landing-page'),
                                                'vlp_fa_icon_class' => __('fa-comment-o', 'variant-landing-page'),
                                                'vlp_fa_heading' => __('Conversion Optimized', 'variant-landing-page'),
                                                'vlp_fa_description' => __('Collect leads instantly and start selling your services.', 'variant-landing-page'),
                                            ),
                                            array(
                                                'title' => __('Feature 3', 'variant-landing-page'),
                                                'vlp_fa_icon_class' => __('fa-comment-o', 'variant-landing-page'),
                                                'vlp_fa_heading' => __('Custom Lead Gen Form', 'variant-landing-page'),
                                                'vlp_fa_description' => __('Create any kind of Form via FormGet and use it on Landing Page.', 'variant-landing-page'),
                                            ),
                                        );
                                        $featured_items = $feature_dummy_content;

                                        if (!empty($featured_items)) {
                                            foreach ($featured_items as $key => $value) {
                                                ?>
                                                <div class="feature_item">
                                                    <span class="font_icon"><i id="<?php echo esc_attr('vlp_fa_icon_class' . ($key + 1)); ?>" class="<?php echo esc_attr(variantlp_get_option('vlp_fa_icon_class' . ($key + 1), $value['vlp_fa_icon_class'])); ?> fa"></i></span> 
                                                    <div class="feature_item_inner">        
                                                        <h2 id="<?php echo esc_attr('vlp_fa_heading' . ($key + 1)); ?>"><?php echo esc_html(variantlp_get_option('vlp_fa_heading' . ($key + 1), $value['vlp_fa_heading'])); ?></h2>
                                                        <p id="<?php echo esc_attr('vlp_fa_description' . ($key + 1)); ?>"><?php echo esc_html(variantlp_get_option('vlp_fa_description' . ($key + 1), $value['vlp_fa_description'])); ?></p>
                                                    </div> 
                                                </div>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div id="lead_form_wrapper" role="form">
                                        <?php
                                        $form_link = variantlp_get_option('vlp_lead_form');
                                        if ($form_link) {
                                            ?>
                                            <div class="form_wrapper_custom">
                                                <?php
                                                //$height = variantlp_get_option('vlp_form_height', '482');
                                                echo variantlp_lead_form($form_link);
                                                ?>
                                            </div>
                                            <?php
                                        } else {
                                            echo '<a class="fg-placeholder" href="http://www.formget.com/app/" target="new"><img src="' . VARIANTLP_DIR_URI . 'assets/imgs/fg-placeholder.png" alt="Formget Placeholder" /></a>';
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>       
            </div>
            <div class="testimonial_heading_container"> 
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="testimonial_heading_content"> 
                                <h2 id="vlp_top_heading"><?php echo esc_html(variantlp_get_option('vlp_testimonial_heading_text', __("Showcase Your Client Testimonial", 'variant-landing-page'))); ?></h2>
                            </div>
                        </div>
                    </div>
                </div>       
            </div>
            <div class="testimonial_item_contianer"> 
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="testimonial_item_content"> 
                                <?php
                                $testimonial = variantlp_get_option('vlp_client_testimonial');
                                $client_dummy_content = array(
                                    array(
                                        'vlp_ct_image' => VARIANTLP_DIR_URI . 'assets/imgs/testimonial1.png',
                                        'vlp_ct_description' => __('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis ligula mauris, euismod volutpat felis ac, ultrices tincidunt felis. Duis aliquam lorem erat, non efficitur metus volutpat maximus.', 'variant-landing-page'),
                                        'vlp_ct_link_url' => '#',
                                        'vlp_ct_link_text' => __('Client Name, Company', 'variant-landing-page'),
                                    ),
                                    array(
                                        'vlp_ct_image' => VARIANTLP_DIR_URI . 'assets/imgs/testimonial2.png',
                                        'vlp_ct_description' => __('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis ligula mauris, euismod volutpat felis ac, ultrices tincidunt felis. Duis aliquam lorem erat, non efficitur metus volutpat maximus.', 'variant-landing-page'),
                                        'vlp_ct_link_url' => '#',
                                        'vlp_ct_link_text' => __('Client Name, Company', 'variant-landing-page'),
                                    ),
                                );

                                $testimonial = $client_dummy_content;

                                if (!empty($testimonial)) {
                                    foreach ($testimonial as $key => $value) {
                                        ?>
                                        <div class="testimonial_item" id="testimonial_item<?php echo esc_attr($key + 1); ?>">
                                            <img src="<?php echo esc_url(variantlp_get_option('vlp_ct_image' . ($key + 1), $value['vlp_ct_image'])); ?>" />
                                            <div class="testimonial_item_inner">  
                                                <p><?php echo esc_html(variantlp_get_option('vlp_ct_description' . ($key + 1), $value['vlp_ct_description'])); ?></p>
                                                <a href="<?php echo esc_url(variantlp_get_option('vlp_ct_link_url' . ($key + 1), $value['vlp_ct_link_url'])); ?>"><?php echo esc_html(variantlp_get_option('vlp_ct_link_text' . ($key + 1), $value['vlp_ct_link_text'])); ?></a>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>       
            </div>
            <div class="footer_container">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="footer_content" role="contentinfo">
                                <p class="footer-text"><?php echo esc_html(variantlp_get_option('vlp_footer_text', date('Y') . ' &copy; Variant All rights reserved.')); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php wp_footer(); ?>
    </body>
</html>