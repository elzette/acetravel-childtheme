<?php
/**
 * Ace Travel.
 *
 * @package      acetravel-childtheme
 * @author       Semblance
 */

/** Start the engine **/
require_once( get_template_directory() . '/lib/init.php' );

// * Add HTML5 markup structure
add_theme_support( 'html5' );

// * Add viewport meta tag for mobile browsers
add_theme_support( 'genesis-responsive-viewport' );

// * Setup Theme
include_once( get_stylesheet_directory() . '/lib/theme-defaults.php' );

add_filter( 'widget_text', 'do_shortcode' );

add_action( 'wp_enqueue_scripts', 'acetravel_scripts' );
/**
 * Enqueue scripts
 */
function acetravel_scripts() {

	wp_enqueue_script( 'acetravel-responsive-menu', get_bloginfo( 'stylesheet_directory' ) . '/js/responsive-menu.js', array( 'jquery' ), '1.0.0' );

	// * Load slick slider
	wp_enqueue_script( 'slick-js', get_bloginfo( 'stylesheet_directory' ) . '/js/slick/slick.js', array( 'jquery' ), '1.3.3', true );
	wp_enqueue_script( 'slick-js-init', get_bloginfo( 'stylesheet_directory' ) . '/js/slick/slick-init.js', array( 'slick-js' ), '1.3.3', true );

	wp_enqueue_style( 'slick-css', get_bloginfo( 'stylesheet_directory' ) . '/js/slick/slick.css', array(), '4.1.0', 'screen' );
	wp_enqueue_style( 'slick-css-theme', get_bloginfo( 'stylesheet_directory' ) . '/js/slick/slick-theme.css', array(), '1.0', 'screen' );
	wp_enqueue_style( 'dashicons' );
	wp_enqueue_script( 'mainjs', get_bloginfo( 'stylesheet_directory' ) . '/js/main.js', array( 'jquery' ), '1.0.0', true );
}

// * Add new image sizes
add_image_size( 'blog-square-featured', 400, 400, true );
add_image_size( 'blog-vertical-featured', 390, 450, true );
add_image_size( 'sidebar-featured', 125, 125, true );
add_image_size( 'large-featured', 750, 500, true );
add_image_size( 'adverts', 575, 400, true );

// * Add support for custom background
add_theme_support( 'custom-background' );

// * Add support for custom header
add_theme_support( 'custom-header', array(
	'width'           => 180,
	'height'          => 110,
	'flex-width'      => true,
	'flex-height'     => true,
	'header-selector' => '.site-title a',
	'header-text'     => false,
) );

// * Add support for 2-column footer widgets
add_theme_support( 'genesis-footer-widgets', 2 );

// * Unregister layout settings
genesis_unregister_layout( 'content-sidebar-sidebar' );
genesis_unregister_layout( 'sidebar-content-sidebar' );
genesis_unregister_layout( 'sidebar-sidebar-content' );

// * Unregister secondary sidebar
unregister_sidebar( 'sidebar-alt' );

add_action( 'genesis_before', 'acetravel_widget_above_header' );
/**
 * Hooks widget area above header
 */
function acetravel_widget_above_header() {

	genesis_widget_area( 'widget-above-header', array(
		'before' => '<div class="widget-above-header widget-area"><div class="wrap">',
		'after'  => '</div></div>',
	) );

}

/**
 * Add woocommerce taxonomy terms of product to to body class
 *
 * @param type $classes Adding different classes to body element.
 */
function custom_taxonomy_in_body_class( $classes ) {
	if ( is_singular() ) {
		global $post;
		$custom_terms = get_the_terms( $post->ID, 'product_cat' );
		if ( $custom_terms ) {
			foreach ( $custom_terms as $custom_term ) {
				$classes[] = $custom_term->slug;
			}
		}
	}
	return $classes;
}
add_filter( 'body_class', 'custom_taxonomy_in_body_class' );


// * Reposition the secondary navigation
remove_action( 'genesis_after_header', 'genesis_do_subnav' );
add_action( 'genesis_before', 'genesis_do_subnav' );

// * Add widget to secondary navigation
add_filter( 'genesis_nav_items', 'acetravel_social_icons', 10, 2 );
add_filter( 'wp_nav_menu_items', 'acetravel_social_icons', 10, 2 );

/**
 * Add secondary navigation in header
 *
 * @param type $menu Add secondary menu in header.
 *
 * @param type $args Option for menu location.
 */
