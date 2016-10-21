<!--Footer-->
<div id="footer" class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php
                /* A sidebar in the footer? Yep. You can can customize
                 * your footer with four columns of widgets.
                 */
                get_sidebar('footer');
                ?>
            </div>
        </div>
    </div>
</div>
<!--/Footer-->
<!--Footer Bottom-->
<div id="footer_bottom" class="footer-bottom">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="copyright" role="contentinfo">
                    <?php echo esc_html(variantlp_get_option('vlp_footer_text', '2015 &copy; <a href="' . esc_url(home_url('/')) . '">InkThemes.com</a> All rights reserved.')); ?>
                </div>
            </div>
        </div>
    </div>
</div> 
<!--Footer Bottom-->
</div>     

<?php wp_footer(); ?>

</body>
</html>
