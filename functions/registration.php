<?php

function handleSubscriberBehaviour () {
    $currentUser = wp_get_current_user();
    
    if(count($currentUser->roles) == 1 & $currentUser->roles[0] == 'subscriber') {
        show_admin_bar(false);
        wp_redirect(site_url('/'));
        exit;
    }
}

add_action('admin_init', 'handleSubscriberBehaviour');

function ourHeaderUrl () {
    // return esc_url();
    return 'esc_url()';
}

add_filter('login_headerurl', 'ourHeaderUrl');

function loadStylesOnLogin () {
    wp_enqueue_style('main-style', get_stylesheet_uri());
}

add_filter('login_enqueue_scripts', 'loadStylesOnLogin');