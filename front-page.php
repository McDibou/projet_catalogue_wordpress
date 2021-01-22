<!--PAGE HOME -->
<?php get_header() ?>
<div class="home">
    <img class="cat-img-home" src="<?php the_post_thumbnail_url(); ?>" alt="">
    <div class="cat-intro-home">
        <div>
            <?php the_content(); ?>
        </div>
        <div>
            <?php while ($promotiom->have_posts()) : $promotiom->the_post(); ?>
                <?php get_template_part('parts/card.article', 'post'); ?>
            <?php endwhile;
            wp_reset_query(); ?>
        </div>
    </div>
</div>
<?php get_footer() ?>