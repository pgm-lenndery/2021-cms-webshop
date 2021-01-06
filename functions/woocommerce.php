<?php

function beforeShopLoop () {
    echo '
        <div>
    ';
}

function afterShopLoop () {
    echo '
        </div>
    ';
}

function mytheme_add_woocommerce_support() {
    add_theme_support( 'woocommerce' );
}

function zgqzerg () {
    echo 'lel';
}

function beforeProductLoopStart() {
    echo '
        <div class="woocommerce__products row">
            <div class="col-12 col-md-8">
    ';
    // sidebar
    echo '
            </div>
        </div>
    ';
}

function wrapProductDropdown () {
    echo '<div class="">';
        echo '<div class="container">';
            woocommerce_catalog_ordering();
        echo '</div>';
    echo '<div>';
}

function afterProductLoop() {
    echo '
            </div>
        </div>
    ';
}

function woocommerce_content() {

		if ( is_singular( 'product' ) ) {

			while ( have_posts() ) :
				the_post();
				wc_get_template_part( 'content', 'single-product' );
			endwhile;

		} else {
			?>

			<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>

                <div class="container">
                    <h1 class="page-title"><?php woocommerce_page_title(); ?></h1>
                </div>

			<?php endif; ?>

			<?php do_action( 'woocommerce_archive_description' ); ?>

			<?php if ( woocommerce_product_loop() ) : ?>

				<?php do_action( 'woocommerce_before_shop_loop' ); ?>

				<?php woocommerce_product_loop_start(); ?>

				<?php if ( wc_get_loop_prop( 'total' ) ) : ?>
					<?php while ( have_posts() ) : ?>
						<?php the_post(); ?>
						<?php wc_get_template_part( 'content', 'product' ); ?>
					<?php endwhile; ?>
				<?php endif; ?>

				<?php woocommerce_product_loop_end(); ?>

				<?php do_action( 'woocommerce_after_shop_loop' ); ?>

				<?php
			else :
				do_action( 'woocommerce_no_products_found' );
			endif;
		}
	}

add_action( 'after_setup_theme', 'mytheme_add_woocommerce_support' );

add_action( 'woocommerce_before_shop_loop', 'beforeProductLoopStart', 10 );
add_action( 'woocommerce_before_shop_loop', 'wrapProductDropdown', 10 );
add_action( 'woocommerce_after_shop_loop', 'afterProductLoop', 10 );
add_action( 'woocommerce_single_product_summary', 'zgqzerg', 10 );

remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 30 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 30 );
