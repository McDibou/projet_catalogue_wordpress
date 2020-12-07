<?php

class PriceArticle
{
    const META_KEY = 'catalogue_price_article';

    public static function register()
    {
        add_action('add_meta_boxes', [self::class, 'add']);
        add_action('save_post', [self::class, 'save']);
    }

    public static function add()
    {
        add_meta_box(self::META_KEY, 'Price', [self::class, 'render'], 'post', 'side');
    }

    public static function render($post)
    {
        $value = get_post_meta($post->ID, self::META_KEY, true);
        ?>
        <label for="<?= self::META_KEY ?>">Ajouter un prix à l'article</label>
        <input name="<?= self::META_KEY ?>" id="<?= self::META_KEY ?>" value="<?= $value ?>" type="number" min="0" step="0.01"/>
        <?php
    }

    public static function save($post_id)
    {
        if (array_key_exists(self::META_KEY, $_POST)) {
            update_post_meta($post_id, self::META_KEY, $_POST[self::META_KEY]);
        }
    }
}