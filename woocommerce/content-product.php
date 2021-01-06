<?php
/**
     * The template for displaying product content within loops
     *
     * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
     *
     * HOWEVER, on occasion WooCommerce will need to update template files and you
     * (the theme developer) will need to copy the new files to your theme to
     * maintain compatibility. We try to do this as little as possible, but it does
     * happen. When this occurs the version of the template file will be bumped and
     * the readme will list any important changes.
     *
     * @see     https://docs.woocommerce.com/document/template-structure/
     * @package WooCommerce\Templates
     * @version 3.6.0
     */

    defined( 'ABSPATH' ) || exit;

    global $product;

    // Ensure visibility.
    if ( empty( $product ) || ! $product->is_visible() ) {
        return;
    }
    
    $shop = get_field('shop')[0];
    $shop_permalink = get_permalink( $shop );
    $title = get_the_title( $shop );
    $address = get_field( 'address', $shop );
    $shop_intro = get_field( 'introduction', $shop );
?>


<div class="vouchers">
    <div class="container">
        <h2 class="font--serif mb-0"><?= $title ?></h2>
        <p><?= $shop_intro ?></p>
    </div>
    <div class="vouchers__wrapper container"> 
        <li <?php wc_product_class( 'vouchers__variations', $product ); ?>>
            <?php
                /**
                 * Hook: woocommerce_before_shop_loop_item.
                 *
                 * @hooked woocommerce_template_loop_product_link_open - 10
                 */
                // do_action( 'woocommerce_before_shop_loop_item' );
                add_action('woocommerce_before_shop_loop_item', 'beforeShopLoop', 100)
            ?>
    
            <?php
                /**
                 * Hook: woocommerce_before_shop_loop_item_title.
                 *
                 * @hooked woocommerce_show_product_loop_sale_flash - 10
                 * @hooked woocommerce_template_loop_product_thumbnail - 10
                 */
                do_action( 'woocommerce_show_product_loop_sale_flash' );
            ?>
            
            <?php 
                $products = $product->get_available_variations();
                foreach( $products as $prod ): 
                // print_r($products)
            ?>
                <a href="<?= get_permalink( $product->get_id() ) . "?value={$prod['display_regular_price']}"; ?>" class="voucher voucher--theme-dark">
                    <div class="voucher__body">
                        <h4 class="voucher__seller"><?= $title ?></h4>
                        <p><?= $address['place'] ?></p>
                    </div>
                    <div class="voucher__value-wrapper">
                        <h5><?= $prod['display_regular_price'] ?></h5>
                        <p>euro</p>
                    </div>
                </a>
            <?php endforeach; ?>
    
            <?php
                /**
                 * Hook: woocommerce_shop_loop_item_title.
                 *
                 * @hooked woocommerce_template_loop_product_title - 10
                 */
                // do_action( 'woocommerce_shop_loop_item_title' );
            ?>
            
            <?php
                /**
                 * Hook: woocommerce_after_shop_loop_item_title.
                 *
                 * @hooked woocommerce_template_loop_rating - 5
                 * @hooked woocommerce_template_loop_price - 10
                 */
                // do_action( 'woocommerce_after_shop_loop_item_title' ); 
            ?>
    
            <?php
                /**
                 * Hook: woocommerce_after_shop_loop_item.
                 *
                 * @hooked woocommerce_template_loop_product_link_close - 5
                 * @hooked woocommerce_template_loop_add_to_cart - 10
                 */
                // do_action( 'woocommerce_after_shop_loop_item' ); 
                add_action('woocommerce_after_shop_loop_item', 'afterShopLoop', 100)
            ?>
        </li>
    </div>
</div>
