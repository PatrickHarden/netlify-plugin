<?php

// ========== INCLUDE FILES IN /INC  ==========

include 'inc/admin.php';
include 'inc/types.php';
include 'inc/fields.php';
include 'inc/menu.php';


// ========== REMOVE WORDPRESS P TAG FILTER  ==========

remove_filter('the_content', 'wpautop');



// ========== ADD CUSTOM FIELDS TO REST API ==========

add_action( 'rest_api_init', 'create_api_posts_meta_field' );
 
function create_api_posts_meta_field() {
 
 // register_rest_field ( 'name-of-post-type', 'name-of-field-to-return', array-of-callbacks-and-schema() )
 register_rest_field( 'homepage', 'contentFields', array(
 'get_callback' => 'get_post_meta_for_api',
 'schema' => null,
 )
 );
}
 
function get_post_meta_for_api( $object ) {
 //get the id of the post object array
 $post_id = $object['id'];
 
 //return the post meta
 return get_post_meta( $post_id );
}



// ========== ADD MENUS TO REST API ==========

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

// WP API v1.
include_once 'inc/wp-api-menus-v1.php';
// WP API v2.
include_once 'inc/wp-api-menus-v2.php';

if ( ! function_exists ( 'wp_rest_menus_init' ) ) :

	/**
	 * Init JSON REST API Menu routes.
	 *
	 * @since 1.0.0
	 */
	function wp_rest_menus_init() {

        if ( ! defined( 'JSON_API_VERSION' ) && ! in_array( 'json-rest-api/plugin.php', get_option( 'active_plugins' ) ) ) {
			$class = new WP_REST_Menus();
			 add_filter( 'rest_api_init', array( $class, 'register_routes' ) );
		} else {
			$class = new WP_JSON_Menus();
			add_filter( 'json_endpoints', array( $class, 'register_routes' ) );
		}
	}

	add_action( 'init', 'wp_rest_menus_init' );

endif;


?>