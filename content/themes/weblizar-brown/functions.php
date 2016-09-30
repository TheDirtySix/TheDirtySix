<?php
add_action('wp_enqueue_scripts', 'removeScripts' , 20);
function removeScripts() {

wp_dequeue_style( 'flat-blue',get_template_directory_uri() .'/css/skins/flat-blue.css'); 

wp_enqueue_style('lite-brown', get_stylesheet_directory_uri() . '/css/skins/light-brown.css');

}?>