<?php

class addressShops
{

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
        $street = get_post_meta($post->ID, 'street_shop', true);
        $number = get_post_meta($post->ID, 'number_shop', true);
        $zip = get_post_meta($post->ID, 'zip_shop', true);
        $latitude = get_post_meta($post->ID, 'latitude_shop', true);
        $longitude = get_post_meta($post->ID, 'longitude_shop', true);

        ?>
        <label for="street">Rue</label>
        <input name="street_shop" value="<?= $street ?>" type="text" id="street">

        <label for="number">Numéro</label>
        <input name="number_shop" value="<?= $number ?>" type="text" id="number">

        <label for="zip">Code postal</label>
        <input name="zip_shop" value="<?= $zip ?>" type="text" id="zip">

        <label for="latitude">Latitude</label>
        <input name="latitude_shop" value="<?= $latitude ?>" type="text" id="latitude">

        <label for="longitude">Longitude</label>
        <input name="longitude_shop" value="<?= $longitude ?>" type="text" id="longitude">
        <?php
    }

    public static function save($post_id)
    {
        if (array_key_exists('street_shop', $_POST)) {
            update_post_meta($post_id, 'street_shop', $_POST['street_shop']);
            update_post_meta($post_id, 'number_shop', $_POST['number_shop']);
            update_post_meta($post_id, 'zip_shop', $_POST['zip_shop']);
            update_post_meta($post_id, 'latitude_shop', $_POST['latitude_shop']);
            update_post_meta($post_id, 'longitude_shop', $_POST['longitude_shop']);
        }
    }


}
