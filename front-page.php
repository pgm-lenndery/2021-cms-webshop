<?php 
    /**
     * TODO: Replace get_posts with WP_Query
     */
    $args = array( 'post_type' => 'product', 'posts_per_page' => 10 );
    $query = get_posts($args);
    $random_index = array_rand($query, 1);
    $product_main = $query[$random_index]->ID;    
    
    $shop = get_field( 'shop', $product_main )[0];
    $address = get_field( 'address', $shop->ID );
    
    $product = get_product($product_main);
    $product_variations = $product->get_available_variations();   
    $limited_products = array_slice($product_variations, 0, 3);
?>

<?php get_header(); ?>

<div class="container position-relative">
    <div class="hero hero--front-page">
        <div class="wrapper">
            <h1 class="hero__title display-2">
                Support your<br>local businesses
            </h1>
            <h4 class="hero__subtitle">Help them now, for later</h4>
        </div>
        <div class="hero__voucher-preview">
            <div class="vouchers">
                <div class="vouchers__wrapper">
                    <div class="vouchers__variations">
                        <?php 
                            foreach( $limited_products as $prod ): 
                        ?>
                            <a href="<?= get_permalink( $shop->ID ) . "?value={$prod['display_regular_price']}"; ?>" class="voucher voucher--theme-dark">
                                <div class="voucher__body">
                                    <h4 class="voucher__seller"><?= $shop->post_title ?></h4>
                                    <p><?= $address['place'] ?></p>
                                </div>
                                <div class="voucher__value-wrapper">
                                    <h5><?= $prod['display_regular_price'] ?></h5>
                                    <p>euro</p>
                                </div>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- <div>
        <?php the_content() ?>
    </div> -->
</div>
<div class="container">
    <!-- <h2 class="font--serif mb-4">Three easy steps</h2> -->
    <div class="row">
        <div class="col d-flex">
            <h4 class="mb-0 font--serif color--chocolat me-3">1<br>— </h4>
            <div>
                <h4 class="mb-0 font--serif color--chocolat">Choose</h4>
                <p class="mb-0 label color--coffee">Choose a local merchant</p>
            </div>
        </div>
        <div class="col d-flex">
            <h4 class="mb-0 font--serif color--chocolat me-3">2<br>— </h4>
            <div>
                <h4 class="mb-0 font--serif color--chocolat">Buy</h4>
                <p class="mb-0 label color--coffee">Buy a voucher</p>
            </div>
        </div>
        <div class="col d-flex">
            <h4 class="mb-0 font--serif color--chocolat me-3">3<br>—</h4>
            <div>
                <h4 class="mb-0 font--serif color--chocolat">Use</h4>
                <p class="mb-0 label color--coffee">Use your voucher when possible</p>
            </div>
        </div>
    </div>
</div>
<div class="container my-5 py-5">
    <a href="/shop" class="link link--center-line mx-auto">
        <span class="link__prepend">visit the store</span>
        Find more vouchers
    </a>
</div>

<?php get_footer(); ?>