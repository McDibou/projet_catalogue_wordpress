<div style="width: 18rem; border: 1px solid black">
    <h1><?php the_title() ?></h1>

    <p>
        <?= get_post_meta(get_the_ID(), 'street_shop', true); ?>
        <?= get_post_meta(get_the_ID(), 'number_shop', true); ?>
        <?= get_post_meta(get_the_ID(), 'zip_shop', true); ?>
    </p>

    <p><?= wp_get_post_terms(get_the_ID(), 'cities', ['fields' => 'names'])[0]; ?></p>
    <p><?= wp_get_post_terms(get_the_ID(), 'country', ['fields' => 'names'])[0]; ?></p>

    <input type="hidden" name="latitude_shop" value="<?= get_post_meta(get_the_ID(), 'latitude_shop', true); ?>">
    <input type="hidden" name="longitude_shop" value="<?= get_post_meta(get_the_ID(), 'longitude_shop', true); ?>">
</div>