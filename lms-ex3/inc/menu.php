<?php


function rest_get_menu() {
    # Change 'menu' to your own navigation slug.
    return wp_get_nav_menu_items('primary-navigation');
}

add_action( 'rest_api_init', function () {
        register_rest_route( 'myroutes', '/menu', array(
        'methods' => 'GET',
        'callback' => 'rest_get_menu',
    ) );
} );


?>