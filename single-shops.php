<?php get_header(); ?>
<?php get_template_part('components/hero') ?>

<?php
    /**
     * show all related products, based on shop id
     */
    $ID = $post->ID;
    $address = get_field( 'address', $ID );
    $introduction = get_field( 'introduction', $ID );
    $banner_image = get_field( 'banner_image', $ID );
    
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
<img src="<?= $banner_image['url'] ?>" width="100%" height="300px" />
<div class="container">
    <!-- <div>
        <strong>
            <?php if(count(get_the_category()) > 1) {
                echo 'Categorieën: ';
            } else {
                echo 'Categorie: ';
            } ?>
        </strong>
        <i>
            <?php the_category() ?>
        </i>
    </div> -->
    <h1 class="mb-0 font--serif"><?php the_title() ?></h1>
    <p class=""><?= $introduction ?></p>

    <?php if(has_excerpt()) { ?>
        <blockquote>
            <?php the_excerpt() ?>
        </blockquote>
    <?php } ?>
    
    <div><?php the_content() ?></div>
    
</div>
<!-- 
    TODO: Implement flexgrid (from webshop webpgm4) for cards
 -->
<div class="container">
    <div class="vouchers maronsy">
        <?php 
            $products = $product->get_available_variations();
            foreach( $products as $prod ): 
            // print_r($products)
        ?>
            <a href="<?= get_permalink( $product->get_id() ) . "?value={$prod['display_regular_price']}"; ?>" class="voucher voucher--theme-dark maronsy__item">
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
<div class="container">
    <!-- <div>
        <?php previous_post_link('%link', 'Previous') ?>
        <?php next_post_link() ?>
    </div> -->
</div>

<?php get_footer(); ?>

