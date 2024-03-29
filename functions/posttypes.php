<?php

// Our custom post type function
function create_posttype() {
    register_post_type( 'shops',
    // CPT Options
        array(
            'labels' => array(
                'name' => __( 'Shops' ),
                'singular_name' => __( 'Shop' )
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'shops'),
            'show_in_rest' => true,
            'menu_icon' => 'dashicons-store',
            'show_in_nav_menus' => true,
            'supports' => array(
                'title', 
                'custom-fields'
            )
        )
    );
    register_post_type( 'Banners',
    // CPT Options
        array(
            'labels' => array(
                'name' => __( 'Banners' ),
                'singular_name' => __( 'Banner' )
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'banners'),
            'show_in_rest' => true,
            'menu_icon' => 'dashicons-bell',
            'show_in_nav_menus' => true,
            'supports' => array(
                'title',
                'custom-fields'
            )
        )
    );
}

function shops_api_add_cf() {
    register_rest_field(
        'shops', 
        'custom_fields',
        array(
            'get_callback'    => 'get_custom_fields',
            'update_callback' => null,
            'schema'          => null,
        )
    );
}

function get_custom_fields( $object, $field_name, $request ) {
    return get_fields($object->ID);
}

// Hooking up our function to theme setup
add_action( 'init', 'create_posttype' );
add_action( 'rest_api_init', 'shops_api_add_cf' );