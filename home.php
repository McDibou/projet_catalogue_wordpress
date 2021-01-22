<!--PAGE CATALOGUE-->
<?php get_header() ?>

<div class="search"><?= get_search_form() ?></div>

<img class="cat-img-home" src="<?php the_post_thumbnail_url(); ?>" alt="">
<?php if (have_posts()) : ?>
    <div class="cat-blog">
        <?php while (have_posts()): the_post() ?>
            <div>
                <?php get_template_part('parts/card.article', 'post'); ?>
            </div>
        <?php endwhile; ?>
    </div>

    <div class="pagination"><?= paginate_links() ?></div>

<?php else : ?>
    <h1 class="message-catalog">NOT FOUND !</h1>
<?php endif; ?>

<?php get_footer() ?>