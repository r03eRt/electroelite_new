<?php
if ( function_exists( 'register_sidebar' ) ) {

	register_sidebar( array (
		'name' => __( 'Primary Sidebar', 'ABdev_revelance'),
		'id' => 'primary-widget-area',
		'description' => __( 'The Primary Widget Area', 'ABdev_revelance'),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => "</div>",
		'before_title' => '<div class="sidebar-widget-heading"><h3>',
		'after_title' => '</h3></div>',
	) );


	register_sidebar( array (
		'name' => __( 'Search Results Sidebar', 'ABdev_revelance' ),
		'id' => 'search-results-widget-area',
		'description' => __( 'Search Results Sidebar', 'ABdev_revelance'),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => "</div>",
		'before_title' => '<h3 class=sidebar-widget-heading>',
		'after_title' => '</h3>',
	) );
	
	
}