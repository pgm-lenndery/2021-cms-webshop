    <?php get_header(); ?>

    <div class="container">
        <h1>
            <?php the_title() ?>
        </h1>

        <div>
            <?php the_content() ?>
        </div>

        <div>
            <h2>Archives</h2>
            <?php wp_get_archives() ?>

            <h2>Categories</h2>
            <?php wp_list_categories() ?>

            <h2>Authors</h2>
            <?php wp_list_authors() ?>
        </div>

        De twee meest recente blog post met categorie "Nieuws"
        <?php
            $newsArticles = new WP_Query( array(
                'category_name' => 'news',
                'posts_per_page' => 2
            ));

            while ($newsArticles->have_posts()) { $newsArticles->the_post() ?>
                <div class="blog">
                    <h2>
                        <a  href="<?php the_permalink() ?>">
                            <?= the_title() ?>
                        </a>
                    </h2>
                </div>
            <?php } wp_reset_postdata(); ?>

            <a href="<?php echo get_category_link(get_cat_ID( 'news' )); ?>">
                Nieuws
            </a>
        <hr/>

        <?php get_template_part( 'components/cards', null, array(
            'type' => 'event',
            ''
        )) ?>

        <div>
            <a class="btn" href="<?php echo get_permalink( get_option( 'page_for_posts' ) ); ?>">Bekijk al de Posts</a>
            <a class="btn" href="<?php echo site_url('blog'); ?>">Naar de blog pagina</a>
        </div>
    </div>

    <?php get_footer(); ?>

