<?php
/**
 * Ace Travel.
 *
 * @package      acetravel-childtheme
 * @author       Semblance
 */

add_action( 'init', 'semb_register_slides_post_type' );
/**
 * Products Custom Post Type - Create custom post type and taxonomies.
 */
function semb_register_slides_post_type() {
	$labels = array(
		'name' => 'Slides',
		'singular_name' => 'Slides',
		'add_new' => 'Add New',
		'add_new_item' => 'Add New Slide',
		'edit_item' => 'Edit Slide',
		'new_item' => 'Slides',
		'view_item' => 'View Slide',
		'search_items' => 'Search Slides',
		'not_found' => 'No slides found',
		'not_found_in_trash' => 'No slides found in trash',
		'parent_item_colon' => '',
		'menu_name' => 'Slides',
	);

	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'query_var' => true,
		'rewrite' => array(
			'slug' => 'slides',
		),
		'capability_type' => 'post',
		'has_archive' => true,
		'hierarchical' => true,
		'menu_position' => 1,
		'menu_icon' => 'dashicons-images-alt2',
		'supports' => array( 'title', 'thumbnail', 'page-attributes', 'revisions', 'editor' ),
	);

	register_post_type( 'slides', $args );
}
