<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <?php wp_head(); ?>
        <link rel="stylesheet" href="https://use.typekit.net/xyt4zrt.css"/>
    </head>
    <body>
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
                <?php if(is_user_logged_in()){?>
                        <span><?php get_avatar(get_current_user_id(), 60)?>
                    <a href="<?= wp_logout_url()?>">Logout</a>
                <?php } else { ?>
                    <a href="<?= wp_registration_url()?>">SignUp</a>
                <?php } ?>
            </div>
        </header>
        <main>
