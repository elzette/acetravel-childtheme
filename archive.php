<?php

//* Remove the breadcrumb navigation
remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs' );

//* Remove the post info function
remove_action( 'genesis_entry_header', 'genesis_post_info' );

//* Remove the post content
remove_action( 'genesis_entry_content', 'genesis_do_post_content' );

//* Remove the post image
remove_action( 'genesis_entry_content', 'genesis_do_post_image', 8 );

//* Add archive body class to the head
add_filter( 'body_class', 'acetravel_add_archive_body_class' );
function acetravel_add_archive_body_class( $classes ) {
   $classes[] = 'divine-archive';
   return $classes;
}

//* Add the featured image before post title
add_action( 'genesis_entry_header', 'acetravel_archive_grid', 9 );

function acetravel_archive_grid() {

    if ( $image = genesis_get_image( 'format=url&size=blog-square-featured' ) ) {
        printf( '<div class="divine-featured-image"><a href="%s" rel="bookmark"><img src="%s" alt="%s" /></a></div>', get_permalink(), $image, the_title_attribute( 'echo=0' ) );

    }

}

//* Display Category Description
add_action( 'genesis_before_loop', 'display_category_archives_description');
function display_category_archives_description () {
	echo category_description( '$category-ID' );
}

//* Remove the post meta function
remove_action( 'genesis_entry_footer', 'genesis_post_meta' );

genesis();
