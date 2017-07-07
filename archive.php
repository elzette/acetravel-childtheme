<?php
/**
 * Ace Travel.
 *
 * @package      acetravel-childtheme
 * @link         http://www.carriedils.com/utility-pro
 * @author       Semblance
 */

// * Remove the breadcrumb navigation
remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs' );

// * Remove the post info function
remove_action( 'genesis_entry_header', 'genesis_post_info' );

// * Remove the post content
remove_action( 'genesis_entry_content', 'genesis_do_post_content' );

// * Remove the post image
remove_action( 'genesis_entry_content', 'genesis_do_post_image', 8 );

add_action( 'genesis_entry_header', 'acetravel_archive_grid', 9 );
/**
 * Add the featured image before post title
 */
function acetravel_archive_grid() {
  if ( $image = genesis_get_image( 'format=url&size=blog-square-featured' ) ) {
    printf( '<div class="divine-featured-image"><a href="%s" rel="bookmark"><img src="%s" alt="%s" /></a></div>', get_permalink(), $image, the_title_attribute( 'echo=0' ) );
  }
}

add_action( 'genesis_before_loop', 'display_category_archives_description' );
/**
 * Display Category Description
 */
function display_category_archives_description() {
	echo category_description( '$category-ID' );
}

// * Remove the post meta function
remove_action( 'genesis_entry_footer', 'genesis_post_meta' );

genesis();
