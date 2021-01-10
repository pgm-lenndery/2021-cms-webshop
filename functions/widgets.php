<?php

function registerWidgets() {
    register_sidebar(array(
        'name' => __( 'Footer Area', 'footer_form' ),
        'id' => 'footer-form',
        'description' => __( 'Description', 'footer_form' ),
        'before_title' => '<h4 class="widget__title">',
        'after_title' => '</h4><div class="widget__content">',
        'before_widget' => '<div class="widget col col-12 col-md-6 col-xl mb-5 mb-xl-0">',
        'after_widget' => '</div></div>',
        'before_sidebar' => '<div class="row sidebar">',
        'after_sidebar' => '</div>',
    ));
}

add_action( 'widgets_init', 'registerWidgets' );