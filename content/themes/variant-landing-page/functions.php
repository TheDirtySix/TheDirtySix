<?php
/**
 * Landing page template module
 */
require_once(trailingslashit(get_template_directory()) . 'mods/variantlp-functions.php');

/**
 * Register Widgets
 */
require trailingslashit(get_template_directory()) . 'inc/widget-init.php';

/**
 * Variant theme setup
 */
if (!function_exists('variantlp_theme_setup')) :

    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function variantlp_theme_setup() {
        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on variantlp, use a find and replace
         * to change 'variantlp' to the name of your theme in all the template files
         */
        load_theme_textdomain('variant-landing-page', get_template_directory() . '/language');

        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        /**
         * Post thumbnail
         */
        add_theme_support('post-thumbnails');

        /**
         * Title tag support
         */
        add_theme_support('title-tag');
        /**
         * Post thumbnail image resize		 */
        add_image_size('variantlp_post_thumbnail', 672, 253, true);
        // This theme uses wp_nav_menu() in one location.

        register_nav_menus(array(
            'header_menu' => __('Header Menu', 'variant-landing-page')
        ));
        /**
         * Support exerpt on page
         */
        add_post_type_support('page', 'excerpt');

        // Enable support for HTML5 markup.
        add_theme_support('html5', array(
            'comment-list',
            'search-form',
            'comment-form',
            'gallery',
            'caption',
        ));
        add_editor_style('');
    }

endif;
/* landing_page_theme_setup */
add_action('after_setup_theme', 'variantlp_theme_setup');

if (!isset($content_width))
    $content_width = 1150;

/**
 * Enqueue styles
 */
function variantlp_styles() {
    if (!is_front_page() || !is_home() || (is_home() && get_option('show_on_front') == 'posts')) {
        wp_enqueue_style('bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.css');
        wp_enqueue_style('variantlp-raleway-font', '//fonts.googleapis.com/css?family=Raleway:500,600,700,100,800,900,400,200,300');
        wp_register_style('variantlp-style', get_stylesheet_uri());
        wp_enqueue_style('variantlp-style', get_stylesheet_uri());
    }
}

add_action('wp_enqueue_scripts', 'variantlp_styles');

/**
 * Default nav fallback
 */
function variantlp_nav_fallback() {
    ?>
    <ul class="sf-menu">
        <?php
        wp_list_pages('title_li=&show_home=1&sort_column=menu_order');
        ?>
    </ul>
    <?php
}

/**
 * Nav menu
 */
function variantlp_header_nav() {
    wp_nav_menu(array('theme_location' => 'header_menu', 'container_id' => 'menu', 'menu_class' => 'sf-menu', 'fallback_cb' => 'variantlp_nav_fallback'));
}

/**
 * For attachment page
 */
