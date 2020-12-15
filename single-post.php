<?php get_header() ?>

    <h5><?php the_title() ?></h5>

<?php $ids = get_post_meta(get_the_ID(), 'vdw_gallery_id', true); ?>
<?php foreach ($ids as $values) : $image = wp_get_attachment_image_src($values, 'small'); ?>
    <img class="image-preview" src="<?php echo $image[0]; ?>" alt="">
<?php endforeach ?>

    <em><?php the_terms(get_the_ID(), 'category') ?></em>
    <p><?php the_content(); ?></p>


<?php get_footer() ?>