<div class="card">

    <?php
    $newDate = new DateTime();
    $date = $newDate->format('Y-m-d');
    $start = get_post_meta(get_the_ID(), 'catalogue_promotion_date_start', true);
    $end = get_post_meta(get_the_ID(), 'catalogue_promotion_date_end', true);
    $promo = get_post_meta(get_the_ID(), 'catalogue_promotion_article', true);
    $price = get_post_meta(get_the_ID(), 'catalogue_price_article', true);
    ?>

    <?php $idImges = get_post_meta(get_the_ID(), 'vdw_gallery_id', true); ?>

    <?php $image = wp_get_attachment_image_src($idImges[0], 'small'); ?>
    <img class="image-preview" src="<?php echo $image[0]; ?>" alt="">


    <h3>GUIT.DEV / <?php the_title() ?></h3>

    <div class="category"><?php the_terms(get_the_ID(), 'category') ?></div>
    <div class="desc"><?php the_content(); ?></div>

    <?php if ($start < $date && $end > $date): ?>
        <div class="prix"><?= number_format($price - ($price / 100 * $promo), 2) ?> €</div>
        <div id="promo"><?= $promo ?> %</div>
    <?php else : ?>
        <div class="prix"><?= $price ?> €</div>
    <?php endif; ?>

    <?php if (!is_single()) : ?>
        <div class="link-pay"><a href="<?php the_permalink() ?>">Voir plus</a></div>
    <?php else : ?>
        <div class="link-pay"><a href="">ACHETER</a></div>
    <?php endif; ?>
</div>