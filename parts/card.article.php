<div style="width: 18rem; border: 1px solid black">

    <?php $idImges = get_post_meta(get_the_ID(), 'vdw_gallery_id', true); ?>

    <?php $image = wp_get_attachment_image_src($idImges[0], 'small'); ?>
    <img class="image-preview" src="<?php echo $image[0]; ?>" alt="">

    <div>
        <h5><?php the_title() ?></h5>
        <div>
            <p><?php the_terms(get_the_ID(), 'category') ?></p>
            <p><?= get_post_meta(get_the_ID(), 'catalogue_price_article', true); ?></p>
        </div>
        <a href="<?php the_permalink() ?>">Voir plus</a>
    </div>

</div>
