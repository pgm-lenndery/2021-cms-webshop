<header>
    <div class="container">
        <nav class="navigation">
            <div class="navigation-wrapper"> 
                <?php
                    if ( function_exists( 'the_custom_logo' ) ) {
                        the_custom_logo();
                    }
                ?>
                <button data-sesam-trigger="headerMenu">menu</button>
            </div>
            <div class="navigation-items-wrapper" data-sesam-target="headerMenu">
                <?php wp_nav_menu(array(
                    'theme_location' => 'header-nav'
                )) ?>
            </div>
        </nav>
        <!-- <?php if(is_user_logged_in()){?>
                <span><?php get_avatar(get_current_user_id(), 60)?>
            <a href="<?= wp_logout_url()?>">Logout</a>
        <?php } else { ?>
            <a href="<?= wp_registration_url()?>">SignUp</a>
        <?php } ?> -->
    </div>
</header>