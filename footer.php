    </main>
    <footer class="pt-5 pb-4">
        <div class="mb-4 d-flex align-items-center justify-content-between">
            <nav class="navigation footer">
                <?php wp_nav_menu(array(
                    'theme_location' => 'footer-nav'
                )) ?>
            </nav>
            <form action="" class="form">
                <div class="form__input-wrapper">
                    <label class="form__input">
                        <input type="email" name="email" placeholder="email" required>
                    </label>
                    <button type="submit">sign up</button>
                </div>
            </form>
        </div>
        <hr class="my-4">
        <nav class="navigation small footer">
            <?php wp_nav_menu(array(
                'theme_location' => 'footer-legal'
            )) ?>
        </nav>
        <!-- <?php echo do_shortcode('[contact-form-7 id="1234" title="Contact form"]') ?> -->

        <?php if (is_active_sidebar( 'footer-form' )) { ?>
            <aside class="widget-area" role="complementary">
                <?php dynamic_sidebar( 'footer-form' ); ?>
            </aside>
        <?php } ?>
    </footer>
    <?php wp_footer() ?>
    </body>
</html>