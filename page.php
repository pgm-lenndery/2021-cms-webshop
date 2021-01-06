<?php get_header(); ?>

<div class="layout layout--page">
    <div class="container page">
        <h1 class="page__title"><?php the_title() ?></h1>
        
        <div class="page__content">
            <?php the_content() ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>

