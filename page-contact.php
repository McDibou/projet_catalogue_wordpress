<!--AUTRE PAGE-->
<?php get_header() ?>

<h1><?php the_title(); ?></h1>

<?php while ($shops->have_posts()) : $shops->the_post(); ?>
    <?php get_template_part('parts/card.shops', 'post'); ?>
<?php endwhile; wp_reset_query(); ?>

<?php get_footer() ?>
