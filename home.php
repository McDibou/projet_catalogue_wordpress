<!--PAGE CATALOGUE-->
<?php get_header() ?>

<?= get_search_form() ?>

<?php if (have_posts()) : ?>
    <div>
        <?php while (have_posts()): the_post() ?>
            <div>
                <?php get_template_part('parts/card.article', 'post'); ?>
            </div>
        <?php endwhile; ?>
    </div>

    <?= paginate_links() ?>

<?php else : ?>
    <h1>Pas d'articles</h1>
<?php endif; ?>

<?php get_footer() ?>