<?php
if (class_exists('WP_Customize_Control')) {

    class Variantlp_Customize_HR extends WP_Customize_Control {

        public function render_content() {
            ?>
            <label style="margin-top: 20px;display: block; color: #298cba !important;">
                <span class="customize-control-title"><?php echo esc_html($this->label); ?></span>    
                <hr/>
            </label>
            <?php
        }

    }

}
