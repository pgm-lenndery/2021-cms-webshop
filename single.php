<?php get_header(); ?>

<?php get_template_part('components/hero') ?>

<div class="container">
    <a class="button" href="<?= get_permalink(get_option('page_for_posts')) ?>">
        All posts
    </a>

    <!-- <div>
        <strong>
            <?php if(count(get_the_category()) > 1) {
                echo 'Categorieën: ';
            } else {
                echo 'Categorie: ';
            } ?>
        </strong>
        <?php the_category() ?>
    </div> -->
</div>
    
<div class="layout layout--page">
    <div class="container page">
        <h1 class="page__title"><?php the_title() ?></h1>
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
        <div class="page__content">
            <?php the_content() ?>
        </div>
    </div>
</div>

<div class="container">
    <?php previous_post_link('%link', 'Previous') ?>
    <?php next_post_link() ?>
</div>
<?php get_footer(); ?>

