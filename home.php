<?php get_header(); ?>

<div class="container">
    <h1><?= wp_title( '' ) ?></h1>

    <div class="maronsy maronsy--blog">
        <?php
            while (have_posts()) { the_post() ?>
                <a href="<?php the_permalink() ?>" class="card card--blog maronsy__item">
                    <h2 class="card__title"><?= the_title() ?></h2>
                    <div class="card__content">
                        <?php
                        if(has_excerpt()) {
                            the_excerpt();
                        } else {
                            echo wp_trim_words(get_the_content(), 30);
                        } ?>
                    </div>

                    <div>
                        <!-- <i>
                            Geschreven door: <?php the_author_posts_link() ?>
                        </i> -->
                        <!-- <?php the_category() ?> -->
                        <?php 
                            $tags = get_the_tags();
                            if ($tags) { 
                        ?>
                            <ul class="post-tags">
                                <?php 
                                    foreach($tags as $tag) {
                                ?>
                                    <li><?= $tag->name ?></li>
                                <?php } ?>
                            </ul>
                        <?php } ?>
                    </div>
                </a>
            <?php }
        ?>
    </div>

    <div class="nav-previous alignleft"><?php previous_posts_link( 'Older posts' ); ?></div>
    <div class="nav-next alignright"><?php next_posts_link( 'Newer posts' ); ?></div>
</div>

<?php get_footer(); ?>

