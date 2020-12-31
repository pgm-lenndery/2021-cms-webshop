<?php

function mytheme_add_woocommerce_support() {
    add_theme_support( 'woocommerce' );
}

function beforeProductLoopStart() {
    echo '<div class="woocommerce__products row">';
    echo '<div class="col-12 col-md-8">';
    // sidebar
    echo '</div>';
    echo '</div>';
}

function wrapProductDropdown () {
    echo '<div class="bg-success">';
    woocommerce_catalog_ordering();
    echo 'div>';
}

function afterProductLoop() {
    echo '</div>';
    echo '</div>';
}

add_action( 'after_setup_theme', 'mytheme_add_woocommerce_support' );
add_action( 'woocommerce_before_shop_loop', 'beforeProductLoopStart', 10 );
add_action( 'woocommerce_before_shop_loop', 'wrapProductDropdown', 10 );
add_action( 'woocommerce_after_shop_loop', 'afterProductLoop', 10 );

remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );