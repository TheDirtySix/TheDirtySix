<?php
/**
 * SKT Charity About Theme
 *
 * @package SKT Charity
 */
 
//about theme info
add_action( 'admin_menu', 'skt_charity_abouttheme' );
function skt_charity_abouttheme() {    	
	add_theme_page( __('About Theme', 'skt-charity'), __('About Theme', 'skt-charity'), 'edit_theme_options', 'skt_charity_guide', 'skt_charity_mostrar_guide');   
} 

//guidline for about theme
function skt_charity_mostrar_guide() { 
	//custom function about theme customizer
	$return = add_query_arg( array()) ;
?>

<style type="text/css">
@media screen and (min-width: 800px) {
.col-left {float:left; width: 65%; padding: 1%;}
.col-right {float:right; width: 30%; padding:1%; border-left:1px solid #DDDDDD; }
}
</style>

<div class="wrapper-info">
	<div class="col-left">
   		   <div style="font-size:16px; font-weight:bold; padding-bottom:5px; border-bottom:1px solid #ccc;">
			  <?php esc_attr_e('About Theme Info', 'skt-charity'); ?>
		   </div>
          <p><?php esc_attr_e('SKT Charity is a charity WordPress theme which is meant for donation, NGO, Churches, fundraising and non profit websites. It can also be used for business, corporate, agency and portfolio as well as personal and blogging websites. It is compatible with WooCommerce, Contact form 7 and Nextgen gallery among others and is multilingual with compatibility with qTranslate X and is translation ready. It is simple, adaptable, flexible and responsive theme.','skt-charity'); ?></p>
		  <a href="<?php echo SKT_PRO_THEME_URL; ?>"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/free-vs-pro.png" alt="" /></a>
	</div><!-- .col-left -->
	
	<div class="col-right">			
			<div style="text-align:center; font-weight:bold;">
				<hr />
				<a href="<?php echo SKT_LIVE_DEMO; ?>" target="_blank"><?php esc_attr_e('Live Demo', 'skt-charity'); ?></a> | 
				<a href="<?php echo SKT_PRO_THEME_URL; ?>"><?php esc_attr_e('Buy Pro', 'skt-charity'); ?></a> | 
				<a href="<?php echo SKT_THEME_DOC; ?>" target="_blank"><?php esc_attr_e('Documentation', 'skt-charity'); ?></a>
                <div style="height:5px"></div>
				<hr />                
                <a href="<?php echo SKT_THEME_URL; ?>" target="_blank"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/sktskill.jpg" alt="" /></a>
			</div>		
	</div><!-- .col-right -->
</div><!-- .wrapper-info -->
<?php } ?>