if (!function_exists('variantlp_posted_in')) :

    /**
     * Prints HTML with meta information for the current post (category, tags and permalink).
     *
     */
    function variantlp_posted_in() {
        // Retrieves tag list of current post, separated by commas.
        $tag_list = get_the_tag_list('', ', ');
        if ($tag_list) {
            $posted_in = __('This entry was posted in %1$s and tagged %2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'variant-landing-page');
        } elseif (is_object_in_taxonomy(get_post_type(), 'category')) {
            $posted_in = __('This entry was posted in %1$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'variant-landing-page');
        } else {
            $posted_in = __('Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'variant-landing-page');
        }
        // Prints the string, replacing the placeholders.
        printf(
                $posted_in, get_the_category_list(', '), $tag_list, esc_url(get_permalink()), the_title_attribute('echo=0')
        );
    }

endif;

/**
 * Pagination
 */
function variantlp_pagination($pages = '', $range = 2) {
    $showitems = ($range * 2) + 1;
    global $paged;
    if (empty($paged))
        $paged = 1;
    if ($pages == '') {
        global $wp_query;
        $pages = $wp_query->max_num_pages;
        if (!$pages) {
            $pages = 1;
        }
    }
    echo paginate_links(array('total' => $pages, 'prev_text' => '&laquo;',
        'next_text' => '&raquo;', 'type' => 'list'));
}

/**
 * Breadcrumbs
 * @global type $post
 * @global type $wp_query
 * @global type $author
 */
function variantlp_breadcrumbs() {
    $delimiter = '&raquo;';
    $home = __('Home', 'variant-landing-page'); // text for the 'Home' link
    $before = '<span class="current">'; // tag before the current crumb
    $after = '</span>'; // tag after the current crumb
    echo '<div id="crumbs">';
    global $post;
    $homeLink = esc_url(home_url());
    echo '<a href="' . $homeLink . '">' . $home . '</a> ' . $delimiter . ' ';
    if (is_category()) {
        global $wp_query;
        $cat_obj = $wp_query->get_queried_object();
        $thisCat = $cat_obj->term_id;
        $thisCat = get_category($thisCat);
        $parentCat = get_category($thisCat->parent);
        if ($thisCat->parent != 0)
            echo(get_category_parents($parentCat, TRUE, ' ' . $delimiter . ' '));
        echo $before . __('Archive by category', 'variant-landing-page') . ' "' . single_cat_title('', false) . '"' . $after;
    }
    elseif (is_day()) {
        echo '<a href="' . esc_url(get_year_link(get_the_time('Y'))) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
        echo '<a href="' . esc_url(get_month_link(get_the_time('Y'), get_the_time('m'))) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
        echo $before . get_the_time('d') . $after;
    } elseif (is_month()) {
        echo '<a href="' . esc_url(get_year_link(get_the_time('Y'))) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
        echo $before . get_the_time('F') . $after;
    } elseif (is_year()) {
        echo $before . get_the_time('Y') . $after;
    } elseif (is_single() && !is_attachment()) {
        if (get_post_type() != 'post') {
            $post_type = get_post_type_object(get_post_type());
            $slug = $post_type->rewrite;
            echo '<a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a> ' . $delimiter . ' ';
            echo $before . get_the_title() . $after;
        } else {
            $cat = get_the_category();
            $cat = $cat[0];
            echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
            echo $before . get_the_title() . $after;
        }
    } elseif (!is_single() && !is_page() && get_post_type() != 'post') {
        $post_type = get_post_type_object(get_post_type());
        echo $before . $post_type->labels->singular_name . $after;
    } elseif (is_attachment()) {
        $parent = get_post($post->post_parent);
        $cat = get_the_category($parent->ID);
        $cat = $cat[0];
        echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
        echo '<a href="' . esc_url(get_permalink($parent)) . '">' . $parent->post_title . '</a> ' . $delimiter . ' ';
        echo $before . get_the_title() . $after;
    } elseif (is_page() && !$post->post_parent) {
        echo $before . get_the_title() . $after;
    } elseif (is_page() && $post->post_parent) {
        $parent_id = $post->post_parent;
        $breadcrumbs = array();
        while ($parent_id) {
            $page = get_page($parent_id);
            $breadcrumbs[] = '<a href="' . esc_url(get_permalink($page->ID)) . '">' . get_the_title($page->ID) . '</a>';
            $parent_id = $page->post_parent;
        }
        $breadcrumbs = array_reverse($breadcrumbs);
        foreach ($breadcrumbs as $crumb)
            echo $crumb . ' ' . $delimiter . ' ';
        echo $before . get_the_title() . $after;
    } elseif (is_search()) {
        echo $before . __('Search results for', 'variant-landing-page') . ' "' . get_search_query() . '"' . $after;
    } elseif (is_tag()) {
        echo $before . __('Posts tagged ', 'variant-landing-page') . '"' . single_tag_title('', false) . '"' . $after;
    } elseif (is_author()) {
        global $author;
        $userdata = get_userdata($author);
        echo $before . __('Articles posted by ', 'variant-landing-page') . $userdata->display_name . $after;
    } elseif (is_404()) {
        echo $before . __('Error 404', 'variant-landing-page') . $after;
    }
    if (get_query_var('paged')) {
        if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author())
            echo ' (';
        echo __('Page', 'variant-landing-page') . ' ' . get_query_var('paged');
        if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author())
            echo ')';
    }
    echo '</div>';
}

/**
 * This function gets image width and height and
 * Prints attached images from the post        
 */
function variantlp_get_image($width, $height) {
    $w = $width;
    $h = $height;
    global $post;
    $img_source = '';
    $permalink = esc_url(get_permalink());
    ob_start();
    ob_end_clean();
    $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
    if (isset($matches [1] [0])) {
        $img_source = $matches [1] [0];
    }
    if (!empty($img_source)) {
        print "<a href='" . esc_url($permalink) . "'><img width='" . esc_attr($w) . "' height='" . esc_attr($h) . "' src='" . esc_url($img_source) . "' class='postimg' alt='Post Image'/></a>";
    }
}

/**
 * Alter default excerpt length
 */
function variantlp_excerpt_length($length) {
    return 160;
}

add_filter('excerpt_length', 'variantlp_excerpt_length');

/**
 * Enqueue scripts and styles.
 */
function variantlp_scripts() {
    if (!is_front_page() || !is_home()) {
        wp_enqueue_script('variantlp-meanmenu', get_template_directory_uri() . '/assets/js/meanmenu.js', array('jquery'), false, true);
        wp_enqueue_script('variantlp-supperfish', get_template_directory_uri() . '/assets/js/superfish.js', array('jquery'), false, true);
        wp_enqueue_script('variantlp-scripts-init', get_template_directory_uri() . '/assets/js/init.js', array('jquery'), false, true);
        if (is_singular() && get_option('thread_comments'))
            wp_enqueue_script('comment-reply');
    }
}

add_action('wp_enqueue_scripts', 'variantlp_scripts');
