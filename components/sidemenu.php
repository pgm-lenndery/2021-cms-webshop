<?php 
    $current_user = wp_get_current_user();
    $args = array(
        'post_type' => 'banners'
    );
    $the_query = new WP_Query( $args );
?>

<div class="sidemenu sesam-hidden" data-sesam-target="sidemenu" data-sesam-group="groupNameHere">
    <nav class="sidemenu__nav nav">
        <ul>
            <li class="nav__item" data-sesam-trigger="cartSection"><i data-feather="shopping-cart"></i></li>
            <li class="nav__item" data-sesam-trigger="notificationSection"><i data-feather="user"></i></li>
            <li class="nav__item" data-sesam-trigger="searchSection"><i data-feather="search"></i></li>
        </ul>
    </nav>
    <div class="sidemenu__wrapper">
        <div class="sidemenu__content">
            <div class="sidemenu__section sesam-hidden" data-sesam-target="cartSection" data-sesam-parent="groupNameHere"> 
                <h4 class="sidemenu__title">Shopping cart</h4>
                <?php echo do_shortcode('[woocommerce_cart]') ?>
            </div>
            <div class="sidemenu__section sesam-hidden" data-sesam-target="notificationSection" data-sesam-parent="groupNameHere"> 
                <h4 class="sidemenu__title">Hello <?= $current_user->user_login ?>!</h4>
                <?php echo do_shortcode( '[woocommerce_my_account]' ) ?>
                <!-- <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
                    <div class="card">
                        <h5 class="card__title"><?php the_title(); ?></h5>
                        <div class="card__content">
                            <?= get_field( 'content', $post->ID ) ?>
                        </div>
                    </div>
                <?php endwhile; ?>
                <?php wp_reset_postdata(); ?> -->
            </div>
            <div class="sidemenu__section sesam-hidden" data-sesam-target="searchSection" data-sesam-parent="groupNameHere">
                <h4 class="sidemenu__title">Search shops</h4>
                <form id="searchForm" class="form form-theme--coffee mb-4">
                    <div class="form__input-wrapper">
                        <label class="form__input">
                            <input type="text" name="search" placeholder="name of a store" value="<?= $_GET['search'] ?>" required>
                        </label>
                        <button type="submit">Search</button>
                    </div>
                </form>
                <div id="searchResults">
                    <div class="d-flex align-items-center justify-content-center color--coffee opacity--75 mt-5">
                        <i data-feather="search" class="me-2"></i>
                        <strong class="text-center label small">Results will appear here</strong>
                    </div>
                    <!-- search results will appear here -->
                </div>
            </div>
        </div>
    </div>
</div>