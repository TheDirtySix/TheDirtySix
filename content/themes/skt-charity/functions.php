<?php  
/**
 * SKT Charity functions and definitions
 *
 * @package SKT Charity
 */
 
global $content_width;
if ( ! isset( $content_width ) )
$content_width = 640; /* pixels */ 

// Set the word limit of post content 
function skt_charity_content($limit) {
$content = explode(' ', get_the_content(), $limit);
if (count($content)>=$limit) {
array_pop($content);
$content = implode(" ",$content).'...';
} else {
$content = implode(" ",$content);
}	
$content = preg_replace('/\[.+\]/','', $content);
$content = apply_filters('the_content', $content);
$content = str_replace(']]>', ']]&gt;', $content);
return $content;
}

/**
 * Set the content width based on the theme's design and stylesheet.
 */

if ( ! function_exists( 'skt_charity_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 */
function skt_charity_setup() {
	load_theme_textdomain( 'skt-charity', get_template_directory() . '/languages' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support('woocommerce');
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'custom-header', array( 'header-text' => false ) );
	add_theme_support( 'title-tag' );
	add_theme_support( 'custom-logo', array(
		'height'      => 350,
		'width'       => 150,
		'flex-height' => true,
	) );
	add_image_size('skt-charity-homepage-thumb',240,145,true);
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'skt-charity' ),		
	) );
	add_theme_support( 'custom-background', array(
		'default-color' => 'ffffff'
	) );
	add_editor_style( 'editor-style.css' );
} 
endif; // skt_charity_setup
add_action( 'after_setup_theme', 'skt_charity_setup' );


function skt_charity_widgets_init() { 
	
	register_sidebar( array(
		'name'          => __( 'Blog Sidebar', 'skt-charity' ),
		'description'   => __( 'Appears on blog page sidebar', 'skt-charity' ),
		'id'            => 'sidebar-1',
		'before_widget' => '',		
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3><aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
	) );
	
	register_sidebar( array(
		'name'          => __( 'Header Left Widget', 'skt-charity' ),
		'description'   => __( 'Appears on left site of header', 'skt-charity' ),
		'id'            => 'header-info-left',
		'before_widget' => '<div class="headerinfo">',	
		'after_widget'  => '</div>',	
		'before_title'  => '<h3 style="display:none">',
		'after_title'   => '</h3>',		
	) );
	
	register_sidebar( array(
		'name'          => __( 'Header Right Widget', 'skt-charity' ),
		'description'   => __( 'Appears on right site of header', 'skt-charity' ),
		'id'            => 'header-info-right',
		'before_widget' => '<div class="headerinfo">',	
		'after_widget'  => '</div>',	
		'before_title'  => '<h3 style="display:none">',
		'after_title'   => '</h3>',		
	) );
			
	
}
add_action( 'widgets_init', 'skt_charity_widgets_init' );


function skt_charity_font_url(){
		$font_url = '';		
		
		/* Translators: If there are any character that are not
		* supported by Roboto, trsnalate this to off, do not
		* translate into your own language.
		*/
		$roboto = _x('on','roboto:on or off','skt-charity');		
		
		
		/* Translators: If there has any character that are not supported 
		*  by Scada, translate this to off, do not translate
		*  into your own language.
		*/
		$scada = _x('on','Scada:on or off','skt-charity');	
		
		if('off' !== $roboto ){
			$font_family = array();
			
			if('off' !== $roboto){
				$font_family[] = 'Roboto:300,400,600,700,800,900';
			}
					
						
			$query_args = array(
				'family'	=> urlencode(implode('|',$font_family)),
			);
			
			$font_url = add_query_arg($query_args,'//fonts.googleapis.com/css');
		}
		
	return $font_url;
	}


function skt_charity_scripts() {
	wp_enqueue_style('skt-charity-font', skt_charity_font_url(), array());
	wp_enqueue_style( 'skt-charity-basic-style', get_stylesheet_uri() );
	wp_enqueue_style( 'skt-charity-editor-style', get_template_directory_uri().'/editor-style.css' );
	wp_enqueue_style( 'nivoslider-style', get_template_directory_uri().'/css/nivo-slider.css' );
	wp_enqueue_style( 'skt-charity-main-style', get_template_directory_uri().'/css/responsive.css' );		
	wp_enqueue_style( 'skt-charity-base-style', get_template_directory_uri().'/css/style_base.css' );
	wp_enqueue_script( 'skt-charity-nivo-script', get_template_directory_uri() . '/js/jquery.nivo.slider.js', array('jquery') );
	wp_enqueue_script( 'skt-charity-custom_js', get_template_directory_uri() . '/js/custom.js' );	

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'skt_charity_scripts' );

define('SKT_URL','https://www.sktthemes.net','skt-charity');
define('SKT_THEME_URL','https://www.sktthemes.net/themes','skt-charity');
define('SKT_THEME_DOC','https://sktthemesdemo.net/documentation/charity_documentation/','skt-charity');
define('SKT_PRO_THEME_URL','https://www.sktthemes.net/shop/charity-wordpress-theme/','skt-charity');
define('SKT_LIVE_DEMO','http://sktthemesdemo.net/charity/','skt-charity');
define('SKT_FEATURED_EMAGE','https://www.youtube.com/watch?v=310YGYtGLIM','skt-charity');
define('SKT_FREE_THEME_URL','https://www.sktthemes.net/product-category/free/','skt-charity');

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template for about theme.
 */
require get_template_directory() . '/inc/about-themes.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

if ( ! function_exists( 'skt_charity_the_custom_logo' ) ) :
/**
 * Displays the optional custom logo.
 *
 * Does nothing if the custom logo is not available.
 *
 */
function skt_charity_the_custom_logo() {
	if ( function_exists( 'the_custom_logo' ) ) {
		the_custom_logo();
	}
}
endif;

// Add a Custom CSS file to WP Admin Area
function skt_charity_admin_theme_style() {
    wp_enqueue_style('custom-admin-style', get_template_directory_uri() . '/css/admin.css');
}
add_action('admin_enqueue_scripts', 'skt_charity_admin_theme_style');