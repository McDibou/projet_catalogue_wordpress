<!--AUTRE PAGE-->
<?php get_header() ?>

<h1><?php the_title(); ?></h1>

<?php $loop = new WP_Query(['post_type' => 'shops', 'order' => 'ASC', 'oderby' => 'name']); ?>
<?php while ($loop->have_posts()) : $loop->the_post(); ?>
    <?php get_template_part('parts/card.shops', 'post'); ?>
<?php endwhile;
wp_reset_query(); ?>

<?php get_footer() ?>
