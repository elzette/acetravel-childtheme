<?php

//* Theme Setting Defaults
add_filter( 'genesis_theme_settings_defaults', 'divine_theme_defaults' );
function divine_theme_defaults( $defaults ) {

	$defaults['blog_cat_num']              = 5;
	$defaults['content_archive']           = 'full';
	$defaults['content_archive_limit']     = 500;
	$defaults['content_archive_thumbnail'] = 1;
	$defaults['image_size']                = 'large-featured';
	$defaults['image_alignment']           = 'alignnone';
	$defaults['posts_nav']                 = 'numeric';
	$defaults['site_layout']               = 'content-sidebar';

	return $defaults;

}

//* Theme Setup
add_action( 'after_switch_theme', 'divine_theme_setting_defaults' );
function divine_theme_setting_defaults() {

	if( function_exists( 'genesis_update_settings' ) ) {

		genesis_update_settings( array(
			'blog_cat_num'              => 5,	
			'content_archive'           => 'full',
			'content_archive_limit'     => 500,
			'content_archive_thumbnail' => 1,
			'image_size'                => 'large-featured',
			'image_alignment'           => 'alignnone',
			'posts_nav'                 => 'numeric',
			'site_layout'               => 'content-sidebar',
		) );
	
	} 

	update_option( 'posts_per_page', 5 );

}