function acetravel_social_icons( $menu, $args ) {
	$args = (array) $args;
	if ( 'secondary' !== $args['theme_location'] )
		return $menu;
	ob_start();
	genesis_widget_area( 'nav-social-menu' );
	$social = ob_get_clean();
	return $menu . $social;
}

// * Position post info above post title
remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );
add_action( 'genesis_entry_header', 'genesis_post_info', 9 );

add_filter( 'genesis_post_info', 'acetravel_post_info_filter' );
/**
 * Customize the Post Info Function
 *
 * @param type $post_info Post info filter.
 */
function acetravel_post_info_filter( $post_info ) {
	$post_info = '[post_categories before="" sep=""]';
	return $post_info;
}

// * Remove post footer
remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_open', 5 );
remove_action( 'genesis_entry_footer', 'genesis_post_meta', 10 );
remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_close', 15 );

add_filter( 'genesis_search_text', 'sp_search_text' );
/**
 * Customize search form input box text
 *
 * @param type $text Return text in search.
 */
function sp_search_text( $text ) {
	return esc_attr( 'Where would you like to go?' );
}

// * Add post navigation (requires HTML5 support)
add_action( 'genesis_entry_footer', 'genesis_prev_next_post_nav', 15 );

// * Add support for after entry widget
add_theme_support( 'genesis-after-entry-widget-area' );

add_action( 'genesis_before_content', 'acetravel_before_content' );
/**
 * Hooks before-content widget area to single posts
 */
function acetravel_before_content() {
	if ( ! is_home() )
		return;
		genesis_widget_area( 'before-content', array(
			'before' => '<div class="before-content widget-area"><div class="wrap">',
			'after'  => '</div></div>',
		) );
}

add_action( 'genesis_after_sidebar_widget_area', 'acetravel_split_sidebars' );
/**
 * Add split sidebars underneath the primary sidebar
 */
function acetravel_split_sidebars() {
	foreach ( array( 'sidebar-split-left', 'sidebar-split-right', 'sidebar-split-bottom' ) as $area ) {
		echo '<div class="' . $area . '">';
		dynamic_sidebar( $area );
		echo '</div><!-- end #' . $area . '-->';
	}
}

add_filter( 'get_the_content_more_link', 'acetravel_read_more_link' );
/**
 * Modify the Genesis content limit read more link
 */
function acetravel_read_more_link() {
	return '... <a class="more-link" href="' . get_permalink() . '">continue reading...</a>';
}

add_action( 'genesis_before_footer', 'partner_logos' );
/**
 * Add partner logos before footer
 */
function partner_logos() {
	if ( is_front_page() || is_page() ) {
		echo '<div class="partner-logos">';
		echo '<h4>Our Partners</h4>';
		if ( have_rows( 'partner_logos', 'option' ) ) : while ( have_rows( 'partner_logos', 'option' ) ) : the_row();
				// * vars
				$image = get_sub_field( 'logo_image', 'option' );
				echo '<div><figure><img data-lazy="' . $image['url'] . '" alt="' . $image['alt'] . '" /></figure></div>';
		endwhile;
		endif;
		echo '</div><!-- end .partner-logos -->';
	}
}

add_action( 'genesis_after', 'acetravel_widget_before_footer' );
/**
 * Hooks widget area before footer
 */
function acetravel_widget_before_footer() {
	genesis_widget_area( 'widget-before-footer', array(
		'before' => '<div class="widget-before-footer widget-area"><div class="wrap">',
		'after'  => '</div></div>',
	) );
}

// * remove emoji from header
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );

// * Reposition the footer widgets
remove_action( 'genesis_before_footer', 'genesis_footer_widget_areas' );
add_action( 'genesis_after', 'genesis_footer_widget_areas' );

// * Reposition the footer
remove_action( 'genesis_footer', 'genesis_footer_markup_open', 5 );
remove_action( 'genesis_footer', 'genesis_do_footer' );
remove_action( 'genesis_footer', 'genesis_footer_markup_close', 15 );
add_action( 'genesis_after', 'genesis_footer_markup_open', 11 );
add_action( 'genesis_after', 'genesis_do_footer', 12 );
add_action( 'genesis_after', 'genesis_footer_markup_close', 13 );

add_filter( 'comment_form_defaults', 'acetravel_remove_comment_form_allowed_tags' );
/**
 * Remove comment form allowed tags
 *
 * @param type $defaults Return going back to the basics.
 */
