<?php

class addressShops
{
    const STREET = 'street_shop';
    const NUM = 'number_shop';
    const ZIP = 'zip_shop';
    const LAT = 'latitude_shop';
    const LONG = 'longitude_shop';
    const NONCE = 'catalogue_adress_nonce';

    public static function register()
    {
        add_action('add_meta_boxes', [self::class, 'add']);
        add_action('save_post', [self::class, 'save']);
    }

    public static function add()
    {
        add_meta_box('catalogue_addess_shops', 'Adresse', [self::class, 'render'], 'shops');
    }

    public static function render($post)
    {
        $street = get_post_meta($post->ID, self::STREET, true);
        $number = get_post_meta($post->ID, self::NUM, true);
        $zip = get_post_meta($post->ID, self::ZIP, true);
        $latitude = get_post_meta($post->ID, self::LAT, true);
        $longitude = get_post_meta($post->ID, self::LONG, true);
        wp_nonce_field(self::NONCE, self::NONCE)
        ?>
        <div class="cat-pad cat-flex">
            <label class="cat-pad-bot" for="street">Rue :</label>
            <input class="cat-width" name="<?= self::STREET ?>" value="<?= $street ?>" type="text"
                   id="street">
        </div>
        <div class="cat-pad cat-flex">
            <label class="cat-pad-bot"  for="number">Numéro :</label>
            <input class="cat-width" name="<?= self::NUM ?>" value="<?= $number ?>" type="text"
                   id="number">
        </div>
        <div class="cat-pad cat-flex">
            <label class="cat-pad-bot" for="zip">Code postal :</label>
            <input class="cat-width" name="<?= self::ZIP ?>" value="<?= $zip ?>" type="text"
                   id="zip">
        </div>
        <div class="cat-pad cat-flex">
            <label class="cat-pad-bot" for="latitude">Latitude :</label>
            <input class="cat-width" name="<?= self::LAT ?>" value="<?= $latitude ?>" type="text"
                   id="latitude">
        </div>
        <div class="cat-pad cat-flex">
            <label class="cat-pad-bot" for="longitude">Longitude :</label>
            <input class="cat-width" name="<?= self::LONG ?>" value="<?= $longitude ?>" type="text"
                   id="longitude">
        </div>
        <?php
    }

    public static function save($post_id)
    {
        if (array_key_exists(self::STREET, $_POST) && wp_verify_nonce($_POST[self::NONCE], self::NONCE)) {
            update_post_meta($post_id, self::STREET, $_POST[self::STREET]);
            update_post_meta($post_id, self::NUM, $_POST[self::NUM]);
            update_post_meta($post_id, self::ZIP, $_POST[self::ZIP]);
            update_post_meta($post_id, self::LAT, $_POST[self::LAT]);
            update_post_meta($post_id, self::LONG, $_POST[self::LONG]);
        }
    }


}
