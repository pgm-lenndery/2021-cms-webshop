    </main>
    
    <footer class="pt-5 mt-5 pb-4">
        <?php if (is_active_sidebar( 'footer-form' )) { ?>
            <aside class="widget-area" role="complementary">
                <?php dynamic_sidebar( 'footer-form' ); ?>
            </aside>
        <?php } ?>
        <!-- <div class="row sidebar">
            <div class="col widget">
                <nav class="navigation navigation--vertical footer">
                    <?php wp_nav_menu(array(
                        'theme_location' => 'footer-nav'
                    )) ?>
                </nav>
            </div>
            <div class="col widget">
                <h4 class="widget__title">Get updates</h4>
                <form action="" class="form">
                    <div class="form__input-wrapper">
                        <label class="form__input">
                            <input type="email" name="email" placeholder="email" required>
                        </label>
                        <button type="submit">sign up</button>
                    </div>
                </form>
            </div>
            <div class="col widget">
                <h4 class="widget__title">Contact</h4>
            </div>
        </div> -->
        <div class="mb-4 d-flex align-items-center justify-content-between">
        </div>
        <hr class="my-4">
        <nav class="navigation small footer">
            <?php wp_nav_menu(array(
                'theme_location' => 'footer-legal'
            )) ?>
        </nav>
        <!-- <?php echo do_shortcode('[contact-form-7 id="1234" title="Contact form"]') ?> -->

    </footer>
    <?php wp_footer() ?>
    </body>
</html>