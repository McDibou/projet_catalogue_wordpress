<!--PAGE SEARCH-->
<?php get_header() ?>

<?= get_search_form() ?>

<?php while ($search->have_posts()) : $search->the_post(); ?>
    <?php get_template_part('parts/card.article', 'post'); ?>
<?php endwhile; ?>

<?= paginate_links([
    'total' => $search->max_num_pages,
    'base' => add_query_arg('page', '%#%'),
    'format' => '?page=%#%',
    'current' => get_query_var('page'),
    'prev_next' => true
]); ?>

<?php get_footer() ?>