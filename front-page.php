<?php 
    $args = array( 'post_type' => 'product' );
    $query = get_posts($args);
    $random_index = array_rand($query, 3);
    $product = $query[$random_index[0]];
    $product_main = get_product($query[$random_index[0]]->ID);
    
    $shop_id = get_field( 'shop', $product )[0];
    $shop = get_post($shop_id);
    $address = get_field( 'address', $shop->ID );
    
    $product_variations = $product_main->get_available_variations();   
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
                            // print_r($prod)
                        ?>
                            <a href="<?= get_permalink( $product_main->get_id() ) . "?value={$prod['display_regular_price']}&id=" . $prod['variation_id'] . '"'; ?>" class="voucher voucher--theme-dark">
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
<div class="container mt-5 mt-lg-0">
    <!-- <h2 class="font--serif mb-4">Three easy steps</h2> -->
    <div class="row">
        <div class="col-12 col-md-6 col-lg-4 mb-4 mb-lg-0 d-flex">
            <h4 class="mb-0 font--serif color--chocolat me-3">1<br>— </h4>
            <div>
                <h4 class="mb-0 font--serif color--chocolat">Choose</h4>
                <p class="mb-0 label color--coffee">Pick a local merchant</p>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-4 mb-4 mb-lg-0 d-flex">
            <h4 class="mb-0 font--serif color--chocolat me-3">2<br>— </h4>
            <div>
                <h4 class="mb-0 font--serif color--chocolat">Buy</h4>
                <p class="mb-0 label color--coffee">Get a voucher</p>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-4 mb-4 mb-lg-0 d-flex">
            <h4 class="mb-0 font--serif color--chocolat me-3">3<br>—</h4>
            <div>
                <h4 class="mb-0 font--serif color--chocolat">Use</h4>
                <p class="mb-0 label color--coffee">Redeem your voucher when possible</p>
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