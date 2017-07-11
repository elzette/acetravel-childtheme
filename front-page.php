<?php
/**
 * Ace Travel.
 * Template Name: Home
 *
 * @package      acetravel-childtheme
 * @author       Semblance
 */

add_action( 'genesis_meta', 'acetravel_home_genesis_meta' );
/**
 * Initialise Ace Travel home page meta
 */
function acetravel_home_genesis_meta() {
	if ( is_active_sidebar( 'home-double-bottom' ) || is_active_sidebar( 'home-triple-bottom' ) || is_active_sidebar( 'home-double-bottom' ) ) {
		remove_action( 'genesis_loop', 'genesis_do_loop' );
		add_action( 'genesis_loop', 'acetravel_home_sections' );
		add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_content_sidebar' );
		add_filter( 'body_class', 'acetravel_add_home_body_class' );
	}
}

/**
 * Initialise Ace Travel home page sections
 */
function acetravel_home_sections() {
	$rows = get_field( 'home_page_slides' );
	if ( $rows ) {
		echo '<div class="home-carousel">';

		// * Setup of rest of timeline to make each entry a row in the table structure
		foreach ( $rows as $row ) {
			echo '<div class="slide-container">';

			// * Using the ACF Image ID with new image size set in function.php called 'blog-vertical-featured'
			$catimage = wp_get_attachment_image_src( $row['slide_image'], 'blog-vertical-featured' );
			if ( $catimage ) {
				echo '<img data-lazy="' . esc_url( $catimage[0] ) . '">';
			}
				echo '<a href="' . esc_url( $row['slide_link'] ) . '"><span><h3>' . esc_html( $row['slide_title'] ) . '</h3></span></a></div>';
		}
		echo '</div>';
	}

	genesis_widget_area( 'before-content', array(
		'before' => '<div class="before-content widget-area">',
		'after'  => '</div>',
	) );

	$adverts = get_field( 'home_page_adverts' );
	if ( $adverts ) {
		echo '<div class="home-adverts-container">';

		// * Setup of rest of timeline to make each entry a row in the table structure
		foreach ( $adverts as $advert ) {
			echo '<div class="home-advert"><a href="' . esc_url( $advert['advert_link'] ) . '">';
			// * Using the ACF Image ID with new image size set in function.php called 'blog-vertical-featured'
			$advertimage = wp_get_attachment_image_src( $advert['advert_image'], 'adverts' );
			if ( $advertimage ) {
				echo '<img src="' . esc_url( $advertimage[0] ) . '">';
			}
			echo '</a></div>';
		}
		echo '</div>';
	}

	if ( is_active_sidebar( 'home-triple-bottom' ) || is_active_sidebar( 'home-double-bottom' ) ) {
		echo '<div class="home-bottom">';
		genesis_widget_area( 'home-triple-bottom', array(
			'before' => '<div class="home-triple-bottom widget-area">',
			'after'  => '</div>',
		) );

		genesis_widget_area( 'home-double-bottom', array(
			'before' => '<div class="home-double-bottom widget-area">',
			'after'  => '</div>',
		) );
		echo '</div>';

	} ?>

<?php }

/**
 * Add body class to home page
 *
 * @param type $classes Adding a different class to body element.
 */
function acetravel_add_home_body_class( $classes ) {
	$classes[] = 'acetravel-home';
	return $classes;
}

genesis();
