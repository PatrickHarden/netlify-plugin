<?php


// Register Custom Post Type
function homepage_post_type() {

	$labels = array(
		'name'                  => _x( 'Homepages', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'Homepage', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'Homepage', 'text_domain' ),
		'name_admin_bar'        => __( 'Homepage', 'text_domain' ),
		'archives'              => __( 'Homepage Archives', 'text_domain' ),
		'attributes'            => __( 'Homepage Attributes', 'text_domain' ),
		'parent_item_colon'     => __( 'Parent Homepage:', 'text_domain' ),
		'all_items'             => __( 'All Homepages', 'text_domain' ),
		'add_new_item'          => __( 'Add New Homepage', 'text_domain' ),
		'add_new'               => __( 'Add New', 'text_domain' ),
		'new_item'              => __( 'New Homepage', 'text_domain' ),
		'edit_item'             => __( 'Edit Homepage', 'text_domain' ),
		'update_item'           => __( 'Update Homepage', 'text_domain' ),
		'view_item'             => __( 'View Homepage', 'text_domain' ),
		'view_items'            => __( 'View Homepages', 'text_domain' ),
		'search_items'          => __( 'Search Homepage', 'text_domain' ),
		'not_found'             => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
		'featured_image'        => __( 'Featured Image', 'text_domain' ),
		'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
		'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
		'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
		'insert_into_item'      => __( 'Insert into Homepage', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this Homepage', 'text_domain' ),
		'items_list'            => __( 'Homepages list', 'text_domain' ),
		'items_list_navigation' => __( 'Homepages list navigation', 'text_domain' ),
		'filter_items_list'     => __( 'Filter Homepages list', 'text_domain' ),
	);
	$args = array(
		'label'                 => __( 'Homepage', 'text_domain' ),
		'description'           => __( 'Contains all the fields for the Homepage', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'revisions' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-analytics',
		'show_in_admin_bar'     => false,
		'show_in_nav_menus'     => false,
		'can_export'            => true,
		'has_archive'           => false,
		'exclude_from_search'   => true,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
		'show_in_rest'          => true,
	);
	register_post_type( 'homepage', $args );

}
add_action( 'init', 'homepage_post_type', 0 );

?>