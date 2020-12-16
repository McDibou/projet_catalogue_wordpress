<!--PAGE SEARCH-->
<?php get_header() ?>

<?= get_search_form() ?>


<?php while ($search->have_posts()) : $search->the_post(); ?>
    <?php get_template_part('parts/card.article', 'post'); ?>
<?php endwhile; ?>

<?php paginate_links() ?>

<?php get_footer() ?>