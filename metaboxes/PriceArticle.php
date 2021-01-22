<?php

class PriceArticle
{
    const META_KEY = 'catalogue_price_article';
    const NONCE = 'catalogue_price_nonce';

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
        wp_nonce_field(self::NONCE, self::NONCE)
        ?>
        <div style="padding-top: 16px;">
            <label class="components-base-control__label css-pezhm9-StyledLabel e1puf3u2" for="<?= self::META_KEY ?>">Ajouter
                un prix à l'article</label>
            <input class="components-text-control__input" name="<?= self::META_KEY ?>" id="<?= self::META_KEY ?>"
                   value="<?= $value ?>" type="number" min="0" step="0.01"/>
        </div>
        <?php
    }

    public static function save($post_id)
    {
        if (array_key_exists(self::META_KEY, $_POST) && wp_verify_nonce($_POST[self::NONCE], self::NONCE)) {
            update_post_meta($post_id, self::META_KEY, $_POST[self::META_KEY]);
        }
    }
}