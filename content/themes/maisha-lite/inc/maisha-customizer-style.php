<?php
//////////////////////////////////////////////////////////////////
// Customizer - Add CSS
//////////////////////////////////////////////////////////////////
function maisha_customizer_css() {
    ?>
    <style type="text/css">

		<?php if(get_theme_mod( 'maisha_custom_css' )) : ?>
		<?php echo wp_kses( get_theme_mod( 'maisha_custom_css' ), '' ); ?>
		<?php endif; ?>

    </style>
    <?php
}
add_action( 'wp_head', 'maisha_customizer_css' );
?>