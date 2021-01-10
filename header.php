<?php

    $args = array(
        'post_type' => 'banners'
    );
    $the_query = new WP_Query( $args );
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <?php wp_head(); ?>
        <link rel="stylesheet" href="https://use.typekit.net/xyt4zrt.css"/>
    </head>
    <body>
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
                        <h4 class="sidemenu__title">Notifications</h4>
                        <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
                            <div class="card">
                                <h5 class="card__title"><?php the_title(); ?></h5>
                                <div class="card__content">
                                    <?= get_field( 'content', $post->ID ) ?>
                                </div>
                            </div>
                        <?php endwhile; ?>
                        <?php wp_reset_postdata(); ?>
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
    <!-- <img src="<?= get_theme_file_uri('/assets/swirl_V3@4x.png', NULL, '1.0', true) ?>" /> -->
        <header>
            <div class="container">
                <nav class="navigation">
                    <?php
                        if ( function_exists( 'the_custom_logo' ) ) {
                            the_custom_logo();
                        }
                    ?>
    
                    <?php wp_nav_menu(array(
                        'theme_location' => 'header-nav'
                    )) ?>
                </nav>
                <!-- <?php if(is_user_logged_in()){?>
                        <span><?php get_avatar(get_current_user_id(), 60)?>
                    <a href="<?= wp_logout_url()?>">Logout</a>
                <?php } else { ?>
                    <a href="<?= wp_registration_url()?>">SignUp</a>
                <?php } ?> -->
            </div>
        </header>
        <main>
