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
        <div class="notify">
            <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
                <div class="card card--notify" data-cookie-hook="notify_<?php the_ID() ?>">
                    <button class="card__close">
                        <i data-feather="x"></i>
                    </button>
                    <div class="card__wrapper">
                        <h5 class="card__title"><?php the_title(); ?></h5>
                        <div class="card__content">
                            <?= get_field( 'content', $post->ID ) ?>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
            <?php wp_reset_postdata(); ?>
        </div>
        <!-- include header menu -->
        <?php include get_template_directory() . '/components/sidemenu.php'; ?>
        <!-- include header menu -->
        <?php include get_template_directory() . '/components/header-menu.php'; ?>
        <main>
