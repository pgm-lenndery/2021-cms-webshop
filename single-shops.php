<?php get_header(); ?>
<?php get_template_part('components/hero') ?>

<?php
    /**
     * show all related products, based on shop id
     */
    $ID = $post->ID;
    
    $address = get_field( 'address', $ID );
    $introduction = get_field( 'introduction', $ID );
    $about = get_field( 'about', $ID );
    $banner_image = get_field( 'banner_image', $ID );
    $gmaps_api = "https://www.google.com/maps/search/?api=1&query=";
    $gmaps_query = $gmaps_api . "{$address['street']}-{$address['number']}-{$address['postal_code']}-{$address['place']}";
    $gmaps_url = get_field( 'address', $ID )['gmaps'];
    
    $args = array(
        'post_type'	=> 'product',
        'meta_query' => array(
            array(
                'key'     => 'shop',
                'compare' => 'LIKE',
                'value'   => '"' . get_the_ID() . '"',
            )
        )
    );
    
    $the_query = new WP_Query( $args );
    $arts = $the_query->posts[0]->ID;
    $product = wc_get_product( $arts );
?>
<div class="layout--shop">
    <div class="page">
        <div class="container">    
            <div class="row">
                <div class="col-12 col-md-6 mb-5 mb-md-0">
                    <img src="<?= $banner_image['url'] ?>" class="mb-4" width="100%" height="300px" />
                    <div class="position-sticky" style="top: 32px;">
                        <h1 class="page__title my-0 font--serif"><?php the_title() ?></h1>
                        <div class="row mb-4">
                            <div class="col-12 col-lg-6">
                                <p class=""><?= $introduction ?></p>
                            </div>
                            <div class="col-12 col-lg-6 text-lg-end">
                                <a class="link link--inline" href="<?= $gmaps_query ?>">
                                    <span><?= $address['street'] ?> <?= $address['number'] ?></span><br>
                                    <span><?= $address['postal_c ode'] ?> <?= $address['place'] ?></span>
                                </a>
                            </div>
                        </div>
                        <div class="page__content color--text"><?= $about ?></div>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="vouchers maronsy maronsy--single-shops">
                        <?php 
                            $products = $product->get_available_variations();
                            foreach( $products as $prod ): 
                        ?>
                            <a href="<?= get_permalink( $product->get_id() ) . "?value={$prod['display_regular_price']}&id={$prod['variation_id']}"; ?>" class="voucher voucher--theme-dark maronsy__item">
                                <div class="voucher__body">
                                    <h4 class="voucher__seller"><?= the_title() ?></h4>
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
</div>
<div class="container">
    <!-- <div>
        <?php previous_post_link('%link', 'Previous') ?>
        <?php next_post_link() ?>
    </div> -->
</div>

<?php get_footer(); ?>

