<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo('charset'); ?>" />  
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php wp_head(); ?> 
    </head>
    <body <?php body_class(); ?>>      
        <div id="main">
            <!--Header-->
            <header id="header" role="banner">
                <div class="header-overlay"></div>
                <div class="header_wrapper">
                    <div class="top-header">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-3">
                                    <?php /* Allow screen readers / text browsers to skip the navigation menu and get right to the good stuff */ ?>
                                    <a class="skip-link screen-reader-text" href="#content_wrapper"><?php _e('Skip to content', 'variant-landing-page'); ?></a>
                                    <div class="logo">
                                        <a href="<?php echo esc_url(site_url('/')); ?>">
                                            <?php
                                            $defalult_logo = VARIANTLP_DIR_URI . "assets/imgs/variant-logo.png";
                                            ?>
                                            <img src="<?php echo esc_url(variantlp_get_option('vlp_logo', $defalult_logo)); ?>" alt="<?php bloginfo('name'); ?>" />
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <!--Menus-->
                                    <div class="menu-wrap">
                                        <menu id="menu" role="navigation">
                                            <?php variantlp_header_nav(); ?>
                                        </menu>
                                    </div>
                                    <!--/Menus-->
                                </div>
                            </div>
                        </div>    
                    </div>
                    <span class="clear"></span>