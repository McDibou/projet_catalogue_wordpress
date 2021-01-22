<!--AUTRE PAGE-->
<?php get_header() ?>

<img class="cat-img-home" src="<?php the_post_thumbnail_url(); ?>" alt="">
<div class="cat-about"><?php the_content(); ?></div>

<?php get_footer() ?>
