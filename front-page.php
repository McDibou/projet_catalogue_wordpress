<!--PAGE HOME -->
<?php get_header() ?>

<img src="<?php the_post_thumbnail_url(); ?>" style="width: 20%" alt="">

<h1><?php the_title(); ?></h1>
<p><?php the_content(); ?></p>

<h5>PROMOTION</h5>
<?php while ($promotiom->have_posts()) : $promotiom->the_post(); ?>
    <?php get_template_part('parts/card.article', 'post'); ?>
<?php endwhile;
wp_reset_query(); ?>

<h5>MISE EN AVANT</h5>
<?php while ($highlight->have_posts()) : $highlight->the_post(); ?>
    <?php get_template_part('parts/card.article', 'post'); ?>
<?php endwhile;
wp_reset_query(); ?>

<?php get_footer() ?>