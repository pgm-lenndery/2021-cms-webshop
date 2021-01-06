<?php

function loadFilesHeader () {
    wp_enqueue_style('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css');
    wp_enqueue_style('main-style', get_stylesheet_uri());
    wp_enqueue_script( 'main-js', get_theme_file_uri('app.js', NULL, '1.0', true));
}

add_action('wp_enqueue_scripts', 'loadFilesHeader');