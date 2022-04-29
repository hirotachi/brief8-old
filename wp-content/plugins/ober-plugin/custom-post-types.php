<?php

/**
 * Register Custom Post Type: Portfolio
 */

function ober_register_portfolio() {
	register_post_type( 'portfolio', array(
			'label' => esc_html__( 'Portfolio', 'ober-plugin' ),
	        'description' => esc_html__( 'Portfolio', 'ober-plugin' ),
	        'supports' => array( 'title','editor','revisions','thumbnail','page-attributes' ),
	        'taxonomies' => array( 'portfolio_categories' ),
	        'hierarchical' => false,
	        'show_in_rest' => true,
	        'public' => true,
	        'show_ui' => true,
	        'show_in_menu' => true,
	        'show_in_nav_menus' => true,
	        'show_in_admin_bar' => true,
	        'menu_position' => 20,
	        'menu_icon' => 'dashicons-images-alt2',
	        'can_export' => true,
	        'has_archive' => false,
	        'exclude_from_search' => true,
	        'publicly_queryable' => true,
	        'capability_type' => 'post',
	        'rewrite' => array( 'slug' => 'portfolio/item', 'with_front' => true  ),
			'labels' => array(
				'name' => esc_html__( 'Portfolio', 'ober-plugin' ),
		        'singular_name' => esc_html__( 'Portfolio', 'ober-plugin' ),
		        'menu_name' => esc_html__( 'Portfolio', 'ober-plugin' ),
		        'parent_item_colon' => esc_html__( 'Parent Portfolio:', 'ober-plugin' ),
		        'all_items' => esc_html__( 'All Portfolio', 'ober-plugin' ),
		        'view_item' => esc_html__( 'View Portfolio', 'ober-plugin' ),
		        'add_new_item' => esc_html__( 'Add New Portfolio', 'ober-plugin' ),
		        'add_new' => esc_html__( 'New Portfolio', 'ober-plugin' ),
		        'edit_item' => esc_html__( 'Edit Portfolio', 'ober-plugin' ),
		        'update_item' => esc_html__( 'Update Portfolio', 'ober-plugin' ),
		        'search_items' => esc_html__( 'Search Portfolio', 'ober-plugin' ),
		        'not_found' => esc_html__( 'No portfolio found', 'ober-plugin' ),
		        'not_found_in_trash' => esc_html__( 'No portfolio found in Trash', 'ober-plugin' ),
			),
		)
	);
}
add_action( 'init', 'ober_register_portfolio' );

function ober_register_portfolio_categories() {
	register_taxonomy( 'portfolio_categories', array ( 0 => 'portfolio' ),
		array(
			'label' => esc_html__( 'Portfolio Categories', 'ober-plugin' ),
			'hierarchical' => true,
			'show_ui' => true,
			'show_in_rest' => true,
			'show_admin_column' => true,
			'query_var' => true,
			'has_archive' => true,
			'rewrite' => array( 'slug' => 'portfolio/category' ),
			'labels' => array(
				'name'              => esc_html__( 'Portfolio Categories', 'ober-plugin' ),
		        'singular_name'     => esc_html__( 'Portfolio Categories', 'ober-plugin' ),
		        'search_items'      => esc_html__( 'Search Portfolio Category', 'ober-plugin' ),
		        'all_items'         => esc_html__( 'All Portfolio Category', 'ober-plugin' ),
		        'parent_item'       => esc_html__( 'Parent Portfolio Category', 'ober-plugin' ),
		        'parent_item_colon' => esc_html__( 'Parent Portfolio Category:', 'ober-plugin' ),
		        'edit_item'         => esc_html__( 'Edit Portfolio Category', 'ober-plugin' ),
		        'update_item'       => esc_html__( 'Update Portfolio Category', 'ober-plugin' ),
		        'add_new_item'      => esc_html__( 'Add New Portfolio Category', 'ober-plugin' ),
		        'new_item_name'     => esc_html__( 'New Portfolio Category Name', 'ober-plugin' ),
		        'menu_name'         => esc_html__( 'Portfolio Category', 'ober-plugin' ),
			)
		)
	);
}
add_action( 'init', 'ober_register_portfolio_categories' );

/**
 * Register Custom Post Type: Theme Templates
 */

function ober_register_hf_templates() {
	$labels = array(
		'name'                  => _x( 'Theme Templates', 'Post Type General Name', 'ober-plugin' ),
		'singular_name'         => _x( 'Template', 'Post Type Singular Name', 'ober-plugin' ),
		'add_new_item'          => __( 'Add New Template', 'ober-plugin' ),
		'add_new'               => __( 'Add New', 'ober-plugin' ),
        'new_item'              => __( 'Add New Template', 'ober-plugin' ),
        'all_items'             => __( 'All Templates', 'ober-plugin' ),
		'edit_item'             => __( 'Edit Template', 'ober-plugin' ),
		'view_item'             => __( 'View Template', 'ober-plugin' ),
		'search_items'          => __( 'Search Template', 'ober-plugin' ),
		'not_found'             => __( 'No Templates Found', 'ober-plugin' ),
		'not_found_in_trash'    => __( 'No Templates Found in Trash', 'ober-plugin' ),
	);
	$args = array(
		'label'                 => __( 'Templates', 'ober-plugin' ),
		'description'           => __( 'Add a Template', 'ober-plugin' ),
		'labels'                => $labels,
		'supports' 				=> array( 'title', 'editor', 'thumbnail', 'author', 'elementor' ),
		'hierarchical'          => false,
		'show_in_nav_menus'     => false,
		'public'                => true,
		'show_ui'               => true,
		'exclude_from_search'   => true,
		'menu_position'         => 81,
		'menu_icon'             => 'dashicons-editor-insertmore',
		'can_export'            => true,
        'capability_type'       => 'post',
		'rewrite' 				=> array( 'slug' => 'hf_templates' ),
	);
	register_post_type( 'hf_templates', $args );
}
add_action( 'init', 'ober_register_hf_templates');