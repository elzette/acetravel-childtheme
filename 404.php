<?php
/**
 * Ace Travel.
 *
 * @package      acetravel-childtheme
 * @author       Semblance
 */

// * Remove default loop
remove_action( 'genesis_loop', 'genesis_do_loop' );

add_action( 'genesis_loop', 'genesis_404' );
/**
 * This function outputs a 404 "Not Found" error message
 *
 * @since 1.6
 */
function genesis_404() {

	echo genesis_html5() ? '<article class="entry">' : '<div class="post hentry">';

		printf( '<h1 class="entry-title">%s</h1>', apply_filters( 'genesis_404_entry_title', __( 'Not found, error 404', 'genesis' ) ) );
		echo '<div class="entry-content">';

	if ( genesis_html5() ) :

			echo apply_filters( 'genesis_404_entry_content', '<p>' . sprintf( __( 'The package you are looking for has expired or the page no longer exists. Perhaps you would like to return back to the <a href="%s">homepage</a>? Or, you can try finding your next dream holiday by using the search form below.', 'genesis' ), trailingslashit( home_url() ) ) . '</p>' );
			echo do_shortcode( '[yith_woocommerce_ajax_search]' );
			echo '<h2>Looking for inspiration?</h2>';
			echo '<h4 class="widget-title widgettitle">Best travel deals – Now on sale!</h4>';
			echo do_shortcode( '[sale_products per_page="9"]' );
			echo '<h4 class="widget-title widgettitle">Just added!</h4>';
			echo do_shortcode( '[recent_products per_page="9"]' );

		else :

			/* Translators: Explain what to follow up from 404 */ ?>
	<p><?php printf( __( 'The package you are looking for has expired or the page no longer exists. Perhaps you would like to return back to the <a href="%s">homepage</a>? Or, you can try finding your next dream holiday by using the search form below.', 'genesis' ), esc_url( home_url() ) ); ?></p>

	<?php
			endif;

		if ( ! genesis_html5() ) {
				genesis_sitemap( 'h4' );
		} elseif ( genesis_a11y( '404-page' ) ) {

			/* Translators: show heading */
				echo '<h2>' . __( 'Sitemap', 'genesis' ) . '</h2>';
				genesis_sitemap( 'h3' );
		}
			echo '</div>';
			echo genesis_html5() ? '</article>' : '</div>';
}

genesis();
