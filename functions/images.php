<?php

function registerThemeSupport() {
    // Images
    add_theme_support('post-thumbnails');
    add_image_size( 'hero-image', 1200);
}

add_action('init', 'registerThemeSupport');

function codeless_file_types_to_uploads($file_types){
    $new_filetypes = array();
    $new_filetypes['svg'] = 'image/svg+xml';
    $file_types = array_merge($file_types, $new_filetypes);
    return $file_types;
}

add_filter('upload_mimes', 'codeless_file_types_to_uploads');