function acetravel_remove_comment_form_allowed_tags( $defaults ) {
	$defaults['comment_notes_after'] = '';
	return $defaults;
}

add_filter( 'genesis_footer_creds_text', 'acetravel_custom_footer_creds_text' );
/**
 * Customize the credits
 */
function acetravel_custom_footer_creds_text() {
	echo '<div class="creds"><p>';
	echo 'All images and text copyright &copy; ';
	echo date( 'Y' );
	echo ' &middot; Ace Travel and their respective owners';
	echo '</p></div>';
}

add_filter( 'upload_mimes', 'wps_mime_types' );
/**
 * Add support for SVG inside WordPress Media Uploader
 *
 * @link http://wpsnipp.com/index.php/functions-php/add-support-svg-inside-wordpress-media-uploader/
 *
 * @param type $mimes Return that mime.
 */
function wps_mime_types( $mimes ) {
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
}

// * Add Theme Support for WooCommerce
add_theme_support( 'genesis-connect-woocommerce' );

add_action( 'woocommerce_after_shop_loop_item', 'remove_add_to_cart_buttons', 1 );
/**
 * Remove Add to Cart on Archives
 */
function remove_add_to_cart_buttons() {
	remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart' );
}

add_filter( 'loop_shop_columns', 'loop_columns' );
if ( ! function_exists( 'loop_columns' ) ) {
	/**
	 * Change number or products per row to 3
	 */
	function loop_columns() {
		return 3; // 3 products per row
	}
}

// * Display all products per page
add_filter( 'loop_shop_per_page', create_function( '$cols', 'return 96;' ), 20 );

// * Register widget areas
genesis_register_sidebar( array(
	'id'			=> 'sidebar-split-left',
	'name'			=> __( 'Sidebar Split Left', 'acetravel' ),
	'description'	=> __( 'This is the left side of the split sidebar', 'acetravel' ),
) );
genesis_register_sidebar( array(
	'id'			=> 'sidebar-split-right',
	'name'			=> __( 'Sidebar Split Right', 'acetravel' ),
	'description'	=> __( 'This is the right side of the split sidebar', 'acetravel' ),
) );
genesis_register_sidebar( array(
	'id'			=> 'sidebar-split-bottom',
	'name'			=> __( 'Sidebar Split Bottom', 'acetravel' ),
	'description'	=> __( 'This is the bottom of the split sidebar', 'acetravel' ),
) );
genesis_register_sidebar( array(
	'id'          => 'before-content',
	'name'        => __( 'Home - Before Content', 'acetravel' ),
	'description' => __( 'This is the slider section on the home page.', 'acetravel' ),
) );
genesis_register_sidebar( array(
	'id'          => 'home-triple-bottom',
	'name'        => __( 'Home - Triple Bottom', 'acetravel' ),
	'description' => __( 'This is the bottom section of the home page.', 'acetravel' ),
) );
genesis_register_sidebar( array(
	'id'          => 'home-double-bottom',
	'name'        => __( 'Home - Double Bottom', 'acetravel' ),
	'description' => __( 'This is the bottom section of the home page.', 'acetravel' ),
) );
genesis_register_sidebar( array(
	'id'          => 'category-index',
	'name'        => __( 'Category Index', 'acetravel' ),
	'description' => __( 'This is the category index for the category index page template.', 'acetravel' ),
) );
genesis_register_sidebar( array(
	'id'			=> 'widget-above-header',
	'name'			=> __( 'Widget Above Header', 'acetravel' ),
	'description'	=> __( 'This is the widget area above the header', 'acetravel' ),
) );
genesis_register_sidebar( array(
	'id'			=> 'widget-before-footer',
	'name'			=> __( 'Widget Before Footer', 'acetravel' ),
	'description'	=> __( 'This is the widget area above the header', 'acetravel' ),
) );
genesis_register_sidebar( array(
	'id'          => 'nav-social-menu',
	'name'        => __( 'Nav Social Menu', 'acetravel' ),
	'description' => __( 'This is the nav social menu section.', 'acetravel' ),
) );

add_action( 'login_head', 'custom_loginlogo' );
/**
 * Login logo
 */
function custom_loginlogo() {
	echo '<style type="text/css">
			#login h1 a {background-image: url(' . get_bloginfo( 'stylesheet_directory' ) . '/images/login_logo.png) !important; }
			</style>';
}
